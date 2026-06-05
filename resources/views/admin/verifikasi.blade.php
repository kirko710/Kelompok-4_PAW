<x-layout.admin title="Verifikasi Pembayaran" activeMenu="admin.verifikasi" breadcrumb="Dashboard > Verifikasi Pembayaran">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Pembayaran</h2>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 px-5 py-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 flex items-center gap-3 px-5 py-3 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <h3 class="font-bold text-gray-800">Notifikasi Pembayaran</h3>
            </div>
            @if($pemesanans->isNotEmpty())
                <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                    {{ $pemesanans->count() }} menunggu
                </span>
            @endif
        </div>

        <div class="space-y-6">
            @forelse($pemesanans as $p)
                @php
                    $bayar   = $p->pembayaran;
                    $metodeLabel = match($bayar?->metode_pembayaran ?? '') {
                        'transfer_bank' => 'Transfer Bank',
                        'qris'          => 'QRIS',
                        'tunai'         => 'Tunai',
                        default         => ucfirst($bayar?->metode_pembayaran ?? '-'),
                    };
                @endphp
                <div class="border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Payment Info --}}
                        <div class="border border-gray-100 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Pembayaran Masuk</h4>
                                    <p class="text-xs text-gray-500">{{ optional($bayar?->created_at)->diffForHumans() ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="text-gray-500">Metode Pembayaran</span>
                                    <p class="font-bold text-xl text-gray-800">{{ $metodeLabel }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Dari</span>
                                    <p class="font-bold text-lg text-gray-800">{{ optional($p->user)->name ?? '-' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Nominal</span>
                                    <p class="font-bold text-xl text-gray-800">
                                        Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if($bayar?->nomor_referensi)
                                    <div>
                                        <span class="text-gray-500">No. Referensi</span>
                                        <p class="font-medium text-gray-700 font-mono text-xs">{{ $bayar->nomor_referensi }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Booking Details --}}
                        <div class="border border-gray-100 rounded-xl p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-courtee-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-courtee-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-gray-800">Detail Pemesanan</h4>
                                </div>
                                <span class="flex items-center gap-1 px-3 py-1 bg-yellow-50 border border-yellow-200 rounded-full text-xs font-medium text-yellow-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Menunggu Verifikasi
                                </span>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="text-gray-500">Nama Lapangan</span>
                                    <p class="font-bold text-lg text-gray-800">{{ optional($p->lapangan)->nama ?? '-' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Tanggal</span>
                                    <p class="font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($p->tanggal_pesan)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Slot Waktu</span>
                                    <p class="font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i') }}
                                        –
                                        {{ \Carbon\Carbon::parse($p->waktu_selesai)->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-5 flex gap-3 justify-end">
                                {{-- Tolak --}}
                                <form action="{{ route('admin.verifikasi.proses', $p->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                                    @csrf
                                    <input type="hidden" name="action" value="tolak">
                                    <button type="submit"
                                            class="px-5 py-2.5 rounded-lg text-sm font-medium bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 transition">
                                        Tolak
                                    </button>
                                </form>
                                {{-- Konfirmasi --}}
                                <form action="{{ route('admin.verifikasi.proses', $p->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="terima">
                                    <button type="submit"
                                            class="px-6 py-2.5 rounded-lg text-sm font-medium bg-courtee-600 hover:bg-courtee-700 text-white transition">
                                        Konfirmasi
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-base font-semibold text-gray-700">Semua Pembayaran Terverifikasi</p>
                    <p class="text-sm text-gray-400 mt-1">Tidak ada pembayaran yang menunggu konfirmasi</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout.admin>
