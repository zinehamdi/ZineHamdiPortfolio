@props(['value', 'label'])
<div class="text-center p-4 bg-white/60 rounded-2xl">
  <div class="text-3xl md:text-4xl font-extrabold text-brand">{{ $value }}</div>
  <div class="text-sm text-gray-700">{{ $label }}</div>
  {{ $slot }}
</div>
