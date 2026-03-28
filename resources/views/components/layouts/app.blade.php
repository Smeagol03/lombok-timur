<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <x-seo-meta 
        :title="$title ?? null"
        :description="$description ?? null"
        :keywords="$keywords ?? null"
        :author="$author ?? null"
        :noIndex="$noIndex ?? false"
        :type="$ogType ?? null"
        :url="$url ?? null"
        :image="$ogImage ?? null"
    />

    @if($setting && $setting->getFirstMediaUrl('favicon'))
    <link rel="icon" type="image/x-icon" href="{{ $setting->getFirstMediaUrl('favicon') }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif

    @if($setting && $setting->site_name)
    <meta name="application-name" content="{{ $setting->site_name }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('meta')
</head>
<body class="antialiased font-body bg-white text-gray-900">
    <div class="hidden md:block">
        @include('components.layouts.partials.topbar')
    </div>

    @include('components.layouts.partials.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('components.layouts.partials.footer')

    @stack('scripts')
</body>
</html>