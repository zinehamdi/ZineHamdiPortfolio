<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $pageTitle = trim($__env->yieldContent('title')) ?: __('common.brand', [], app()->getLocale()) ?: 'Hamdi Salem Zine';
        $pageDesc = trim($__env->yieldContent('meta_description')) ?: __('nav.meta_description');
        $ogTitle = trim($__env->yieldContent('og_title')) ?: $pageTitle;
        $ogDesc = trim($__env->yieldContent('og_description')) ?: $pageDesc;
        $ogImage = trim($__env->yieldContent('og_image')) ?: asset('favicon.ico');
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDesc }}">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    @php
        // Build hreflang alternates for current path across locales
        $supported = ['en','fr','ar'];
        $path = request()->path();
        $segments = explode('/', trim($path, '/'));
        $tail = $segments && in_array($segments[0], $supported) ? implode('/', array_slice($segments, 1)) : implode('/', $segments);
    @endphp
    @foreach(['en','fr','ar'] as $hl)
        <link rel="alternate" hreflang="{{ $hl }}" href="{{ url('/'.$hl.($tail ? '/'.$tail : '')) }}" />
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ url('/en'.($tail ? '/'.$tail : '')) }}" />

    <!-- Open Graph / Twitter -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ str_replace('_','-',app()->getLocale()) }}">
    <meta property="og:site_name" content="{{ __('common.brand') }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Manrope:wght@400;600;700;800&family=IBM+Plex+Sans+Arabic:wght@400;600;700;800&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @include('partials.analytics')

    <!-- JSON-LD Structured Data -->
    @php
        $org = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => __('common.brand'),
            'url' => url('/'),
            'logo' => asset('favicon.ico'),
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
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/search?q={query}'),
                'query-input' => 'required name=query',
            ],
        ];
        $crumbs = [];
        $accum = '';
        foreach(array_filter(explode('/', $tail)) as $i => $seg){
            $accum .= '/'.$seg;
            $crumbs[] = [
                '@type' => 'ListItem',
                'position' => $i+1,
                'name' => ucfirst(str_replace('-', ' ', $seg)),
                'item' => url('/'.app()->getLocale().$accum),
            ];
        }
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $crumbs,
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($org, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($website, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @if(!empty($crumbs))
        <script type="application/ld+json">{!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
</head>
<body class="bg-[#dbdbd7] text-[#1b1b18] min-h-screen overflow-x-hidden">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] bg-[#FFA400] text-[#1b1b18] px-4 py-2 rounded-lg">Skip to content</a>
    
    <!-- Removed mobile menu toggle: sidebar is always visible -->

    <!-- Mobile Language Switcher removed (moved into header) -->

    <!-- Fixed Left Panel with Navigation (desktop) / Toggle drawer (mobile) -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 sm:w-80 h-full bg-[#FFA400] z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0" aria-label="Main navigation">
        <div class="p-8 h-full flex flex-col">
            <!-- Language Switcher data (vars only) -->
            @php
                $supported = ['en','fr','ar'];
                $path = request()->path();
                $segments = explode('/', trim($path, '/'));
                $tail = $segments && in_array($segments[0], $supported) ? implode('/', array_slice($segments, 1)) : implode('/', $segments);
                $qs = request()->getQueryString();
                $qsPart = $qs ? ('?'.$qs) : '';
            @endphp
            <!-- Profile Image / Brand -->
            <div class="text-center mb-8">
                @php
                    $profileImg = file_exists(public_path('images/home.jpg'))
                        ? asset('images/home.jpg')
                        : (file_exists(public_path('home.jpg'))
                            ? asset('home.jpg')
                            : (file_exists(public_path('images/profili1.jpg')) ? asset('images/profili1.jpg') : asset('favicon.ico')));
                @endphp
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[#1b1b18] shadow-lg sidebar-full">
                    <img src="{{ $profileImg }}" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Navigation Menu -->
                        <nav class="flex-1 space-y-2" aria-label="Section navigation">
                                @php 
                                    $navItems = [
                    ['key' => 'home', 'label' => __('common.nav.home') ?: 'HOME'],
                    ['key' => 'about', 'label' => __('common.nav.about') ?: 'ABOUT'],
                    ['key' => 'resume', 'label' => __('resume.title') ?: 'RESUME'],
                    ['key' => 'portfolio', 'label' => __('common.nav.portfolio') ?: 'PORTFOLIO'],
                    ['key' => 'testimonials', 'label' => __('testimonials.title') ?: 'TESTIMONIALS'],
                    ['key' => 'contact', 'label' => __('common.nav.contact') ?: 'CONTACT'],
                                    ]; 
                                    $isHome = request()->routeIs('home');
                                    $base = url('/'.app()->getLocale());
                                    $icons = [
                                        'home' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 10.5l9-7 9 7V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-9.5z"/></svg>',
                                        'about' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0v1H5v-1z"/></svg>',
                                        'resume' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h9l5 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm8 1.5V8h4.5"/></svg>',
                                        'portfolio' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 7h18v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm5-4h8a2 2 0 012 2v2H6V5a2 2 0 012-2z"/></svg>',
                                        'testimonials' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 11h10v2H7v-2zm-2 6h9v2H5v-2zM4 5h16v10H5l-1 1V5z"/></svg>',
                                        'contact' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M2 4h20v14H6l-4 4V4zm6 3h8v2H8V7zm0 4h8v2H8v-2z"/></svg>',
                                    ];
                                @endphp
                                @foreach($navItems as $item)
                                    @php $href = $isHome ? '#'.$item['key'] : $base.'#'.$item['key']; @endphp
                                            <a href="{{ $href }}" 
                                                class="nav-item flex items-center gap-3 px-6 py-4 text-sm font-bold transition-all duration-300 hover:scale-105" 
                     data-section="{{ $item['key'] }}">
                    <span class="sidebar-icon text-[#1b1b18]">{!! $icons[$item['key']] ?? '' !!}</span>
                    <span class="sidebar-label">{{ $item['label'] }}</span>
                  </a>
                @endforeach
            </nav>
            <!-- Sidebar bottom chat button (desktop) -->
            <div class="mt-6 pt-4 border-t border-[#1b1b18]/20 hidden lg:block">
                <!-- Chat removed -->
                    <span class="text-lg">💬</span>
                    <span class="sidebar-label">{{ __('messages.title') }}</span>
                </button>
            </div>

            <!-- Language Switcher (desktop bottom) -->
            <x-lang-switcher id="lang-switcher-desktop" class="hidden lg:flex items-center justify-center gap-2 mt-auto pt-4 border-t border-[#1b1b18]/20" />
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden" aria-hidden="true"></div>

    <!-- Main Content -->
    <!-- Top Navbar with contact info -->
    @php
        $email = config('site.admin_email');
        $waRaw = config('site.whatsapp_number');
        $waDigits = preg_replace('/\D+/', '', $waRaw);
        $waLink = 'https://wa.me/'.$waDigits;
        // Reuse profile image for mobile header avatar
        $profileImgHeader = file_exists(public_path('images/home.jpg'))
            ? asset('images/home.jpg')
            : (file_exists(public_path('home.jpg'))
                ? asset('home.jpg')
                : (file_exists(public_path('images/profili1.jpg')) ? asset('images/profili1.jpg') : asset('favicon.ico')));
    @endphp
    <header class="fixed left-0 lg:left-72 right-0 top-0 z-30 bg-[#1b1b18] text-white/90 backdrop-blur supports-[backdrop-filter]:bg-[#1b1b18]/90 h-16 flex items-center px-3 sm:px-6 gap-4 shadow-lg">
        <!-- Mobile hamburger -->
    <button id="mobile-sidebar-toggle" class="lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-md border border-white/10 text-white hover:text-[#FFA400] hover:border-[#FFA400] focus:outline-none focus:ring-2 focus:ring-[#FFA400]" aria-label="Toggle navigation" aria-controls="sidebar" aria-expanded="false">
            <svg id="icon-hamburger" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg id="icon-close" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6"/></svg>
        </button>
        <!-- Mobile inline avatar to fill blank space when sidebar hidden -->
        <div id="header-avatar" class="lg:hidden w-14 h-14 rounded-full overflow-hidden border-2 border-[#FFA400]/80 shadow-lg flex-shrink-0">
            <img src="{{ $profileImgHeader }}" alt="Profile" class="w-full h-full object-cover">
        </div>
        <div class="flex items-center gap-5 text-[11px] sm:text-sm font-medium overflow-x-auto pr-2">
            <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2 hover:text-[#FFA400] transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4z"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 6l-10 7L2 6"/></svg>
                <span class="hidden sm:inline">{{ $email }}</span>
                <span class="sm:hidden">Email</span>
            </a>
            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 hover:text-[#FFA400] transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.197.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.521-.075-.149-.672-1.612-.922-2.207-.242-.58-.487-.5-.672-.51-.173-.008-.372-.01-.571-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 5.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885"/></svg>
                <span class="hidden sm:inline">{{ $waRaw }}</span>
                <span class="sm:hidden">WhatsApp</span>
            </a>
        </div>
        <div class="ml-auto flex items-center gap-2 sm:gap-3">
            <!-- Mobile & desktop language switchers unified -->
            <x-lang-switcher class="flex gap-1 md:gap-2 md:flex" />
            <!-- Chat removed -->
        </div>
    </header>
    <main id="main" class="mt-16 lg:mt-0 lg:ml-80 min-h-screen">
        @if(session('status'))
            <div class="mb-4 rounded-lg border border-[#FFA400]/30 bg-[#FFA400]/10 text-[#1b1b18] px-4 py-3">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->has('rate'))
            <div class="mb-4 rounded-lg border border-red-600/30 bg-red-600/10 text-red-900 px-4 py-3">
                {{ $errors->first('rate') }}
            </div>
        @endif
      @yield('content')
    </main>

    <!-- Chat widget removed -->
    {{-- Livewire scripts are loaded via ESM in resources/js/app.js --}}

    <script>
        // Mobile menu and navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Pricing CTA: choose package without reloading
            document.body.addEventListener('click', function(e) {
                const a = e.target.closest('a.js-choose-package');
                if (a) {
                    e.preventDefault();
                    const slug = a.getAttribute('data-package');
                    try {
                        const url = new URL(window.location.href);
                        url.searchParams.set('package', slug);
                        history.replaceState({}, '', url.toString());
                    } catch (_) {}
                    // Notify Livewire component to preselect
                    window.dispatchEvent(new CustomEvent('choose-package', { detail: { slug } }));
                    const el = document.getElementById('quote');
                    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, { passive: false });

            const navItems = document.querySelectorAll('.nav-item');
            const sections = document.querySelectorAll('section[id]');
            const sidebar = document.getElementById('sidebar');
            const langSwitcher = document.getElementById('lang-switcher-desktop');
            const mobileToggle = document.getElementById('mobile-sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');
            const iconHamburger = document.getElementById('icon-hamburger');
            const iconClose = document.getElementById('icon-close');
            let langHideTimeout = null;
            let isMobileOpen = false;
            const headerAvatar = document.getElementById('header-avatar');

            function openMobileSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                mobileToggle.setAttribute('aria-expanded', 'true');
                iconHamburger.classList.add('hidden');
                iconClose.classList.remove('hidden');
                if (headerAvatar) headerAvatar.classList.add('opacity-0','pointer-events-none');
                isMobileOpen = true;
            }
            function closeMobileSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                mobileToggle.setAttribute('aria-expanded', 'false');
                iconHamburger.classList.remove('hidden');
                iconClose.classList.add('hidden');
                if (headerAvatar) headerAvatar.classList.remove('opacity-0','pointer-events-none');
                isMobileOpen = false;
            }
            function toggleMobileSidebar() { isMobileOpen ? closeMobileSidebar() : openMobileSidebar(); }
            if (mobileToggle) mobileToggle.addEventListener('click', toggleMobileSidebar);
            if (overlay) overlay.addEventListener('click', closeMobileSidebar);
            window.addEventListener('keydown', e => { if (e.key === 'Escape' && isMobileOpen) closeMobileSidebar(); });
            // Ensure correct state on resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) { // lg
                    // Desktop: keep sidebar visible
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    mobileToggle.setAttribute('aria-expanded','false');
                    iconHamburger.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    if (headerAvatar) headerAvatar.classList.add('hidden');
                    isMobileOpen = false;
                } else {
                    // Mobile: hide by default
                    if (!isMobileOpen) sidebar.classList.add('-translate-x-full');
                    if (headerAvatar) headerAvatar.classList.remove('hidden');
                }
            });

            // Smooth scroll to section and close mobile menu
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    const href = this.getAttribute('href') || '';
                    // Only intercept pure hash links (same-page)
                    if (href.startsWith('#')) {
                        e.preventDefault();
                        const targetId = href.substring(1);
                        const targetSection = document.getElementById(targetId);
                        if (targetSection) {
                            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            // no menu closing needed; always visible
                        }
                    }
                    // Otherwise, let the browser navigate normally (e.g., from Services back to Home#section)
                });
            });

            // Update active navigation on scroll
            function updateActiveNav() {
                const scrollPos = window.scrollY + 100;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');

                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        // Remove active class from all nav items
                        navItems.forEach(item => item.classList.remove('active'));
                        
                        // Add active class to current section nav items
                        const activeItems = document.querySelectorAll(`[data-section="${sectionId}"]`);
                        activeItems.forEach(item => item.classList.add('active'));
                    }
                });
            }

            // Resize handling not needed for toggle

            window.addEventListener('scroll', updateActiveNav);
            updateActiveNav(); // Initial call

            // Optional: fade desktop language switcher slightly while scrolling (kept for subtle feedback)
            window.addEventListener('scroll', function() {
                if (!langSwitcher) return;
                if (window.innerWidth < 1024) return; // desktop only
                langSwitcher.style.opacity = '0.35';
                if (langHideTimeout) clearTimeout(langHideTimeout);
                langHideTimeout = setTimeout(() => {
                    langSwitcher.style.opacity = '';
                }, 400);
            }, { passive: true });
            // No collapse/expand initialization needed
            // Initialize mobile closed
            if (window.innerWidth < 1024) closeMobileSidebar();
        });

        // Chat toggle is handled by the chat widget itself via @toggle-chat.window="$wire.toggle()"
    </script>

    <style>
        section[id] { scroll-margin-top: 6rem; }
        #lang-switcher-desktop { opacity: 1; transition: opacity 0.3s ease; }
        .nav-item {
            color: #1b1b18;
            transition: all 0.3s ease;
            border-radius: 12px;
            text-align: center;
        }

        .nav-item:hover {
            background-color: #1b1b18;
            color: #FFA400;
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(27, 27, 24, 0.3);
        }

        .nav-item.active {
            background-color: #1b1b18;
            color: #FFA400;
            box-shadow: 0 8px 25px rgba(27, 27, 24, 0.4);
        }

        /* Enhanced box shadows for sections */
        .section-shadow {
            box-shadow: 0 20px 40px rgba(27, 27, 24, 0.15), 0 8px 16px rgba(27, 27, 24, 0.1);
        }

        .section-shadow:hover {
            box-shadow: 0 25px 50px rgba(27, 27, 24, 0.2), 0 12px 24px rgba(27, 27, 24, 0.15);
            transform: translateY(-2px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #dbdbd7;
        }

        ::-webkit-scrollbar-thumb {
            background: #FFA400;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1b1b18;
        }
    </style>
</body>
</html>