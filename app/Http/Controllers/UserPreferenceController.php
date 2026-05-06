<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    private function getPreferences()
    {
        if (!Storage::exists('user_preferences.json')) {
            Storage::put('user_preferences.json', json_encode([]));
        }
        return json_decode(Storage::get('user_preferences.json'), true);
    }

    private function savePreferences($data)
    {
        Storage::put('user_preferences.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    // READ - Tampilkan preferensi user yang sedang login
    public function index()
    {
        $preferences = $this->getPreferences();
        $userId = Auth::id();
        $userPref = $preferences[$userId] ?? null;

        return view('user.preferences', compact('userPref'));
    }

    // CREATE/UPDATE - Simpan preferensi ke JSON
    public function store(Request $request)
    {
        $request->validate([
            'olahraga' => 'required|array|min:1',
            'notifikasi_email' => 'nullable|boolean',
            'notifikasi_booking' => 'nullable|boolean',
        ], [
            'olahraga.required' => 'Pilih minimal 1 olahraga favorit.',
            'olahraga.min' => 'Pilih minimal 1 olahraga favorit.',
        ]);

        $preferences = $this->getPreferences();
        $userId = Auth::id();

        // CREATE atau UPDATE preferensi user
        $preferences[$userId] = [
            'user_id' => $userId,
            'user_name' => Auth::user()->name,
            'olahraga_favorit' => $request->input('olahraga', []),
            'notifikasi_email' => $request->boolean('notifikasi_email'),
            'notifikasi_booking' => $request->boolean('notifikasi_booking'),
            'updated_at' => now()->format('d M Y H:i'),
        ];

        $this->savePreferences($preferences);

        return back()->with('success', 'Preferensi berhasil disimpan!');
    }

    // READ ALL - Admin lihat semua preferensi
    public function all()
    {
        $preferences = $this->getPreferences();
        return view('user.all-preferences', compact('preferences'));
    }
}
?>