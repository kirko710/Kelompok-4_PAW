<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use App\Models\User;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;

        $totalTransaksi = Pemesanan::where('id_user', $user->id)->count();
        $totalPengeluaran = Pemesanan::where('id_user', $user->id)
            ->where('status_pesanan', 'confirmed')
            ->sum('total_harga');

        $now = now();
        $upcomingBookings = Pemesanan::with(['lapangan', 'lapangan.venue'])
            ->where('id_user', $user->id)
            ->whereRaw("CONCAT(tanggal_pesan, ' ', waktu_mulai) >= ?", [$now->format('Y-m-d H:i:s')])
            ->orderByRaw("CONCAT(tanggal_pesan, ' ', waktu_mulai) ASC")
            ->take(5)
            ->get();

        return view('penyewa.profile', compact(
            'user', 'profile', 'totalTransaksi', 'totalPengeluaran', 'upcomingBookings'
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;

        return view('penyewa.profile-edit', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'tanggal_lahir' => 'nullable|date',
            'telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (method_exists($user, 'profile')) {
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
                    'telepon' => $data['telepon'] ?? null,
                    'alamat' => $data['alamat'] ?? null,
                ]
            );
        }

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
