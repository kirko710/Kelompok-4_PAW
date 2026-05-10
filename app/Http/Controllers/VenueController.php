<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    /**
     * Tampilkan semua venue milik pengelola yang sedang login.
     */
    public function index()
    {
        $venues = Venue::where('id_user', Auth::id())->latest()->get();
        return view('admin.venue', compact('venues'));
    }

    /**
     * Form tambah venue baru.
     */
    public function create()
    {
        return view('admin.venue-create');
    }

    /**
     * Simpan venue baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'lokasi'  => 'required|string|max:500',
            'deskripsi' => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('venues', 'public');
        }

        Venue::create([
            'id_user'   => Auth::id(),
            'nama'      => $request->nama,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('admin.venue')->with('success', 'Venue berhasil ditambahkan!');
    }

    /**
     * Detail venue beserta daftar lapangannya.
     */
    public function show($id)
    {
        $venue = Venue::where('id_user', Auth::id())->with('lapangans')->findOrFail($id);
        return view('admin.venue-show', compact('venue'));
    }

    /**
     * Form edit venue.
     */
    public function edit($id)
    {
        $venue = Venue::where('id_user', Auth::id())->findOrFail($id);
        return view('admin.venue-edit', compact('venue'));
    }

    /**
     * Update venue di database.
     */
    public function update(Request $request, $id)
    {
        $venue = Venue::where('id_user', Auth::id())->findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'lokasi'  => 'required|string|max:500',
            'deskripsi' => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'nama'      => $request->nama,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($venue->foto) {
                Storage::disk('public')->delete($venue->foto);
            }
            $data['foto'] = $request->file('foto')->store('venues', 'public');
        }

        $venue->update($data);

        return redirect()->route('admin.venue')->with('success', 'Venue berhasil diperbarui!');
    }

    /**
     * Hapus venue dari database (cascade ke lapangan via DB).
     */
    public function destroy($id)
    {
        $venue = Venue::where('id_user', Auth::id())->findOrFail($id);

        // Hapus foto dari storage
        if ($venue->foto) {
            Storage::disk('public')->delete($venue->foto);
        }

        // Hapus juga foto lapangan-lapangan yang ada
        foreach ($venue->lapangans as $lapangan) {
            if ($lapangan->foto) {
                Storage::disk('public')->delete($lapangan->foto);
            }
        }

        $venue->delete(); // SoftDelete → cascade handled by DB

        return redirect()->route('admin.venue')->with('success', 'Venue berhasil dihapus!');
    }
}
