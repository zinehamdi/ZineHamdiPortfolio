@props(['title' => null, 'subtitle' => null, 'id' => null, 'contained' => true])
<section @if($id) id="{{ $id }}" @endif {{ $attributes->merge(['class' => 'py-12']) }}>
  <div class="{{ $contained ? 'max-w-7xl mx-auto px-6' : '' }}">
    @if($title)
      <h2 class="uppercase font-black tracking-wide2 text-2xl mb-3 text-brand-ink">{{ $title }}</h2>
    @endif
    @if($subtitle)
      <p class="text-brand-ink/70 mb-8 max-w-3xl">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
  </div>
</section>
