<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>
<body class="bg-[#0a0a0f] text-[#E8E8E8] min-h-screen overflow-x-hidden">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 bg-[#00FF88] text-[#0a0a0f] p-3 rounded-lg shadow-lg" aria-label="Toggle menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Fixed Left Panel with Navigation (Admin) -->
    <aside id="sidebar" class="fixed left-0 top-0 w-72 h-full bg-[#12121a] border-r border-white/5 z-40 transform -translate-x-full lg:translate-x-0 transition-all duration-300" aria-label="Admin navigation" data-state="expanded">
        <div class="p-6 h-full flex flex-col">
            <!-- Brand / Profile -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-xl bg-gradient-to-br from-[#00FF88] to-[#7B61FF] flex items-center justify-center text-2xl font-extrabold text-[#0a0a0f] mb-3">
                    A
                </div>
                <div class="font-bold text-[#E8E8E8]">Admin Panel</div>
                <div class="text-sm text-[#A0A0A0] font-mono">dashboard.admin</div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 space-y-2" aria-label="Section navigation">
                @php 
                    $items = [
                        ['href' => route('admin.dashboard'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard', 'match' => 'admin.dashboard|admin.dashboard.page'],
                        ['href' => route('admin.inbox'), 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4', 'label' => 'Inbox', 'match' => 'admin.inbox'],
                        ['href' => route('admin.leads'), 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Leads', 'match' => 'admin.leads'],
                        ['href' => route('admin.promo'), 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z', 'label' => 'Vlog/Promo', 'match' => 'admin.promo'],
                    ];
                @endphp
                @foreach($items as $it)
                    @php $active = request()->routeIs($it['match']); @endphp
                    <a href="{{ $it['href'] }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 {{ $active ? 'bg-[#00FF88] text-[#0a0a0f]' : 'text-[#A0A0A0] hover:bg-white/5 hover:text-[#E8E8E8]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $it['icon'] }}"/>
                        </svg>
                        <span>{{ $it['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout -->
            <div class="mt-6 pt-4 border-t border-white/10">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                    <button class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl font-medium hover:bg-red-500/20 transition" aria-label="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-all duration-300"></div>

    <!-- Main Content -->
    <main id="main" class="lg:ml-72 min-h-screen p-4 md:p-6">
        @if(session('status'))
            <div class="mb-4 rounded-xl border border-[#00FF88]/30 bg-[#00FF88]/10 text-[#00FF88] px-4 py-3">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            const mobileOverlay = document.getElementById('mobile-overlay');
            let isMenuOpen = false;

            function toggleMobileMenu() {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    sidebar.classList.remove('-translate-x-full');
                    mobileOverlay.classList.remove('opacity-0', 'invisible');
                    document.body.style.overflow = 'hidden';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    mobileOverlay.classList.add('opacity-0', 'invisible');
                    document.body.style.overflow = '';
                }
            }
            function closeMobileMenu() {
                isMenuOpen = false;
                sidebar.classList.add('-translate-x-full');
                mobileOverlay.classList.add('opacity-0', 'invisible');
                document.body.style.overflow = '';
            }
            mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            mobileOverlay.addEventListener('click', closeMobileMenu);
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && isMenuOpen) closeMobileMenu(); });
        });
    </script>

    @stack('scripts')

    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #12121a; }
        ::-webkit-scrollbar-thumb { background: #00FF88; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #7B61FF; }
    </style>
</body>
</html>