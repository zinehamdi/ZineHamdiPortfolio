@props([
    'promoTitle' => null,
    'promoText' => null,
    'promoLink' => '#',
    'promoCta' => null,
    'promoImg' => null,
    'variant' => 'light',
])

@php
    $variant = $variant === 'dark' ? 'dark' : 'light';
    $title = $promoTitle ?? 'Daily Story';
    $text = $promoText ?? 'Share an update, a tip, or promote an offer here. You can customize this block content from config.';
    $link = $promoLink ?: '#';
    $cta = $promoCta ?? __('common.nav.blog');
    $image = $promoImg ?: asset('favicon.ico');

    $showMore = __('common.actions.show_more');
    if ($showMore === 'common.actions.show_more') {
        $showMore = 'Show more';
    }
    $showLess = __('common.actions.show_less');
    if ($showLess === 'common.actions.show_less') {
        $showLess = 'Show less';
    }

    $baseClasses = 'rounded-2xl transition-all duration-300';
    if ($variant === 'light') {
        $baseClasses .= ' bg-white section-shadow';
    } else {
        $baseClasses .= ' glass-card border border-white/10';
    }

    $titleClass = $variant === 'light' ? 'mt-5 text-2xl font-extrabold text-[#1b1b18]' : 'mt-5 text-2xl font-bold text-white';
    $bodyClass = $variant === 'light' ? 'text-[#1b1b18]/80 leading-relaxed' : 'text-gray-300 leading-relaxed';
    $moreButtonClass = $variant === 'light'
        ? 'mt-2 text-sm font-semibold underline underline-offset-2 text-[#1b1b18]/70 hover:text-[#1b1b18]'
        : 'mt-2 text-sm font-semibold text-brand-accent hover:text-brand-accent/80 underline underline-offset-4';
    $ctaClass = $variant === 'light'
        ? 'inline-flex items-center gap-2 px-5 py-3 bg-[#FFA400] text-[#1b1b18] font-bold rounded-lg hover:opacity-90 transition'
        : 'inline-flex items-center justify-between px-5 py-3 rounded-xl bg-brand-accent/20 border border-brand-accent/40 text-brand-accent font-semibold hover:bg-brand-accent/30 transition';
    $imageWrapperClass = $variant === 'light'
        ? 'rounded-xl overflow-hidden border border-[#1b1b18]/10'
        : 'rounded-xl overflow-hidden border border-white/10';
    $fadeStyle = $variant === 'light'
        ? 'background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));'
        : 'background: linear-gradient(to bottom, rgba(10,10,15,0), rgba(10,10,15,0.95));';

    $attrs = $attributes->class($baseClasses);
    if (!$attributes->has('x-data')) {
        $attrs = $attrs->merge(['x-data' => 'vlogCard']);
    }
@endphp

<div {{ $attrs }}>
    <div class="w-full" x-ref="card">
        <div class="{{ $imageWrapperClass }}">
            <img src="{{ $image }}" alt="Promo image" class="w-full h-56 object-cover">
        </div>
        <h3 class="{{ $titleClass }}">{{ $title }}</h3>
        <div class="relative mt-2">
            <div x-ref="textWrap" class="{{ $bodyClass }} overflow-hidden transition-all duration-300" :style="styleTextWrap()">
                {{ $text }}
            </div>
            <div class="pointer-events-none absolute left-0 right-0 bottom-0 h-8" x-show="!expanded" style="{{ $fadeStyle }}"></div>
            <button type="button" class="{{ $moreButtonClass }}" @click="toggle()">
                <span x-show="!expanded" aria-hidden="true">{{ $showMore }}</span>
                <span x-show="expanded" aria-hidden="true">{{ $showLess }}</span>
            </button>
        </div>
        <div class="mt-4">
            <a href="{{ $link }}" class="{{ $ctaClass }}">
                {{ $cta }}
                @if($variant === 'light')
                    <span aria-hidden="true">→</span>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12" />
                    </svg>
                @endif
            </a>
        </div>
    </div>
</div>
