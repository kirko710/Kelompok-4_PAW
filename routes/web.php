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

    // Register Step 1: Pilih role
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

    // Register Step 2: Form akun
    Route::get('/register/user', [AuthController::class, 'showRegisterForm'])->defaults('role', 'user')->name('register.user');
    Route::get('/register/owner', [AuthController::class, 'showRegisterForm'])->defaults('role', 'owner')->name('register.owner');
    Route::post('/register/submit', [AuthController::class, 'submitRegisterForm'])->name('register.submit');

    // Register Step 3: Profil
    Route::get('/register/profile/user', [AuthController::class, 'showProfileUser'])->name('register.profile.user');
    Route::get('/register/profile/owner', [AuthController::class, 'showProfileOwner'])->name('register.profile.owner');
    Route::post('/register/profile/save', [AuthController::class, 'submitProfile'])->name('register.profile.save');

    // Register Step 4: Preferensi
    Route::get('/register/preferensi', [AuthController::class, 'showPreferensi'])->name('register.preferensi');
    Route::post('/register/preferensi/save', [AuthController::class, 'submitPreferensi'])->name('register.preferensi.save');
});

// ============ AUTH - LOGGED IN ONLY (sudah login) ============
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register/welcome', [AuthController::class, 'showWelcome'])->name('register.welcome');
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
