<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Tampilkan semua lapangan milik pengelola yang sedang login.
     */
    public function index()
    {
        $venueIds = Venue::where('id_user', Auth::id())->pluck('id');
        $hasVenue = $venueIds->isNotEmpty();

        $lapangans = Lapangan::with('venue')
            ->whereIn('id_venue', $venueIds)
            ->latest()
            ->get();

        return view('admin.lapangan', compact('hasVenue', 'lapangans'));
    }

    /**
     * Form tambah lapangan baru.
     */
    public function create()
    {
        $venues = Venue::where('id_user', Auth::id())->get();
        return view('admin.lapangan-create', compact('venues'));
    }

    /**
     * Simpan lapangan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'id_venue'       => 'required|exists:venues,id',
            'jenis_olahraga' => 'required|string|max:100',
            'harga_sewa'     => 'required|numeric|min:0',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jam_buka'       => 'nullable|date_format:H:i',
            'jam_tutup'      => 'nullable|date_format:H:i|after:jam_buka',
        ]);

        // Pastikan venue yang dipilih milik pengelola yang login
        $venue = Venue::where('id_user', Auth::id())->findOrFail($request->id_venue);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('lapangans', 'public');
        }

        Lapangan::create([
            'id_venue'       => $venue->id,
            'nama'           => $request->nama,
            'jenis_olahraga' => $request->jenis_olahraga,
            'harga_sewa'     => $request->harga_sewa,
            'foto'           => $fotoPath,
            'jam_buka'       => $request->jam_buka,
            'jam_tutup'      => $request->jam_tutup,
        ]);

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil ditambahkan!');
    }

    /**
     * Form edit lapangan.
     */
    public function edit($id)
    {
        $venueIds = Venue::where('id_user', Auth::id())->pluck('id');
        $lapangan = Lapangan::whereIn('id_venue', $venueIds)->findOrFail($id);
        $venues   = Venue::where('id_user', Auth::id())->get();

        return view('admin.lapangan-edit', compact('lapangan', 'venues'));
    }

    /**
     * Update lapangan di database.
     */
    public function update(Request $request, $id)
    {
        $venueIds = Venue::where('id_user', Auth::id())->pluck('id');
        $lapangan = Lapangan::whereIn('id_venue', $venueIds)->findOrFail($id);

        $request->validate([
            'nama'           => 'required|string|max:255',
            'id_venue'       => 'required|exists:venues,id',
            'jenis_olahraga' => 'required|string|max:100',
            'harga_sewa'     => 'required|numeric|min:0',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jam_buka'       => 'nullable|date_format:H:i',
            'jam_tutup'      => 'nullable|date_format:H:i|after:jam_buka',
        ]);

        // Pastikan venue target juga milik pengelola yang login
        Venue::where('id_user', Auth::id())->findOrFail($request->id_venue);

        $data = [
            'id_venue'       => $request->id_venue,
            'nama'           => $request->nama,
            'jenis_olahraga' => $request->jenis_olahraga,
            'harga_sewa'     => $request->harga_sewa,
            'jam_buka'       => $request->jam_buka,
            'jam_tutup'      => $request->jam_tutup,
        ];

        if ($request->hasFile('foto')) {
            if ($lapangan->foto) {
                Storage::disk('public')->delete($lapangan->foto);
            }
            $data['foto'] = $request->file('foto')->store('lapangans', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil diperbarui!');
    }

    /**
     * Hapus lapangan dari database.
     * Ditolak jika ada pemesanan aktif atau pending.
     */
    public function destroy($id)
    {
        $venueIds = Venue::where('id_user', Auth::id())->pluck('id');
        $lapangan = Lapangan::whereIn('id_venue', $venueIds)->findOrFail($id);

        if ($lapangan->hasActivePemesanan()) {
            return redirect()->route('admin.lapangan')
                ->with('error', 'Lapangan tidak dapat dihapus karena masih ada pemesanan aktif atau pending.');
        }

        if ($lapangan->foto) {
            Storage::disk('public')->delete($lapangan->foto);
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil dihapus!');
    }
}
