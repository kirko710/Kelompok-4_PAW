<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Courtee')</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="auth-body">

    <div class="auth-container">

        {{-- Sisi kiri: branding / ilustrasi --}}
        <div class="auth-side">
            <a href="{{ route('home') }}" class="navbar__logo">
                <img src="{{ asset('images/logo.png') }}" alt="Courtee Logo">
                <span class="navbar__logo-text">ourtee</span>
            </a>
            <p class="auth-side__tagline">
                Temukan & booking lapangan olahraga favoritmu dengan mudah.
            </p>
        </div>

        {{-- Sisi kanan: form login / register --}}
        <div class="auth-form">
            @yield('content')
        </div>

    </div>

    @stack('scripts')
</body>
</html>