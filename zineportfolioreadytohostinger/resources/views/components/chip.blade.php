@props(['variant' => 'light', 'as' => 'span'])
@php
  $base = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium ring-1 ring-inset';
  $variants = [
    'light' => 'bg-[#FFF7ED] text-[#1b1b18] ring-[#FDE68A]', // warm light amber chip
    'brand' => 'bg-amber-100 text-[#1b1b18] ring-amber-200',
  'premium' => 'bg-brand-accent text-white ring-amber-300/30',
    'outline' => 'bg-white text-[#1b1b18] ring-[#e3e3e0]'
  ];
  $class = $base.' '.($variants[$variant] ?? $variants['light']);
@endphp
<{{ $as }} {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</{{ $as }}>
