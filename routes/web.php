<?php

use Illuminate\Support\Facades\Route;

// ============ GUEST PAGES ============
Route::get('/', function () { return view('guest.home'); })->name('home');
Route::get('/venue', function () { return view('guest.venue-search'); })->name('venue.index');
Route::get('/venue/{id}', function ($id) { return view('guest.venue-detail'); })->name('venue.show');
Route::get('/pemesanan', function () { return view('guest.detail-pemesanan'); })->name('pemesanan.detail');
Route::get('/pembayaran', function () { return view('guest.pembayaran'); })->name('pembayaran');
Route::get('/profile', function () { return view('guest.profile'); })->name('profile');

// ============ COMMUNITY PAGES ============
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
    Route::get('/lapangan', function () { return view('admin.lapangan'); })->name('lapangan');
    Route::get('/jadwal', function () { return view('admin.jadwal'); })->name('jadwal');
    Route::get('/pemesanan', function () { return view('admin.pemesanan'); })->name('pemesanan');
    Route::get('/verifikasi', function () { return view('admin.verifikasi'); })->name('verifikasi');
    Route::get('/pembatalan', function () { return view('admin.pembatalan'); })->name('pembatalan');
    Route::get('/laporan', function () { return view('admin.laporan'); })->name('laporan');
    Route::get('/komunikasi', function () { return view('admin.komunikasi'); })->name('komunikasi');
    Route::get('/profile', function () { return view('admin.profile'); })->name('profile');
});
