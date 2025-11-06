@props(['packages' => null, 'tiers' => null])
@php use Illuminate\Support\Str; @endphp
@php
    // Normalize input: accept either 'packages' (models) or 'tiers' (arrays)
    $items = [];
    if (isset($packages) && is_iterable($packages)) {
        $items = $packages;
    } elseif (isset($tiers) && is_iterable($tiers)) {
        $items = $tiers;
    }
@endphp
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($items as $key => $item)
        @php
            // If it's an Eloquent model (Package), pull translated fields
            $isModel = is_object($item) && method_exists($item, 'getAttribute');
            $titleKey = $isModel ? null : ($item['title'] ?? null);
            $nameKey = $isModel ? null : ($item['name'] ?? null);
            $slug = $isModel
                ? $item->slug
                : ($item['slug'] ?? (is_string($key) ? $key : Str::slug(($titleKey ?? $nameKey ?? 'plan'))));
            $title = $isModel
                ? ($item->title[app()->getLocale()] ?? $item->title['en'] ?? '')
                : (($titleKey ?? $nameKey) ?? '');
            $subtitle = $isModel
                ? ($item->subtitle[app()->getLocale()] ?? $item->subtitle['en'] ?? '')
                : ($item['desc'] ?? ($item['subtitle'] ?? ''));
            $features = $isModel ? ($item->features ?? []) : ($item['features'] ?? []);
            $featured = $isModel ? (bool)$item->is_featured : (bool)($item['featured'] ?? false);
            $priceMonthly = $isModel ? $item->price_monthly : null;
            $priceOnce = $isModel ? $item->price_once : null;
            $currency = $isModel ? ($item->currency ?? 'TND') : null;
            $cta = $isModel ? __('quote.cta.start') : ($item['cta'] ?? __('quote.cta.start'));
            $quoteUrl = route('services', ['locale' => app()->getLocale()]) . '?package=' . $slug . '#quote';
        @endphp
    <div class="relative bg-white rounded-2xl p-6 flex flex-col text-center border section-shadow {{ $featured ? 'border-amber-400 ring-2 ring-amber-200/60' : 'border-[#e3e3e0]' }}">
            @if($featured)
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <x-badge variant="gold">{{ __('services.pricing.badge_featured') ?? 'Most Popular' }}</x-badge>
                </div>
            @endif
            <h3 class="text-2xl font-bold mb-1">{{ $title }}</h3>
            <p class="mb-4 text-gray-700">{{ $subtitle }}</p>
            <div class="text-3xl font-extrabold mb-5">
                @if($priceOnce)
                    {{ $priceOnce }} {{ $currency }}
                    @if($priceMonthly)
                        <span class="block text-sm font-medium text-gray-500 mt-1">+ {{ $priceMonthly }} {{ $currency }} / {{ __('month') }}</span>
                    @endif
                @elseif(!$isModel)
                    {{ $item['price'] ?? '' }}
                @endif
            </div>
            <ul class="mb-6 text-left space-y-2">
                @foreach($features as $feature)
                    @php
                        $text = is_array($feature) ? ($feature[app()->getLocale()] ?? $feature['en'] ?? reset($feature)) : $feature;
                    @endphp
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-amber-500 mt-0.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.25 7.25a1 1 0 01-1.414 0L3.296 9.217a1 1 0 111.414-1.414l3.04 3.04 6.543-6.543a1 1 0 011.41-.01z" clip-rule="evenodd"/></svg>
                        <span>{{ $text }}</span>
                    </li>
                @endforeach
            </ul>
            <x-button variant="primary" href="{{ $quoteUrl }}" class="mt-auto js-choose-package" data-package="{{ $slug }}">{{ $cta }}</x-button>
        </div>
    @endforeach
</div>
