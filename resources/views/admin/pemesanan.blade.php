<x-layout.admin title="Daftar Pemesanan" activeMenu="admin.pemesanan" breadcrumb="Dashboard > Daftar Pemesanan">

    <h2 class="text-2xl font-bold text-purple-600 mb-6">Daftar Pemesanan</h2>

    {{-- ============================================================ --}}
    {{-- Filter Bar                                                   --}}
    {{-- ============================================================ --}}
    <div class="flex flex-wrap items-center gap-3 mb-3">

        {{-- Status --}}
        <div class="relative">
            <select id="filterStatus" class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[130px]">
                <option value="all">Semua Status</option>
                <option value="confirmed">Dikonfirmasi</option>
                <option value="pending">Menunggu</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Pembayaran --}}
        <div class="relative">
            <select id="filterPembayaran" class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[140px]">
                <option value="all">Semua Pembayaran</option>
                <option value="paid">Lunas</option>
                <option value="unpaid">Belum Lunas</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Rentang Tanggal --}}
        <div class="relative">
            <select id="filterRentang" class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[160px]">
                <option value="all">Semua Tanggal</option>
                <option value="7">7 Hari Terakhir</option>
                <option value="30">30 Hari Terakhir</option>
                <option value="90">3 Bulan Terakhir</option>
                <option value="365">Tahun Ini</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Cari nama pelanggan --}}
        <input
            id="searchPelanggan"
            type="text"
            placeholder="Cari nama pelanggan"
            class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition min-w-[200px] flex-1 max-w-xs"
        >

    </div>

    {{-- Search Button --}}
    <button id="btnSearch" class="mb-6 px-6 py-2.5 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 active:scale-95 transition">
        Search
    </button>

    {{-- ============================================================ --}}
    {{-- Loading Indicator (tersembunyi by default)                   --}}
    {{-- ============================================================ --}}
    <div id="loadingIndicator" class="hidden flex items-center justify-center py-16">
        <div class="flex flex-col items-center gap-3">
            <svg class="animate-spin h-8 w-8 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span class="text-sm text-gray-400">Memuat data...</span>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- Empty State (tersembunyi by default)                         --}}
    {{-- ============================================================ --}}
    <div id="emptyState" class="hidden flex flex-col items-center justify-center py-20 text-gray-400">
        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <p class="text-base font-semibold text-gray-500 mb-1">Tidak ada data pemesanan</p>
        <p class="text-sm">Coba ubah filter atau kata kunci pencarian.</p>
    </div>

    {{-- ============================================================ --}}
    {{-- Table                                                        --}}
    {{-- ============================================================ --}}
    <div id="tableWrapper" class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Nama Pelanggan</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Lapangan</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Tanggal &amp; Waktu</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Durasi</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Pembayaran</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Status</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    {{-- Diisi oleh JavaScript via AJAX --}}
                </tbody>

            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- JavaScript: AJAX Live Search & Filter                        --}}
    {{-- ============================================================ --}}
    <script>
        // URL endpoint filter (dari route name admin.pemesanan.filter)
        const FILTER_URL = '{{ route('admin.pemesanan.filter') }}';

        // Elemen-elemen DOM
        const tableBody        = document.getElementById('tableBody');
        const tableWrapper     = document.getElementById('tableWrapper');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const emptyState       = document.getElementById('emptyState');

        /**
         * Render satu baris tabel dari data JSON
         */
        function renderRow(item) {
            // Badge pembayaran
            const badgePembayaran = item.status_bayar === 'paid'
                ? `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600 border border-green-200">Lunas</span>`
                : `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-500 border border-orange-200">Belum Lunas</span>`;

            // Warna teks status pesanan
            const statusColorMap = {
                pending:   'text-yellow-600',
                confirmed: 'text-blue-600',
                completed: 'text-green-600',
                cancelled: 'text-red-500',
            };
            const statusClass = statusColorMap[item.status_pesanan] || 'text-gray-600';

            // Tombol Batalkan (kondisional)
            const batalkanUrl = `/admin/pemesanan/${item.id}/batalkan`;
            const btnBatalkan = item.bisa_batalkan
                ? `<button
                    onclick="batalkanPemesanan(${item.id}, this)"
                    class="px-4 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 active:scale-95 transition whitespace-nowrap">
                    Batalkan
                  </button>`
                : `<span class="text-gray-300 text-xs">—</span>`;

            return `
                <tr class="border-b border-gray-100 hover:bg-gray-50/60 transition-colors">
                    {{-- Nama Pelanggan --}}
                    <td class="px-5 py-4 text-gray-800 font-medium whitespace-nowrap">${escapeHtml(item.nama_pelanggan)}</td>

                    {{-- Lapangan --}}
                    <td class="px-5 py-4 text-gray-600 whitespace-nowrap">${escapeHtml(item.lapangan)}</td>

                    {{-- Tanggal & Waktu --}}
                    <td class="px-5 py-4 text-gray-600">
                        <p class="whitespace-nowrap">${escapeHtml(item.tanggal)}</p>
                        <p class="text-xs text-gray-400 whitespace-nowrap">${escapeHtml(item.waktu_mulai)} – ${escapeHtml(item.waktu_selesai)}</p>
                    </td>

                    {{-- Durasi --}}
                    <td class="px-5 py-4 text-gray-600 whitespace-nowrap">${escapeHtml(item.durasi)}</td>

                    {{-- Pembayaran Badge --}}
                    <td class="px-5 py-4">${badgePembayaran}</td>

                    {{-- Status --}}
                    <td class="px-5 py-4 whitespace-nowrap font-medium ${statusClass}">${escapeHtml(item.status_pesanan_label)}</td>

                    {{-- Aksi --}}
                    <td class="px-5 py-4">${btnBatalkan}</td>
                </tr>
            `;
        }

        /**
         * Escape HTML untuk mencegah XSS dari data user
         */
        function escapeHtml(str) {
            if (str === null || str === undefined) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        /**
         * Fungsi utama: fetch data dari endpoint AJAX dan render ke tabel
         */
        async function fetchPemesanan() {
            // 1. Tampilkan loading, sembunyikan tabel & empty state
            loadingIndicator.classList.remove('hidden');
            tableWrapper.classList.add('hidden');
            emptyState.classList.add('hidden');

            // 2. Ambil nilai semua filter
            const search     = document.getElementById('searchPelanggan').value.trim();
            const status     = document.getElementById('filterStatus').value;
            const pembayaran = document.getElementById('filterPembayaran').value;
            const rentang    = document.getElementById('filterRentang').value;

            // 3. Build URL dengan URLSearchParams
            const params = new URLSearchParams({ search, status, pembayaran, rentang });
            const url    = `${FILTER_URL}?${params.toString()}`;

            try {
                // 4. Fetch ke endpoint
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                // 5. Parse JSON
                const json = await response.json();

                // 6. Render ulang tbody
                if (json.status === 'success' && json.data.length > 0) {
                    tableBody.innerHTML = json.data.map(renderRow).join('');
                    tableWrapper.classList.remove('hidden');
                    emptyState.classList.add('hidden');
                } else {
                    tableBody.innerHTML = '';
                    tableWrapper.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Gagal memuat data pemesanan:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-red-400 text-sm">
                            Terjadi kesalahan saat memuat data. Silakan coba lagi.
                        </td>
                    </tr>`;
                tableWrapper.classList.remove('hidden');
                emptyState.classList.add('hidden');
            } finally {
                // 7. Sembunyikan loading
                loadingIndicator.classList.add('hidden');
            }
        }

        // ──────────────────────────────────────────────
        // Event Listeners
        // ──────────────────────────────────────────────

        // Tombol Search
        document.getElementById('btnSearch').addEventListener('click', fetchPemesanan);

        // Select filter langsung trigger (UX lebih responsif)
        document.getElementById('filterStatus').addEventListener('change', fetchPemesanan);
        document.getElementById('filterPembayaran').addEventListener('change', fetchPemesanan);
        document.getElementById('filterRentang').addEventListener('change', fetchPemesanan);

        // Debounce 300ms untuk input search
        let debounceTimer;
        document.getElementById('searchPelanggan').addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchPemesanan, 300);
        });

        // Load data pertama kali saat halaman dibuka
        fetchPemesanan();

        // ──────────────────────────────────────────────
        // Batalkan Pemesanan via AJAX
        // ──────────────────────────────────────────────
        async function batalkanPemesanan(id, btn) {
            if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;

            btn.disabled = true;
            btn.textContent = 'Memproses...';

            try {
                const res = await fetch(`/admin/pemesanan/${id}/batalkan`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });

                const json = await res.json();

                if (res.ok) {
                    // Update baris: ganti status + sembunyikan tombol
                    const row = btn.closest('tr');
                    const statusCell = row.querySelector('td:nth-child(6)');
                    if (statusCell) statusCell.innerHTML = '<span class="font-medium text-red-500">Dibatalkan</span>';
                    btn.parentElement.innerHTML = '<span class="text-gray-300 text-xs">—</span>';
                } else {
                    alert(json.message || 'Gagal membatalkan pesanan.');
                    btn.disabled = false;
                    btn.textContent = 'Batalkan';
                }
            } catch (err) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
                btn.disabled = false;
                btn.textContent = 'Batalkan';
            }
        }

    </script>

</x-layout.admin>
