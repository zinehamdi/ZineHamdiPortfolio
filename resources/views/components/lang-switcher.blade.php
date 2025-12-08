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
  // Allow switching on all pages by default
  // $allowedFirst logic removed to fix switcher behavior

  $qs = request()->getQueryString();
  $qsPart = $qs ? ('?'.$qs) : '';
@endphp
<div {{ $attributes->merge(['class' => $class]) }}>
  @foreach($labels as $lang => $label)
    @php
      $is = app()->getLocale() === $lang;
      if ($tone === 'dark') {
        $classes = $is
          ? 'bg-[#FFA400] text-[#1b1b18] border-[#FFA400] shadow-[0_0_12px_rgba(255,164,0,0.4)]'
          : 'text-white/80 bg-white/5 border-white/20 hover:border-[#FFA400]/50 hover:shadow-[0_0_8px_rgba(255,164,0,0.2)] hover:text-white';
      } else { // light
        $classes = $is
          ? 'bg-[#FFA400] text-[#1b1b18] border-[#FFA400] shadow-[0_0_12px_rgba(255,164,0,0.4)]'
          : 'text-[#A0A0A0] bg-[#1b1b18]/80 border-[#333]/60 hover:border-[#FFA400]/50 hover:shadow-[0_0_8px_rgba(255,164,0,0.2)] hover:text-[#FFA400]';
      }
    @endphp
    <a href="{{ url('/'.$lang.($tail ? '/'.$tail : '')) }}{{ $qsPart }}"
       class="px-2.5 py-1.5 rounded-lg text-xs border {{ $classes }} transition-all duration-300"
       aria-current="{{ $is ? 'true' : 'false' }}"
       aria-label="{{ __('common.lang.switch_to', ['lang' => $label]) }}">
      {{ $label }}
    </a>
  @endforeach
</div>
