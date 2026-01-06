<section id="home" class="mlp-bg-root min-h-screen text-mlp-text-main overflow-hidden">
  <div class="absolute inset-0 pointer-events-none">
    <div class="mlp-bg-metal opacity-70"></div>
    <div class="mlp-laser-grid"></div>
    <div class="mlp-lens-glow"></div>
  </div>

  <div
    class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-0 py-14 sm:py-16 lg:py-20 grid lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] gap-10 lg:gap-16 items-center">
    <div class="space-y-8">
      <div
        class="inline-flex items-center gap-2 px-3 py-1 rounded-mlp-pill mlp-glass-subtle border border-mlp-border-subtle/70 text-xs sm:text-sm shadow-mlp-laser-green"
        data-animate="hero-badge">
        <span class="w-1.5 h-1.5 rounded-full bg-mlp-laser-green animate-ping"></span>
        <span class="text-mlp-text-muted">{{ __("hero.badge") }}</span>
      </div>

      <div class="space-y-3" data-animate="hero-title">
        <h1
          class="text-5xl sm:text-7xl lg:text-8xl font-display font-black tracking-tight text-mlp-text-main mlp-metal-sheen">
          {{ __("hero.brand") }}
        </h1>
        <p class="text-lg sm:text-xl font-bold text-mlp-laser-green tracking-[0.25em] uppercase">
          {{ __("hero.tagline") }}
        </p>
        @php
          $typingTexts = __("hero.typing_texts");
          $typingTextsJson = json_encode($typingTexts);
        @endphp
        <div class="h-8 sm:h-10 overflow-hidden text-base sm:text-xl font-mono text-mlp-text-muted">
          <span x-data="{
              text: '',
              textArray: {{ $typingTextsJson }},
              typeSpeed: 100,
              deleteSpeed: 50,
              waitSpeed: 2000,
              textIndex: 0,
              charIndex: 0,
              isDeleting: false,
              type() {
                  const current = this.textIndex % this.textArray.length;
                  const fullTxt = this.textArray[current];
                  if (this.isDeleting) {
                      this.text = fullTxt.substring(0, this.charIndex - 1);
                      this.charIndex--;
                  } else {
                      this.text = fullTxt.substring(0, this.charIndex + 1);
                      this.charIndex++;
                  }
                  let speed = this.typeSpeed;
                  if (this.isDeleting) { speed /= 2; }
                  if (!this.isDeleting && this.text === fullTxt) {
                      speed = this.waitSpeed; this.isDeleting = true;
                  } else if (this.isDeleting && this.text === '') {
                      this.isDeleting = false; this.textIndex++; speed = 500;
                  }
                  setTimeout(() => this.type(), speed);
              }
          }" x-init="type()">
            <span x-text="text"></span><span class="text-mlp-laser-green">_</span>
          </span>
        </div>
      </div>

      <p class="text-sm sm:text-base text-white/90 max-w-2xl mlp-glass-subtle p-4 rounded-mlp-md border border-mlp-border-subtle/60"
        data-animate="hero-body">
        {!! __("hero.description", [
  'laravel' => '<span class="text-mlp-laser-green">' . __("hero.description_laravel") . '</span>',
  'ai' => '<span class="text-mlp-laser-green">' . __("hero.description_ai") . '</span>',
  'business' => '<span class="text-mlp-laser-green">' . __("hero.description_business") . '</span>'
]) !!}
      </p>

      <div class="flex flex-wrap gap-4" data-animate="hero-cta">
        <a href="#projects"
          class="mlp-btn-gold flex items-center gap-2 px-6 py-3 rounded-mlp-md shadow-mlp-laser-green">
          <span>{{ __("hero.cta_work") }}</span>
          <span class="w-2 h-2 rounded-full bg-mlp-laser-green"></span>
        </a>
        <a href="#contact" class="mlp-btn-laser px-6 py-3 text-sm font-semibold">
          {{ __("hero.cta_contact") }}
        </a>
        <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
          class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-6 py-3 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
          </svg>
          {{ __("hero.cta_blog") }}
        </a>
      </div>
    </div>

    <div class="relative" data-animate="hero-card">
      <div
        class="mlp-card-strong mlp-laser-orbit mlp-metal-sheen p-4 sm:p-6 rounded-mlp-xl overflow-hidden shadow-mlp-laser-blue">
        <div class="absolute inset-x-8 sm:inset-x-12 top-1/2 -translate-y-1/2 mlp-laser-beam"></div>
        <div
          class="absolute top-6 right-6 w-20 h-20 rounded-full overflow-hidden border-2 border-mlp-gold/70 shadow-mlp-laser-green mlp-laser-orbit z-20">
          <img src="{{ asset('images/portfoliopicture/profili2.jpg') }}" alt="Hamdi Zine"
            class="w-full h-full object-cover object-top" style="object-position: center 15%;">
        </div>
        <div class="relative z-10 space-y-4">
          <div
            class="flex items-center gap-3 mlp-glass-subtle rounded-mlp-md px-4 py-2 border border-mlp-border-subtle/70">
            <div class="w-3 h-3 rounded-full bg-red-500/40"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500/40"></div>
            <div class="w-3 h-3 rounded-full bg-green-500/40"></div>
            <span class="text-xs font-mono text-mlp-text-muted">zindev.php</span>
          </div>
          <div
            class="mlp-glass rounded-mlp-lg p-5 font-mono text-sm text-mlp-text-muted space-y-2 border border-mlp-border-subtle/70">
            <div><span class="text-mlp-laser-green">class</span> <span class="text-mlp-gold">Developer</span> {</div>
            <div class="pl-4"><span class="text-mlp-laser-green">public</span> $stack = [</div>
            <div class="pl-6">'backend' => <span class="text-mlp-gold">'Laravel'</span>,</div>
            <div class="pl-6">'frontend' => <span class="text-mlp-gold">'Tailwind'</span>,</div>
            <div class="pl-6">'mobile' => <span class="text-mlp-gold">'Flutter'</span>,</div>
            <div class="pl-6">'ai' => <span class="text-mlp-gold">'TensorFlow'</span></div>
            <div class="pl-4">];</div>
            <div class="pl-4"><span class="text-mlp-laser-green">public function</span> <span
                class="text-mlp-gold">create</span>() {</div>
            <div class="pl-6"><span class="text-mlp-laser-green">return</span> new <span
                class="text-mlp-gold">ProblemSolver</span>();</div>
            <div class="pl-4">}</div>
            <div>}</div>
          </div>
          <div class="grid grid-cols-3 gap-3 text-[0.75rem] text-mlp-text-muted">
            <div class="mlp-glass-subtle px-3 py-2 rounded-mlp-md text-center">
              <div class="text-mlp-text-main font-semibold">{{ __("hero.stats.years") }}</div>
              <div>{{ __("hero.stats.years_label") }}</div>
            </div>
            <div class="mlp-glass-subtle px-3 py-2 rounded-mlp-md text-center">
              <div class="text-mlp-text-main font-semibold">{{ __("hero.stats.stack") }}</div>
              <div>{{ __("hero.stats.stack_label") }}</div>
            </div>
            <div class="mlp-glass-subtle px-3 py-2 rounded-mlp-md text-center">
              <div class="text-mlp-text-main font-semibold">{{ __("hero.stats.specialty") }}</div>
              <div>{{ __("hero.stats.specialty_label") }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>