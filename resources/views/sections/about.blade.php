@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function (string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
@endphp

<section id="about" class="py-10 lg:py-14 relative overflow-hidden mlp-bg-root border-t border-mlp-border-subtle/50"
  @if($rtl) dir="rtl" @endif aria-labelledby="about-heading">

  <!-- Background Elements -->
  <div class="absolute top-0 right-0 w-1/3 h-full bg-brand-accent/5 blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-brand-primary/10 blur-3xl pointer-events-none"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">

    <!-- Header with integrated image - Horizontal Layout -->
    <div class="mlp-glass-subtle rounded-mlp-md border border-mlp-border-subtle/60 overflow-hidden mb-8"
      data-animate="about-header">
      <div class="flex flex-col md:flex-row gap-6 md:gap-8 p-6 md:p-8">
        <!-- Profile Image -->
        <div class="relative group/img flex-shrink-0">
          <div
            class="w-[280px] h-[360px] overflow-hidden rounded-xl border border-mlp-border-subtle/60 shadow-mlp-laser-green">
            <div
              class="absolute inset-0 mlp-laser-orbit group-hover/img:opacity-80 transition-opacity duration-500 z-10">
            </div>
            <img src="{{ asset('images/portfoliopicture/profili1.jpg') }}?v={{ time() }}" alt="Hamdi Zine"
              class="w-full h-full object-cover object-top transform group-hover/img:scale-110 transition-transform duration-700"
              style="object-position: center 15%;">
          </div>
          <!-- Status badge -->
          <div
            class="absolute -bottom-2 -right-2 z-20 mlp-glass-subtle border border-mlp-border-subtle/60 px-2 py-1 rounded-lg shadow-mlp-laser-green text-xs">
            <span class="text-brand-accent font-bold">{{ $tr('about.badge_status', 'Open for Projects') }}</span>
          </div>
        </div>

        <!-- Text content -->
        <div class="flex-1">
          <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-brand-accent/20 bg-brand-accent/5 backdrop-blur-sm mb-3">
            <span class="w-2 h-2 rounded-full bg-brand-accent animate-pulse"></span>
            <span class="text-brand-accent text-xs font-mono tracking-wider">{{ $tr('about.badge', 'WHO I AM') }}</span>
          </div>
          <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3">
            {{ $tr('about.title', 'Laravel Developer &') }} <br>
            <span class="font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#00FF88] to-[#FFD700]"
              style="background: linear-gradient(to right, #00FF88, #FFD700); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $tr('about.title_gradient', 'Digital Solutions Architect') }}</span>
          </h2>
          <p class="text-white/80 text-sm md:text-base leading-relaxed mb-4">
            {{ $tr('about.description', 'I\'m Hamdi Zine, a Laravel full-stack developer specializing in AI-powered business automation and premium digital experiences. Based in Kairouan, Tunisia, I deliver enterprise-grade web platforms, e-commerce solutions, and olive oil export branding for clients across the Gulf region. With proven expertise in multi-vendor marketplaces, booking systems, and automated workflows, I bring the complete development team experience as one dedicated professional.') }}
          </p>

          <!-- CV Download Button -->
          <a href="#"
            class="inline-flex items-center gap-2 px-6 py-3 bg-brand-accent text-brand-primary font-bold rounded-xl hover:bg-brand-accent/90 transition-all shadow-[0_0_20px_rgba(0,255,136,0.3)]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            {{ $tr('about.cta_cv', 'Download My CV') }}
          </a>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

      <!-- Content Column -->
      <div class="space-y-6">

        <!-- Skills Grid -->
        <div class="mlp-card mlp-metal-sheen border border-mlp-border-subtle/70 p-6" data-animate="about-skills">
          <h3 class="text-white font-bold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            {{ $tr('about.skills_title', 'Core Superpowers') }}
          </h3>
          <div class="flex flex-wrap gap-3">
            @php
              $skills = __('about.skills');
              if (!is_array($skills) || $skills === 'about.skills') {
                $skills = ['Laravel Expert', 'Vue.js & Tailwind', 'AI Automation', 'E-commerce Platforms', 'Multi-vendor Systems', 'API Development'];
              }
            @endphp
            @foreach($skills as $skill)
              <span
                class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 text-sm hover:border-brand-accent/50 hover:text-brand-accent transition-colors cursor-default">
                {{ $skill }}
              </span>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Second Column -->
      <div class="space-y-6">

        <!-- How I Work -->
        <div class="mlp-card-strong mlp-metal-sheen rounded-2xl p-6 border border-mlp-border-subtle/70"
          data-animate="about-process">
          <h3 class="text-white font-bold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
            {{ $tr('about.process_title', 'How I Work') }}
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @php
              $process = __('about.process');
              if (!is_array($process) || $process === 'about.process') {
                $process = [
                  ['number' => '01.', 'title' => 'Discover', 'desc' => 'Understand your business goals and technical requirements.'],
                  ['number' => '02.', 'title' => 'Build', 'desc' => 'Develop scalable solutions with clean code and best practices.'],
                  ['number' => '03.', 'title' => 'Launch', 'desc' => 'Deploy with full documentation, training, and ongoing support.']
                ];
              }
            @endphp
            @foreach($process as $step)
              <div class="space-y-2">
                <span class="text-brand-accent font-black text-xl">{{ $step['number'] }}</span>
                <h4 class="text-white font-bold text-sm">{{ $step['title'] }}</h4>
                <p class="text-white/60 text-xs">{{ $step['desc'] }}</p>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </div>
</section>