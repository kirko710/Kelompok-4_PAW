<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Courtee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] },
                    colors: {
                        courtee: {
                            50: '#faf5ff', 100: '#f3e8ff', 200: '#e9d5ff', 300: '#d8b4fe',
                            400: '#c084fc', 500: '#a855f7', 600: '#9333ea', 700: '#7e22ce',
                            800: '#6b21a8', 900: '#581c87',
                        }
                    }
                }
            }
        }
    </script>
    <style>* { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-courtee-100/40 min-h-screen flex items-center justify-center px-6 py-12">
    <div class="bg-white rounded-3xl shadow-lg w-full max-w-lg p-10 text-center">
        <div class="flex items-center justify-center gap-1 mb-6">
            <img src="/assets/logo.png" alt="Courtee" class="h-24 -mr-5">
            <span class="text-2xl font-bold text-courtee-800">ourtee</span>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-courtee-600 text-sm font-medium">Anda telah terdaftar!</p>
        <h1 class="text-3xl font-bold text-gray-800 mt-2 mb-4">Selamat Datang di Courtee!</h1>

        @auth
            <p class="text-gray-500 mb-8">Halo, <strong>{{ Auth::user()->name }}</strong>! Akun kamu sudah siap.</p>
        @endauth

        <div class="bg-courtee-50 rounded-2xl p-8 mb-8">
            <svg viewBox="0 0 400 200" class="w-full max-w-sm mx-auto" xmlns="http://www.w3.org/2000/svg">
                <rect x="130" y="10" width="140" height="40" rx="20" fill="#e9d5ff" stroke="#c084fc" stroke-width="1.5"/>
                <text x="200" y="36" text-anchor="middle" fill="#7e22ce" font-weight="bold" font-size="14" font-family="Poppins">WELCOME</text>
                <circle cx="100" cy="100" r="20" fill="#f97316"/>
                <rect x="80" y="125" width="40" height="50" rx="10" fill="#f97316"/>
                <circle cx="200" cy="90" r="22" fill="#6366f1"/>
                <rect x="178" y="117" width="44" height="55" rx="10" fill="#818cf8"/>
                <circle cx="300" cy="100" r="20" fill="#ef4444"/>
                <rect x="280" y="125" width="40" height="50" rx="10" fill="#f87171"/>
            </svg>
        </div>

        <a href="/" class="block w-full bg-courtee-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md">
            Lanjutkan &rarr;
        </a>
    </div>
</body>
</html>
