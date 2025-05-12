<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $metadata['title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $metadata['description'] ?? '' }}">
    <meta name="keywords" content="{{ $metadata['keywords'] ?? '' }}">
    <meta name="author" content="{{ $metadata['author'] ?? 'SMK Pelayaran' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $metadata['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $metadata['description'] ?? '' }}">
    <meta property="og:type" content="{{ $metadata['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $metadata['og_url'] ?? url()->current() }}">
    <meta property="og:image" content="{{ $metadata['og_image'] ?? asset('images/logo.png') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $metadata['twitter_card'] ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $metadata['title'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $metadata['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $metadata['og_image'] ?? asset('images/logo.png') }}">

    <!-- Existing head content -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="https://smk-pelayaran-production.up.railway.app/build/assets/app-BOfM0q7f.css">
</head>

<body>
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
    <script src="https://smk-pelayaran-production.up.railway.app/build/assets/app-DspuE8pW.js" defer></script>
</body>

</html>
