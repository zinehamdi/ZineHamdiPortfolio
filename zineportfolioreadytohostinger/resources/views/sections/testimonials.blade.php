@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
  $items = [
    [
      'name' => 'Ahmed',
      'role' => 'Startup Founder',
      'quote' => 'Hamdi delivered our website faster than expected with a clear project plan. Felt like working with a whole team!',
      'rating' => 5,
  'avatar' => 'https://via.placeholder.com/60x60/1b1b18/FFA400?text=A',
      'alt' => 'Ahmed avatar',
    ],
    [
      'name' => 'Sarah',
      'role' => 'Small Business Owner',
      'quote' => 'Professional, responsive, and supportive. He guided me through the process step by step.',
      'rating' => 5,
  'avatar' => 'https://via.placeholder.com/60x60/1b1b18/FFA400?text=S',
      'alt' => 'Sarah avatar',
    ],
    [
      'name' => 'Youssef',
      'role' => 'Freelancer Partner',
      'quote' => 'Great collaborator—technical skills plus project management, a rare mix!',
      'rating' => 5,
  'avatar' => 'https://via.placeholder.com/60x60/1b1b18/FFA400?text=Y',
      'alt' => 'Youssef avatar',
    ],
  ];
@endphp

<section id="testimonials" class="py-16 lg:py-20" @if($rtl) dir="rtl" @endif aria-labelledby="testimonials-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
          <header class="mb-8">
            <h2 id="testimonials-heading" class="text-[#1b1b18] uppercase font-black text-4xl mb-4">{{ $tr('testimonials.title','Testimonials') }}</h2>
          </header>

          <!-- Testimonials Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($items as $t)
              <figure class="bg-[#1b1b18] text-white rounded-xl p-6 section-shadow transition-all duration-300">
                <div class="flex items-center gap-4 mb-4">
                  <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-[#FFA400]/20">
                    <img src="{{ $t['avatar'] }}" alt="{{ $t['alt'] ?? '' }}" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <figcaption class="font-bold leading-tight">{{ $t['name'] }}</figcaption>
                    <p class="text-sm text-white/70 leading-snug">{{ $t['role'] }}</p>
                  </div>
                </div>
                <blockquote class="text-white/90 leading-relaxed mb-3">"{{ $t['quote'] }}"</blockquote>
                <div class="text-[#FFA400]" aria-label="{{ $t['rating'] }} out of 5 stars">
                  @for($i=1;$i<=5;$i++)
                    <span aria-hidden="true">{{ $i <= $t['rating'] ? '★' : '☆' }}</span>
                  @endfor
                </div>
              </figure>
            @endforeach
          </div>
    </div>
  </div>
</section>
