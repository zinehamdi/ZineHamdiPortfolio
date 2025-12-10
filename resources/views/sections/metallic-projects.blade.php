@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };

  // Portfolio album structure - EXACTLY 6 projects
  $portfolioAlbums = [
    [
      'id' => 'zindev',
      'name' => $tr('portfolio.projects.zindev.name', 'ZINDEV Portfolio'),
      'category' => 'web',
      'description' => $tr('portfolio.projects.zindev.description', 'Modern portfolio website showcasing full-stack capabilities with Metallic Laser UI design system, GSAP animations, and Laravel backend.'),
      'cover' => 'zindev/myportfoliosc1.webp',
      'tech' => json_decode($tr('portfolio.projects.zindev.tech', '["Laravel 11","Tailwind CSS","GSAP","Livewire"]'), true),
    ],
    [
      'id' => 'abiooc',
      'name' => $tr('portfolio.projects.abiooc.name', 'ABIOOC'),
      'category' => 'web',
      'description' => $tr('portfolio.projects.abiooc.description', 'E-commerce platform for Tunisian organic olive oil association targeting export markets with multilingual support and wholesale pricing.'),
      'cover' => 'abiooc/abioocschome.webp',
      'images' => ['abiooc/abioocschome.webp', 'abiooc/abioocgallerysc.webp', 'abiooc/abioocaboutsc.webp'],
      'tech' => json_decode($tr('portfolio.projects.abiooc.tech', '["Laravel","Vue.js","Payment Integration"]'), true),
    ],
    [
      'id' => 'samouha',
      'name' => $tr('portfolio.projects.samouha.name', 'Samouha'),
      'category' => 'web',
      'description' => $tr('portfolio.projects.samouha.description', 'Elegant e-commerce platform for a premium couture house featuring lookbook galleries, custom tailoring booking system, and sophisticated brand presentation.'),
      'cover' => 'samouha/samouhachhome.jpeg',
      'images' => ['samouha/samouhachhome.jpeg', 'samouha/sammouhachshop.jpeg', 'samouha/samouhachscstory.jpeg'],
      'tech' => json_decode($tr('portfolio.projects.samouha.tech', '["Laravel","E-commerce","Booking System"]'), true),
    ],
    [
      'id' => 'kairouanhub',
      'name' => $tr('portfolio.projects.kairouanhub.name', 'Kairouan Hub'),
      'category' => 'web',
      'description' => $tr('portfolio.projects.kairouanhub.description', 'Multi-vendor marketplace platform connecting local artisans and businesses in Kairouan with customers, featuring vendor management and booking systems.'),
      'cover' => 'kairouanhub/kairouanhubschome.webp',
      'images' => ['kairouanhub/kairouanhubschome.webp', 'kairouanhub/kairouanhubsc2.webp', 'kairouanhub/kairouanhubsc3.webp'],
      'tech' => json_decode($tr('portfolio.projects.kairouanhub.tech', '["Laravel","Multi-vendor","Booking System"]'), true),
    ],
    [
      'id' => 'almishkat',
      'name' => $tr('portfolio.projects.almishkat.name', 'Al-Mishkat'),
      'category' => 'web',
      'description' => $tr('portfolio.projects.almishkat.description', 'Full-featured e-commerce platform for organic olive oil with shopping cart, checkout system, and comprehensive admin dashboard.'),
      'cover' => 'almishkat/al-mishkatsc.webp',
      'images' => ['almishkat/al-mishkatsc.webp', 'almishkat/cartal-mishkat.webp', 'almishkat/checkoutal-mishkat.webp', 'almishkat/dashboardal_mishkatsc.webp'],
      'tech' => json_decode($tr('portfolio.projects.almishkat.tech', '["Laravel","E-commerce","Admin Panel"]'), true),
    ],
    [
      'id' => 'setpa',
      'name' => $tr('portfolio.projects.setpa.name', 'SETPA'),
      'category' => 'design',
      'description' => $tr('portfolio.projects.setpa.description', 'Premium olive oil brand identity, packaging design, and export labels compliant with Saudi market regulations and luxury positioning.'),
      'cover' => 'setpa/designoliveoiltan.webp',
      'images' => ['setpa/designoliveoiltan.webp', 'setpa/logosetpa.png'],
      'tech' => json_decode($tr('portfolio.projects.setpa.tech', '["Branding","Canva Pro","Export Packaging"]'), true),
    ],
  ];

  // Check which images actually exist - FIXED: removed reference & to prevent corruption
  foreach ($portfolioAlbums as $key => $album) {
    $coverPath = public_path('images/'.$album['cover']);
    if (!file_exists($coverPath)) {
      $portfolioAlbums[$key]['cover'] = 'favicon.ico';
    }
    if (isset($album['images'])) {
      $portfolioAlbums[$key]['images'] = array_filter($album['images'], function($img) {
        return file_exists(public_path('images/'.$img));
      });
    }
  }
