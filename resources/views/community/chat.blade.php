<x-layout.layout title="Komunitas - Chat Internal Tim">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800">KOMUNITAS</h1>
        <p class="text-gray-600 mt-2">Terhubung dengan sesama pecinta olahraga, bergabunglah dengan tim dan jangan lewatkan event seru!</p>

        {{-- Tabs --}}
        <div class="flex gap-3 mt-6 mb-8">
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Forum Diskusi</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Grup Olahraga</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold bg-courtee-600 text-white shadow-md">Chat Internal Tim</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Pengumuman Event</a>
        </div>

        {{-- Chat Container --}}
        <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm" style="height: 600px;">
            <div class="flex h-full">
                {{-- Sidebar --}}
                <div class="w-72 bg-blue-50 border-r border-blue-100 flex flex-col">
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-3">Daftar Obrolan Tim</h3>
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" placeholder="Masukkan Teks" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm outline-none focus:border-courtee-400">
                        </div>
                    </div>
                    <div class="flex-1 overflow-y-auto px-3 space-y-1">
                        @foreach(['Street Football', 'Futsal Gacor', 'Badmin Jago'] as $i => $chat)
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $i === 0 ? 'bg-blue-200/60' : 'hover:bg-blue-100' }}">
                                <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <span class="font-medium text-sm text-gray-700">{{ $chat }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Chat Area --}}
                <div class="flex-1 flex flex-col bg-blue-50/30">
                    {{-- Chat Header --}}
                    <div class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-gray-800">Street Football</h3>
                            <p class="text-xs text-gray-500">Hadyan, Nabil, Reyhan, Rizki, ...</p>
                        </div>
                        <div class="flex gap-3 text-gray-500">
                            <button class="hover:text-courtee-600 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></button>
                            <button class="hover:text-courtee-600 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></button>
                            <button class="hover:text-courtee-600 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg></button>
                        </div>
                    </div>

                    {{-- Messages --}}
                    <div class="flex-1 overflow-y-auto p-6 space-y-4">
                        @php
                            $messages = [
                                ['sender' => 'Nabil', 'text' => 'Allo Prenn', 'time' => '10:23', 'self' => false],
                                ['sender' => 'Aki', 'text' => 'Halo halo', 'time' => '10:23', 'self' => false],
                                ['sender' => 'Nabil', 'text' => 'Malem ini mo main ngga?', 'time' => '10:25', 'self' => false],
                                ['sender' => 'Kamu', 'text' => 'Boleh boleh, ayo aja gua mahh', 'time' => '10:25', 'self' => true],
                                ['sender' => 'Reyhan', 'text' => 'Ayooo, udah lama juga kita ngga main', 'time' => '10:26', 'self' => false],
                                ['sender' => 'Aki', 'text' => 'Yokk ramein gess', 'time' => '10:26', 'self' => false],
                            ];
                        @endphp

                        @foreach($messages as $msg)
                            <div class="flex {{ $msg['self'] ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs {{ $msg['self'] ? 'bg-white border border-gray-200' : 'bg-blue-100' }} rounded-2xl px-4 py-3">
                                    @if(!$msg['self'])
                                        <p class="text-xs font-semibold text-courtee-600">{{ $msg['sender'] }}</p>
                                    @endif
                                    <p class="text-sm text-gray-700">{{ $msg['text'] }}</p>
                                    <p class="text-xs text-gray-400 mt-1 {{ $msg['self'] ? 'text-right' : '' }}">
                                        {{ $msg['time'] }}
                                        @if($msg['self']) &#10003;&#10003; @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Input --}}
                    <div class="bg-white border-t border-gray-200 px-6 py-4 flex items-center gap-3">
                        <button class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></button>
                        <button class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg></button>
                        <input type="text" placeholder="Ketik Pesan" class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                        <button class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
