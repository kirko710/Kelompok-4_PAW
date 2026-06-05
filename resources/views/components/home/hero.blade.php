<section class="hero">

    {{-- Background foto --}}
    <img class="hero__bg" src="{{ asset('assets/hero-bg.jpg') }}" alt="Hero Background">

    {{-- Overlay warna brand --}}
    <div class="hero__overlay"></div>

    {{-- Form Pencarian --}}
    <div class="hero__content">
        <form id="heroSearchForm" action="{{ route('venue.index') }}" method="GET" class="hero-search-form" style="width:100%;">
            <div style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
                {{-- Input Daerah --}}
                <input
                    type="text"
                    name="daerah"
                    placeholder="Daerah"
                    class="form-input"
                    value="{{ request('lokasi') ?? '' }}"
                    style="flex:1; min-width:160px;"
                />

                {{-- Select Jenis Olahraga --}}
                <div class="form-select-wrapper">
                    <select name="jenis_olahraga" class="form-select" style="width:100%; height:44px; padding:8px 12px; box-sizing:border-box;">
                        <option value="">Jenis Olahraga</option>
                        <option value="Futsal" {{ request('jenis_olahraga') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                        <option value="Badminton" {{ request('jenis_olahraga') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                        <option value="Tennis" {{ request('jenis_olahraga') == 'Tennis' ? 'selected' : '' }}>Tenis</option>
                        <option value="Basket" {{ request('jenis_olahraga') == 'Basket' ? 'selected' : '' }}>Basket</option>
                        <option value="Voli" {{ request('jenis_olahraga') == 'Voli' ? 'selected' : '' }}>Voli</option>
                        <option value="Renang" {{ request('jenis_olahraga') == 'Renang' ? 'selected' : '' }}>Renang</option>
                        <option value="Gym" {{ request('jenis_olahraga') == 'Gym' ? 'selected' : '' }}>Gym</option>
                    </select>
                </div>
            </div>

            {{-- Tombol Cari --}}
            <div style="margin-top:12px; display:flex; justify-content:center; align-items:center;">
                <button
                    type="submit"
                    class="btn-cta hero-search-btn"
                    style="width:220px; height:44px; background:#9333ea; border:2px solid rgba(147,51,234,0.18); color:#ffffff; padding:0 12px; border-radius:10px; box-shadow:0 4px 12px rgba(147,51,234,0.12); font-weight:600; display:inline-flex; align-items:center; justify-content:center;"
                >Cari</button>
            </div>
        </form>
    </div>
</section>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('heroSearchForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const base = "{{ route('venue.index') }}";
        const lokasi = (form.querySelector('[name="daerah"]') || {}).value || '';
        const jenis_olahraga = (form.querySelector('[name="jenis_olahraga"]') || {}).value || '';

        const params = new URLSearchParams();
        if (lokasi.trim() !== '') params.append('lokasi', lokasi.trim());
        if (jenis_olahraga.trim() !== '') params.append('jenis_olahraga', jenis_olahraga.trim());

        const url = params.toString() ? (base + '?' + params.toString()) : base;
        window.location.href = url;
    });
});
</script>
@endpush