@props(['icon' => null, 'title', 'summary', 'href' => null])
<article {{ $attributes->merge(['class' => 'bg-white rounded-2xl p-6 flex flex-col gap-3 border border-brand-ink/10 section-shadow']) }}>
  <header class="flex items-center gap-3 flex-dir-rr">
    @if($icon)
      <div class="shrink-0 text-2xl" aria-hidden="true">{!! $icon !!}</div>
    @endif
    <h3 class="text-lg font-semibold">{{ $title }}</h3>
  </header>
  <p class="text-gray-700">{{ $summary }}</p>
  @if($href)
    <div class="pt-2">
      <x-button variant="outline" href="{{ $href }}">{{ __('nav.learn_more') }}</x-button>
    </div>
  @endif
  {{ $slot }}
</article>
