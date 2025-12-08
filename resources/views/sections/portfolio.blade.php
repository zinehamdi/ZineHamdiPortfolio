@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };

  // Dynamically load real screenshots from public/images/workscreenshot
  $screensDir = public_path('images/workscreenshot');
  $files = [];
  if (is_dir($screensDir)) {
    foreach (scandir($screensDir) as $f) {
      if ($f === '.' || $f === '..' || str_starts_with($f, '.')) continue;
      $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
      if (!in_array($ext, ['png','jpg','jpeg','webp','gif'])) continue;
      $files[] = $f;
    }
  }

  // Map to portfolio entries (simple heuristic categories)
  $items = [];
  $i = 1;
  foreach ($files as $f) {
      $lower = strtolower($f);
      $cat = 'web';
      if (str_contains($lower, 'ai')) $cat = 'ai';
      elseif (str_contains($lower, 'maquette') || str_contains($lower, 'backlog')) $cat = 'pm';
      $items[] = [
        'id' => $i++,
        'title' => ucwords(str_replace(['-', '_', '.png', '.jpg', '.jpeg', '.webp'], ' ', pathinfo($f, PATHINFO_FILENAME))),
        'category' => $cat,
        'img' => asset('images/workscreenshot/'.$f),
        'alt' => 'Screenshot '.$f,
      ];
  }

  // Fallback if directory empty
  if (!$items) {
      $localPlaceholder = file_exists(public_path('images/placeholder-portfolio.png'))
        ? asset('images/placeholder-portfolio.png')
        : asset('favicon.ico');
      $items = [
        ['id'=>1,'title'=>'Sample Project','category'=>'web','img'=>$localPlaceholder,'alt'=>'Sample project placeholder']
      ];
  }

  $sectionId = isset($sectionId) && $sectionId ? $sectionId : 'portfolio';
  $headingId = isset($headingId) && $headingId ? $headingId : ($sectionId.'-heading');
@endphp

<section id="{{ $sectionId }}" class="py-16 lg:py-24" @if($rtl) dir="rtl" @endif aria-labelledby="{{ $headingId }}" x-data="portfolioTabs">
  <div class="max-w-7xl mx-auto px-0 sm:px-6">
    <div class="glass-card p-6 sm:p-8 lg:p-12">
          <header class="mb-6 sm:mb-8">
            <h2 id="{{ $headingId }}" class="uppercase font-black text-4xl mb-4 text-white">{{ $tr('portfolio.title','Portfolio') }}</h2>
          </header>

          <!-- Tabs -->
          <nav class="mb-8 -mx-4 sm:mx-0" role="tablist" aria-label="Portfolio Categories">
            @php $tabs = [
              ['key' => 'all', 'label' => $tr('portfolio.tabs.all','ALL')],
              ['key' => 'web', 'label' => $tr('portfolio.tabs.webdev','WEB DEVELOPMENT')],
              ['key' => 'pm', 'label' => $tr('portfolio.tabs.pm','PROJECT MANAGEMENT')],
              ['key' => 'ai', 'label' => $tr('portfolio.tabs.ai','AI & AUTOMATION')],
            ]; @endphp
            <ul class="flex gap-3 sm:gap-6 overflow-x-auto scrollbar-thin scrollbar-track-transparent scrollbar-thumb-[#00FF88]/60 px-4 sm:px-0 @if($rtl) flex-row-reverse @endif" style="scrollbar-width: thin;">
              @foreach($tabs as $t)
                <li>
                  <button
                    type="button"
                    class="px-4 py-2 text-sm font-bold focus:outline-none focus-visible:ring-2 focus-visible:ring-[#00FF88]/60 rounded-lg transition-all whitespace-nowrap border"
                    :class="btnClass('{{ $t['key'] }}')"
                    role="tab"
                    :aria-selected="ariaSelected('{{ $t['key'] }}')"
                    @click="setTab('{{ $t['key'] }}')"
                  >{{ $t['label'] }}</button>
                </li>
              @endforeach
            </ul>
          </nav>

          <!-- Grid -->
          <div class="px-4 sm:px-0 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6" x-cloak>
            @foreach($items as $it)
              <article
                class="group rounded-2xl overflow-hidden border border-white/10 bg-white/5 backdrop-blur-sm transition-all duration-300 ease-out transform-gpu hover:scale-[1.02] hover:border-brand-accent/40"
                x-show="showFor('{{ $it['category'] }}')"
                x-transition.opacity.duration.300ms
              >
                <div class="aspect-[4/3] overflow-hidden">
                  <img src="{{ $it['img'] }}" alt="{{ $it['alt'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-4">
                  <p class="text-xs uppercase font-bold text-gray-400 mb-1 tracking-wide">
                    @php
                      $catMap = ['web' => 'WEB DEVELOPMENT', 'pm' => 'PROJECT MANAGEMENT', 'ai' => 'AI & AUTOMATION'];
                    @endphp
                    {{ $catMap[$it['category']] ?? strtoupper($it['category']) }}
                  </p>
                  <h3 class="font-bold text-white">{{ $it['title'] }}</h3>
                </div>
              </article>
            @endforeach
          </div>
    </div>
  </div>
</section>
