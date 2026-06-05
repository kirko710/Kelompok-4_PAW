<x-layout.admin title="Edit Profil" activeMenu="admin.profile" breadcrumb="Dashboard > Profil > Edit">

    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.profile') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Edit Profil</h2>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-5 flex items-center gap-3 px-5 py-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-5 px-5 py-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =============== FORM DATA PRIBADI =============== --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
            <h3 class="font-bold text-gray-800 text-base mb-5">Data Pribadi</h3>
            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Lahir</label>
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', optional($profile)->tanggal_lahir ? \Carbon\Carbon::parse($profile->tanggal_lahir)->format('Y-m-d') : '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition">
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition resize-none">{{ old('alamat', optional($profile)->alamat) }}</textarea>
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                    <input id="telepon" type="text" name="telepon"
                        value="{{ old('telepon', optional($profile)->telepon) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- =============== FORM INFO REKENING =============== --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-800 text-base mb-5">Info Rekening</h3>
            <form action="{{ route('admin.profile.rekening') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Bank --}}
                <div>
                    <label for="bank" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Bank <span class="text-red-400">*</span></label>
                    <select id="bank" name="bank" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition appearance-none bg-white">
                        <option value="">-- Pilih Bank --</option>
                        @foreach(['BCA', 'BNI', 'BRI', 'Mandiri', 'CIMB Niaga', 'BSI', 'Danamon', 'Permata'] as $b)
                            <option value="{{ $b }}" {{ old('bank', optional($profile)->bank) === $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nomor Rekening --}}
                <div>
                    <label for="rekening" class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Rekening <span class="text-red-400">*</span></label>
                    <input id="rekening" type="text" name="rekening"
                        value="{{ old('rekening', optional($profile)->rekening) }}"
                        placeholder="Contoh: 1234567890"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-800 outline-none focus:border-courtee-400 focus:ring-2 focus:ring-courtee-100 transition">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Rekening
                    </button>
                </div>
            </form>
        </div>

    </div>

</x-layout.admin>
