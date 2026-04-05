<x-layout.layout title="Pembayaran">
    <div class="max-w-2xl mx-auto px-6 py-10">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-6">
            <a href="#" class="w-10 h-10 bg-courtee-100 rounded-full flex items-center justify-center text-courtee-700 hover:bg-courtee-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-bold text-courtee-700">Pembayaran</h1>
        </div>

        <p class="text-gray-600 leading-relaxed">
            Silahkan scan dan lakukan pembayaran melalui QR Code di bawah menggunakan aplikasi e-wallet pilihan anda.
        </p>

        <div class="mt-6 space-y-1">
            <p class="text-courtee-600 font-medium">Nominal yang harus dibayarkan <span class="font-bold text-gray-800">Rp 55.100,00</span></p>
            <p class="text-courtee-600 font-medium">Selesaikan pembayaran dalam <span class="font-bold text-gray-800" id="countdown">60:00</span></p>
        </div>

        {{-- QR Code Placeholder --}}
        <div class="mt-8 flex flex-col items-center">
            <div class="w-72 h-72 bg-gray-100 border-2 border-gray-200 rounded-2xl flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-32 h-32 text-gray-400 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm11-2h2v2h-2v-2zm-4 0h2v2h-2v-2zm0 4h2v2h-2v-2zm4 0h2v2h-2v-2zm2-4h2v2h-2v-2zm0 4h2v2h-2v-2zm2-2h2v2h-2v-2z"/>
                    </svg>
                    <p class="text-sm text-gray-400 mt-2">QR Code</p>
                </div>
            </div>

            <button class="mt-4 flex items-center gap-2 bg-gray-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download QR
            </button>
        </div>

        {{-- Payment Guide --}}
        <div class="mt-10 bg-gray-50 rounded-xl p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">Panduan Pembayaran</h3>
            <ol class="space-y-2 text-sm text-gray-600 list-decimal list-inside">
                <li>Buka aplikasi e-wallet anda</li>
                <li>Pilih menu bayar melalui QR</li>
                <li>Scan QR di atas</li>
                <li>Masukan nominal sesuai tagihan anda</li>
                <li>Selesaikan transfer</li>
                <li>Tekan tombol konfirmasi di bawah</li>
            </ol>
        </div>

        {{-- CTA --}}
        <button class="w-full mt-8 bg-courtee-600 text-white py-4 rounded-xl font-semibold text-sm hover:bg-courtee-700 transition shadow-lg">
            Konfirmasi
        </button>
    </div>

    @push('scripts')
    <script>
        // Countdown timer
        let time = 3600;
        const el = document.getElementById('countdown');
        setInterval(() => {
            if (time <= 0) return;
            time--;
            const m = Math.floor(time / 60).toString().padStart(2, '0');
            const s = (time % 60).toString().padStart(2, '0');
            el.textContent = `${m}:${s}`;
        }, 1000);
    </script>
    @endpush
</x-layout.layout>
