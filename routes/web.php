<?php

use Illuminate\Support\Facades\Route;

// ============ HOME (yoga) ============
Route::get('/', function () { return view('home.index'); })->name('home');

// ============ AUTH - LOGIN & REGISTER (kirko) ============
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login/penyewa', function () { return redirect('/venue'); })->name('login.penyewa');
Route::post('/login/owner', function () { return redirect('/admin'); })->name('login.owner');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::get('/register/user', function () { return view('auth.register-form'); })->name('register.user');
Route::post('/register/user', function () { return redirect('/register/profile/user'); })->name('register.user.post');
Route::get('/register/owner', function () { return view('auth.register-form'); })->name('register.owner');
Route::post('/register/owner', function () { return redirect('/register/profile/owner'); })->name('register.owner.post');
Route::get('/register/profile/user', function () { return view('auth.register-profile-user'); })->name('register.profile.user');
Route::post('/register/profile/user', function () { return redirect('/register/preferensi'); })->name('register.profile.user.post');
Route::get('/register/profile/owner', function () { return view('auth.register-profile-owner'); })->name('register.profile.owner');
Route::post('/register/profile/owner', function () { return redirect('/register/preferensi'); })->name('register.profile.owner.post');
Route::get('/register/preferensi', function () { return view('auth.register-preferensi'); })->name('register.preferensi');
Route::post('/register/preferensi', function () { return redirect('/register/welcome'); })->name('register.preferensi.post');
Route::get('/register/welcome', function () { return view('auth.welcome'); })->name('register.welcome');

// ============ ADMIN (affan) ============
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::get('/venue', function () { return view('admin.venue'); })->name('venue');
    Route::get('/lapangan', function () { return view('admin.lapangan'); })->name('lapangan');
    Route::get('/jadwal', function () { return view('admin.jadwal'); })->name('jadwal');
    Route::get('/pemesanan', function () { return view('admin.pemesanan'); })->name('pemesanan');
    Route::get('/verifikasi', function () { return view('admin.verifikasi'); })->name('verifikasi');
    Route::get('/verifikasi-pembayaran', function () { return view('admin.verifikasi-pembayaran'); })->name('verifikasi-pembayaran');
    Route::get('/profile', function () { return view('admin.profile'); })->name('profile');
});

// ============ VENUE & COMMUNITY (placeholder - belum ada dari teman) ============
Route::get('/venue', function () { return view('guest.venue-search'); })->name('venue.index');
Route::get('/venue/{id}', function ($id) { return view('guest.venue-detail'); })->name('venue.show');

Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', function () { return view('community.forum'); })->name('index');
    Route::get('/forum', function () { return view('community.forum'); })->name('forum');
    Route::get('/grup', function () { return view('community.grup'); })->name('grup');
    Route::get('/chat', function () { return view('community.chat'); })->name('chat');
    Route::get('/event', function () { return view('community.event'); })->name('event');
});

// ============ AUTH PAGES ============
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::get('/register/user', function () { return view('auth.register-form'); })->name('register.user');
Route::get('/register/owner', function () { return view('auth.register-form'); })->name('register.owner');
Route::get('/register/profile/user', function () { return view('auth.register-profile-user'); })->name('register.profile.user');
Route::get('/register/profile/owner', function () { return view('auth.register-profile-owner'); })->name('register.profile.owner');
Route::get('/register/preferensi', function () { return view('auth.register-preferensi'); })->name('register.preferensi');
Route::get('/register/welcome', function () { return view('auth.welcome'); })->name('register.welcome');

// ============ ADMIN PAGES ============
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::get('/venue', function () { return view('admin.venue'); })->name('venue');
    Route::get('/venue/create', function () { return view('admin.venue-create'); })->name('venue.create');
    Route::get('/venue/show', function () { return view('admin.venue-show'); })->name('venue.show');
    Route::get('/lapangan', function () { return view('admin.lapangan'); })->name('lapangan');
    Route::get('/lapangan/create', function () { return view('admin.lapangan-create'); })->name('lapangan.create');
    Route::get('/lapangan/show', function () { return view('admin.lapangan-show'); })->name('lapangan.show');
    Route::get('/jadwal', function () { return view('admin.jadwal'); })->name('jadwal');
    Route::get('/pemesanan', function () { return view('admin.pemesanan'); })->name('pemesanan');
    Route::get('/verifikasi', function () { return view('admin.verifikasi'); })->name('verifikasi');
    Route::get('/pembatalan', function () { return view('admin.pembatalan'); })->name('pembatalan');
    Route::get('/laporan', function () { return view('admin.laporan'); })->name('laporan');
    Route::get('/komunikasi', function () { return view('admin.komunikasi'); })->name('komunikasi');
    Route::get('/profile', function () { return view('admin.profile'); })->name('profile');
});
