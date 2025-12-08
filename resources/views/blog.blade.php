@extends('layouts.portfolio')

@section('title', __('common.nav.blog'))
@section('meta_description', 'Articles and notes.')

@section('content')
  <section class="py-16 lg:py-24" aria-labelledby="blog-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

      <!-- Section Header -->
      <header class="mb-12 text-center">
        <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#00FF88]/20">
          <span class="w-2 h-2 bg-[#7B61FF] rounded-full"></span>
          <span class="text-[#A0A0A0] text-sm font-mono">blog.posts</span>
        </div>
        <h1 id="blog-heading" class="section-title mb-4">{{ __('common.nav.blog') }}</h1>
        <p class="section-subtitle mx-auto">Insights, tutorials, and updates from my development journey</p>
      </header>

      <!-- Coming Soon Card -->
      <div class="max-w-2xl mx-auto">
        <div class="glass-card glass-card-hover p-8 text-center">
          <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#7B61FF]/20 flex items-center justify-center">
            <svg class="w-10 h-10 text-[#7B61FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-[#E8E8E8] mb-3">Coming Soon</h2>
          <p class="text-[#A0A0A0] mb-6">I'm working on exciting articles about web development, AI integration, and
            project management. Stay tuned!</p>

          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}"
              class="btn-outline inline-flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              <span>Back to Portfolio</span>
            </a>
            <a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}#contact"
              class="btn-primary inline-flex items-center justify-center gap-2">
              <span>Get Notified</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection