<x-layout.layout title="Venue Detail">
    {{-- Hero Image --}}
    <div class="w-full h-64 md:h-80 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=1400&q=80"
             alt="Venue" class="w-full h-full object-cover">
    </div>

    <div class="max-w-4xl mx-auto px-6 py-10">
        {{-- Venue Info --}}
        <h1 class="text-3xl font-bold text-gray-800">Longfield Sport Center</h1>
        <p class="text-gray-500 mt-1">Jakarta Pusat</p>

        <div class="flex gap-3 mt-4">
            <a href="#" class="w-9 h-9 bg-courtee-100 rounded-full flex items-center justify-center text-courtee-600 hover:bg-courtee-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
            </a>
            <a href="#" class="w-9 h-9 bg-courtee-100 rounded-full flex items-center justify-center text-courtee-600 hover:bg-courtee-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            </a>
            <a href="#" class="w-9 h-9 bg-courtee-100 rounded-full flex items-center justify-center text-courtee-600 hover:bg-courtee-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
            </a>
        </div>

        {{-- Date Picker --}}
        <div class="mt-8">
            <select class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 w-full max-w-xs outline-none focus:border-courtee-400">
                <option>20 Desember 2025</option>
                <option>21 Desember 2025</option>
                <option>22 Desember 2025</option>
            </select>
        </div>

        {{-- Available Courts --}}
        <h2 class="text-xl font-bold text-gray-800 mt-10 mb-6">Lapangan yang Tersedia</h2>

        @php
            $courts = [
                ['name' => 'Lapangan Sejahtera', 'desc' => 'Lapangan rumput sintetis berkualitas dengan penerangan malam, gawang standar, dan area bersih. Cocok untuk latihan, pertandingan persahabatan, serta kegiatan komunitas.', 'img' => 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80'],
                ['name' => 'Lapangan Makmur', 'desc' => 'Lapangan rumput sintetis berkualitas dengan penerangan malam, gawang standar, dan area bersih. Cocok untuk latihan, pertandingan persahabatan, serta kegiatan komunitas.', 'img' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80'],
            ];
            $timeSlots = [
                ['time' => '06.00-07.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '07.00-08.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '09.00-10.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '10.00-11.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '11.00-12.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '13.00-14.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '14.00-15.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '16.00-17.00', 'price' => 'Rp 24.000,00', 'available' => true],
            ];
        @endphp

        <div class="space-y-8">
            @foreach($courts as $court)
                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-2/5 h-64 md:h-auto overflow-hidden">
                            <img src="{{ $court['img'] }}" alt="{{ $court['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="md:w-3/5 p-6">
                            <h3 class="font-bold text-lg text-gray-800">{{ $court['name'] }}</h3>
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">{{ $court['desc'] }}</p>

                            <div class="grid grid-cols-2 gap-2 mt-5">
                                @foreach($timeSlots as $slot)
                                    <div class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium border
                                        {{ $slot['available'] ? 'border-courtee-300 bg-courtee-50 text-courtee-700 cursor-pointer hover:bg-courtee-100' : 'border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                                        <span>{{ $slot['time'] }}</span>
                                        <span>{{ $slot['price'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <button class="w-full mt-10 bg-courtee-600 text-white py-4 rounded-xl font-semibold text-sm hover:bg-courtee-700 transition shadow-lg">
            Lanjutkan ke Pembayaran
        </button>
    </div>
</x-layout.layout>
