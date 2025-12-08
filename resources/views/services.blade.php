@extends('layouts.portfolio')

@section('title', __('services.page_title'))
@section('meta_description', __('services.page_desc'))

@section('content')
    @php use Illuminate\Support\Str; @endphp
    
    <!-- Promotion / Trust section -->
    <section class="py-16 lg:py-20" aria-labelledby="promo-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Section Header -->
            <header class="mb-12 text-center">
                <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#00FF88]/20">
                    <span class="w-2 h-2 bg-[#00FF88] rounded-full"></span>
                    <span class="text-[#A0A0A0] text-sm font-mono">services.why</span>
                </div>
                <h2 id="promo-heading" class="section-title mb-4">{{ __('services.promo.title', [], app()->getLocale()) ?? 'Why work with me' }}</h2>
                <p class="section-subtitle mx-auto">{{ __('services.promo.subtitle', [], app()->getLocale()) ?? 'A reliable full‑stack partner focused on your business outcomes — not just code.' }}</p>
            </header>
            
            <!-- Benefits Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @php $benefits = [
                    ['title' => __('services.promo.benefits.0.title', [], app()->getLocale()) ?? 'End‑to‑end delivery', 'desc' => __('services.promo.benefits.0.desc', [], app()->getLocale()) ?? 'From strategy and UX to Laravel builds, hosting, and maintenance.', 'color' => '#00FF88', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['title' => __('services.promo.benefits.1.title', [], app()->getLocale()) ?? 'Agile & transparent', 'desc' => __('services.promo.benefits.1.desc', [], app()->getLocale()) ?? 'Short iterations, clear demos, and frequent check‑ins so you stay in control.', 'color' => '#7B61FF', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                    ['title' => __('services.promo.benefits.2.title', [], app()->getLocale()) ?? 'AI where it matters', 'desc' => __('services.promo.benefits.2.desc', [], app()->getLocale()) ?? 'Practical AI integrations to automate tasks and cut costs — no hype.', 'color' => '#FF6B35', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ]; @endphp
                @foreach($benefits as $i => $b)
                    <article class="glass-card glass-card-hover p-6 animate-fade-in-up" style="animation-delay: {{ $i * 0.1 }}s;">
                        <div class="w-12 h-12 rounded-xl mb-4 flex items-center justify-center" style="background: {{ $b['color'] }}20;">
                            <svg class="w-6 h-6" style="color: {{ $b['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $b['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-[#E8E8E8] mb-2">{{ $b['title'] }}</h3>
                        <p class="text-[#A0A0A0] text-sm">{{ $b['desc'] }}</p>
                    </article>
                @endforeach
            </div>
            
            <!-- Metrics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @php $metrics = [
                    ['value' => '50+', 'label' => __('services.promo.metrics.projects', [], app()->getLocale()) ?? 'projects shipped'],
                    ['value' => '5y', 'label' => __('services.promo.metrics.experience', [], app()->getLocale()) ?? 'experience'],
                    ['value' => '98%', 'label' => __('services.promo.metrics.satisfaction', [], app()->getLocale()) ?? 'client satisfaction'],
                    ['value' => '24h', 'label' => __('services.promo.metrics.response', [], app()->getLocale()) ?? 'average response'],
                ]; @endphp
                @foreach($metrics as $i => $m)
                    <div class="stat-card animate-fade-in-up" style="animation-delay: {{ 0.3 + ($i * 0.1) }}s;">
                        <div class="stat-value text-2xl">{{ $m['value'] }}</div>
                        <div class="stat-label">{{ $m['label'] }}</div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="{{ route('services', ['locale' => app()->getLocale()]) }}#quote" class="btn-primary inline-flex items-center gap-2 group">
                    {{ __('services.promo.cta', [], app()->getLocale()) ?? __('services.cta_quote') }}
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor"><path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="py-16 lg:py-20" aria-labelledby="services-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <header class="mb-12 text-center">
                <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#7B61FF]/20">
                    <span class="w-2 h-2 bg-[#7B61FF] rounded-full"></span>
                    <span class="text-[#A0A0A0] text-sm font-mono">services.list</span>
                </div>
                <h1 id="services-heading" class="section-title mb-4">{{ __('services.page_title') }}</h1>
                <p class="section-subtitle mx-auto">{{ __('services.page_desc') }}</p>
            </header>

            @php
                $cards = (array) __('services.cards');
                $pick = ['site-management','laravel-development','ai-prompting'];
                $icons = [
                    'site-management' => ['icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'color' => '#00FF88'],
                    'laravel-development' => ['icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'color' => '#7B61FF'],
                    'ai-prompting' => ['icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => '#FF6B35'],
                ];
                $services = collect($pick)->map(fn($k) => [
                    'key' => $k,
                    'title' => $cards[$k]['title'] ?? '',
                    'summary' => $cards[$k]['summary'] ?? '',
                    'icon' => $icons[$k]['icon'] ?? 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                    'color' => $icons[$k]['color'] ?? '#00FF88',
                ])->toArray();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($services as $i => $s)
                    <article class="glass-card glass-card-hover p-6 animate-fade-in-up" style="animation-delay: {{ $i * 0.1 }}s;">
                        <div class="w-14 h-14 rounded-xl mb-4 flex items-center justify-center transition-all group-hover:scale-110" style="background: {{ $s['color'] }}20;">
                            <svg class="w-7 h-7" style="color: {{ $s['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#E8E8E8] mb-2">{{ $s['title'] }}</h3>
                        <p class="text-[#A0A0A0] mb-4">{{ $s['summary'] }}</p>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}?package={{ Str::contains(Str::lower($s['title']), 'laravel') ? 'smart' : (Str::contains(Str::lower($s['title']), 'ai') ? 'pro' : 'starter') }}#quote" 
                           class="inline-flex items-center gap-2 text-[#00FF88] hover:text-[#7B61FF] font-semibold transition-colors group">
                            {{ __('services.cta_quote') }}
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor"><path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-16 lg:py-20" aria-labelledby="pricing-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <header class="mb-12 text-center">
                <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#FFD700]/20">
                    <span class="w-2 h-2 bg-[#FFD700] rounded-full"></span>
                    <span class="text-[#A0A0A0] text-sm font-mono">pricing.tiers</span>
                </div>
                <h2 id="pricing-heading" class="section-title mb-4">{{ __('services.pricing.title') }}</h2>
                <p class="section-subtitle mx-auto">{{ __('services.pricing.subtitle') }}</p>
            </header>
            @php($tiers = (array) __('services.pricing.tiers'))
            <x-pricing-table :tiers="$tiers" />
            <div id="quote" class="mt-12">
                @livewire('quote-wizard')
            </div>
        </div>
    </section>
@endsection
