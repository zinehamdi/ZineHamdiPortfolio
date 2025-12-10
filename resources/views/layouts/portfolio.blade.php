<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
    $pageTitle = trim($__env->yieldContent('title')) ?: __('common.brand', [], app()->getLocale()) ?: 'Hamdi Zine';
        $pageDesc = trim($__env->yieldContent('meta_description')) ?: __('nav.meta_description');
        $ogTitle = trim($__env->yieldContent('og_title')) ?: $pageTitle;
        $ogDesc = trim($__env->yieldContent('og_description')) ?: $pageDesc;
        // Use ZINDEV logo as default OG image
        $ogImage = trim($__env->yieldContent('og_image')) ?: asset('images/zindev/ZINDEVLogo.svg');
    @endphp
    <title>{!! $pageTitle !!}</title>
    <meta name="description" content="{{ $pageDesc }}">
    <meta name="author" content="{{ __('common.brand') }}">
    <meta name="keywords" content="Laravel Developer, Full Stack Developer, AI Integration, Web Development Tunisia, PHP Developer, Vue.js, Tailwind CSS, Olive Oil Branding, Scrum Master">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    @php
        $supported = ['en','fr','ar'];
        $path = request()->path();
        $segments = explode('/', trim($path, '/'));
        $tail = $segments && in_array($segments[0], $supported) ? implode('/', array_slice($segments, 1)) : implode('/', $segments);
    @endphp
    @foreach(['en','fr','ar'] as $hl)
        <link rel="alternate" hreflang="{{ $hl }}" href="{{ url('/'.$hl.($tail ? '/'.$tail : '')) }}" />
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ url('/en'.($tail ? '/'.$tail : '')) }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/zindev/ZINDEVLogo.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph / Twitter -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ str_replace('_','-',app()->getLocale()) }}">
    <meta property="og:site_name" content="{{ __('common.brand') }}">
    <meta property="og:title" content="{!! $ogTitle !!}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{!! $ogTitle !!}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&family=IBM+Plex+Sans+Arabic:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/metallic-hero.js',
            'resources/js/metallic-sections.js',
    ])
    <style>[x-cloak] { display: none !important; }</style>
    @livewireStyles
    @include('partials.analytics')

    <!-- JSON-LD Structured Data -->
    @php
        $org = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => __('common.brand'),
            'url' => url('/'),
            'logo' => asset('images/zindev/ZINDEVLogo.svg'),
            'sameAs' => array_values(array_filter([
                config('site.social.github'),
                config('site.social.linkedin'),
                config('site.social.instagram'),
            ])),
        ];
        $website = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => __('common.brand'),
            'url' => url('/'),
        ];
        $person = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Hamdi Zine',
            'alternateName' => 'ZINDEV',
            'jobTitle' => 'Full Stack Developer | AI-Assisted Builder | Scrum Master | Branding Designer',
            'description' => 'Full Stack PHP Developer in Kairouan, Tunisia. Laravel, Vue, Angular, Tailwind. AI-assisted development, olive oil branding, Scrum-certified project management.',
            'url' => url('/'),
            'image' => asset('images/home.jpg'),
            'knowsAbout' => ['Laravel', 'PHP', 'Vue.js', 'Angular', 'Tailwind CSS', 'AI Integration', 'Scrum', 'Olive Oil Branding', 'Canva Design'],
            'sameAs' => array_values(array_filter([
                'https://github.com/zinehamdi',
                'https://linkedin.com/in/zinehamdi',
                config('site.social.instagram'),
            ])),
            'worksFor' => [
                '@type' => 'Organization',
                'name' => 'ZINDEV',
            ],
        ];
        $services = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'ZINDEV',
            'description' => 'Full Stack Web Development, AI Integration, and Premium Branding Services',
            'url' => url('/'),
            'priceRange' => '$$',
            'areaServed' => ['Tunisia', 'Saudi Arabia', 'United Arab Emirates', 'Qatar', 'Kuwait'],
            'serviceType' => ['Web Development', 'Laravel Development', 'AI Integration', 'Olive Oil Branding', 'Product Label Design'],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Web Development Services',
                'itemListElement' => [
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Laravel Full-Stack Development']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'AI-Assisted Development']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Premium Olive Oil Branding']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Product Label Design']],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($org, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($website, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($person, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($services, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body class="bg-[#0a0a0f] text-[#E8E8E8] min-h-screen overflow-x-hidden">
    <!-- Gradient Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-[#050507] via-[#0a0a0f] to-[#050507] z-0"></div>
    <div class="fixed inset-0 bg-[radial-gradient(circle_at_50%_0%,_rgba(0,255,136,0.05),_transparent_70%)] z-0 pointer-events-none"></div>
    
    <!-- Skip Link -->
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] bg-[#00FF88] text-[#0a0a0f] px-4 py-2 rounded-lg font-bold">Skip to content</a>

    @php
        $email = config('site.admin_email') ?? 'zinehamdi8@gmail.com';
        $waRaw = config('site.whatsapp_number') ?? '+216 25 777 926';
        $waDigits = preg_replace('/\D+/', '', $waRaw);
        $waLink = 'https://wa.me/'.$waDigits;
        $profileImg = asset('favicon.ico'); // default fallback
        $profileCandidates = [
            'images/portfoliopicture/profili1.jpg',
            'images/portfoliopicture/profili2.webp',
            'images/portfoliopicture/profili2.jpg',
            'images/portfoliopicture/IMG_3796.jpg',
            'images/portfoliopicture/IMG_3781.JPG',
            'images/zindev.png',
        ];
        foreach ($profileCandidates as $img) {
            if (file_exists(public_path($img))) {
                $profileImg = asset($img);
                break;
            }
        }
    @endphp

    <!-- Modern Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 bottom-0 w-72 sm:w-80 mlp-card-strong mlp-bg-metal/80 mlp-glass-subtle border border-mlp-border-subtle/70 z-50 transform -translate-x-full transition-transform duration-500 ease-out lg:translate-x-0" aria-label="Main navigation">
        <div class="p-6 h-full flex flex-col relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-mlp-laser-green/10 opacity-60 blur-3xl rounded-full"></div>
            <div class="absolute bottom-8 left-4 w-24 h-24 bg-mlp-laser-purple/10 opacity-50 blur-3xl rounded-full"></div>
            
            <!-- Profile Section -->
            <div class="text-center mb-8 relative z-10">
                <div class="w-28 h-28 mx-auto rounded-full overflow-hidden border border-mlp-border-subtle/70 shadow-mlp-laser-green mlp-laser-orbit">
                    <img src="{{ $profileImg }}" alt="Profile" class="w-full h-full object-cover object-top" style="object-position: center 15%;">
                </div>
                <h2 class="mt-4 text-xl font-bold text-mlp-text-main mlp-metal-sheen">{{ __('common.brand') ?: 'ZINDEV' }}</h2>
                <p class="text-sm text-mlp-laser-green font-mono">Full-Stack Developer</p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 space-y-2" aria-label="Section navigation">
                @php 
                    $navItems = [
                        ['key' => 'home', 'label' => __('common.nav.home') ?: 'HOME', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['key' => 'about', 'label' => __('common.nav.about') ?: 'ABOUT', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['key' => 'services', 'label' => __('common.nav.services') ?: 'SERVICES', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['key' => 'projects', 'label' => __('common.nav.portfolio') ?: 'PORTFOLIO', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['key' => 'pricing', 'label' => __('common.nav.pricing') ?: 'PRICING', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['key' => 'quote', 'label' => __('common.nav.quote') ?: 'GET QUOTE', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                        ['key' => 'blog', 'label' => __('common.nav.blog') ?: 'BLOG', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                        ['key' => 'contact', 'label' => __('common.nav.contact') ?: 'CONTACT', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ]; 
                    $isHome = request()->routeIs('home');
                    $base = url('/'.app()->getLocale());
                @endphp
                @foreach($navItems as $item)
                    @php $href = $isHome ? '#'.$item['key'] : $base.'#'.$item['key']; @endphp
                    <a href="{{ $href }}" 
                       class="nav-link relative flex items-center gap-3 px-4 py-3 rounded-mlp-md text-sm font-semibold transition-all duration-300 group mlp-glass-subtle border border-mlp-border-subtle/60 hover:border-mlp-gold/70 hover:shadow-mlp-laser-green" 
                       data-section="{{ $item['key'] }}">
                        <span class="absolute left-2 h-6 w-1 rounded-full bg-mlp-gold opacity-0 group-[.active]:opacity-100 transition-opacity"></span>
                        <svg class="w-5 h-5 text-mlp-text-muted group-hover:text-mlp-laser-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span class="text-mlp-text-main">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Language Switcher -->
            <div class="mt-auto pt-4 border-t border-white/10">
                <x-lang-switcher class="flex items-center justify-center gap-2" />
            </div>
            
            <!-- Social Links -->
            <div class="flex justify-center gap-4 mt-4">
                <a href="https://github.com/zinehamdi" target="_blank" rel="noopener noreferrer" aria-label="GitHub profile" class="text-[#A0A0A0] hover:text-[#00FF88] transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a href="https://linkedin.com/in/zinehamdi" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile" class="text-[#A0A0A0] hover:text-[#00FF88] transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden" aria-hidden="true"></div>

    <!-- Top Header -->
    <header class="fixed left-0 right-0 top-0 z-30 glass-card rounded-none h-16 flex items-center px-4 sm:px-6 lg:pl-80 gap-4 border-b border-white/5">
        <!-- Mobile hamburger -->
        <button id="mobile-sidebar-toggle" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-white/10 text-[#A0A0A0] hover:text-[#00FF88] hover:border-[#00FF88]/50 transition-all" aria-label="Toggle navigation" aria-expanded="false" aria-controls="sidebar">
            <svg id="icon-hamburger" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg id="icon-close" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6"/></svg>
        </button>
        
        <!-- Mobile avatar -->
        <div id="header-avatar" class="lg:hidden w-10 h-10 rounded-full overflow-hidden border border-[#00FF88]/30 flex-shrink-0">
            <img src="{{ $profileImg }}" alt="Profile" class="w-full h-full object-cover">
        </div>
        
        <!-- Contact Info -->
        <div class="flex items-center gap-4 text-xs sm:text-sm font-medium overflow-x-auto">
            <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2 text-[#A0A0A0] hover:text-[#00FF88] transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="hidden sm:inline">{{ $email }}</span>
            </a>
            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-[#A0A0A0] hover:text-[#00FF88] transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.197.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.521-.075-.149-.672-1.612-.922-2.207-.242-.58-.487-.5-.672-.51-.173-.008-.372-.01-.571-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                <span class="hidden sm:inline">WhatsApp</span>
            </a>
        </div>
        
        <!-- Right side: Language switcher for mobile -->
        <div class="ml-auto flex items-center gap-2 lg:hidden">
            <x-lang-switcher class="flex gap-1" tone="dark" />
        </div>
    </header>

    <!-- Main Content -->
    <main id="main" class="pt-16 lg:ml-80 min-h-screen relative z-10">
        @if(session('status'))
            <div class="mx-4 mt-4 rounded-lg border border-[#00FF88]/30 bg-[#00FF88]/10 text-[#00FF88] px-4 py-3">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->has('rate'))
            <div class="mx-4 mt-4 rounded-lg border border-red-500/30 bg-red-500/10 text-red-400 px-4 py-3">
                {{ $errors->first('rate') }}
            </div>
        @endif
      @yield('content')
    </main>

    @livewireScripts

    <!-- Main Script -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.getElementById('mobile-sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');
            const iconHamburger = document.getElementById('icon-hamburger');
            const iconClose = document.getElementById('icon-close');
            const headerAvatar = document.getElementById('header-avatar');
            const navLinks = document.querySelectorAll('.nav-link');
            let isMobileOpen = false;

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                iconHamburger.classList.add('hidden');
                iconClose.classList.remove('hidden');
                if (headerAvatar) headerAvatar.classList.add('opacity-0');
                if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
                isMobileOpen = true;
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                iconHamburger.classList.remove('hidden');
                iconClose.classList.add('hidden');
                if (headerAvatar) headerAvatar.classList.remove('opacity-0');
                if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
                isMobileOpen = false;
            }

            if (mobileToggle) {
                mobileToggle.addEventListener('click', () => isMobileOpen ? closeSidebar() : openSidebar());
            }
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Close on nav click (mobile)
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href') || '';
                    if (href.startsWith('#') && window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Active nav highlight on scroll
            const sections = document.querySelectorAll('section[id]');
            function updateActiveNav() {
                const scrollPos = window.scrollY + 100;
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');
                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        navLinks.forEach(link => link.classList.remove('active'));
                        document.querySelectorAll(`[data-section="${sectionId}"]`).forEach(link => link.classList.add('active'));
                    }
                });
            }

            window.addEventListener('scroll', updateActiveNav, { passive: true });
            updateActiveNav();

            // Escape key to close sidebar
            window.addEventListener('keydown', e => {
                if (e.key === 'Escape' && isMobileOpen) closeSidebar();
            });

            // Desktop: ensure sidebar is visible
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    isMobileOpen = false;
                }
            });

            // Pricing CTA: choose package without reloading
            document.addEventListener('click', e => {
                const a = e.target.closest('a.js-choose-package');
                if (!a) return;
                e.preventDefault();
                const slug = a.dataset.package;
                // Dispatch event for Alpine/Livewire
                window.dispatchEvent(new CustomEvent('choose-package', { detail: { slug } }));
                // Scroll to quote
                const quote = document.getElementById('quote');
                if (quote) quote.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>