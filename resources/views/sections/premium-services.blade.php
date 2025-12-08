@php
  $rtl = app()->getLocale() === 'ar';
  $servicesData = __("services.services");
  // Fallback to default services if translation fails
  if (!is_array($servicesData)) {
    $servicesData = [
      ['title' => 'Laravel Full-Stack Development', 'desc' => 'Enterprise-grade web applications with robust backends, intuitive frontends, and scalable architecture. Complete project delivery from database design to deployment.'],
      ['title' => 'E-commerce & Multi-vendor Platforms', 'desc' => 'Custom online stores and marketplace solutions with payment integration, inventory management, and vendor dashboards. Specialized in Gulf market compliance.'],
      ['title' => 'AI-Powered Business Automation', 'desc' => 'Intelligent workflow automation, chatbots, and AI-assisted tools to streamline operations. Reduce manual work and scale your business efficiently.'],
      ['title' => 'API Development & Integration', 'desc' => 'RESTful APIs, third-party integrations, and microservices architecture. Connect your systems seamlessly with secure, documented endpoints.'],
      ['title' => 'Premium Branding & Label Design', 'desc' => 'Olive oil export packaging, product labels, and brand identity for Gulf markets. Specialized in luxury positioning and Arabic typography.'],
      ['title' => 'Booking & Reservation Systems', 'desc' => 'Service marketplace platforms with appointment scheduling, provider management, and automated notifications. Perfect for multi-vendor service businesses.'],
    ];
  }
  $services = $servicesData;
  $accents = ['mlp-laser-green', 'mlp-gold', 'mlp-laser-blue', 'mlp-laser-purple', 'mlp-gold', 'mlp-laser-green'];
  $svgIcons = [
    // Laravel Full-Stack
    '<svg class="w-16 h-16 text-mlp-laser-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
    // E-commerce
    '<svg class="w-16 h-16 text-mlp-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
    // AI Automation
    '<svg class="w-16 h-16 text-mlp-laser-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
    // API Development
    '<svg class="w-16 h-16 text-mlp-laser-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
    // Branding
    '<svg class="w-16 h-16 text-mlp-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>',
    // Booking Systems
    '<svg class="w-16 h-16 text-mlp-laser-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
  ];
  $categories = ['Development', 'E-commerce', 'AI & Automation', 'API', 'Branding', 'Booking'];
  $comicBackgrounds = [
    'comicbackground/laravelcomic1.jpg',
    'comicbackground/ecomercecomic1.jpg',
    'comicbackground/automationcomic.jpg',
    'comicbackground/apicomic.jpg',
    'comicbackground/brandingolivecomic.jpg',
    'comicbackground/reservationcomic2.jpg',
  ];
@endphp

<section id="services" class="premium-services mlp-bg-root border-t border-mlp-border-subtle/50" @if($rtl) dir="rtl" @endif>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-0 py-10 sm:py-12 lg:py-14 space-y-8">
    <div class="space-y-3" data-animate="services-header">
      <p class="text-xs uppercase tracking-[0.3em] text-mlp-text-muted">{{ __("services.section_label") }}</p>
      <h2 class="text-2xl sm:text-3xl lg:text-4xl font-display font-semibold text-mlp-text-main mlp-metal-sheen">{{ __("services.title") }}</h2>
      <p class="text-sm sm:text-base text-mlp-text-main/80 max-w-3xl mlp-glass-subtle p-4 rounded-mlp-md border border-mlp-border-subtle/60">
        {{ __("services.intro") }}
      </p>
    </div>

    <div class="grid gap-6 sm:gap-7 md:grid-cols-3" data-animate="services-grid">
      @foreach ($services as $index => $service)
        <article class="mlp-card mlp-metal-sheen border border-mlp-border-subtle/70 overflow-hidden flex flex-col hover:border-mlp-gold/70 transition-all duration-300 group" data-service="{{ $service['title'] }}">
          
          <!-- Image Header with Comic Background -->
          <div class="h-48 relative overflow-hidden">
            <!-- Comic Background Image -->
            <img src="{{ asset('images/' . $comicBackgrounds[$index]) }}" 
                 alt="{{ $service['title'] }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 group-hover:scale-110 transition-all duration-700">
            
            <!-- Overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/40 to-transparent"></div>
            
            <!-- Decorative grid pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,255,136,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
            
            <!-- Icon container -->
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="bg-black/30 backdrop-blur-sm p-4 rounded-2xl border border-{{ $accents[$index] }}/30 group-hover:scale-110 group-hover:border-{{ $accents[$index] }}/50 transition-all duration-500">
                {!! $svgIcons[$index] !!}
              </div>
            </div>
            
            <!-- Category badge -->
            <div class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-accent border border-brand-accent/30 shadow-[0_0_15px_rgba(0,255,136,0.4)]">
              {{ $categories[$index] }}
            </div>
          </div>

          <!-- Content -->
          <div class="p-6 sm:p-7 flex flex-col gap-4 flex-1">
            <div>
              <h3 class="text-lg font-semibold text-mlp-text-main group-hover:text-mlp-laser-green transition-colors">{{ $service['title'] }}</h3>
            </div>
            <p class="text-sm text-white/70 leading-relaxed flex-1">{{ $service['desc'] }}</p>
          
          <!-- CTA Button -->
          <div class="pt-3 border-t border-mlp-border-subtle/40">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#quote" 
               class="btn-primary w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-brand-accent text-brand-primary font-bold rounded-xl hover:bg-brand-accent/90 transition-all shadow-[0_0_20px_rgba(0,255,136,0.3)] group/btn">
              <span>{{ __('services.cta_select') ?? 'Select' }}</span>
              <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </a>
            <p class="text-center text-xs text-brand-accent/80 mt-2 font-semibold">
              {{ __('services.discount_badge') ?? '30% reduced prices' }}
            </p>
          </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
