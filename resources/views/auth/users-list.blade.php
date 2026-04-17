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
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-purple-700">Daftar User Terdaftar</h1>
            <div class="flex gap-3">
                <a href="/register" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium hover:bg-purple-700">+ Tambah User</a>
                <a href="/" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-100">Kembali</a>
            </div>
        </div>

        @if(count($users) === 0)
            <div class="bg-white rounded-xl p-12 text-center shadow-sm">
                <p class="text-gray-400 text-lg">Belum ada user terdaftar.</p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-purple-50 border-b">
                        <tr>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">No</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Nama</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Email</th>
                            <th class="text-left px-6 py-4 font-semibold text-purple-700">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $i => $user)
                            <tr class="border-b border-gray-50 hover:bg-purple-50/30">
                                <td class="px-6 py-4">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-sm text-gray-500 mt-4">Total: {{ count($users) }} user terdaftar</p>
        @endif
    </div>
</body>
</html>
