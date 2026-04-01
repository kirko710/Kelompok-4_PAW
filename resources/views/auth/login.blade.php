<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Courtee</title>
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

    {{-- Back Button --}}
    <div class="p-6">
        <a href="/" class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm text-sm text-gray-600 hover:bg-gray-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Home
        </a>
    </div>

    {{-- Login Card --}}
    <div class="flex-1 flex items-center justify-center px-6 pb-16">
        <div class="bg-white rounded-3xl shadow-lg w-full max-w-lg p-10">
            {{-- Logo --}}
            <div class="flex items-center justify-center gap-3 mb-10">
                <div class="flex items-center gap-1">
                    <div class="w-10 h-10 bg-courtee-700 rounded-full flex items-center justify-center">
                        <span class="text-white text-lg font-bold">C</span>
                    </div>
                    <span class="text-2xl font-bold text-courtee-800">ourtee</span>
                </div>
                <div class="w-px h-8 bg-gray-300"></div>
                <h1 class="text-2xl font-bold text-courtee-700">Login</h1>
            </div>

            {{-- Form --}}
            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label class="text-sm text-gray-500 mb-1 block">Email</label>
                    <input type="email" placeholder="johndoe@gmail.com"
                        class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
                </div>

                <div>
                    <label class="text-sm text-gray-500 mb-1 block">Password</label>
                    <input type="password" placeholder="**********"
                        class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
                </div>

                <div class="text-center pt-2">
                    <p class="text-sm text-gray-600">Belum punya akun? <a href="/register" class="text-courtee-600 font-medium hover:underline">Register</a></p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-courtee-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md">
                        Login sebagai Penyewa
                    </button>
                    <button type="submit"
                        class="flex-1 border-2 border-gray-200 text-gray-700 py-3.5 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Login sebagai Owner
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
