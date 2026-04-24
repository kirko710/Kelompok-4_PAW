<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Courtee')</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Slot CSS tambahan per halaman --}}
    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('components.navbar.navbar')

    {{-- Konten halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.common.footer')

    {{-- Slot JS tambahan per halaman --}}
    @stack('scripts')

</body>
</html>