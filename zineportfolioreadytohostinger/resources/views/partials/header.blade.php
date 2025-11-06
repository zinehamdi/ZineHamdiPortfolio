<div class="bg-white/80 text-[#1b1b18] backdrop-blur">
  <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-4 flex items-center justify-between">
  @php $loc = app()->getLocale(); @endphp
  @php
    $brandLogo = file_exists(public_path('images/zinedev.png')) ? asset('images/zinedev.png') : asset('favicon.ico');
  @endphp
  <a href="{{ url('/'.$loc) }}" class="flex items-center gap-3 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70" aria-label="Home">
      <img src="{{ $brandLogo }}" alt="ZINDEV logo" class="h-9 w-9 rounded-xl object-contain bg-white" loading="lazy">
      <span class="text-base md:text-lg font-semibold text-[#1b1b18]">Hamdi Salem Zine</span>
    </a>

  <nav class="hidden md:flex items-center gap-6 text-[#1b1b18]/80" aria-label="Primary">
  <a href="{{ url('/'.$loc) }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('common.nav.home') }}</a>
  <a href="{{ url('/'.$loc).'#about' }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('common.nav.about') }}</a>
  <a href="{{ url('/'.$loc).'#resume' }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('resume.title') }}</a>
  <a href="{{ url('/'.$loc).'#portfolio' }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('common.nav.portfolio') }}</a>
  <a href="{{ url('/'.$loc).'#testimonials' }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('testimonials.title') }}</a>
  <a href="{{ url('/'.$loc).'#contact' }}" class="hover:text-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold/70">{{ __('common.nav.contact') }}</a>
    </nav>

    <div class="flex items-center gap-3">
      <x-lang-switcher class="flex gap-2" />
      @php
        $digits = preg_replace('/\D+/', '', (string) config('site.whatsapp_number'));
        $prefill = urlencode('Hello Hamdi, I need a quote');
        $wa = $digits ? ("https://wa.me/{$digits}?text={$prefill}") : null;
      @endphp
      @if($wa)
        <x-button variant="primary" href="{{ $wa }}" target="_blank">{{ __('messages.whatsapp') }}</x-button>
      @endif
    </div>
  </div>
</div>
