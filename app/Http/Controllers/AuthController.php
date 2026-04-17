<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
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
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            if ($role === 'owner') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai Owner!');
            }
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah!')->withInput($request->only('email'));
    }

    // Tampilkan halaman pilih role register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Tampilkan form register
    public function showRegisterForm($role = 'user')
    {
        return view('auth.register-form', ['role' => $role]);
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
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

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Langsung login setelah register
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/register/welcome')->with('success', 'Registrasi berhasil! Selamat datang di Courtee.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session dan regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    // Lihat daftar user (READ)
    public function listUsers()
    {
        $users = User::all();
        return view('auth.users-list', compact('users'));
    }
}
