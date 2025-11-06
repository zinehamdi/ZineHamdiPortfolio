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

    <!-- Fonts: preconnect and styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@400;600;700&family=IBM+Plex+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">

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
                'logo' => (file_exists(public_path('images/zinedev.png')) ? asset('images/zinedev.png') : asset('favicon.ico')),
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
<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-dvh">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] bg-gold text-stone px-4 py-2 rounded-lg">Skip to content</a>
    <header class="sticky top-0 z-50">
        @include('partials.header')
    </header>

    <main id="main" class="min-h-[70dvh]">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-8">
                        @if(session('status'))
                            <div class="mb-4 rounded-lg border border-olive-600/30 bg-olive-600/10 text-olive-900 px-4 py-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($errors->has('rate'))
                            <div class="mb-4 rounded-lg border border-red-600/30 bg-red-600/10 text-red-900 px-4 py-3">
                                {{ $errors->first('rate') }}
                            </div>
                        @endif
            @yield('content')
        </div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <!-- Chat widget removed -->
    {{-- Livewire scripts are loaded via ESM in resources/js/app.js --}}
</body>
</html>
