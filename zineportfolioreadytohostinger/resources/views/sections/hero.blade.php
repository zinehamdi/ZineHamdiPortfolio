@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
@endphp

<section id="home" class="relative min-h-screen flex items-center pt-20 lg:pt-0 bg-center bg-cover" style="background-image: url('{{ asset('images/bgPortfolioImage.png') }}');" @if($rtl) dir="rtl" @endif>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-center">
      <!-- Left Panel - Text Content -->
      <div class="bg-white p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
        <h1 class="text-3xl sm:text-4xl lg:text-6xl font-black text-[#1b1b18] mb-4 lg:mb-6 leading-tight">
          <span class="block">{{ $tr('hero.greeting', 'WELCOME TO') }}</span>
          <span class="block text-[#FFA400]">{{ $tr('hero.name', 'zin.Dev') }}</span>
        </h1>
  <div class="bg-[#FFA400] text-[#1b1b18] px-4 sm:px-6 py-2 sm:py-3 rounded-lg mb-4 lg:mb-6 inline-block">
          <span class="font-bold text-base sm:text-lg">{{ $tr('hero.title', 'FULL-STACK WEB DEVELOPER & PROJECT MANAGER') }}</span>
        </div>
        <p class="text-[#1b1b18]/80 text-base sm:text-lg leading-relaxed mb-6 lg:mb-8">
          {{ $tr('hero.description', 'I’m a one-man full-stack team helping small businesses grow online. From strategy to code, I build clean, modern Laravel + Vue solutions, integrate AI tools, and manage projects end-to-end with agile methodology. Think of me as your complete digital partner—developer, designer, and manager in one.') }}
        </p>
  <a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="bg-[#FFA400] hover:bg-[#1b1b18] text-[#1b1b18] hover:text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-base sm:text-lg transition-all duration-300 transform hover:scale-105 inline-block">
          {{ $tr('hero.cta', 'DISCOVER MY SERVICES') }}
        </a>
      </div>
      
      <!-- Right Panel - Blog / Promo Card -->
  <div id="vlog" class="bg-white p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300 order-first lg:order-last">
    @php
      // Try to get a promo for current locale or a global one; if none, fall back to the latest promo regardless of locale
      $dbPromo = \App\Models\Promo::query()
        ->where(function($q){ $q->whereNull('locale')->orWhere('locale', app()->getLocale()); })
        ->latest('id')->first();
      if (!$dbPromo) {
        $dbPromo = \App\Models\Promo::query()->latest('id')->first();
      }
      $promo = $dbPromo ? [
        'title' => $dbPromo->title,
        'text' => $dbPromo->text,
        'cta' => $dbPromo->cta,
        'link' => $dbPromo->link,
        'image' => $dbPromo->image_path,
      ] : (config('site.hero_promo') ?? []);
          $promoTitle = $promo['title'] ?? 'Daily Story';
          $promoText  = $promo['text']  ?? 'Share an update, a tip, or promote an offer here. You can customize this block content from config.';
          $promoLink  = $promo['link']  ?? route('blog', ['locale' => app()->getLocale()]);
          $promoCta   = $promo['cta']   ?? __('common.nav.blog');
      $imgPath    = $promo['image'] ?? 'images/hero-promo.jpg';
      // Resolve image URL robustly: absolute URL, storage path, or public path fallbacks
      $isAbsolute = is_string($imgPath) && (str_starts_with($imgPath, 'http://') || str_starts_with($imgPath, 'https://') || str_starts_with($imgPath, '//'));
      if ($isAbsolute) {
        $promoImg = $imgPath;
      } else if (str_starts_with($imgPath, 'storage/')) {
        $promoImg = asset($imgPath);
      } else if (file_exists(public_path($imgPath))) {
        $promoImg = asset($imgPath);
      } else if (file_exists(public_path('images/home.jpg'))) {
        $promoImg = asset('images/home.jpg');
      } else if (file_exists(public_path('images/zinedev.png'))) {
        $promoImg = asset('images/zinedev.png');
      } else {
        $promoImg = asset('favicon.ico');
      }
        @endphp
        <div class="w-full max-w-md mx-auto">
          <div class="rounded-xl overflow-hidden border border-[#1b1b18]/10">
            <img src="{{ $promoImg }}" alt="Promo image" class="w-full h-56 object-cover">
          </div>
          <h3 class="mt-5 text-2xl font-extrabold text-[#1b1b18]">{{ $promoTitle }}</h3>
          <p class="mt-2 text-[#1b1b18]/80 leading-relaxed">{{ $promoText }}</p>
          <div class="mt-4">
            <a href="{{ $promoLink }}" class="inline-flex items-center gap-2 px-5 py-3 bg-[#FFA400] text-[#1b1b18] font-bold rounded-lg hover:opacity-90 transition">
              {{ $promoCta }}
              <span aria-hidden="true">→</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
