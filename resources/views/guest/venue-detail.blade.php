@extends('layouts.layout')
@section('title', ($venue->nama ?? 'Venue Detail') . ' - Courtee')

@push('styles')
<style>
.venue-hero { width: 100%; height: 300px; overflow: hidden; }
.venue-hero img { width: 100%; height: 100%; object-fit: cover; }
.venue-info { padding: 40px 0; }
.venue-info__name { font-size: 32px; font-weight: 700; color: var(--text-primary); }
.venue-info__location { font-size: 16px; color: var(--text-secondary); margin-top: 4px; }
.venue-socials { display: flex; gap: 12px; margin-top: 16px; }
.venue-social-icon {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(153,87,179,0.1); display: flex; align-items: center; justify-content: center;
    color: var(--brand-primary); transition: background var(--transition);
}
.venue-social-icon:hover { background: rgba(153,87,179,0.2); }
.court-card {
    border: 1px solid var(--stroke-secondary); border-radius: 16px;
    overflow: hidden; margin-bottom: 24px; display: flex;
}
.court-card__image { width: 35%; min-height: 200px; flex-shrink: 0; }
.court-card__image img { width: 100%; height: 100%; object-fit: cover; }
.court-card__body { flex: 1; padding: 24px; }
.court-card__name { font-size: 18px; font-weight: 700; color: var(--text-primary); }
.court-card__desc { font-size: 14px; color: var(--text-secondary); margin-top: 6px; }

/* Date Picker */
.date-section {
    background: rgba(153,87,179,0.05);
    border: 1px solid rgba(153,87,179,0.15);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}
.date-section label { font-size: 14px; font-weight: 600; color: var(--text-primary); white-space: nowrap; }
.date-input {
    padding: 10px 14px;
    border: 1px solid rgba(153,87,179,0.3);
    border-radius: 8px;
    font-size: 14px;
    font-family: var(--font-base);
    color: var(--text-primary);
    outline: none;
    background: white;
    cursor: pointer;
}
.date-input:focus { border-color: var(--brand-primary); box-shadow: 0 0 0 3px rgba(153,87,179,0.1); }

/* Slots Grid */
.slots-container { margin-top: 16px; }
.slots-loading { text-align: center; color: #888; font-size: 14px; padding: 20px 0; }
.slots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 10px;
    margin-top: 12px;
}
.slot-card {
    border-radius: 10px;
    padding: 10px 12px;
    font-size: 13px;
    font-weight: 500;
    text-align: center;
    transition: all 0.15s;
    cursor: pointer;
    user-select: none;
    border: 2px solid transparent;
}
.slot-available {
    background: rgba(22, 163, 74, 0.08);
    border-color: rgba(22, 163, 74, 0.3);
    color: #15803d;
}
.slot-available:hover {
    background: rgba(22, 163, 74, 0.18);
    border-color: #16a34a;
}
.slot-available.selected {
    background: #16a34a;
    border-color: #15803d;
    color: white;
    transform: scale(1.02);
    box-shadow: 0 2px 8px rgba(22,163,74,0.3);
}
.slot-taken {
    background: #f5f5f5;
    border-color: #e5e5e5;
    color: #aaa;
    cursor: not-allowed;
}
.slot-label { display: block; font-size: 12px; }
.slot-badge { font-size: 10px; margin-top: 3px; opacity: 0.8; }

/* Summary bar */
.booking-summary {
    display: none;
    background: white;
    border: 1px solid rgba(153,87,179,0.2);
    border-radius: 14px;
    padding: 16px 20px;
    margin-top: 16px;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
}
.booking-summary.visible { display: flex; }
.summary-info { font-size: 14px; color: var(--text-secondary); }
.summary-info strong { color: var(--text-primary); font-size: 16px; }
.btn-cta {
    padding: 12px 28px; background: var(--brand-primary); color: white;
    border: none; border-radius: 10px; font-size: 14px; font-weight: 600;
    font-family: var(--font-base); cursor: pointer;
    transition: opacity var(--transition);
}
.btn-cta:hover { opacity: 0.85; }
.btn-cta:disabled { opacity: 0.5; cursor: not-allowed; }
.no-login-msg {
    color: #64748b; font-size: 14px; margin-top: 16px; line-height: 1.6;
    padding: 14px 18px; background: #faf5ff; border-radius: 10px;
    border: 1px solid rgba(153,87,179,0.2);
}
.no-login-link {
    color: #8b5cf6; font-weight: 600; text-decoration: none;
}
.no-login-link:hover { text-decoration: underline; }

/* No jam set warning */
.jam-warning {
    background: #fffbeb; border: 1px solid #fcd34d; color: #92400e;
    border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-top: 12px;
}

@media (max-width: 768px) {
    .court-card { flex-direction: column; }
    .court-card__image { width: 100%; min-height: 180px; }
    .slots-grid { grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); }
}
</style>
@endpush

@section('content')
{{-- Hero Foto Venue --}}
<div class="venue-hero">
    @if($venue->foto)
        <img src="{{ Storage::url($venue->foto) }}" alt="{{ $venue->nama }}">
    @else
        <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=1400&q=80" alt="{{ $venue->nama }}">
    @endif
