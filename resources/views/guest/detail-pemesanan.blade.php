<x-layout.layout title="Detail Pemesanan">
    <div class="max-w-2xl mx-auto px-6 py-10">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="#" class="w-10 h-10 bg-courtee-100 rounded-full flex items-center justify-center text-courtee-700 hover:bg-courtee-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-bold text-courtee-700">Detail Pemesanan</h1>
        </div>

        {{-- Booking Items --}}
        <div class="space-y-4">
            @php
                $bookings = [
                    ['venue' => 'Longfield Sport Center', 'court' => 'Lapangan Makmur', 'date' => '20 Desember 2025', 'time' => '09.00-10.00', 'price' => '25.000,00'],
                    ['venue' => 'Longfield Sport Center', 'court' => 'Lapangan Makmur', 'date' => '20 Desember 2025', 'time' => '10.00-11.00', 'price' => '25.000,00'],
                ];
            @endphp

            @foreach($bookings as $booking)
                <div class="border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $booking['venue'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $booking['court'] }}</p>
                        </div>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="text-gray-600">{{ $booking['date'] }}</span>
                            <span class="text-courtee-600 font-semibold">{{ $booking['time'] }}</span>
                            <span class="text-gray-800 font-medium">Rp {{ $booking['price'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="mt-8 space-y-3">
            <div class="flex justify-between text-sm">
                <span class="text-courtee-600 font-medium">Subtotal</span>
                <span class="text-gray-800 font-medium">Rp 50.000,00</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-courtee-600 font-medium">Pajak (12%)</span>
                <span class="text-gray-800 font-medium">Rp 5.100,00</span>
            </div>
            <hr class="border-gray-200">
            <div class="flex justify-between text-sm">
                <span class="text-courtee-600 font-bold">Total</span>
                <span class="text-gray-800 font-bold text-lg">Rp 55.100,00</span>
            </div>
        </div>

        {{-- Payment Method --}}
        <div class="mt-10">
            <h2 class="text-xl font-bold text-courtee-700 mb-4">Metode Pembayaran</h2>
            <div class="flex gap-4">
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="payment" value="qris" class="hidden peer" checked>
                    <div class="border-2 border-gray-200 rounded-xl p-6 text-center peer-checked:border-green-500 peer-checked:bg-green-50 transition">
                        <div class="text-3xl font-bold tracking-wider text-gray-800">QRIS</div>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="payment" value="bank" class="hidden peer">
                    <div class="border-2 border-gray-200 rounded-xl p-6 text-center peer-checked:border-green-500 peer-checked:bg-green-50 transition">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/></svg>
                            <span class="font-bold text-gray-800">Mobile Banking</span>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        {{-- CTA --}}
        <button class="w-full mt-8 bg-courtee-600 text-white py-4 rounded-xl font-semibold text-sm hover:bg-courtee-700 transition shadow-lg">
            Lanjutkan ke Konfirmasi Pembayaran
        </button>
    </div>
</x-layout.layout>
