<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>
<body class="bg-[#dbdbd7] text-[#1b1b18] min-h-screen overflow-x-hidden">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 bg-[#FFA400] text-[#1b1b18] p-3 rounded-lg shadow-lg" aria-label="Toggle menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Fixed Left Panel with Navigation (Admin) -->
    <aside id="sidebar" class="fixed left-0 top-0 w-80 h-full bg-[#FFA400] z-40 shadow-2xl transform -translate-x-full lg:translate-x-0 transition-all duration-300" aria-label="Admin navigation" data-state="expanded">
        <div class="p-8 h-full flex flex-col">
            <!-- Brand / Profile -->
            <div class="text-center mb-8">
                <button id="sidebar-toggle" class="mx-auto mb-4 inline-flex items-center justify-center w-10 h-10 rounded-lg bg-[#1b1b18] text-[#FFA400] hover:opacity-90" aria-label="Toggle sidebar width">⇔</button>
                <div class="w-28 h-28 mx-auto rounded-full overflow-hidden border-4 border-[#1b1b18] shadow-lg sidebar-full bg-[#1b1b18] text-[#FFA400] flex items-center justify-center text-xl font-extrabold">
                    A
                </div>
                <div class="mt-2 font-bold">Admin</div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 space-y-2" aria-label="Section navigation">
                @php 
                    $items = [
                        ['href' => route('admin.dashboard'), 'icon' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 10.5l9-7 9 7V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-9.5z"/></svg>', 'label' => 'Dashboard', 'match' => 'admin.dashboard|admin.dashboard.page'],
                        ['href' => route('admin.inbox'), 'icon' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M2 4h20v14H6l-4 4V4zm6 3h8v2H8V7zm0 4h8v2H8v-2z"/></svg>', 'label' => 'Inbox', 'match' => 'admin.inbox'],
                        ['href' => route('admin.leads'), 'icon' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h9l5 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm8 1.5V8h4.5"/></svg>', 'label' => 'Leads', 'match' => 'admin.leads'],
                        ['href' => route('admin.promo'), 'icon' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16v4H4V4zm0 6h10v10H4V10zm12 0h4v10h-4V10z"/></svg>', 'label' => 'Vlog/Promo', 'match' => 'admin.promo'],
                    ];
                @endphp
                @foreach($items as $it)
                    @php $active = request()->routeIs($it['match']); @endphp
                    <a href="{{ $it['href'] }}" class="nav-item flex items-center gap-3 px-6 py-4 text-sm font-bold transition-all duration-300 hover:scale-105 {{ $active ? 'active' : '' }}">
                        <span class="sidebar-icon text-[#1b1b18]">{!! $it['icon'] !!}</span>
                        <span class="sidebar-label">{{ $it['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout -->
            <div class="mt-6 pt-4 border-t border-[#1b1b18]/20">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                    <button class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#1b1b18] text-[#FFA400] rounded-lg font-bold hover:opacity-90 transition" aria-label="Logout">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30 opacity-0 invisible transition-all duration-300"></div>

    <!-- Main Content -->
    <main id="main" class="lg:ml-80 min-h-screen p-4 md:p-6">
        @if(session('status'))
            <div class="mb-4 rounded-lg border border-[#FFA400]/30 bg-[#FFA400]/10 text-[#1b1b18] px-4 py-3">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </main>

    {{-- Livewire scripts are loaded via ESM in resources/js/app.js --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileOverlay = document.getElementById('mobile-overlay');
            let isMenuOpen = false;
            let shrinkTimeout = null;

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

            function setSidebarState(state) {
                sidebar.dataset.state = state;
                if (state === 'collapsed') {
                    sidebar.style.width = '88px';
                    document.querySelectorAll('.sidebar-label').forEach(el => el.style.display = 'none');
                    document.querySelectorAll('.sidebar-full').forEach(el => el.style.display = 'none');
                } else {
                    sidebar.style.width = '20rem';
                    document.querySelectorAll('.sidebar-label').forEach(el => el.style.display = '');
                    document.querySelectorAll('.sidebar-full').forEach(el => el.style.display = '');
                }
            }
            function collapseOnScroll() {
                setSidebarState('collapsed');
                if (shrinkTimeout) clearTimeout(shrinkTimeout);
                shrinkTimeout = setTimeout(() => setSidebarState('expanded'), 600);
            }
            window.addEventListener('scroll', collapseOnScroll, { passive: true });
            sidebarToggle?.addEventListener('click', () => {
                const next = sidebar.dataset.state === 'expanded' ? 'collapsed' : 'expanded';
                setSidebarState(next);
            });
            setSidebarState('expanded');
        });
    </script>

    @stack('scripts')

    <style>
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
        .section-shadow {
            box-shadow: 0 20px 40px rgba(27, 27, 24, 0.15), 0 8px 16px rgba(27, 27, 24, 0.1);
        }
        .section-shadow:hover {
            box-shadow: 0 25px 50px rgba(27, 27, 24, 0.2), 0 12px 24px rgba(27, 27, 24, 0.15);
            transform: translateY(-2px);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #dbdbd7; }
    ::-webkit-scrollbar-thumb { background: #FFA400; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #1b1b18; }
    </style>
</body>
</html>