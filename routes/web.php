<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ============ HOME (yoga) ============
Route::get('/', function () { return view('home.index'); })->name('home');

// ============ VENUE & PENYEWA ============
Route::get('/venue', function () { return view('guest.venue-search'); })->name('venue.index');
Route::get('/venue/{id}', function ($id) { return view('guest.venue-detail'); })->name('venue.show');
Route::get('/pemesanan', function () { return view('guest.detail-pemesanan'); })->name('pemesanan.detail');
Route::get('/pembayaran', function () { return view('guest.pembayaran'); })->name('pembayaran');
Route::get('/profile', function () { return view('guest.profile'); })->name('profile');

// ============ COMMUNITY ============
Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', function () { return view('community.forum'); })->name('index');
    Route::get('/forum', function () { return view('community.forum'); })->name('forum');
    Route::get('/grup', function () { return view('community.grup'); })->name('grup');
    Route::get('/chat', function () { return view('community.chat'); })->name('chat');
    Route::get('/event', function () { return view('community.event'); })->name('event');
});

// ============ AUTH (guest middleware - hanya untuk yang belum login) ============
Route::middleware('guest')->group(function () {
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
    Route::get('/register/user', function () { return view('auth.register-form', ['role' => 'user']); })->name('register.user');
    Route::get('/register/owner', function () { return view('auth.register-form', ['role' => 'owner']); })->name('register.owner');
    Route::post('/register/submit', [AuthController::class, 'register'])->name('register.submit');
});

// ============ AUTH (auth middleware - hanya untuk yang sudah login) ============
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register/welcome', function () { return view('auth.welcome'); })->name('register.welcome');
    Route::get('/users', [AuthController::class, 'listUsers'])->name('users.list');
});

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

Route::get('/admin/pembatalan', function () { return 'Halaman Pembatalan - Coming Soon'; })->name('admin.pembatalan');
Route::get('/admin/laporan', function () { return 'Halaman Laporan - Coming Soon'; })->name('admin.laporan');
Route::get('/admin/komunikasi', function () { return 'Halaman Komunikasi - Coming Soon'; })->name('admin.komunikasi');