</div>

<div class="container">
    <div class="venue-info">
        <h1 class="venue-info__name">{{ $venue->nama }}</h1>
        <p class="venue-info__location">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:4px"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $venue->lokasi }}
        </p>
        @if($venue->deskripsi)
            <p style="margin-top: 12px; font-size: 14px; color: var(--text-secondary); line-height: 1.7;">{{ $venue->deskripsi }}</p>
        @endif

        <h2 style="font-size: 22px; font-weight: 700; margin-top: 40px; margin-bottom: 24px;">Lapangan yang Tersedia</h2>

        @forelse($lapangan as $court)
        <div class="court-card" id="court-{{ $court->id }}">
            <div class="court-card__image">
                @if($court->foto)
                    <img src="{{ Storage::url($court->foto) }}" alt="{{ $court->nama }}">
                @else
                    <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80" alt="{{ $court->nama }}">
                @endif
            </div>
            <div class="court-card__body">
                <h3 class="court-card__name">{{ $court->nama }}</h3>
                <p class="court-card__desc">
                    <span style="display:inline-block;background:rgba(153,87,179,0.1);color:var(--brand-primary);padding:2px 10px;border-radius:20px;font-size:12px;font-weight:600;">{{ $court->jenis_olahraga }}</span>
                    &nbsp;&nbsp;
                    <strong>Rp {{ number_format($court->harga_sewa, 0, ',', '.') }}</strong> / jam
                </p>
                @if($court->jam_buka && $court->jam_tutup)
                    <p style="font-size:12px;color:#888;margin-top:4px;">
                        🕐 Jam operasional: {{ substr($court->jam_buka, 0, 5) }} – {{ substr($court->jam_tutup, 0, 5) }}
                    </p>
                @endif

                {{-- Date Picker --}}
                <div class="date-section" style="margin-top: 18px;">
                    <label for="date-{{ $court->id }}">📅 Pilih Tanggal:</label>
                    <input
                        type="date"
                        id="date-{{ $court->id }}"
                        class="date-input"
                        min="{{ date('Y-m-d') }}"
                        onchange="loadSlots({{ $court->id }}, this.value, {{ $court->harga_sewa }})"
                    >
                </div>

                {{-- Slots Container --}}
                <div class="slots-container" id="slots-{{ $court->id }}">
                    @if(!$court->jam_buka || !$court->jam_tutup)
                        <div class="jam-warning">
                            ⚠️ Pengelola belum mengatur jam operasional lapangan ini.
                        </div>
                    @else
                        <p style="font-size:13px;color:#888;">Pilih tanggal untuk melihat slot tersedia.</p>
                    @endif
                </div>

                {{-- Booking Summary --}}
                <div class="booking-summary" id="summary-{{ $court->id }}">
                    <div class="summary-info">
                        <div id="summary-waktu-{{ $court->id }}" style="font-size:13px;color:#888;"></div>
                        <strong id="summary-harga-{{ $court->id }}">Rp 0</strong>
                    </div>
                    @auth
                        <form method="GET" action="{{ route('pemesanan.detail') }}" id="form-{{ $court->id }}">
                            <input type="hidden" name="id_lapangan" value="{{ $court->id }}">
                            <input type="hidden" name="tanggal_pesan" id="inp-tanggal-{{ $court->id }}">
                            <input type="hidden" name="waktu_mulai" id="inp-mulai-{{ $court->id }}">
                            <input type="hidden" name="waktu_selesai" id="inp-selesai-{{ $court->id }}">
                            <input type="hidden" name="total_harga" id="inp-total-{{ $court->id }}">
                            <button type="submit" class="btn-cta" id="btn-pesan-{{ $court->id }}">
                                Pesan Sekarang
                            </button>
                        </form>
                    @else
                        <p class="no-login-msg">
                            <a href="{{ route('login') }}" class="no-login-link">Login</a> untuk melanjutkan pemesanan.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <p style="color: #999; text-align: center; padding: 40px 0;">Belum ada lapangan tersedia untuk venue ini.</p>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
// State: menyimpan slot yang dipilih per lapangan
const selectedSlots = {};
const lapanganHarga = {};

function loadSlots(lapanganId, tanggal, harga) {
    if (!tanggal) return;

    lapanganHarga[lapanganId] = harga;
    selectedSlots[lapanganId] = [];

    const container = document.getElementById(`slots-${lapanganId}`);
    container.innerHTML = '<p class="slots-loading">⏳ Memuat slot tersedia...</p>';

    // Sembunyikan summary
    const summary = document.getElementById(`summary-${lapanganId}`);
    summary.classList.remove('visible');

    fetch(`/lapangan/${lapanganId}/slots?tanggal=${tanggal}`)
        .then(res => res.json())
        .then(data => {
            if (data.jam_belum_diset) {
                container.innerHTML = '<div class="jam-warning">⚠️ Pengelola belum mengatur jam operasional lapangan ini.</div>';
                return;
            }
            if (!data.slots || data.slots.length === 0) {
                container.innerHTML = '<p style="color:#888;font-size:13px;">Tidak ada slot tersedia untuk tanggal ini.</p>';
                return;
            }
            renderSlots(lapanganId, tanggal, data.slots);
        })
        .catch(() => {
            container.innerHTML = '<p style="color:#e53e3e;font-size:13px;">Gagal memuat slot. Coba lagi.</p>';
        });
}

