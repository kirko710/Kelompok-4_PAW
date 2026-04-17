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
<body class="bg-courtee-100/40 min-h-screen flex items-center justify-center px-6 py-12">
    <div class="bg-white rounded-3xl shadow-lg w-full max-w-lg p-10">
        <div class="flex items-center justify-center gap-3 mb-10">
            <div class="flex items-center">
                <img src="/assets/logo.png" alt="Courtee" class="h-24 -mr-5">
                <span class="text-2xl font-bold text-courtee-800">ourtee</span>
            </div>
            <div class="w-px h-8 bg-gray-300"></div>
            <h1 class="text-2xl font-bold text-courtee-700">Register</h1>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register/submit" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="role" value="{{ $role ?? 'user' }}">

            <div>
                <label class="text-sm text-gray-500 mb-1 block">Nama Lengkap</label>
                <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
            </div>

            <div>
                <label class="text-sm text-gray-500 mb-1 block">Email</label>
                <input type="email" name="email" placeholder="johndoe@gmail.com" value="{{ old('email') }}"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
            </div>

            <div>
                <label class="text-sm text-gray-500 mb-1 block">Password</label>
                <input type="password" name="password" placeholder="**********"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
            </div>

            <div>
                <label class="text-sm text-gray-500 mb-1 block">Ulangi Password</label>
                <input type="password" name="password_confirmation" placeholder="**********"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
            </div>

            <div class="text-center pt-2">
                <p class="text-sm text-gray-600">Sudah punya akun? <a href="/login" class="text-courtee-600 font-medium hover:underline">Login</a></p>
            </div>

            <button type="submit"
                class="w-full bg-courtee-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md flex items-center justify-center gap-2">
                Lanjutkan <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>
</body>
</html>
