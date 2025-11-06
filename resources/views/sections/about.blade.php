@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
@endphp

<section id="about" class="py-12 lg:py-20" @if($rtl) dir="rtl" @endif aria-labelledby="about-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
  <div class="bg-[#dbdbd7] p-5 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
          <header class="mb-6 lg:mb-8">
            <h2 id="about-heading" class="text-[#1b1b18] uppercase font-black text-2xl sm:text-3xl lg:text-4xl mb-3">{{ $tr('about.title','About Me') }}</h2>
            <p class="text-[#1b1b18]/80 text-lg sm:text-xl">{{ $tr('about.subtitle','I’m Hamdi Zine — a full-stack developer, project manager, and digital builder') }}</p>
          </header>

          <p class="text-[#1b1b18]/80 text-base sm:text-lg leading-relaxed mb-6 lg:mb-8">
            {{ $tr('about.bio','Based in Tunisia, I bring 5+ years of experience in web development, business management, and agile project delivery. I specialize in building multilingual Laravel websites, integrating AI-powered features, and leading small projects with a professional touch. My mission is to give entrepreneurs affordable, complete solutions without the overhead of a big team.') }}
          </p>

          <!-- Metrics Grid -->
          <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:gap-6 mb-5 lg:mb-8">
            @php $metrics = [
              ['value' => '5+', 'label' => $tr('about.metrics.years','YEARS IN WEB DEV')],
              ['value' => '20+', 'label' => $tr('about.metrics.projects','PROJECTS DELIVERED')],
              ['value' => '10+', 'label' => $tr('about.metrics.partners','HAPPY BUSINESS PARTNERS')],
              ['value' => '3', 'label' => $tr('about.metrics.certs','CERTIFICATIONS (Full-Stack, PMO, Scrum)')],
            ]; @endphp
            @foreach($metrics as $m)
              <div class="bg-white rounded-xl p-4 sm:p-6 text-center section-shadow transition-all duration-300">
                <div class="text-2xl sm:text-3xl font-black text-[#1b1b18] mb-2">{{ $m['value'] }}</div>
                <div class="text-xs sm:text-sm uppercase font-bold text-[#1b1b18]/70">{{ $m['label'] }}</div>
              </div>
            @endforeach
          </div>

          <!-- What I Do Section -->
          <div class="bg-white rounded-xl p-5 sm:p-6 section-shadow transition-all duration-300">
            <h3 class="text-lg uppercase font-black text-[#1b1b18] mb-6">{{ $tr('about.what_i_do','What I Do?') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
              <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                  <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9L12 15L22 9L12 3M4 10.91L12 15.5L20 10.91V17L12 21.5L4 17V10.91Z"/></svg>
                </div>
                <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('about.do.webdev','WEB DEVELOPMENT') }}</h4>
                <p class="text-sm text-[#1b1b18]/70">{{ $tr('about.do.webdev_desc','Laravel, Vue, Angular, and full-stack PHP solutions designed for speed and security.') }}</p>
              </div>
              <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                  <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24"><path d="M9 2V4H4V6H9V8L12 5L9 2M15 8V6H20V4H15V2L12 5L15 8M4 18V20H9V22L12 19L9 16V18H4M15 16L12 19L15 22V20H20V18H15V16Z"/></svg>
                </div>
                <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('about.do.pm','PROJECT MANAGEMENT') }}</h4>
                <p class="text-sm text-[#1b1b18]/70">{{ $tr('about.do.pm_desc','Certified Scrum & PMO, I organize projects with clear backlogs, sprints, and results.') }}</p>
              </div>
              <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                  <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12C2 16.4 4.8 20.1 8.7 21.5L9.3 19.7C6.1 18.6 4 15.6 4 12C4 7.6 7.6 4 12 4C16.4 4 20 7.6 20 12C20 15.6 17.9 18.6 14.7 19.7L15.3 21.5C19.2 20.1 22 16.4 22 12C22 6.5 17.5 2 12 2M11 6V13L16.2 16.1L17 14.8L12.5 12.2V6H11Z"/></svg>
                </div>
                <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('about.do.ai','AI INTEGRATION') }}</h4>
                <p class="text-sm text-[#1b1b18]/70">{{ $tr('about.do.ai_desc','Custom chatbots, automation, and AI-assisted tools to make your business smarter.') }}</p>
              </div>
              <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                  <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13H11V3H3V13M3 21H11V15H3V21M13 21H21V11H13V21M13 3V9H21V3H13Z"/></svg>
                </div>
                <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('about.do.strategy','BUSINESS STRATEGY') }}</h4>
                <p class="text-sm text-[#1b1b18]/70">{{ $tr('about.do.strategy_desc','Helping entrepreneurs shape ideas into actionable plans, from concept to launch.') }}</p>
              </div>
            </div>
          </div>
    </div>
  </div>
</section>
