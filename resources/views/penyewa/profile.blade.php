<x-layout.layout title="Profile">
    {{-- Cover --}}
    <div class="relative h-48 bg-gradient-to-r from-courtee-400 to-courtee-600">
        <div class="absolute -bottom-16 left-8">
            <img src="https://ui-avatars.com/api/?name=Ahmad+Brandon&size=128&background=7e22ce&color=fff"
                 class="w-32 h-32 rounded-full border-4 border-white shadow-lg" alt="Avatar">
        </div>
        <div class="absolute bottom-4 left-48">
            <button class="bg-red-500 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">Logout</button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-20 pb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left: Profile Info --}}
            <div class="space-y-4">
                <div>
                    <label class="text-sm text-gray-500">Nama</label>
                    <input type="text" value="Ahmad Brandon" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400" readonly>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Tanggal Lahir</label>
                    <div class="flex gap-2 mt-1">
                        <input type="text" value="31" class="w-16 border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-center outline-none" readonly>
                        <input type="text" value="Oktober" class="flex-1 border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none" readonly>
                        <input type="text" value="1982" class="w-20 border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-center outline-none" readonly>
                    </div>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Email</label>
                    <input type="email" value="saipulAlexan87@gmail.com" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none" readonly>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Nomor Telepon</label>
                    <input type="text" value="081923129" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none" readonly>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Alamat</label>
                    <input type="text" value="Jalan Icikiwir No.68, Tangerang, Indonesia" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none" readonly>
                </div>
                <button class="bg-courtee-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-courtee-700 transition flex items-center gap-2 mx-auto">
                    Edit <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </button>
            </div>

            {{-- Center: Transaction History --}}
            <div>
                <div class="flex gap-3 mb-4">
                    <select class="bg-courtee-600 text-white px-4 py-2 rounded-lg text-sm font-medium outline-none">
                        <option>Berdasarkan</option>
                        <option>Terbaru</option>
                        <option>Terlama</option>
                    </select>
                    <select class="bg-courtee-600 text-white px-4 py-2 rounded-lg text-sm font-medium outline-none">
                        <option>Semua Status</option>
                        <option>Berhasil</option>
                        <option>Gagal</option>
                        <option>Tertunda</option>
                    </select>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <table class="w-full text-sm">
                        <tbody>
                            @php
                                $transactions = [
                                    ['date' => '28 Mei', 'venue' => 'SAlex86', 'amount' => 'Rp 1.700', 'status' => 'Berhasil', 'color' => 'green'],
                                    ['date' => '17 Agus', 'venue' => 'SAlex86', 'amount' => 'Rp 2.500', 'status' => 'Berhasil', 'color' => 'green'],
                                    ['date' => '15 Apr', 'venue' => 'SAlex86', 'amount' => 'Rp 300', 'status' => 'Gagal', 'color' => 'red'],
                                    ['date' => '20 Des', 'venue' => 'SAlex86', 'amount' => 'Rp 450', 'status' => 'Tertunda', 'color' => 'yellow'],
                                ];
                            @endphp
                            @foreach($transactions as $t)
                                <tr class="border-b border-gray-50">
                                    <td class="px-4 py-3 text-gray-600">{{ $t['date'] }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $t['venue'] }}</td>
                                    <td class="px-4 py-3 text-gray-700 font-medium">{{ $t['amount'] }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            {{ $t['color'] === 'green' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $t['color'] === 'red' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $t['color'] === 'yellow' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                            {{ $t['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-4 py-3 bg-gray-50 text-sm flex justify-between">
                        <span class="text-gray-500">4 Transaksi</span>
                        <span class="font-medium text-gray-700">Total Rp 4.950.000</span>
                    </div>
                </div>

                {{-- Favorite Sports --}}
                <div class="mt-6">
                    <label class="text-sm text-gray-500">Olahraga Favorit</label>
                    <select class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                        <option>Pilih olahraga favorit anda (multiseleksi)</option>
                    </select>
                    <div class="flex gap-2 mt-3">
                        <span class="flex items-center gap-1 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600">
                            <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Sepak Bola <button>&times;</button>
                        </span>
                        <span class="flex items-center gap-1 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600">
                            <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Basket <button>&times;</button>
                        </span>
                        <span class="flex items-center gap-1 px-3 py-1 bg-courtee-50 border border-courtee-200 rounded-full text-xs text-courtee-600">
                            <span class="w-2 h-2 bg-courtee-500 rounded-full"></span> Tenis <button>&times;</button>
                        </span>
                    </div>
                    <div class="flex justify-end mt-3">
                        <button class="bg-courtee-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-courtee-700 transition">Simpan</button>
                    </div>
                </div>
            </div>

            {{-- Right: Notification Settings --}}
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm h-fit">
                <h3 class="font-bold text-gray-800 mb-4">Notification Settings</h3>
                <div class="space-y-4">
                    @foreach(['Payment Receipt' => true, 'Payment Reminder' => true, 'Offer and Promotions' => false, 'Security Alert' => true] as $label => $on)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $label }}</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ $on ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-courtee-600"></div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Upcoming Booking --}}
        <div class="mt-10 border border-gray-100 rounded-xl p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-courtee-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-courtee-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Lapangan Futsal A</h3>
                        <p class="text-sm text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            GOR Bakti
                        </p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium">Segera</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 text-sm">
                <div><span class="text-gray-500">Waktu:</span> <span class="font-medium">Senin, 1 Des - 09:00</span></div>
                <div><span class="text-gray-500">Tim:</span> <span class="font-medium">Tim Futsal A</span></div>
                <div><span class="text-gray-500">Durasi:</span> <span class="font-medium">2 Jam</span></div>
                <div><span class="text-gray-500">Harga:</span> <span class="font-medium">Rp200.000</span></div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="bg-courtee-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-courtee-700 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    Atur Pengingat
                </button>
                <button class="border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-50 transition">Lihat Detail</button>
                <button class="bg-red-500 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-red-600 transition">Batalkan</button>
            </div>
        </div>
    </div>
</x-layout.layout>
