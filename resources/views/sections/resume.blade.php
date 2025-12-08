@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function (string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };

  $education = [
    ['title' => 'B.Sc. in Computer Science', 'org' => 'University of Kairouan', 'period' => '2015 — 2018', 'description' => 'Strong foundation in programming, databases, and software engineering.'],
    ['title' => 'Full-Stack PHP Certification', 'org' => 'Infinity Code', 'period' => '2022', 'description' => 'Practical training in Laravel, front-end, and deployment best practices.'],
    ['title' => 'PMO & Scrum Master Certifications', 'org' => 'Professional', 'period' => '2025', 'description' => 'Professional project management and agile delivery methods.'],
  ];

  $experience = [
    ['title' => 'Freelance Full-Stack Developer', 'org' => 'Self-Employed', 'period' => '2022 — Present', 'description' => 'Building multilingual Laravel projects, e-commerce sites, and AI-integrated tools.'],
    ['title' => 'Store Supervisor', 'org' => 'Restaurant Al Dakhilia', 'period' => '2019 — 2021', 'description' => 'Managed inventory and daily operations, strengthening leadership skills.'],
    ['title' => 'Entrepreneur / Project Manager', 'org' => 'Various Ventures', 'period' => '2021 — Present', 'description' => 'Leading projects such as TuniHub and olive oil branding (Azayateen/SETPA).'],
  ];
@endphp

<section id="resume" class="py-16 lg:py-24" @if($rtl) dir="rtl" @endif aria-labelledby="resume-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    <!-- Section Header -->
    <header class="mb-12 text-center">
      <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#00FF88]/20">
        <span class="w-2 h-2 bg-[#FF6B35] rounded-full"></span>
        <span class="text-[#A0A0A0] text-sm font-mono">resume.json</span>
      </div>
      <h2 id="resume-heading" class="section-title mb-4">{{ $tr('resume.title', 'Resume') }}</h2>
      <p class="section-subtitle mx-auto">{{ $tr('resume.subtitle', 'My professional journey and qualifications') }}</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

      <!-- Education Column -->
      <div>
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 rounded-lg bg-[#7B61FF]/20 flex items-center justify-center">
            <svg class="w-5 h-5 text-[#7B61FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-[#E8E8E8]">{{ $tr('resume.education', 'Education') }}</h3>
        </div>

        <div class="space-y-4 relative">
          <!-- Timeline line -->
          <div
            class="absolute left-5 top-0 bottom-0 w-px bg-gradient-to-b from-[#7B61FF] via-[#7B61FF]/50 to-transparent">
          </div>

          @foreach($education as $i => $item)
            <div class="glass-card glass-card-hover p-5 ml-10 relative animate-fade-in-up"
              style="animation-delay: {{ $i * 0.1 }}s;">
              <!-- Timeline dot -->
              <div class="absolute -left-[30px] top-6 w-3 h-3 rounded-full bg-[#7B61FF] ring-4 ring-[#0a0a0f]"></div>

              <div class="flex items-start justify-between gap-4 mb-2">
                <h4 class="font-bold text-[#E8E8E8]">{{ $item['title'] }}</h4>
                <span class="text-xs font-mono text-[#7B61FF] whitespace-nowrap">{{ $item['period'] }}</span>
              </div>
              <p class="text-sm text-[#00FF88] mb-2">{{ $item['org'] }}</p>
              <p class="text-sm text-[#A0A0A0]">{{ $item['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Experience Column -->
      <div>
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 rounded-lg bg-[#00FF88]/20 flex items-center justify-center">
            <svg class="w-5 h-5 text-[#00FF88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-[#E8E8E8]">{{ $tr('resume.experience', 'Experience') }}</h3>
        </div>

        <div class="space-y-4 relative">
          <!-- Timeline line -->
          <div
            class="absolute left-5 top-0 bottom-0 w-px bg-gradient-to-b from-[#00FF88] via-[#00FF88]/50 to-transparent">
          </div>

          @foreach($experience as $i => $item)
            <div class="glass-card glass-card-hover p-5 ml-10 relative animate-fade-in-up"
              style="animation-delay: {{ ($i + 3) * 0.1 }}s;">
              <!-- Timeline dot -->
              <div class="absolute -left-[30px] top-6 w-3 h-3 rounded-full bg-[#00FF88] ring-4 ring-[#0a0a0f]"></div>

              <div class="flex items-start justify-between gap-4 mb-2">
                <h4 class="font-bold text-[#E8E8E8]">{{ $item['title'] }}</h4>
                <span class="text-xs font-mono text-[#00FF88] whitespace-nowrap">{{ $item['period'] }}</span>
              </div>
              <p class="text-sm text-[#7B61FF] mb-2">{{ $item['org'] }}</p>
              <p class="text-sm text-[#A0A0A0]">{{ $item['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>