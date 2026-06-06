<x-layout.admin title="Laporan & Analitik" activeMenu="admin.laporan" breadcrumb="Dashboard > Laporan & Analitik">

<div x-data="laporanPage()" x-init="init()">

    {{-- ============================================================ --}}
    {{-- Header                                                       --}}
    {{-- ============================================================ --}}
    <div class="flex items-center justify-between mb-1">
        <h2 class="text-2xl font-bold text-gray-800">Laporan & Analitik</h2>
    </div>
    <hr class="border-gray-200 mb-5">

    {{-- Filter --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-sm font-medium text-gray-600">Filter:</span>
        <div class="relative">
            <select
                x-model="filter"
                @change="switchFilter()"
                class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2 text-sm text-gray-700 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[140px]"
            >
                <option value="mingguan">7 Hari Terakhir</option>
                <option value="harian">30 Hari Terakhir</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- Stat Cards                                                   --}}
    {{-- ============================================================ --}}
    @php
        if ($totalPendapatan >= 1_000_000) {
            $pendapatanLabel = 'Rp ' . number_format($totalPendapatan / 1_000_000, 1) . ' Jt';
        } elseif ($totalPendapatan >= 1_000) {
            $pendapatanLabel = 'Rp ' . number_format($totalPendapatan / 1_000, 0) . ' Rb';
        } else {
            $pendapatanLabel = 'Rp ' . number_format($totalPendapatan, 0, ',', '.');
        }
    @endphp

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Pendapatan</p>
                <p class="text-xl font-bold text-gray-800">{{ $pendapatanLabel }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-white text-sm font-bold">Rp</span>
            </div>
        </div>

        {{-- Total Jam Booking --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Jam Booking</p>
                <p class="text-xl font-bold text-gray-800">{{ $totalJamBooking }}</p>
            </div>
            <div class="w-10 h-10 bg-green-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        {{-- Total Pelanggan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Pelanggan</p>
                <p class="text-xl font-bold text-gray-800">{{ $totalPelanggan }}</p>
            </div>
            <div class="w-10 h-10 bg-purple-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>

        {{-- Total Lapangan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Lapangan</p>
                <p class="text-xl font-bold text-gray-800">{{ $rincianLapangan->count() }}</p>
            </div>
            <div class="w-10 h-10 bg-orange-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                </svg>
            </div>
        </div>

    </div>

    {{-- ============================================================ --}}
    {{-- Chart Section                                                --}}
    {{-- ============================================================ --}}
    <div class="bg-purple-100 rounded-2xl p-6 mb-6">

        {{-- Tab Buttons --}}
        <div class="flex items-center justify-center gap-6 mb-6">
            <button
                @click="switchTab('mingguan')"
                :class="tab === 'mingguan'
                    ? 'bg-purple-700 text-white shadow'
                    : 'bg-white text-purple-600 border border-purple-300 hover:bg-purple-50'"
                class="px-10 py-2 rounded-lg text-sm font-semibold transition"
            >
                7 Hari
            </button>
            <button
                @click="switchTab('harian')"
                :class="tab === 'harian'
                    ? 'bg-purple-700 text-white shadow'
                    : 'bg-white text-purple-600 border border-purple-300 hover:bg-purple-50'"
                class="px-10 py-2 rounded-lg text-sm font-semibold transition"
            >
                30 Hari
            </button>
        </div>

        {{-- Charts Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            {{-- Left: Tren Penyewaan --}}
            <div class="bg-white rounded-xl p-5">
                <h3 class="text-base font-semibold text-purple-600 mb-4">Grafik: Tren Penyewaan Lapangan</h3>
                <div class="relative" style="height: 200px">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>

            {{-- Right: Lapangan Paling Laku --}}
            <div class="bg-white rounded-xl p-5">
                <h3 class="text-base font-semibold text-purple-600 mb-4">Grafik: &nbsp;Lapangan Paling Laku</h3>
                <div class="relative" style="height: 200px">
                    <canvas id="chartLaku"></canvas>
                </div>
                {{-- Dynamic Legend --}}
                <div class="flex flex-wrap gap-x-4 gap-y-1 mt-3">
                    @foreach($rincianLapangan as $idx => $r)
                        <span class="flex items-center gap-1.5 text-xs text-gray-500">
                            <span class="w-3 h-3 rounded-sm inline-block"
                                  style="background: {{ $lapanganColors[$idx % count($lapanganColors)] }}"></span>
                            {{ $r->nama }}
                        </span>
                    @endforeach
                    @if($rincianLapangan->isEmpty())
                        <span class="text-xs text-gray-400">Belum ada data lapangan</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- Bottom Section                                               --}}
    {{-- ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Rincian Pendapatan Per Lapangan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-800 text-center">Rincian Pendapatan Per Lapangan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/60">
                            <th class="text-left px-5 py-3 text-gray-600 font-semibold">Nama Lapangan</th>
                            <th class="text-left px-5 py-3 text-gray-600 font-semibold">Total Penyewaan</th>
                            <th class="text-left px-5 py-3 text-gray-600 font-semibold">Harga Sewa</th>
                            <th class="text-left px-5 py-3 text-gray-600 font-semibold">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rincianLapangan as $r)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-700 font-medium">{{ $r->nama }}</td>
                            <td class="px-5 py-3.5 text-gray-600">{{ $r->total_booking ?? 0 }}</td>
                            <td class="px-5 py-3.5 text-gray-600">Rp {{ number_format($r->harga_sewa, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5 text-gray-800 font-semibold">
                                Rp {{ number_format($r->total_pendapatan ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-400 text-sm">
                                Belum ada data pendapatan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekomendasi Tindakan (dinamis dari data) --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">Rekomendasi Tindakan</h3>
            @php
                $rekomendasi = [];
                // Lapangan dengan booking nol → rekomendasikan promosi
                $lapanganSepi = $rincianLapangan->where('total_booking', 0)->take(2);
                foreach ($lapanganSepi as $ls) {
                    $rekomendasi[] = 'Optimalkan promosi untuk ' . $ls->nama . ' (belum ada booking)';
                }
                // Lapangan dengan booking terbanyak → pertahankan kualitas
                $lapanganTop = $rincianLapangan->sortByDesc('total_booking')->first();
                if ($lapanganTop && $lapanganTop->total_booking > 0) {
                    $rekomendasi[] = 'Pertahankan kualitas ' . $lapanganTop->nama . ' sebagai lapangan terfavorit';
                }
                // Tips umum
                $rekomendasi = array_merge($rekomendasi, [
                    'Berikan diskon khusus untuk pemesanan hari kerja guna meningkatkan okupansi',
                    'Pertimbangkan paket bundling sewa untuk meningkatkan durasi booking',
                    'Evaluasi jam operasional dan sesuaikan dengan jam puncak pemesanan',
                ]);
                $rekomendasi = array_slice($rekomendasi, 0, 5);
            @endphp
            <ol class="space-y-3">
                @foreach($rekomendasi as $i => $r)
                <li class="flex items-start gap-3">
                    <span class="flex-shrink-0 w-6 h-6 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xs font-bold">
                        {{ $i + 1 }}
                    </span>
                    <span class="text-sm text-gray-700 pt-0.5">{{ $r }}</span>
                </li>
                @endforeach
            </ol>
        </div>

    </div>

</div>

{{-- PHP chart data → JS variable --}}
<script>
    window.__laporanData = @json($chartDataJson);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
function laporanPage() {
    return {
        tab: 'mingguan',
        filter: 'mingguan',
        chartTren: null,
        chartLaku: null,

        data: window.__laporanData,

        // ----------------------------------------------------------------
        // init: tunggu Chart.js benar-benar ready sebelum render
        // ----------------------------------------------------------------
        init() {
            this.$nextTick(() => { this.waitForChart(0); });
        },

        // Polling hingga Chart global tersedia & canvas ada di DOM
        waitForChart(attempt) {
            if (typeof Chart !== 'undefined'
                && document.getElementById('chartTren')
                && document.getElementById('chartLaku')) {
                this.renderCharts();
            } else if (attempt < 50) {
                // Retry tiap 100ms, maks 5 detik
                setTimeout(() => this.waitForChart(attempt + 1), 100);
            } else {
                console.warn('[LaporanPage] Chart.js atau canvas tidak ditemukan setelah 5 detik.');
            }
        },

        switchTab(newTab) {
            this.tab = newTab;
            this.filter = newTab;
            this.$nextTick(() => this.updateCharts());
        },

        switchFilter() {
            this.tab = this.filter;
            this.$nextTick(() => this.updateCharts());
        },

        currentData() {
            return this.data[this.tab] || this.data['mingguan'];
        },

        renderCharts() {
            const d = this.currentData();

            // ── Grafik Tren Penyewaan (Line) ──────────────────────────────
            const ctxTren = document.getElementById('chartTren');
            if (!ctxTren) return;

            // Destroy instance lama agar tidak terjadi error "Canvas already in use"
            if (this.chartTren) { this.chartTren.destroy(); this.chartTren = null; }

            this.chartTren = new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: d.labels,
                    datasets: [{
                        label: 'Total Booking',
                        data: d.tren,
                        borderColor: 'rgb(109, 40, 217)',
                        backgroundColor: 'rgba(109, 40, 217, 0.05)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgb(109, 40, 217)',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        tension: 0.3,
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, position: 'bottom', labels: { font: { size: 10 }, boxWidth: 12 } },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 9 } } },
                        y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 9 } }, beginAtZero: true }
                    }
                }
            });

            // ── Grafik Lapangan Paling Laku (Bar) ─────────────────────────
            const ctxLaku = document.getElementById('chartLaku');
            if (!ctxLaku) return;

            // Destroy instance lama
            if (this.chartLaku) { this.chartLaku.destroy(); this.chartLaku = null; }

            this.chartLaku = new Chart(ctxLaku, {
                type: 'bar',
                data: { labels: d.labels, datasets: d.datasets },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                        y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 9 } }, beginAtZero: true }
                    }
                }
            });
        },

        // ----------------------------------------------------------------
        // updateCharts: destroy + recreate agar tidak ada instance leak
        // ----------------------------------------------------------------
        updateCharts() {
            // Destroy dulu sebelum recreate
            if (this.chartTren) { this.chartTren.destroy(); this.chartTren = null; }
            if (this.chartLaku) { this.chartLaku.destroy(); this.chartLaku = null; }

            this.renderCharts();
        }
    }
}
</script>

</x-layout.admin>
