<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Courtee</title>
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
<body class="bg-courtee-100/40 min-h-screen flex flex-col">

    <div class="p-6">
        <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm text-sm text-gray-600 hover:bg-gray-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Home
        </a>
    </div>

    <div class="flex-1 flex items-center justify-center px-6 pb-16">
        <div class="bg-white rounded-3xl shadow-lg w-full max-w-lg p-10">
            {{-- Logo --}}
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="flex items-center">
                    
                </div>
                <img src="/assets/logo.png" alt="Courtee" class="h-24 -mr-7"><span class="text-2xl font-bold text-courtee-800">ourtee</span>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 text-center mb-8">Daftar sebagai</h2>

            <div class="space-y-4">
                <a href="/register/user"
                    class="flex items-center justify-center gap-3 w-full bg-courtee-500 text-white py-4 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    User
                </a>
                <a href="/register/owner"
                    class="flex items-center justify-center gap-3 w-full bg-courtee-400 text-white py-4 rounded-xl font-semibold text-sm hover:bg-courtee-500 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Owner
                </a>
            </div>

            <div class="text-center mt-8">
                <p class="text-sm text-gray-600">Sudah punya akun? <a href="/login" class="text-courtee-600 font-medium hover:underline">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
