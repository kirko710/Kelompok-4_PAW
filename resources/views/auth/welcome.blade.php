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
        {{-- Logo --}}
        <div class="flex items-center justify-center gap-1 mb-6">
            <div class="w-10 h-10 bg-courtee-700 rounded-full flex items-center justify-center">
                <span class="text-white text-lg font-bold">C</span>
            </div>
            <span class="text-2xl font-bold text-courtee-800">ourtee</span>
        </div>

        <p class="text-courtee-600 text-sm font-medium">Anda telah terdaftar!</p>
        <h1 class="text-3xl font-bold text-gray-800 mt-2 mb-8">Selamat Datang di Courtee!</h1>

        {{-- Welcome Illustration --}}
        <div class="bg-courtee-50 rounded-2xl p-8 mb-8">
            <div class="flex justify-center items-end gap-2">
                {{-- Simple SVG people illustration --}}
                <svg viewBox="0 0 400 250" class="w-full max-w-sm" xmlns="http://www.w3.org/2000/svg">
                    {{-- Speech bubble --}}
                    <rect x="130" y="10" width="140" height="40" rx="20" fill="#e9d5ff" stroke="#c084fc" stroke-width="1.5"/>
                    <text x="200" y="36" text-anchor="middle" fill="#7e22ce" font-weight="bold" font-size="14" font-family="Poppins">WELCOME</text>
                    <polygon points="190,50 200,60 210,50" fill="#e9d5ff"/>

                    {{-- Person 1 --}}
                    <circle cx="80" cy="100" r="20" fill="#f97316"/>
                    <rect x="60" y="125" width="40" height="60" rx="10" fill="#f97316"/>
                    <rect x="60" y="185" width="15" height="50" rx="5" fill="#3b82f6"/>
                    <rect x="85" y="185" width="15" height="50" rx="5" fill="#3b82f6"/>

                    {{-- Person 2 --}}
                    <circle cx="160" cy="90" r="22" fill="#9ca3af"/>
                    <rect x="138" y="117" width="44" height="65" rx="10" fill="#d1d5db"/>
                    <rect x="138" y="182" width="17" height="55" rx="5" fill="#4b5563"/>
                    <rect x="165" y="182" width="17" height="55" rx="5" fill="#4b5563"/>

                    {{-- Person 3 --}}
                    <circle cx="240" cy="90" r="22" fill="#6366f1"/>
                    <rect x="218" y="117" width="44" height="65" rx="10" fill="#818cf8"/>
                    <rect x="218" y="182" width="17" height="55" rx="5" fill="#312e81"/>
                    <rect x="245" y="182" width="17" height="55" rx="5" fill="#312e81"/>

                    {{-- Person 4 --}}
                    <circle cx="320" cy="100" r="20" fill="#ef4444"/>
                    <rect x="300" y="125" width="40" height="60" rx="10" fill="#f87171"/>
                    <rect x="300" y="185" width="15" height="50" rx="5" fill="#1e3a5f"/>
                    <rect x="325" y="185" width="15" height="50" rx="5" fill="#1e3a5f"/>

                    {{-- Waving hands --}}
                    <line x1="55" y1="130" x2="30" y2="90" stroke="#f97316" stroke-width="6" stroke-linecap="round"/>
                    <line x1="345" y1="130" x2="370" y2="90" stroke="#f87171" stroke-width="6" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        <a href="/"
            class="block w-full bg-courtee-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md">
            Lanjutkan <span class="ml-1">&rarr;</span>
        </a>
    </div>
</body>
</html>
