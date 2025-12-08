@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function (string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
@endphp

@php
  $bgImage = 'images/og/bgPortfolioImage.webp';
  if (!file_exists(public_path($bgImage))) {
    $bgImage = (file_exists(public_path('images/home.jpg')) ? 'images/home.jpg' : (file_exists(public_path('images/zinedev.png')) ? 'images/zinedev.png' : 'favicon.ico'));
  }
@endphp
<section id="home" class="relative min-h-screen flex items-center pt-20 lg:pt-0 bg-center bg-cover"
  style="background-image: url('{{ asset($bgImage) }}');" @if($rtl) dir="rtl" @endif>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-start lg:items-stretch">
      <!-- Left Panel - Text Content -->
      <div id="introCard"
        class="bg-white p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300 h-full">
        <h1 class="text-3xl sm:text-4xl lg:text-6xl font-black text-[#1b1b18] mb-4 lg:mb-6 leading-tight">
          <span class="block">{{ $tr('hero.greeting', 'WELCOME TO') }}</span>
          <span class="block text-[#FFA400]">{{ $tr('hero.name', 'ZINDEV') }}</span>
        </h1>
        <div class="bg-[#FFA400] text-[#1b1b18] px-4 sm:px-6 py-2 sm:py-3 rounded-lg mb-4 lg:mb-6 inline-block">
          <span
            class="font-bold text-base sm:text-lg">{{ $tr('hero.title', 'FULL-STACK WEB DEVELOPER & PROJECT MANAGER') }}</span>
        </div>
        <p class="text-[#1b1b18]/80 text-base sm:text-lg leading-relaxed mb-6 lg:mb-8">
          {{ $tr('hero.description', 'I’m a one-man full-stack team helping small businesses grow online. From strategy to code, I build clean, modern Laravel + Vue solutions, integrate AI tools, and manage projects end-to-end with agile methodology. Think of me as your complete digital partner—developer, designer, and manager in one.') }}
        </p>
        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
          class="bg-[#FFA400] hover:bg-[#1b1b18] text-[#1b1b18] hover:text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-base sm:text-lg transition-all duration-300 transform hover:scale-105 inline-block">
          {{ $tr('hero.cta', 'DISCOVER MY SERVICES') }}
        </a>
      </div>

      <!-- Right Panel - Blog / Promo Card -->
      @php
        $promoData = \App\Support\PromoCard::current();
        $promoTitle = $promoData['title'] ?? 'Daily Story';
        $promoText = $promoData['text'] ?? 'Share an update, a tip, or promote an offer here. You can customize this block content from config.';
        $promoLink = $promoData['link'] ?? route('blog', ['locale' => app()->getLocale()]);
        $promoCta = $promoData['cta'] ?? __('common.nav.blog');
        $promoImg = $promoData['image_url'];
      @endphp
      <x-promo-card id="vlog"
        class="bg-white p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300 order-first lg:order-last h-full"
        :promo-title="$promoTitle"
        :promo-text="$promoText"
        :promo-link="$promoLink"
        :promo-cta="$promoCta"
        :promo-img="$promoImg"
        variant="light"
      />
    </div>
  </div>
</section>