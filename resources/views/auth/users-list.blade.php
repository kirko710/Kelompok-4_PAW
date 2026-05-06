<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User - Courtee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>* { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-purple-700">Daftar User Terdaftar</h1>
            <div class="flex gap-3">
                <a href="/register" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium hover:bg-purple-700">+ Tambah User</a>
                <a href="/" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-100">Kembali</a>
            </div>
        </div>

        {{-- Filter JS DOM --}}
        <div class="flex gap-4 mb-6">
            <input type="text" id="search-user" placeholder="Cari nama atau email..."
                class="flex-1 border border-gray-200 rounded-xl px-5 py-3 text-sm outline-none focus:border-purple-400">
            <select id="filter-role" class="border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-purple-400">
                <option value="">Semua Role</option>
                <option value="user">User</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        {{-- Counter --}}
        <p id="user-count" class="text-sm text-gray-500 mb-4">Total: {{ count($users) }} user</p>

        @if(count($users) === 0)
            <div class="bg-white rounded-xl p-12 text-center shadow-sm">
                <p class="text-gray-400 text-lg">Belum ada user terdaftar.</p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-sm" id="users-table">
                    <thead class="bg-purple-50 border-b">
                        <tr>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">No</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Nama</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Email</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Role</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Telepon</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody id="users-tbody">
                        @foreach($users as $i => $user)
                            <tr class="user-row border-b border-gray-50 hover:bg-purple-50/30"
                                data-name="{{ strtolower($user->name) }}"
                                data-email="{{ strtolower($user->email) }}"
                                data-role="{{ $user->role ?? 'user' }}">
                                <td class="px-6 py-4">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        {{ ($user->role ?? 'user') === 'owner' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($user->role ?? 'user') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $user->profile->telepon ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ===== JAVASCRIPT DOM ===== --}}
    <script>
        const searchInput = document.getElementById('search-user');
        const filterRole = document.getElementById('filter-role');
        const countEl = document.getElementById('user-count');

        function filterUsers() {
            const query = searchInput.value.toLowerCase();
            const role = filterRole.value.toLowerCase();
            const rows = document.querySelectorAll('.user-row');
            let visible = 0;

            rows.forEach(function(row) {
                const name = row.dataset.name;
                const email = row.dataset.email;
                const rowRole = row.dataset.role;

                const matchSearch = name.includes(query) || email.includes(query);
                const matchRole = role === '' || rowRole === role;

                if (matchSearch && matchRole) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update counter (DOM manipulation)
            countEl.textContent = 'Menampilkan: ' + visible + ' user';
        }

        // Event listeners
        searchInput.addEventListener('input', filterUsers);
        filterRole.addEventListener('change', filterUsers);
    </script>
</body>
</html>
