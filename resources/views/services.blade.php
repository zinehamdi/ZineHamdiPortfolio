@extends('layouts.portfolio')

@section('title', __('services.page_title'))
@section('meta_description', __('services.page_desc'))

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <!-- Promotion / Trust section -->
    <section class="py-16 lg:py-20" aria-labelledby="promo-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
                <header class="mb-8">
                    <h2 id="promo-heading" class="text-[#1b1b18] uppercase font-black text-3xl mb-2">{{ __('services.promo.title', [], app()->getLocale()) ?? 'Why work with me' }}</h2>
                    <p class="text-[#1b1b18]/80">{{ __('services.promo.subtitle', [], app()->getLocale()) ?? 'A reliable full‑stack partner focused on your business outcomes — not just code.' }}</p>
                </header>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article class="bg-white rounded-2xl p-6 section-shadow">
                        <h3 class="font-bold text-[#1b1b18] mb-2">{{ __('services.promo.benefits.0.title', [], app()->getLocale()) ?? 'End‑to‑end delivery' }}</h3>
                        <p class="text-[#1b1b18]/80">{{ __('services.promo.benefits.0.desc', [], app()->getLocale()) ?? 'From strategy and UX to Laravel builds, hosting, and maintenance.' }}</p>
                    </article>
                    <article class="bg-white rounded-2xl p-6 section-shadow">
                        <h3 class="font-bold text-[#1b1b18] mb-2">{{ __('services.promo.benefits.1.title', [], app()->getLocale()) ?? 'Agile & transparent' }}</h3>
                        <p class="text-[#1b1b18]/80">{{ __('services.promo.benefits.1.desc', [], app()->getLocale()) ?? 'Short iterations, clear demos, and frequent check‑ins so you stay in control.' }}</p>
                    </article>
                    <article class="bg-white rounded-2xl p-6 section-shadow">
                        <h3 class="font-bold text-[#1b1b18] mb-2">{{ __('services.promo.benefits.2.title', [], app()->getLocale()) ?? 'AI where it matters' }}</h3>
                        <p class="text-[#1b1b18]/80">{{ __('services.promo.benefits.2.desc', [], app()->getLocale()) ?? 'Practical AI integrations to automate tasks and cut costs — no hype.' }}</p>
                    </article>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div class="bg-white rounded-xl p-4 text-center">
                        <div class="text-3xl font-extrabold text-[#1b1b18]">20+</div>
                        <div class="text-sm text-[#1b1b18]/70">{{ __('services.promo.metrics.projects', [], app()->getLocale()) ?? 'projects shipped' }}</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center">
                        <div class="text-3xl font-extrabold text-[#1b1b18]">5y</div>
                        <div class="text-sm text-[#1b1b18]/70">{{ __('services.promo.metrics.experience', [], app()->getLocale()) ?? 'experience' }}</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center">
                        <div class="text-3xl font-extrabold text-[#1b1b18]">98%</div>
                        <div class="text-sm text-[#1b1b18]/70">{{ __('services.promo.metrics.satisfaction', [], app()->getLocale()) ?? 'client satisfaction' }}</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center">
                        <div class="text-3xl font-extrabold text-[#1b1b18]">24h</div>
                        <div class="text-sm text-[#1b1b18]/70">{{ __('services.promo.metrics.response', [], app()->getLocale()) ?? 'average response' }}</div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="{{ route('services', ['locale' => app()->getLocale()]) }}#quote" class="inline-flex items-center gap-2 bg-[#FFA400] hover:bg-[#1b1b18] text-[#1b1b18] hover:text-white px-6 py-3 rounded-lg font-bold transition">
                        {{ __('services.promo.cta', [], app()->getLocale()) ?? __('services.cta_quote') }}
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 lg:py-20" aria-labelledby="services-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
                <header class="mb-8">
                    <h1 id="services-heading" class="text-[#1b1b18] uppercase font-black text-4xl mb-2">{{ __('services.page_title') }}</h1>
                    <p class="text-[#1b1b18]/80">{{ __('services.page_desc') }}</p>
                </header>

                @php
                    // You can later fetch from DB: App\Models\Service::where('is_active', true)->take(6)->get()
                    $cards = (array) __('services.cards');
                    $pick = ['site-management','laravel-development','ai-prompting'];
                    $services = collect($pick)->map(fn($k) => [
                            'title' => $cards[$k]['title'] ?? '',
                            'summary' => $cards[$k]['summary'] ?? '',
                            'icon' => match($k) {
                                    'site-management' => '🛠️',
                                    'laravel-development' => '⚙️',
                                    'ai-prompting' => '🤖',
                                    'social-content' => '📝',
                                    'seo' => '📈',
                                    default => '⭐',
                            }
                    ])->toArray();
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($services as $s)
                        <x-service-card :title="$s['title']" :summary="$s['summary']" :icon="$s['icon']">
                            <a href="{{ route('services', ['locale' => app()->getLocale()]) }}?package={{ Str::contains(Str::lower($s['title']), 'laravel') ? 'smart' : (Str::contains(Str::lower($s['title']), 'ai') ? 'pro' : 'starter') }}#quote" class="mt-3 inline-flex items-center gap-2 text-[#1b1b18] hover:opacity-80 font-semibold flex-dir-rr">
                                {{ __('services.cta_quote') }}
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                            </a>
                        </x-service-card>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-8" aria-labelledby="pricing-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
                <header class="mb-8">
                    <h2 id="pricing-heading" class="text-[#1b1b18] uppercase font-black text-3xl mb-2">{{ __('services.pricing.title') }}</h2>
                    <p class="text-[#1b1b18]/80">{{ __('services.pricing.subtitle') }}</p>
                </header>
                @php($tiers = (array) __('services.pricing.tiers'))
                <x-pricing-table :tiers="$tiers" />
                <div id="quote" class="mt-12">
                    @livewire('quote-wizard')
                </div>
            </div>
        </div>
    </section>
@endsection
