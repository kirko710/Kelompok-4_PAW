<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LapanganController;

// ============ HOME (yoga) ============
Route::get('/', fn () => view('home.index'))->name('home');

// ============ VENUE ============
Route::get('/venue', [GuestController::class, 'index'])->name('venue.index');
Route::get('/venue/{id}', [GuestController::class, 'show'])->name('venue.show');

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

// ============= USER =============
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/detail-pemesanan', fn () => view('penyewa.detail-pemesanan'))->name('pemesanan.detail');
    Route::get('/pembayaran', fn () => view('penyewa.pembayaran'))->name('pembayaran');
    Route::get('/profile', fn () => view('penyewa.profile'))->name('user.profile');
});
// ============ ADMIN (affan) ============
Route::middleware(['auth', 'role:owner'])->prefix('admin') ->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/venue', fn () => view('admin.venue'))->name('venue');
    Route::get('/venue/create', fn () => view('admin.venue-create'))->name('venue.create');

    // Venue
    Route::get('/venue', [VenueController::class, 'index'])->name('venue');
    Route::get('/venue/create', [VenueController::class, 'create'])->name('venue.create');
    Route::post('/venue', [VenueController::class, 'store'])->name('venue.store');
    Route::get('/venue/show', fn () => view('admin.venue-show'))->name('venue.show');
    Route::get('/lapangan', fn () => view('admin.lapangan'))->name('lapangan');
    Route::get('/lapangan/create', fn () => view('admin.lapangan-create'))->name('lapangan.create');

    // Lapangan
    Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan');
    Route::get('/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
    Route::post('/lapangan', [LapanganController::class, 'store'])->name('lapangan.store');
    Route::get('/lapangan/show', fn () => view('admin.lapangan-show'))->name('lapangan.show');

    Route::get('/jadwal', fn () => view('admin.jadwal'))->name('jadwal');
    Route::get('/pemesanan', fn () => view('admin.pemesanan'))->name('pemesanan');
    Route::get('/verifikasi', fn () => view('admin.verifikasi'))->name('verifikasi');
    Route::get('/pembatalan', fn () => view('admin.pembatalan'))->name('pembatalan');
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