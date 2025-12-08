@props(['packages' => null, 'tiers' => null])
@php use Illuminate\Support\Str; @endphp
@php
    $items = [];
    if (isset($packages) && is_iterable($packages)) {
        $items = $packages;
    } elseif (isset($tiers) && is_iterable($tiers)) {
        $items = $tiers;
    }

    $colors = ['#00FF88', '#00FF88', '#00FF88']; // Unified Neon Green
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($items as $i => $item)
        @php
            $isModel = is_object($item) && method_exists($item, 'getAttribute');
            $titleKey = $isModel ? null : ($item['title'] ?? null);
            $nameKey = $isModel ? null : ($item['name'] ?? null);
            $slug = $isModel
                ? $item->slug
                : ($item['slug'] ?? (is_string($i) ? $i : Str::slug(($titleKey ?? $nameKey ?? 'plan'))));
            $title = $isModel
                ? ($item->title[app()->getLocale()] ?? $item->title['en'] ?? '')
                : (($titleKey ?? $nameKey) ?? '');
            $subtitle = $isModel
                ? ($item->subtitle[app()->getLocale()] ?? $item->subtitle['en'] ?? '')
                : ($item['desc'] ?? ($item['subtitle'] ?? ''));
            $features = $isModel ? ($item->features ?? []) : ($item['features'] ?? []);
            $featured = $isModel ? (bool) $item->is_featured : (bool) ($item['featured'] ?? false);
            $priceMonthly = $isModel ? $item->price_monthly : null;
            $priceOnce = $isModel ? $item->price_once : null;
            $currency = $isModel ? ($item->currency ?? 'TND') : null;
            $cta = $isModel ? __('quote.cta.start') : ($item['cta'] ?? __('quote.cta.start'));
            $quoteUrl = route('home', ['locale' => app()->getLocale()]) . '?package=' . $slug . '#quote';
            $color = $colors[$i % 3];
        @endphp

        <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl border {{ $featured ? 'border-brand-accent shadow-[0_0_30px_rgba(0,255,136,0.15)]' : 'border-brand-accent/20' }} p-6 flex flex-col text-center group hover:scale-[1.02] transition-all duration-300 hover:border-brand-accent/50"
            style="animation-delay: {{ $i * 0.1 }}s;">
            @if($featured)
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-brand-accent text-brand-primary text-xs font-bold shadow-[0_0_15px_rgba(0,255,136,0.4)]">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        {{ __('services.pricing.badge_featured') ?? 'Most Popular' }}
                    </span>
                </div>
            @endif

            <div class="w-14 h-14 mx-auto mb-4 rounded-xl flex items-center justify-center bg-brand-accent/10 border border-brand-accent/20 group-hover:bg-brand-accent/20 transition-colors">
                <svg class="w-7 h-7 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $i === 0 ? 'M13 10V3L4 14h7v7l9-11h-7z' : ($i === 1 ? 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' : 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z') }}" />
                </svg>
            </div>

            <h3 class="text-xl font-bold text-white mb-2">{{ $title }}</h3>
            <p class="text-gray-400 text-sm mb-4">{{ $subtitle }}</p>

            <div class="mb-6">
                @if($priceOnce)
                    <div class="flex items-center justify-center gap-3">
                        <div class="text-3xl font-bold text-brand-accent">{{ $priceOnce }} {{ $currency }}</div>
                    </div>
                    @if($priceMonthly)
                        <div class="text-sm text-gray-500 mt-1">+ {{ $priceMonthly }} {{ $currency }}/{{ __('month') }}</div>
                    @endif
                @elseif(!$isModel)
                    @if(isset($item['original_price']) && $item['price'] !== 'Custom')
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="text-base text-white/40 line-through font-medium">{{ $item['original_price'] }}</span>
                            <span class="px-2 py-0.5 bg-red-500/20 text-red-400 text-xs font-bold rounded-full border border-red-400/40">-30%</span>
                        </div>
                    @endif
                    <div class="text-3xl font-bold text-brand-accent">{{ $item['price'] ?? '' }}</div>
                @endif
            </div>

            <ul class="mb-6 text-left space-y-3 flex-1">
                @foreach($features as $feature)
                    @php
                        $text = is_array($feature) ? ($feature[app()->getLocale()] ?? $feature['en'] ?? reset($feature)) : $feature;
                    @endphp
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-0.5 bg-brand-accent/10">
                            <svg class="w-3 h-3 text-brand-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $text }}</span>
                    </li>
                @endforeach
            </ul>

            <a href="{{ $quoteUrl }}"
                class="block w-full py-3 px-4 rounded-xl font-bold text-center transition-all duration-300 {{ $featured ? 'bg-brand-accent text-brand-primary hover:bg-brand-accent/90 shadow-[0_0_20px_rgba(0,255,136,0.3)]' : 'border-2 border-brand-accent/30 text-brand-accent hover:bg-brand-accent/10 hover:border-brand-accent/50' }} js-choose-package"
                data-package="{{ $slug }}">
                {{ $cta }}
            </a>
        </div>
    @endforeach
</div>