@endphp

<section id="projects" class="mlp-bg-root border-t border-mlp-border-subtle/50" @if($rtl) dir="rtl" @endif>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-0 py-10 sm:py-12 lg:py-14 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between" data-animate="projects-header">
      <div class="space-y-2">
        <p class="text-xs uppercase tracking-[0.3em] text-mlp-text-muted">{{ $tr('portfolio.section_label','Recent Work') }}</p>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-display font-semibold text-mlp-text-main mlp-metal-sheen">{{ $tr('portfolio.title','Featured Projects') }}</h2>
      </div>
      <div class="inline-flex items-center gap-2 mlp-glass-subtle rounded-mlp-pill px-3 py-2 text-xs text-mlp-text-muted border border-mlp-border-subtle/60">
        <span class="w-2 h-2 rounded-full bg-mlp-laser-green animate-ping"></span>
        <span>{{ $tr('portfolio.badge','Real client work') }}</span>
      </div>
    </div>

    <div class="grid gap-6 sm:gap-7 md:grid-cols-2 xl:grid-cols-3" data-animate="projects-grid">
      <!-- DEBUG: Total albums = {{ count($portfolioAlbums) }} -->
      @foreach ($portfolioAlbums as $index => $album)
        @php
          $categories = __('portfolio.categories');
          if (!is_array($categories) || $categories === 'portfolio.categories') {
            $categories = ['web' => 'WEB DEVELOPMENT', 'design' => 'BRAND DESIGN', 'pm' => 'PROJECT MANAGEMENT', 'ai' => 'AI & AUTOMATION'];
          }
          $label = $categories[$album['category']] ?? strtoupper($album['category']);
          $imageCount = isset($album['images']) ? count($album['images']) : 1;
        @endphp
        <article class="group mlp-card mlp-metal-sheen border border-mlp-border-subtle/70 overflow-hidden flex flex-col h-full transition-transform duration-500 will-change-transform hover:scale-[1.02]" data-tilt data-category="{{ $album['category'] }}">
          <div class="relative overflow-hidden">
            <div class="mlp-laser-beam h-1.5"></div>
            <div class="aspect-[16/10] bg-mlp-bg-elevated-soft mlp-laser-orbit flex items-center justify-center relative">
              <img src="{{ asset('images/'.$album['cover']) }}" alt="{{ $album['name'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              @if($imageCount > 1)
                <div class="absolute top-3 right-3 mlp-glass-subtle px-2 py-1 rounded-mlp-md text-xs text-mlp-laser-green font-semibold border border-mlp-laser-green/30">
                  {{ str_replace(':count', $imageCount, $tr('portfolio.images_count', ':count images')) }}
                </div>
              @endif
            </div>
          </div>
          <div class="p-5 sm:p-6 space-y-3 flex-1 flex flex-col">
            <div class="flex items-start justify-between gap-3">
              <div class="flex-1">
                <p class="text-mlp-text-muted text-xs uppercase tracking-wide mb-1">{{ $label }}</p>
                <h3 class="text-lg font-semibold text-mlp-text-main mb-2">{{ $album['name'] }}</h3>
                <p class="text-sm text-mlp-text-muted leading-relaxed">{{ $album['description'] }}</p>
              </div>
            </div>
            
            <!-- Tech Stack -->
            <div class="flex flex-wrap gap-2 mt-auto pt-3 border-t border-mlp-border-subtle/50">
              @foreach($album['tech'] as $tech)
                <span class="px-2 py-1 rounded-mlp-sm text-[0.65rem] bg-mlp-laser-green/10 text-mlp-laser-green border border-mlp-laser-green/20">
                  {{ $tech }}
                </span>
              @endforeach
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
