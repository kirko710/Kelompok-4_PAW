<?php

use Illuminate\Support\Facades\Route;

// ============ HOME ============
Route::get('/', fn () => view('home.index'))->name('home');

// ============ AUTH - LOGIN ============
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login/penyewa', fn () => redirect('/venue'))->name('login.penyewa');
Route::post('/login/owner', fn () => redirect('/admin'))->name('login.owner');

// ============ AUTH - REGISTER ============
Route::get('/register', fn () => view('auth.register'))->name('register');

Route::prefix('register')->name('register.')->group(function () {

    Route::get('/user', fn () => view('auth.register-form', ['role' => 'user']))->name('user');
    Route::post('/user', fn () => redirect('/register/profile/user'))->name('user.post');

    Route::get('/owner', fn () => view('auth.register-form', ['role' => 'owner']))->name('owner');
    Route::post('/owner', fn () => redirect('/register/profile/owner'))->name('owner.post');

    Route::get('/profile/user',  fn () => view('auth.register-profile-user'))->name('profile.user');
    Route::post('/profile/user', fn () => redirect('/register/preferensi'))->name('profile.user.post');

    Route::get('/profile/owner',  fn () => view('auth.register-profile-owner'))->name('profile.owner');
    Route::post('/profile/owner', fn () => redirect('/register/preferensi'))->name('profile.owner.post');

    Route::get('/preferensi',  fn () => view('auth.register-preferensi'))->name('preferensi');
    Route::post('/preferensi', fn () => redirect('/register/welcome'))->name('preferensi.post');

    Route::get('/welcome', fn () => view('auth.welcome'))->name('welcome');
});

// ============ VENUE (Guest) ============
Route::get('/venue', [App\Http\Controllers\GuestController::class, 'index'])->name('venue.index');
Route::get('/venue/{id}', [App\Http\Controllers\GuestController::class, 'show'])->name('venue.show');

// ============= Penyewa =============
Route::get('/detail-pemesanan', fn () => view('penyewa.detail-pemesanan'))->name('pemesanan.detail');
Route::get('/pembayaran', fn () => view('penyewa.pembayaran'))->name('pembayaran');
Route::get('/profile', fn () => view('penyewa.profile'))->name('user.profile');

// ============ ADMIN ============
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

    // Venue
    Route::get('/venue', [App\Http\Controllers\VenueController::class, 'index'])->name('venue');
    Route::get('/venue/create', [App\Http\Controllers\VenueController::class, 'create'])->name('venue.create');
    Route::post('/venue', [App\Http\Controllers\VenueController::class, 'store'])->name('venue.store');
    Route::get('/venue/show', fn () => view('admin.venue-show'))->name('venue.show');

    // Lapangan
    Route::get('/lapangan', [App\Http\Controllers\LapanganController::class, 'index'])->name('lapangan');
    Route::get('/lapangan/create', [App\Http\Controllers\LapanganController::class, 'create'])->name('lapangan.create');
    Route::post('/lapangan', [App\Http\Controllers\LapanganController::class, 'store'])->name('lapangan.store');
    Route::get('/lapangan/show', fn () => view('admin.lapangan-show'))->name('lapangan.show');

    Route::get('/jadwal', fn () => view('admin.jadwal'))->name('jadwal');
    Route::get('/pemesanan', fn () => view('admin.pemesanan'))->name('pemesanan');
    Route::get('/verifikasi', fn () => view('admin.verifikasi'))->name('verifikasi');
    Route::get('/pembatalan', fn () => view('admin.pembatalan'))->name('pembatalan');
    Route::get('/laporan', fn () => view('admin.laporan'))->name('laporan');
    Route::get('/komunikasi', fn () => view('admin.komunikasi'))->name('komunikasi');
    Route::get('/profile', fn () => view('admin.profile'))->name('profile');
});