<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Profile - Courtee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { courtee: { 50:'#faf5ff',100:'#f3e8ff',200:'#e9d5ff',300:'#d8b4fe',400:'#c084fc',500:'#a855f7',600:'#9333ea',700:'#7e22ce',800:'#6b21a8',900:'#581c87' }}}}}
    </script>
    <style>* { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-courtee-100/40 min-h-screen flex items-center justify-center px-6 py-12">
    <div class="bg-white rounded-3xl shadow-lg w-full max-w-lg p-10">
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="flex items-center">
                <img src="/assets/logo.png" alt="Courtee" class="h-24 -mr-5">
                <span class="text-xl font-bold text-courtee-800">ourtee</span>
            </div>
            <div class="w-px h-7 bg-gray-300"></div>
            <h1 class="text-xl font-bold text-courtee-600">Register</h1>
        </div>

        <div class="flex flex-col items-center mb-8">
            <div class="w-32 h-32 rounded-full bg-gray-100 border-4 border-courtee-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&q=80" alt="Avatar" class="w-full h-full object-cover">
            </div>
            <button type="button" class="mt-3 px-5 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">
                Pilih foto profil
            </button>
        </div>

        <form action="{{ route('register.profile.save') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="John Doe"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-courtee-400 transition">
            </div>
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Alamat</label>
                <input type="text" name="alamat" placeholder="Jl. Contoh No. 123"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-courtee-400 transition">
            </div>
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Tanggal Lahir</label>
                <input type="text" name="tanggal_lahir" placeholder="16/06/2000"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-courtee-400 transition">
            </div>
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Nomor Telepon</label>
                <input type="text" name="telepon" placeholder="+6281234737805"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-courtee-400 transition">
            </div>
            <div class="flex gap-3 pt-4">
                <a href="javascript:history.back()"
                    class="flex items-center justify-center gap-2 px-6 py-3 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <button type="submit"
                    class="flex-1 bg-courtee-500 text-white py-3 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md flex items-center justify-center gap-2">
                    Lanjutkan <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
