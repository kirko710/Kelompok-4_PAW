{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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
                <option value="minggu">Minggu Ini</option>
                <option value="bulan">Bulan Ini</option>
                <option value="tahun">Tahun Ini</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- Stat Cards                                                   --}}
    {{-- ============================================================ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Pendapatan</p>
                <p class="text-xl font-bold text-gray-800">65.550.000</p>
            </div>
            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-white text-sm font-bold">Rp</span>
            </div>
        </div>

        {{-- Total Jam Booking --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Total Jam Booking</p>
                <p class="text-xl font-bold text-gray-800">257</p>
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
                <p class="text-xl font-bold text-gray-800">471</p>
            </div>
            <div class="w-10 h-10 bg-purple-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>

        {{-- Okupansi Rata-rata --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 mb-1">Okupansi Rata-rata</p>
                <p class="text-xl font-bold text-gray-800">93.5</p>
            </div>
            <div class="w-10 h-10 bg-orange-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-white text-sm font-bold">%</span>
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
                @click="switchTab('harian')"
                :class="tab === 'harian'
                    ? 'bg-purple-700 text-white shadow'
                    : 'bg-white text-purple-600 border border-purple-300 hover:bg-purple-50'"
                class="px-10 py-2 rounded-lg text-sm font-semibold transition"
            >
                Harian
            </button>
            <button
                @click="switchTab('mingguan')"
                :class="tab === 'mingguan'
                    ? 'bg-purple-700 text-white shadow'
                    : 'bg-white text-purple-600 border border-purple-300 hover:bg-purple-50'"
                class="px-10 py-2 rounded-lg text-sm font-semibold transition"
            >
                Mingguan
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
                {{-- Legend --}}
                <div class="flex flex-wrap gap-x-4 gap-y-1 mt-3">
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <span class="w-3 h-3 rounded-sm bg-indigo-500 inline-block"></span> Lapangan A (Futsal)
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <span class="w-3 h-3 rounded-sm bg-orange-400 inline-block"></span> Lapangan B (Futsal)
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <span class="w-3 h-3 rounded-sm bg-cyan-400 inline-block"></span> Lapangan C (Badminton)
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <span class="w-3 h-3 rounded-sm bg-yellow-400 inline-block"></span> Lapangan D (Basket)
                    </span>
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
                        @php
                        $rincian = [
                            ['nama' => 'Lapangan A (Futsal)',    'total' => 157, 'harga' => 'Rp150.000', 'pendapatan' => 'Rp23.500.000'],
                            ['nama' => 'Lapangan B (Futsal)',    'total' => 98,  'harga' => 'Rp150.000', 'pendapatan' => 'Rp14.700.000'],
                            ['nama' => 'Lapangan C (Badminton)', 'total' => 124, 'harga' => 'Rp100.000', 'pendapatan' => 'Rp12.400.000'],
                            ['nama' => 'Lapangan D (Basket)',    'total' => 79,  'harga' => 'Rp190.000', 'pendapatan' => 'Rp14.950.000'],
                        ];
                        @endphp
                        @foreach($rincian as $r)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-700 font-medium">{{ $r['nama'] }}</td>
                            <td class="px-5 py-3.5 text-gray-600">{{ $r['total'] }}</td>
                            <td class="px-5 py-3.5 text-gray-600">{{ $r['harga'] }}</td>
                            <td class="px-5 py-3.5 text-gray-800 font-semibold">{{ $r['pendapatan'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekomendasi Tindakan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">Rekomendasi Tindakan</h3>
            <ol class="space-y-3">
                @php
                $rekomendasi = [
                    'Optimalisasi Lapangan Futsal',
                    'Peningkatan Okupansi Lapangan Basket & Badminton',
                    'Pengembangan Paket Bundling Sewa',
                    'Evaluasi Jam Operasional Sepi',
                    'Promosi Khusus Hari Kerja',
                ];
                @endphp
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

{{-- ============================================================ --}}
{{-- Alpine Component + Chart.js Logic                            --}}
{{-- ============================================================ --}}
<script>
function laporanPage() {
    return {
        tab: 'mingguan',
        filter: 'minggu',
        chartTren: null,
        chartLaku: null,

        data: {
            harian: {
                labels: Array.from({length: 30}, (_, i) => String(i + 1)),
                tren:   [12,18,15,22,16,20,19,17,24,20,18,25,22,16,13,20,22,25,18,22,24,22,26,24,20,24,28,22,26,20],
                laku: {
                    a: [4,5,3,6,4,5,4,3,6,5,4,6,5,4,3,5,6,7,4,5,6,5,7,6,5,6,7,5,6,5],
                    b: [3,4,3,5,3,4,3,3,5,4,3,5,4,3,2,4,5,6,3,4,5,4,6,5,4,5,6,4,5,4],
                    c: [2,3,2,4,2,3,2,2,4,3,2,4,3,2,1,3,4,5,2,3,4,3,5,4,3,4,5,3,4,3],
                    d: [1,2,1,3,1,2,1,1,3,2,1,3,2,1,1,2,3,4,1,2,3,2,4,3,2,3,4,2,3,2],
                }
            },
            mingguan: {
                labels: ['1','2','3','4','5'],
                tren:   [100, 107, 108, 128, 50],
                laku: {
                    a: [45, 40, 38, 50, 30],
                    b: [35, 30, 28, 40, 20],
                    c: [25, 22, 18, 30, 15],
                    d: [15, 12, 10, 20, 10],
                }
            }
        },

        init() {
            this.$nextTick(() => {
                this.renderCharts();
            });
        },

        switchTab(newTab) {
            this.tab = newTab;
            this.$nextTick(() => this.updateCharts());
        },

        switchFilter() {
            // In real app, would fetch new data based on filter
            // Here we just toggle between harian/mingguan visual
        },

        currentData() {
            return this.data[this.tab];
        },

        renderCharts() {
            const d = this.currentData();

            // --- Line Chart: Tren ---
            const ctxTren = document.getElementById('chartTren');
            if (!ctxTren) return;
            this.chartTren = new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: d.labels,
                    datasets: [{
                        label: 'Lapangan',
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
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: { font: { size: 10 }, boxWidth: 12 }
                        },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 9 } } },
                        y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 9 } }, beginAtZero: true }
                    }
                }
            });

            // --- Bar Chart: Lapangan Paling Laku ---
            const ctxLaku = document.getElementById('chartLaku');
            if (!ctxLaku) return;
            this.chartLaku = new Chart(ctxLaku, {
                type: 'bar',
                data: {
                    labels: d.labels,
                    datasets: [
                        { label: 'Lapangan A (Futsal)',    data: d.laku.a, backgroundColor: 'rgb(99,102,241)',  borderRadius: 2 },
                        { label: 'Lapangan B (Futsal)',    data: d.laku.b, backgroundColor: 'rgb(251,146,60)',  borderRadius: 2 },
                        { label: 'Lapangan C (Badminton)', data: d.laku.c, backgroundColor: 'rgb(34,211,238)',  borderRadius: 2 },
                        { label: 'Lapangan D (Basket)',    data: d.laku.d, backgroundColor: 'rgb(251,191,36)',  borderRadius: 2 },
                    ]
                },
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

        updateCharts() {
            const d = this.currentData();
            if (!this.chartTren || !this.chartLaku) return;

            // Update Tren chart
            this.chartTren.data.labels = d.labels;
            this.chartTren.data.datasets[0].data = d.tren;
            this.chartTren.update();

            // Update Laku chart
            this.chartLaku.data.labels = d.labels;
            this.chartLaku.data.datasets[0].data = d.laku.a;
            this.chartLaku.data.datasets[1].data = d.laku.b;
            this.chartLaku.data.datasets[2].data = d.laku.c;
            this.chartLaku.data.datasets[3].data = d.laku.d;
            this.chartLaku.update();
        }
    }
}
</script>

</x-layout.admin>
