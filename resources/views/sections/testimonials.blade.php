@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function (string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };

  $defaultAvatar = (function () {
    if (file_exists(public_path('images/profili1.jpg')))
      return asset('images/profili1.jpg');
    if (file_exists(public_path('images/home.jpg')))
      return asset('images/home.jpg');
    return asset('favicon.ico');
  })();

  $resolveAvatar = function (string $path) use ($defaultAvatar) {
    $path = ltrim($path, '/');
    return file_exists(public_path($path)) ? asset($path) : $defaultAvatar;
  };

  $items = [
    ['name' => 'Ahmed', 'role' => 'Startup Founder', 'quote' => 'Hamdi delivered our website faster than expected with a clear project plan. Felt like working with a whole team!', 'rating' => 5, 'avatar' => $resolveAvatar('images/avatar-a.png')],
    ['name' => 'Sarah', 'role' => 'Small Business Owner', 'quote' => 'Professional, responsive, and supportive. He guided me through the process step by step.', 'rating' => 5, 'avatar' => $resolveAvatar('images/avatar-s.png')],
    ['name' => 'Youssef', 'role' => 'Freelancer Partner', 'quote' => 'Great collaborator—technical skills plus project management, a rare mix!', 'rating' => 5, 'avatar' => $resolveAvatar('images/avatar-y.png')],
  ];
@endphp

<section id="testimonials" class="py-16 lg:py-24" @if($rtl) dir="rtl" @endif aria-labelledby="testimonials-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    <!-- Section Header -->
    <header class="mb-12 text-center">
              <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500">
                Client Stories
            </h2>
      <p class="section-subtitle mx-auto">{{ $tr('testimonials.subtitle', 'What my clients say about working with me') }}
      </p>
    </header>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($items as $i => $t)
        <figure class="glass-card glass-card-hover p-6 relative animate-fade-in-up"
          style="animation-delay: {{ $i * 0.1 }}s;">
          <!-- Quote icon -->
          <div class="absolute -top-3 -left-3 w-10 h-10 rounded-full bg-[#FFD700]/20 flex items-center justify-center">
            <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
            </svg>
          </div>

          <blockquote class="text-[#A0A0A0] leading-relaxed mb-6 pl-4">
            "{{ $t['quote'] }}"
          </blockquote>

          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-[#00FF88]/30">
              <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
              <figcaption class="font-bold text-[#E8E8E8]">{{ $t['name'] }}</figcaption>
              <p class="text-sm text-[#7B61FF]">{{ $t['role'] }}</p>
            </div>
          </div>

          <!-- Star rating -->
          <div class="flex gap-1 mt-4" aria-label="{{ $t['rating'] }} out of 5 stars">
            @for($s = 1; $s <= 5; $s++)
              <svg class="w-4 h-4 {{ $s <= $t['rating'] ? 'text-[#FFD700]' : 'text-[#333]' }}" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            @endfor
          </div>
        </figure>
      @endforeach
    </div>
  </div>
</section>