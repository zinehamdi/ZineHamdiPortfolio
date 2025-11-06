@props(['variant' => 'gold'])
@php
  $base = 'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold';
  $variants = [
    'gold' => 'bg-gold/15 text-gold',
    'olive' => 'bg-olive-300/15 text-olive-600',
  'premium' => 'bg-brand-accent text-white',
  ];
@endphp
<span {{ $attributes->merge(['class' => $base.' '.($variants[$variant] ?? $variants['gold'])]) }}>
  {{ $slot }}
</span>
