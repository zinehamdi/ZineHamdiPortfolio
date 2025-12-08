<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Metallic Laser Portfolio') }}</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/metallic-hero.js',
        'resources/js/metallic-sections.js',
    ])
</head>
<body class="antialiased">
    @include('sections.metallic-hero')
    @include('sections.metallic-projects')
    @include('sections.premium-services')
    @include('sections.laser-contact')
</body>
</html>
