<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;

// ============ HOME (yoga) ============
Route::get('/', fn () => view('home.index'))->name('home');

// ============ AUTH - GUEST ONLY (belum login) ============
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/penyewa', function (\Illuminate\Http\Request $request) {
        $request->merge(['role' => 'user']);
        return app(AuthController::class)->login($request);
    })->name('login.penyewa');
    Route::post('/login/owner', function (\Illuminate\Http\Request $request) {
        $request->merge(['role' => 'owner']);
        return app(AuthController::class)->login($request);
    })->name('login.owner');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/register/user', [AuthController::class, 'showRegisterForm'])->defaults('role', 'user')->name('register.user');
    Route::get('/register/owner', [AuthController::class, 'showRegisterForm'])->defaults('role', 'owner')->name('register.owner');
    Route::post('/register/submit', [AuthController::class, 'submitRegisterForm'])->name('register.submit');
    Route::get('/register/profile/user', [AuthController::class, 'showProfileUser'])->name('register.profile.user');
    Route::get('/register/profile/owner', [AuthController::class, 'showProfileOwner'])->name('register.profile.owner');
    Route::post('/register/profile/save', [AuthController::class, 'submitProfile'])->name('register.profile.save');
    Route::get('/register/preferensi', [AuthController::class, 'showPreferensi'])->name('register.preferensi');
    Route::post('/register/preferensi/save', [AuthController::class, 'submitPreferensi'])->name('register.preferensi.save');
});

// ============ VENUE ============
Route::get('/venue', [GuestController::class, 'index'])->name('venue.index');
Route::get('/venue/{id}', [GuestController::class, 'show'])->name('venue.show');

// ============ LAPANGAN SLOTS (public, no auth required) ============
Route::get('/lapangan/{id}/slots', [GuestController::class, 'getSlots'])->name('lapangan.slots');

// ============= USER =============
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/detail-pemesanan/{id}', [PemesananController::class, 'detailPemesanan'])->name('pemesanan.detail');
    Route::get('/pembayaran/{id_pemesanan}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('/pembayaran/{id}/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');
    Route::get('/profile', fn () => view('penyewa.profile'))->name('user.profile');
    Route::get('/riwayat', [PemesananController::class, 'riwayatIndex'])->name('user.riwayat');
    Route::get('/riwayat/{id}', [PemesananController::class, 'showRiwayat'])->name('riwayat.detail');
});

// ============ USER PREFERENCES (JSON CRUD) ============
Route::middleware('auth')->group(function () {
    Route::get('/preferensi', [App\Http\Controllers\UserPreferenceController::class, 'index'])->name('preferensi.index');
    Route::post('/preferensi/save', [App\Http\Controllers\UserPreferenceController::class, 'store'])->name('preferensi.save');
    Route::get('/preferensi/all', [App\Http\Controllers\UserPreferenceController::class, 'all'])->name('preferensi.all');
});

// ============ ADMIN / PENGELOLA (affan) ============
Route::middleware(['auth', 'role:owner'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/venue', fn () => view('admin.venue'))->name('venue');
    Route::get('/venue/create', fn () => view('admin.venue-create'))->name('venue.create');

    // Venue
    Route::get('/venue', [VenueController::class, 'index'])->name('venue');
    Route::get('/venue/create', [VenueController::class, 'create'])->name('venue.create');
    Route::post('/venue', [VenueController::class, 'store'])->name('venue.store');
    Route::get('/venue/{id}', [VenueController::class, 'show'])->name('venue.show');
    Route::get('/venue/{id}/edit', [VenueController::class, 'edit'])->name('venue.edit');
    Route::put('/venue/{id}', [VenueController::class, 'update'])->name('venue.update');
    Route::delete('/venue/{id}', [VenueController::class, 'destroy'])->name('venue.destroy');

    // Lapangan
    Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan');
    Route::get('/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
    Route::post('/lapangan', [LapanganController::class, 'store'])->name('lapangan.store');
    Route::get('/lapangan/{id}/edit', [LapanganController::class, 'edit'])->name('lapangan.edit');
    Route::put('/lapangan/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
    Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');

    Route::get('/jadwal', fn () => view('admin.jadwal'))->name('jadwal');
    Route::get('/pemesanan', fn () => view('admin.pemesanan'))->name('pemesanan');
    // Route::get('/pemesanan', [PemesananController::class, 'adminIndex'])->name('pemesanan');
    Route::get('/verifikasi', [App\Http\Controllers\PembayaranController::class, 'daftarVerifikasi'])->name('verifikasi');
    Route::post('/verifikasi/{id}', [App\Http\Controllers\PembayaranController::class, 'prosesVerifikasi'])->name('verifikasi.proses');
    Route::get('/pembatalan', [PemesananController::class, 'adminPembatalanIndex'])->name('pembatalan');
    // Route::get('/verifikasi', fn () => view('admin.verifikasi'))->name('verifikasi');
    // Route::get('/pembatalan', fn () => view('admin.pembatalan'))->name('pembatalan');
    Route::get('/laporan', fn () => view('admin.laporan'))->name('laporan');
    Route::get('/komunikasi', fn () => view('admin.komunikasi'))->name('komunikasi');
    Route::get('/profile', fn () => view('admin.profile'))->name('profile');
});

// ============ AUTH - LOGGED IN ONLY (sudah login) ============
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register/welcome', [AuthController::class, 'showWelcome'])->name('register.welcome');
    Route::get('/users', [AuthController::class, 'listUsers'])->name('users.list');
});