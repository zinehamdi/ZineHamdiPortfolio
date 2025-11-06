@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };

  $education = [
    [
      'title' => 'B.Sc. in Computer Science',
      'org' => 'University of Kairouan',
      'period' => '2015 — 2018',
      'description' => 'Strong foundation in programming, databases, and software engineering.',
    ],
    [
      'title' => 'Full-Stack PHP Certification',
      'org' => 'Infinity Code',
      'period' => '2022',
      'description' => 'Practical training in Laravel, front-end, and deployment best practices.',
    ],
    [
      'title' => 'PMO & Scrum Master Certifications',
      'org' => '—',
      'period' => '2025',
      'description' => 'Professional project management and agile delivery methods.',
    ],
  ];

  $experience = [
    [
      'title' => 'Freelance Full-Stack Developer',
      'org' => 'Self-Employed',
      'period' => '2022 — Present',
      'description' => 'Building multilingual Laravel projects, e-commerce sites, and AI-integrated tools for small businesses.',
    ],
    [
      'title' => 'Store Supervisor',
      'org' => 'Restaurant Al Dakhilia',
      'period' => '2019 — 2021',
      'description' => 'Managed inventory and daily operations, strengthening organizational and leadership skills.',
    ],
    [
      'title' => 'Entrepreneur / Project Manager',
      'org' => 'Various Ventures',
      'period' => '2021 — Present',
      'description' => 'Leading projects such as TuniHub (services marketplace) and olive oil branding (Azayateen/SETPA).',
    ],
  ];
@endphp

<section id="resume" class="py-16 lg:py-20" @if($rtl) dir="rtl" @endif aria-labelledby="resume-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
          <header class="mb-8">
            <h2 id="resume-heading" class="text-[#1b1b18] uppercase font-black text-4xl mb-4">{{ $tr('resume.title','Resume') }}</h2>
          </header>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Education -->
            <div>
              <h3 class="text-lg uppercase font-black text-[#1b1b18] mb-6">{{ $tr('resume.education','Education') }}</h3>
              <div class="space-y-4">
                @foreach($education as $item)
                  <div class="bg-white rounded-xl p-6 section-shadow transition-all duration-300">
                    <h4 class="font-bold text-[#1b1b18] mb-2">{{ $item['title'] }}</h4>
                    <div class="text-sm text-[#1b1b18]/70 mb-2">{{ $item['org'] }} • {{ $item['period'] }}</div>
                    <p class="text-sm text-[#1b1b18]/80">{{ $item['description'] }}</p>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Experience -->
            <div>
              <h3 class="text-lg uppercase font-black text-[#1b1b18] mb-6">{{ $tr('resume.experience','Experience') }}</h3>
              <div class="space-y-4">
                @foreach($experience as $item)
                  <div class="bg-white rounded-xl p-6 section-shadow transition-all duration-300">
                    <h4 class="font-bold text-[#1b1b18] mb-2">{{ $item['title'] }}</h4>
                    <div class="text-sm text-[#1b1b18]/70 mb-2">{{ $item['org'] }} • {{ $item['period'] }}</div>
                    <p class="text-sm text-[#1b1b18]/80">{{ $item['description'] }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
    </div>
  </div>
</section>
