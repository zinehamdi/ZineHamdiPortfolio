@props([
  'variant' => 'primary',
  'href' => null,
  'type' => 'button'
])
@php
  $base = 'inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';
  $v = in_array($variant, ['primary', 'outline']) ? $variant : 'primary';
  $styles = [
    'primary' => 'bg-[#00FF88] text-[#0a0a0f] hover:bg-[#00FF88]/90 hover:shadow-lg hover:shadow-[#00FF88]/25',
    'outline' => 'border border-white/20 bg-transparent text-[#E8E8E8] hover:border-[#00FF88]/50 hover:text-[#00FF88]',
  ][$v] ?? 'bg-[#00FF88] text-[#0a0a0f] hover:bg-[#00FF88]/90';
  $class = $base . ' ' . $styles;
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
