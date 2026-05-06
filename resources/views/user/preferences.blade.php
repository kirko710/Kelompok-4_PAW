<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferensi - Courtee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { courtee: { 50:'#faf5ff',500:'#a855f7',600:'#9333ea',700:'#7e22ce' }}}}}
    </script>
    <style>* { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-courtee-700">Preferensi Saya</h1>
            <a href="/" class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100">Kembali</a>
        </div>

        {{-- Feedback --}}
        @if(session('success'))
            <div id="alert-success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-6 flex justify-between">
                {{ session('success') }}
                <button onclick="document.getElementById('alert-success').remove()" class="font-bold">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Form Preferensi --}}
        <form action="/preferensi/save" method="POST" class="bg-white rounded-2xl shadow-sm p-8 space-y-6">
            @csrf

            {{-- Pilih Olahraga --}}
            <div>
                <h2 class="font-bold text-gray-800 mb-4">Olahraga Favorit</h2>
                <div id="olahraga-container" class="grid grid-cols-3 gap-3">
                    @php
                        $olahragaList = ['Futsal', 'Badminton', 'Tenis', 'Basket', 'Sepak Bola', 'Renang', 'Voli', 'Padel'];
                        $selected = $userPref['olahraga_favorit'] ?? [];
                    @endphp
                    @foreach($olahragaList as $item)
                        <label class="olahraga-item flex items-center gap-2 p-3 border-2 rounded-xl cursor-pointer transition hover:border-courtee-400
                            {{ in_array($item, $selected) ? 'border-courtee-500 bg-courtee-50' : 'border-gray-200' }}">
                            <input type="checkbox" name="olahraga[]" value="{{ $item }}"
                                class="w-4 h-4 accent-purple-600"
                                {{ in_array($item, $selected) ? 'checked' : '' }}
                                onchange="updateSelection(this)">
                            <span class="text-sm font-medium">{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
                {{-- Counter dinamis pakai JS DOM --}}
                <p id="counter" class="text-sm text-gray-500 mt-3">
                    <span id="count">{{ count($selected) }}</span> olahraga dipilih
                </p>
            </div>

            {{-- Notifikasi --}}
            <div>
                <h2 class="font-bold text-gray-800 mb-4">Pengaturan Notifikasi</h2>
                <div class="space-y-3">
                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl cursor-pointer">
                        <span class="text-sm font-medium">Notifikasi Email</span>
                        <input type="checkbox" name="notifikasi_email" value="1"
                            class="w-5 h-5 accent-purple-600"
                            {{ ($userPref['notifikasi_email'] ?? false) ? 'checked' : '' }}>
                    </label>
                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl cursor-pointer">
                        <span class="text-sm font-medium">Notifikasi Booking</span>
                        <input type="checkbox" name="notifikasi_booking" value="1"
                            class="w-5 h-5 accent-purple-600"
                            {{ ($userPref['notifikasi_booking'] ?? false) ? 'checked' : '' }}>
                    </label>
                </div>
            </div>

            {{-- Preview pilihan (JS DOM) --}}
            <div id="preview-section" class="{{ count($selected) > 0 ? '' : 'hidden' }}">
                <h2 class="font-bold text-gray-800 mb-3">Pilihan Kamu</h2>
                <div id="preview-tags" class="flex flex-wrap gap-2">
                    @foreach($selected as $item)
                        <span class="px-3 py-1 bg-courtee-100 text-courtee-700 rounded-full text-sm font-medium">{{ $item }}</span>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                class="w-full bg-courtee-600 text-white py-3 rounded-xl font-semibold text-sm hover:bg-courtee-700 transition">
                Simpan Preferensi
            </button>
        </form>

        {{-- Info penyimpanan --}}
        <p class="text-xs text-gray-400 mt-4 text-center">
            Data preferensi disimpan di <code>storage/app/user_preferences.json</code>
        </p>

        @if($userPref)
        <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
            <h3 class="font-bold text-gray-700 mb-3">Data Tersimpan (dari JSON)</h3>
            <div class="text-sm text-gray-600 space-y-2">
                <p><span class="font-medium">User:</span> {{ $userPref['user_name'] }}</p>
                <p><span class="font-medium">Olahraga:</span> {{ implode(', ', $userPref['olahraga_favorit']) }}</p>
                <p><span class="font-medium">Notifikasi Email:</span> {{ $userPref['notifikasi_email'] ? 'Ya' : 'Tidak' }}</p>
                <p><span class="font-medium">Notifikasi Booking:</span> {{ $userPref['notifikasi_booking'] ? 'Ya' : 'Tidak' }}</p>
                <p><span class="font-medium">Diupdate:</span> {{ $userPref['updated_at'] }}</p>
            </div>
        </div>
        @endif
    </div>

    {{-- ===== JAVASCRIPT DOM ===== --}}
    <script>
        // UPDATE COUNTER & PREVIEW saat checkbox berubah (JavaScript DOM)
        function updateSelection(checkbox) {
            const label = checkbox.closest('.olahraga-item');
            const countEl = document.getElementById('count');
            const previewSection = document.getElementById('preview-section');
            const previewTags = document.getElementById('preview-tags');

            // Update styling label
            if (checkbox.checked) {
                label.classList.add('border-courtee-500', 'bg-courtee-50');
                label.classList.remove('border-gray-200');
            } else {
                label.classList.remove('border-courtee-500', 'bg-courtee-50');
                label.classList.add('border-gray-200');
            }

            // Kumpulkan semua yang dipilih
            const checked = document.querySelectorAll('input[name="olahraga[]"]:checked');
            const count = checked.length;

            // Update counter (DOM manipulation)
            countEl.textContent = count;

            // Update preview tags (DOM manipulation)
            if (count > 0) {
                previewSection.classList.remove('hidden');
                previewTags.innerHTML = '';
                checked.forEach(function(item) {
                    const tag = document.createElement('span');
                    tag.className = 'px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium';
                    tag.textContent = item.value;
                    previewTags.appendChild(tag);
                });
            } else {
                previewSection.classList.add('hidden');
            }
        }

        // FILTER OLAHRAGA dengan search (JavaScript DOM)
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Cari olahraga...';
        searchInput.className = 'w-full border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-purple-400 mb-4';
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.olahraga-item').forEach(function(item) {
                const name = item.querySelector('span').textContent.toLowerCase();
                item.style.display = name.includes(query) ? '' : 'none';
            });
        });

        const container = document.getElementById('olahraga-container');
        container.parentNode.insertBefore(searchInput, container);
    </script>
</body>
</html>