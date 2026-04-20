<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trend Blogger') - Your source of great content</title>
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.svg') }}">
    <meta name="theme-color" content="#4DE5E7">
    
    <!-- SEO and Social Media -->
    <meta name="description" content="Trend Blogger - Your source of great content and trending topics">
    <meta name="keywords" content="blog, trending, articles, content, news">
    <meta name="author" content="Trend Blogger">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Trend Blogger - Your source of great content">
    <meta property="og:description" content="Discover amazing content from talented writers around the world">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Trend Blogger - Your source of great content">
    <meta property="twitter:description" content="Discover amazing content from talented writers around the world">
    <meta property="twitter:image" content="{{ asset('images/og-image.png') }}">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('layouts.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>
</html>
