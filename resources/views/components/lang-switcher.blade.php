@props([
  'class' => '',
  'labels' => ['ar' => 'العربية', 'en' => 'EN', 'fr' => 'FR'],
  // tone: 'light' for light backgrounds, 'dark' when placed on dark navbar
  'tone' => 'light',
])
@php
  $supported = ['en','fr','ar'];
  $path = request()->path();
  $segments = explode('/', trim($path, '/'));
  $tail = $segments && in_array($segments[0], $supported) ? implode('/', array_slice($segments, 1)) : implode('/', $segments);
  // Prevent leaking into admin or other non-public namespaces when switching language.
  $allowedFirst = ['', 'home', 'about','services','packages','portfolio','blog','contact','quote'];
  $first = $tail === '' ? '' : explode('/', $tail)[0];
  if ($first && !in_array($first, $allowedFirst, true)) {
      $tail = ''; // reset to homepage for language switch
  }
  $qs = request()->getQueryString();
  $qsPart = $qs ? ('?'.$qs) : '';
@endphp
<div {{ $attributes->merge(['class' => $class]) }}>
  @foreach($labels as $lang => $label)
    @php
      $is = app()->getLocale() === $lang;
      if ($tone === 'dark') {
        $classes = $is
          ? 'bg-[#FFA400] text-[#1b1b18] border-transparent'
          : 'text-white/90 border-white/30 hover:bg-white/10';
      } else { // light
        $classes = $is
          ? 'bg-[#1b1b18] text-[#FFA400] border-[#1b1b18]'
          : 'text-[#1b1b18] border-[#1b1b18] hover:bg-black/5';
      }
    @endphp
    <a href="{{ url('/'.$lang.($tail ? '/'.$tail : '')) }}{{ $qsPart }}"
       class="px-2.5 py-1.5 rounded-lg text-xs border {{ $classes }}"
       aria-current="{{ $is ? 'true' : 'false' }}"
       aria-label="{{ __('common.lang.switch_to', ['lang' => $label]) }}">
      {{ $label }}
    </a>
  @endforeach
</div>
