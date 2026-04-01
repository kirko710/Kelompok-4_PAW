<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Preferensi - Courtee</title>
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
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="flex items-center gap-1">
                <div class="w-10 h-10 bg-courtee-700 rounded-full flex items-center justify-center">
                    <span class="text-white text-lg font-bold">C</span>
                </div>
                <span class="text-2xl font-bold text-courtee-800">ourtee</span>
            </div>
            <div class="w-px h-8 bg-gray-300"></div>
            <h1 class="text-2xl font-bold text-courtee-700">Register</h1>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 text-center mb-8">Setelan Preferensi</h2>

        <form action="#" method="POST" class="space-y-6">
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Olahraga Favorit</label>
                <select class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition appearance-none bg-white">
                    <option>Pilih olahraga favorit anda (multiseleksi)</option>
                    <option>Sepak Bola</option>
                    <option>Basket</option>
                    <option>Tenis</option>
                    <option>Badminton</option>
                    <option>Futsal</option>
                    <option>Renang</option>
                </select>
                <div class="flex gap-2 mt-3">
                    <span class="flex items-center gap-1.5 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600 font-medium">
                        <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Sepak Bola <button class="ml-0.5 hover:text-red-500">&times;</button>
                    </span>
                    <span class="flex items-center gap-1.5 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600 font-medium">
                        <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Basket <button class="ml-0.5 hover:text-red-500">&times;</button>
                    </span>
                    <span class="flex items-center gap-1.5 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600 font-medium">
                        <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Tenis <button class="ml-0.5 hover:text-red-500">&times;</button>
                    </span>
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500 mb-1 block">Alamat</label>
                <input type="text" placeholder="Jl. Sultan Ageng Tirtayasa, No. 67, Mojolangu, Lowokwaru, Malang 245823"
                    class="w-full border border-gray-200 rounded-xl px-5 py-3.5 text-sm outline-none focus:border-courtee-400 transition">
            </div>

            <div class="flex gap-3 pt-4">
                <a href="#"
                    class="flex items-center justify-center gap-2 px-6 py-3.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <button type="submit"
                    class="flex-1 bg-courtee-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-courtee-600 transition shadow-md flex items-center justify-center gap-2">
                    Lanjutkan <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
