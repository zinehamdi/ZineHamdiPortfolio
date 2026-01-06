@extends('layouts.portfolio')

@section('title', __('common.nav.blog'))
@section('meta_description', __('blog.subtitle'))

@section('content')
  <section id="blog" class="py-16 lg:py-24 mlp-bg-root" aria-labelledby="blog-heading">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

      <!-- Section Header -->
      <header class="mb-12 text-center">
        <!-- Hero Badge with Animated Glow -->
        <div class="relative inline-block mb-6">
          <!-- Animated glow background -->
          <div
            class="absolute -inset-1 bg-gradient-to-r from-[#00FF88] via-[#7B61FF] to-[#00BFFF] rounded-full opacity-40 blur-lg animate-pulse">
          </div>
          <div
            class="absolute -inset-0.5 bg-gradient-to-r from-[#00FF88] via-[#7B61FF] to-[#00BFFF] rounded-full opacity-60">
          </div>

          <!-- Badge content -->
          <div
            class="relative inline-flex items-center gap-3 px-6 py-3 rounded-full bg-[#0a0a0f]/95 backdrop-blur-xl border border-white/10">
            <!-- Animated pulse dot -->
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00FF88] opacity-75"></span>
              <span
                class="relative inline-flex rounded-full h-3 w-3 bg-[#00FF88] shadow-[0_0_12px_rgba(0,255,136,0.8)]"></span>
            </span>

            <!-- Icon -->
            <svg class="w-5 h-5 text-[#7B61FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>

            <!-- Text with gradient -->
            <span
              class="text-sm font-bold tracking-wider uppercase bg-gradient-to-r from-[#00FF88] via-[#7B61FF] to-[#00BFFF] bg-clip-text text-transparent">
              Technical Articles
            </span>

            <!-- Decorative right icon -->
            <svg class="w-4 h-4 text-[#00BFFF] animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>

        <h1 id="blog-heading" class="text-3xl md:text-5xl font-bold text-white mb-4 tracking-tight">{{ __('blog.title') }}
        </h1>
        <p class="text-white/70 max-w-2xl mx-auto text-lg">{{ __('blog.subtitle') }}</p>
      </header>

      {{-- Featured Promo Section --}}
      @php
        $promoData = \App\Support\PromoCard::current();
      @endphp
      @if($promoData['title'])
        <div class="mb-16">
          <div class="relative group">
            {{-- Animated glow border --}}
            <div
              class="absolute -inset-0.5 bg-gradient-to-r from-[#00FF88] via-[#7B61FF] to-[#00BFFF] rounded-2xl opacity-50 blur group-hover:opacity-75 transition-all duration-500">
            </div>

            <div class="relative mlp-card overflow-hidden rounded-2xl border border-white/10">
              <div class="grid md:grid-cols-2 gap-0">
                {{-- Promo Image --}}
                <div class="relative h-64 md:h-80 overflow-hidden">
                  <img src="{{ $promoData['image_url'] }}" alt="{{ $promoData['title'] }}"
                    class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-700">
                  <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#0a0a0f]/90"></div>
                  <div class="absolute top-4 left-4">
                    <span
                      class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#7B61FF]/90 backdrop-blur text-white text-xs font-bold uppercase tracking-wider">
                      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                      </svg>
                      Featured
                    </span>
                  </div>
                </div>

                {{-- Promo Content --}}
                <div class="p-8 flex flex-col justify-center">
                  <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight">
                    {{ $promoData['title'] }}
                  </h2>
                  <p class="text-white/70 mb-6 line-clamp-3">
                    {{ $promoData['text'] }}
                  </p>
                  @if($promoData['link'])
                    <a href="{{ $promoData['link'] }}"
                      class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#00FF88] to-[#00BFFF] text-[#0a0a0f] font-bold text-sm hover:shadow-[0_0_30px_rgba(0,255,136,0.5)] transition-all duration-300 w-fit">
                      {{ $promoData['cta'] ?? __('common.learn_more') }}
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                      </svg>
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif

      @if($posts->isEmpty())
        <!-- No Posts Yet -->
        <div class="max-w-2xl mx-auto">
          <div class="mlp-card mlp-metal-sheen p-8 text-center border border-mlp-border-subtle/70">
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#7B61FF]/20 flex items-center justify-center">
              <svg class="w-10 h-10 text-[#7B61FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-3">{{ __('blog.coming_soon') }}</h2>
            <p class="text-white/60 mb-6">{{ __('blog.coming_soon_text') }}</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-6 py-3 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green inline-flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>{{ __('blog.back_to_home') }}</span>
              </a>
            </div>
          </div>
        </div>
      @else
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($posts as $post)
            <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}"
              class="block mlp-card mlp-metal-sheen overflow-hidden border border-mlp-border-subtle/70 hover:border-mlp-gold/70 hover:shadow-mlp-laser-green transition-all duration-300 group cursor-pointer">
              <article>
                <!-- Featured Image -->
                <div class="h-48 relative overflow-hidden">
                  @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}"
                      class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700">
                  @else
                    <div class="absolute inset-0 bg-gradient-to-br from-[#7B61FF]/30 to-[#00FF88]/20"></div>
                  @endif
                  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                  <div
                    class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-accent border border-brand-accent/30 shadow-[0_0_15px_rgba(0,255,136,0.4)]">
                    {{ $post->category }}
                  </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                  <div class="flex items-center gap-3 text-sm text-gray-500 mb-2">
                    <span>{{ $post->published_at?->format('M d, Y') }}</span>
                    <span>•</span>
                    <span>{{ $post->reading_time }} {{ __('blog.min_read') }}</span>
                  </div>
                  <h2 class="text-xl font-bold text-white mb-3 group-hover:text-brand-accent transition-colors">
                    {{ $post->title }}
                  </h2>
                  <p class="text-white/60 text-sm mb-4 line-clamp-2">
                    {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}
                  </p>
                  <span class="inline-flex items-center text-brand-accent font-bold text-sm group-hover:underline">
                    {{ __('blog.cta_read') }}
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                  </span>
                </div>
              </article>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
          <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
          </div>
        @endif
      @endif

    </div>
  </section>
@endsection