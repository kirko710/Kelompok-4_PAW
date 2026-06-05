<x-layout.admin title="Pembatalan & Refund" activeMenu="admin.pembatalan" breadcrumb="Dashboard > Pembatalan & Refund">

    <div x-data="{ tab: 'semua' }">

        <h2 class="text-2xl font-bold text-purple-600 mb-5">Pembatalan & Refund</h2>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 px-5 py-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Tab Navigation --}}
        <div class="flex items-center gap-1 mb-6">
            <button @click="tab = 'semua'"
                :class="tab === 'semua' ? 'bg-purple-600 text-white' : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Semua Permintaan
            </button>
            <button @click="tab = 'menunggu'"
                :class="tab === 'menunggu' ? 'bg-purple-600 text-white' : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Perlu Refund
            </button>
            <button @click="tab = 'selesai'"
                :class="tab === 'selesai' ? 'bg-purple-600 text-white' : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Refund Selesai
            </button>
        </div>

        {{-- Content Card --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

            {{-- Filter Bar --}}
            <form method="GET" action="{{ route('admin.pembatalan') }}" class="flex flex-wrap items-center gap-3 mb-6">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama pelanggan"
                    class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition flex-1 min-w-[200px] max-w-sm">
                <div class="relative">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                        class="border border-gray-200 rounded-lg pl-4 pr-10 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 transition min-w-[160px]">
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 active:scale-95 transition">
                    Cari
                </button>
                @if(request('cari') || request('tanggal'))
                    <a href="{{ route('admin.pembatalan') }}" class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Kode Booking</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Nama Penyewa</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Lapangan</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Jadwal Pesanan</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Status Refund</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $p)
                            @php
                                $statusBayar = optional($p->pembayaran)->status_bayar ?? 'failed';
                                $isRefunded  = $statusBayar === 'refunded';
                                $isPaid      = $statusBayar === 'paid'; // Pembayaran sudah dibayar → perlu refund

                                // Tentukan status label refund
                                if ($isRefunded) {
                                    $refundLabel = 'Selesai';
                                    $refundBadge = 'bg-green-100 text-green-600 border-green-200';
                                    $tabTarget   = 'selesai';
                                } elseif ($isPaid) {
                                    $refundLabel = 'Perlu Refund';
                                    $refundBadge = 'bg-orange-100 text-orange-500 border-orange-200';
                                    $tabTarget   = 'menunggu';
                                } else {
                                    $refundLabel = 'Tidak Ada Refund';
                                    $refundBadge = 'bg-gray-100 text-gray-500 border-gray-200';
                                    $tabTarget   = 'selesai'; // sudah tidak perlu aksi
                                }
                            @endphp
                            <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors"
                                x-show="tab === 'semua' || tab === '{{ $tabTarget }}'">

                                {{-- Kode Booking --}}
                                <td class="px-4 py-4 text-gray-600 font-mono text-xs whitespace-nowrap">
                                    #ORD-{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- Nama Penyewa --}}
                                <td class="px-4 py-4 text-gray-800 font-medium whitespace-nowrap">
                                    {{ optional($p->user)->name ?? '-' }}
                                </td>

                                {{-- Lapangan --}}
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">
                                    {{ optional($p->lapangan)->nama ?? '-' }}
                                </td>

                                {{-- Jadwal Pesanan --}}
                                <td class="px-4 py-4 text-gray-600">
                                    <p class="whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($p->tanggal_pesan)->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="text-xs text-gray-400 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i') }}
                                        –
                                        {{ \Carbon\Carbon::parse($p->waktu_selesai)->format('H:i') }}
                                    </p>
                                </td>

                                {{-- Status Refund --}}
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $refundBadge }}">
                                        {{ $refundLabel }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-4">
                                    @if($isPaid && !$isRefunded)
                                        {{-- Perlu refund → tampilkan tombol Refund --}}
                                        <form action="{{ route('admin.pembatalan.refund', $p->id) }}" method="POST"
                                              onsubmit="return confirm('Konfirmasi refund untuk {{ optional($p->user)->name }}?')">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg active:scale-95 transition whitespace-nowrap">
                                                Proses Refund
                                            </button>
                                        </form>
                                    @elseif($isRefunded)
                                        <span class="text-xs text-green-500 font-medium">✓ Selesai</span>
                                    @else
                                        <span class="text-gray-300 text-xs">—</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-sm text-gray-400 font-medium">Tidak ada data pembatalan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-layout.admin>
