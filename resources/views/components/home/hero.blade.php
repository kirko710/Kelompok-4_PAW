<section class="hero">

    {{-- Background foto --}}
    <img class="hero__bg" src="{{ asset('assets/hero-bg.jpg') }}" alt="Hero Background">

    {{-- Overlay warna brand --}}
    <div class="hero__overlay"></div>

    {{-- Form Pencarian --}}
    <div class="hero__content">

        {{-- Input Daerah --}}
        <input
            type="text"
            name="daerah"
            placeholder="Daerah"
            class="form-input"
        >

        {{-- Select Jenis Olahraga --}}
        <div class="form-select-wrapper">
            <select name="jenis_olahraga" class="form-select">
                <option value="" disabled selected>Jenis Olahraga</option>
                <option value="sepak_bola">Sepak Bola</option>
                <option value="badminton">Badminton</option>
                <option value="padel">Padel</option>
                <option value="tenis">Tenis</option>
                <option value="mini_soccer">Mini Soccer</option>
            </select>
            <svg class="chevron-icon" width="12" height="8" viewBox="0 0 12 8" fill="none">
                <path d="M1 1L6 7L11 1" stroke="#344054" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        {{-- Select Tanggal --}}
        <div class="form-select-wrapper">
            <select name="tanggal" class="form-select">
                <option value="" disabled selected>Tanggal</option>
                <option value="2025-04-01">Selasa, 1 April 2025</option>
                <option value="2025-04-02">Rabu, 2 April 2025</option>
                <option value="2025-04-03">Kamis, 3 April 2025</option>
                <option value="2025-04-04">Jumat, 4 April 2025</option>
                <option value="2025-04-05">Sabtu, 5 April 2025</option>
                <option value="2025-04-06">Minggu, 6 April 2025</option>
            </select>
            <svg class="chevron-icon" width="12" height="8" viewBox="0 0 12 8" fill="none">
                <path d="M1 1L6 7L11 1" stroke="#344054" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

    </div>
</section>