<x-layout.admin title="Daftar Pemesanan" activeMenu="admin.pemesanan" breadcrumb="Dashboard > Daftar Pemesanan">
    <h2 class="text-2xl font-bold text-courtee-600 mb-6">Daftar Pemesanan</h2>

    {{-- Filters --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <select class="border border-gray-200 rounded-lg px-4 py-3 text-sm outline-none focus:border-courtee-400">
            <option>Status</option>
            <option>Dikonfirmasi</option>
            <option>Menunggu</option>
            <option>Selesai</option>
            <option>Dibatalkan</option>
        </select>
        <select class="border border-gray-200 rounded-lg px-4 py-3 text-sm outline-none focus:border-courtee-400">
            <option>Pembayaran</option>
            <option>Lunas</option>
            <option>Belum Lunas</option>
        </select>
        <select class="border border-gray-200 rounded-lg px-4 py-3 text-sm outline-none focus:border-courtee-400">
            <option>Rentang Tanggal</option>
        </select>
        <input type="text" placeholder="Cari nama pelanggan" class="border border-gray-200 rounded-lg px-4 py-3 text-sm outline-none focus:border-courtee-400">
    </div>
    <button class="bg-courtee-600 text-white px-6 py-3 rounded-lg text-sm font-semibold hover:bg-courtee-700 transition mb-6">Search</button>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Nama Pelanggan</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Lapangan</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Tanggal & Waktu</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Durasi</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Pembayaran</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Status</th>
                    <th class="text-left px-6 py-4 text-gray-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $orders = [
                        ['name' => 'Rizky Ramadhan', 'court' => 'Sumber Sari Jaya 1', 'datetime' => '28 Mei 2024<br>18.00-20.00', 'duration' => '2 Jam', 'payment' => 'Lunas', 'payColor' => 'green', 'status' => 'Dikonfirmasi', 'hasAction' => true],
                        ['name' => 'Andi Pratama', 'court' => 'Sumber Sari Jaya 2', 'datetime' => '17 Oktober 2024<br>16.00-19.00', 'duration' => '3 Jam', 'payment' => 'Belum Lunas', 'payColor' => 'yellow', 'status' => 'Menunggu', 'hasAction' => true],
                        ['name' => 'Samuel Alexander', 'court' => 'Sumber Sari Jaya 1', 'datetime' => '18 April 2024<br>18.30-20.30', 'duration' => '2 Jam', 'payment' => 'Lunas', 'payColor' => 'green', 'status' => 'Selesai', 'hasAction' => false],
                        ['name' => 'Dina Wijaya', 'court' => 'Sumber Sari Jaya 1', 'datetime' => '30 April 2024<br>15.00-20.00', 'duration' => '5 Jam', 'payment' => 'Belum Lunas', 'payColor' => 'yellow', 'status' => 'Dibatalkan', 'hasAction' => false],
                        ['name' => 'Asep Saepuloh', 'court' => 'Sumber Sari Jaya 2', 'datetime' => '24 Maret 2025<br>12.25-14.25', 'duration' => '2 Jam', 'payment' => 'Lunas', 'payColor' => 'green', 'status' => 'Selesai', 'hasAction' => false],
                        ['name' => 'Daffa Ramadian', 'court' => 'Sumber Sari jaya 2', 'datetime' => '31 Januari 2025<br>19.00-20.00', 'duration' => '1 Jam', 'payment' => 'Lunas', 'payColor' => 'green', 'status' => 'Selesai', 'hasAction' => false],
                        ['name' => 'Abimanyu Aryasatya', 'court' => 'Sumber Sari jaya 1', 'datetime' => '28 Februari 2025<br>17.30-20.30', 'duration' => '3 Jam', 'payment' => 'Belum Lunas', 'payColor' => 'yellow', 'status' => 'Dikonfirmasi', 'hasAction' => true],
                        ['name' => 'Daniel Craig', 'court' => 'Sumber Sari jaya 2', 'datetime' => '12 Maret 2025<br>10.00-14.00', 'duration' => '4 Jam', 'payment' => 'Belum Lunas', 'payColor' => 'yellow', 'status' => 'Dikonfirmasi', 'hasAction' => true],
                        ['name' => 'Budi Pikiran', 'court' => 'Sumber Sari jaya 2', 'datetime' => '19 Maret 2025<br>12.00-13.00', 'duration' => '1 Jam', 'payment' => 'Lunas', 'payColor' => 'green', 'status' => 'Selesai', 'hasAction' => false],
                    ];
                @endphp
                @foreach($orders as $o)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $o['name'] }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $o['court'] }}</td>
                        <td class="px-6 py-4 text-gray-600">{!! $o['datetime'] !!}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $o['duration'] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $o['payColor'] === 'green' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $o['payment'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $o['status'] }}</td>
                        <td class="px-6 py-4">
                            @if($o['hasAction'])
                                <button class="px-4 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600 transition">Batalkan</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.admin>
