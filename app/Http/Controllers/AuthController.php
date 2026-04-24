<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==================== LOGIN ====================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role', 'user');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($role === 'owner') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai Owner!');
            }
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah!')->withInput($request->only('email'));
    }

    // ==================== REGISTER ====================

    // Step 1: Pilih role (user/owner)
    public function showRegister()
    {
        return view('auth.register');
    }

    // Step 2: Form akun (nama, email, password)
    public function showRegisterForm($role)
    {
        return view('auth.register-form', ['role' => $role]);
    }

    // Step 2: Proses form akun - simpan ke session dulu, BELUM ke database
    public function submitRegisterForm(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,owner',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Simpan data di session, belum masuk database
        session([
            'register_data' => [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ]
        ]);

        // Arahkan ke halaman profile sesuai role
        $role = $request->input('role');
        if ($role === 'owner') {
            return redirect('/register/profile/owner');
        }
        return redirect('/register/profile/user');
    }

    // Step 3: Form profil user
    public function showProfileUser()
    {
        if (!session('register_data')) {
            return redirect('/register')->with('error', 'Silakan isi data akun terlebih dahulu.');
        }
        return view('auth.register-profile-user');
    }

    // Step 3: Form profil owner
    public function showProfileOwner()
    {
        if (!session('register_data')) {
            return redirect('/register')->with('error', 'Silakan isi data akun terlebih dahulu.');
        }
        return view('auth.register-profile-owner');
    }

    // Step 3: Proses simpan profil ke session
    public function submitProfile(Request $request)
    {
        $registerData = session('register_data');
        if (!$registerData) {
            return redirect('/register');
        }

        // Tambahkan data profil ke session
        $registerData['nama_lengkap'] = $request->input('nama', '');
        $registerData['alamat'] = $request->input('alamat', '');
        $registerData['tanggal_lahir'] = $request->input('tanggal_lahir', '');
        $registerData['telepon'] = $request->input('telepon', '');
        $registerData['bank'] = $request->input('bank', '');
        $registerData['rekening'] = $request->input('rekening', '');

        session(['register_data' => $registerData]);

        return redirect('/register/preferensi');
    }

    // Step 4: Form preferensi
    public function showPreferensi()
    {
        if (!session('register_data')) {
            return redirect('/register')->with('error', 'Silakan isi data akun terlebih dahulu.');
        }
        return view('auth.register-preferensi');
    }

    // Step 4: Proses simpan preferensi + SIMPAN KE DATABASE + AUTO LOGIN
    public function submitPreferensi(Request $request)
    {
        $registerData = session('register_data');
        if (!$registerData) {
            return redirect('/register');
        }

        // Sekarang baru simpan ke database
        $user = User::create([
            'name' => $registerData['name'],
            'email' => $registerData['email'],
            'password' => Hash::make($registerData['password']),
        ]);

        // Bersihkan session register
        session()->forget('register_data');

        // Auto login setelah semua step selesai
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/register/welcome')->with('success', 'Registrasi berhasil! Selamat datang di Courtee.');
    }

    // Step 5: Halaman welcome
    public function showWelcome()
    {
        return view('auth.welcome');
    }

    // ==================== LOGOUT ====================

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    // ==================== READ USERS ====================

    public function listUsers()
    {
        $users = User::all();
        return view('auth.users-list', compact('users'));
    }
}
