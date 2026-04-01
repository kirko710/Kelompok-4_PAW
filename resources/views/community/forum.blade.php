<x-layout.layout title="Komunitas">
    <div class="max-w-7xl mx-auto px-6 py-10">
        {{-- Header --}}
        <h1 class="text-2xl font-bold text-gray-800">KOMUNITAS</h1>
        <p class="text-gray-600 mt-2">Terhubung dengan sesama pecinta olahraga, bergabunglah dengan tim dan jangan lewatkan event seru!</p>

        {{-- Tabs --}}
        <div class="flex gap-3 mt-6">
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold bg-courtee-600 text-white shadow-md">Forum Diskusi</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Grup Olahraga</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Chat Internal Tim</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Pengumuman Event</a>
        </div>

        {{-- Search + Create --}}
        <div class="flex items-center justify-between mt-6 pb-6 border-b border-gray-200">
            <div class="flex-1 max-w-lg relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Masukkan Teks" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg text-sm outline-none focus:border-courtee-400 transition">
            </div>
            <button class="bg-courtee-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-courtee-700 transition">
                Buat Topik Baru
            </button>
        </div>

        {{-- Forum Topics --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            @php
                $topics = [
                    ['title' => 'Jaya Sport main bareng', 'author' => 'Ahmad Dani', 'replies' => 3, 'comments' => ['Banyak ngga yang main?', 'Gassss', 'Kasih paham boss!!']],
                    ['title' => 'Sewa lapangan sekarang dikenakan pajak', 'author' => 'Lilil Bahlul', 'replies' => 4, 'comments' => ['Hari hari dipajak mulu', 'Ngga sekalian nafas di sini kena pajak juga?', 'Diam tidak terlihat, bergerak menyusahkan rakyat', 'Sehat pun harus kena pajak']],
                    ['title' => 'Badminton Sehatt', 'author' => 'Gilang Pandjaitan', 'replies' => 2, 'comments' => ['Ikut dong bangg', 'Kapan nih mainnya?']],
                    ['title' => 'Lapangan padel mulai jarang didatangi pengunjung', 'author' => 'Aldi Omof', 'replies' => 1, 'comments' => ['Olahraga orang orang fomo doang, makanya sekarang sepi']],
                ];
            @endphp

            @foreach($topics as $topic)
                <div class="border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="font-bold text-gray-800 text-lg">{{ $topic['title'] }}</h3>
                    <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $topic['author'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            {{ $topic['replies'] }}
                        </span>
                    </div>

                    <div class="mt-4 bg-courtee-50 rounded-lg p-4 space-y-2">
                        @foreach($topic['comments'] as $comment)
                            <div class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-3.5 h-3.5 mt-0.5 text-courtee-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                <span>{{ $comment }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <a href="#" class="inline-flex items-center gap-1 mt-8 text-sm text-gray-500 hover:text-courtee-600 transition">
            Lihat Semua Topik <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</x-layout.layout>
