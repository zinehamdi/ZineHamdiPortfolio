@props([
  'variant' => 'primary', // primary | outline (legacy variants map to primary)
  'href' => null,
  'type' => 'button'
])

@php
  $base = 'inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';
  // Map any legacy variants to primary
  $v = in_array($variant, ['primary','outline']) ? $variant : 'primary';
  $styles = [
    'primary' => 'bg-brand-accent text-black hover:brightness-95',
    'outline' => 'border border-brand-ink/20 bg-white text-brand-ink hover:border-brand-ink/40',
  ][$v] ?? 'bg-brand-accent text-black hover:brightness-95';
  $class = $base.' '.$styles;
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
  </a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
  </button>
@endif