function renderSlots(lapanganId, tanggal, slots) {
    const container = document.getElementById(`slots-${lapanganId}`);
    let html = '<div class="slots-grid">';

    slots.forEach(slot => {
        if (slot.tersedia) {
            html += `<div
                class="slot-card slot-available"
                id="slot-${lapanganId}-${slot.mulai.replace(':','')}"
                onclick="toggleSlot(${lapanganId}, '${slot.mulai}', '${slot.selesai}', '${tanggal}')"
                title="Klik untuk memilih slot ini"
            >
                <span class="slot-label">${slot.label}</span>
                <span class="slot-badge">✓ Tersedia</span>
            </div>`;
        } else {
            html += `<div class="slot-card slot-taken" title="Slot ini sudah terpesan">
                <span class="slot-label">${slot.label}</span>
                <span class="slot-badge">✗ Terpesan</span>
            </div>`;
        }
    });

    html += '</div>';
    container.innerHTML = html;
}

function toggleSlot(lapanganId, mulai, selesai, tanggal) {
    if (!selectedSlots[lapanganId]) selectedSlots[lapanganId] = [];

    const key = mulai;
    const idx = selectedSlots[lapanganId].findIndex(s => s.mulai === mulai);
    const elId = `slot-${lapanganId}-${mulai.replace(':','')}`;
    const el = document.getElementById(elId);

    if (idx === -1) {
        // Tambahkan slot — hanya boleh pilih slot berurutan
        const sorted = [...selectedSlots[lapanganId]].sort((a, b) => a.mulai.localeCompare(b.mulai));

        if (sorted.length > 0) {
            // Cek apakah slot baru berurutan dengan yang sudah dipilih
            const firstMulai = sorted[0].mulai;
            const lastSelesai = sorted[sorted.length - 1].selesai;
            if (mulai !== lastSelesai && selesai !== firstMulai) {
                showToast('Pilih slot yang berurutan!');
                return;
            }
        }

        selectedSlots[lapanganId].push({ mulai, selesai, tanggal });
        el && el.classList.add('selected');
    } else {
        // Hapus slot — hanya boleh hapus dari ujung
        const sorted = [...selectedSlots[lapanganId]].sort((a, b) => a.mulai.localeCompare(b.mulai));
        const firstMulai = sorted[0].mulai;
        const lastMulai  = sorted[sorted.length - 1].mulai;

        if (mulai !== firstMulai && mulai !== lastMulai) {
            showToast('Hapus slot dari ujung terlebih dahulu!');
            return;
        }

        selectedSlots[lapanganId].splice(idx, 1);
        el && el.classList.remove('selected');
    }

    updateSummary(lapanganId, tanggal);
}

function updateSummary(lapanganId, tanggal) {
    const slots = (selectedSlots[lapanganId] || []).sort((a, b) => a.mulai.localeCompare(b.mulai));
    const summary = document.getElementById(`summary-${lapanganId}`);

    if (slots.length === 0) {
        summary.classList.remove('visible');
        return;
    }

    const waktuMulai  = slots[0].mulai;
    const waktuSelesai = slots[slots.length - 1].selesai;
    const totalHarga  = slots.length * (lapanganHarga[lapanganId] || 0);

    document.getElementById(`summary-waktu-${lapanganId}`).textContent =
        `${slots.length} jam: ${waktuMulai} – ${waktuSelesai}`;
    document.getElementById(`summary-harga-${lapanganId}`).textContent =
        'Rp ' + totalHarga.toLocaleString('id-ID');

    // Update hidden form inputs
    const inpTanggal = document.getElementById(`inp-tanggal-${lapanganId}`);
    const inpMulai   = document.getElementById(`inp-mulai-${lapanganId}`);
    const inpSelesai = document.getElementById(`inp-selesai-${lapanganId}`);
    const inpTotal   = document.getElementById(`inp-total-${lapanganId}`);
    if (inpTanggal) inpTanggal.value = tanggal;
    if (inpMulai)   inpMulai.value   = waktuMulai + ':00';
    if (inpSelesai) inpSelesai.value = waktuSelesai + ':00';
    if (inpTotal)   inpTotal.value   = totalHarga;

    summary.classList.add('visible');
}

// Toast notification sederhana
let toastTimeout;
function showToast(msg) {
    let toast = document.getElementById('courtee-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'courtee-toast';
        toast.style.cssText = 'position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#1e293b;color:white;padding:10px 20px;border-radius:8px;font-size:13px;z-index:9999;transition:opacity 0.3s;';
        document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    clearTimeout(toastTimeout);
    toastTimeout = setTimeout(() => { toast.style.opacity = '0'; }, 2500);
}
</script>
@endpush
@endsection