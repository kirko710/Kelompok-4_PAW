<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Preferensi - Courtee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>* { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-purple-700">Semua Preferensi User (JSON)</h1>
            <a href="/" class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100">Kembali</a>
        </div>

        {{-- Search dengan JS DOM --}}
        <input type="text" id="search-input" placeholder="Cari nama user..."
            class="w-full border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-purple-400 mb-6">

        <div id="preferences-list" class="space-y-4">
            @forelse($preferences as $userId => $pref)
                <div class="preference-item bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-800 user-name">{{ $pref['user_name'] }}</h3>
                            <p class="text-sm text-gray-500 mt-1">User ID: {{ $userId }}</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $pref['updated_at'] }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($pref['olahraga_favorit'] as $olahraga)
                            <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-medium">{{ $olahraga }}</span>
                        @endforeach
                    </div>
                    <div class="flex gap-4 mt-3 text-xs text-gray-500">
                        <span>📧 Email: {{ $pref['notifikasi_email'] ? 'Aktif' : 'Non-aktif' }}</span>
                        <span>🔔 Booking: {{ $pref['notifikasi_booking'] ? 'Aktif' : 'Non-aktif' }}</span>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl p-12 text-center">
                    <p class="text-gray-400">Belum ada preferensi tersimpan.</p>
                </div>
            @endforelse
        </div>

        <p class="text-xs text-gray-400 mt-4">Total: {{ count($preferences) }} user | Data dari: <code>storage/app/user_preferences.json</code></p>
    </div>

    <script>
        // SEARCH dengan JavaScript DOM
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.preference-item').forEach(function(item) {
                const name = item.querySelector('.user-name').textContent.toLowerCase();
                item.style.display = name.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>
</html>