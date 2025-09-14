<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="p-4 flex justify-end gap-2">
        @foreach(['ar' => 'العربية', 'en' => 'English', 'fr' => 'Français'] as $lang => $label)
            <a href="{{ url('lang/' . $lang) }}" class="px-3 py-1 rounded @if(app()->getLocale() === $lang) bg-blue-500 text-white @else bg-gray-200 @endif">
                {{ $label }}
            </a>
        @endforeach
    </nav>
    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
