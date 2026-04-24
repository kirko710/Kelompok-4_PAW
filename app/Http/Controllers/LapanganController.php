<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LapanganController extends Controller
{
    private string $lapanganPath;
    private string $venuePath;

    public function __construct()
    {
        $this->lapanganPath = storage_path('app/lapangan.json');
        $this->venuePath    = storage_path('app/venues.json');
    }

    private function readLapangan(): array
    {
        if (!file_exists($this->lapanganPath)) {
            file_put_contents($this->lapanganPath, json_encode([], JSON_PRETTY_PRINT));
            return [];
        }
        $content = file_get_contents($this->lapanganPath);
        return json_decode($content, true) ?? [];
    }

    private function writeLapangan(array $lapangan): void
    {
        file_put_contents($this->lapanganPath, json_encode($lapangan, JSON_PRETTY_PRINT));
    }

    private function readVenues(): array
    {
        if (!file_exists($this->venuePath)) {
            return [];
        }
        $content = file_get_contents($this->venuePath);
        return json_decode($content, true) ?? [];
    }

    public function index()
    {
        $venues   = $this->readVenues();
        $hasVenue = count($venues) > 0;
        $lapangan = $this->readLapangan();

        return view('admin.lapangan', compact('hasVenue', 'lapangan', 'venues'));
    }

    public function create()
    {
        $venues = $this->readVenues();
        return view('admin.lapangan-create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'venue_id'       => 'required|string',
            'jenis_olahraga' => 'required|string|max:100',
            'harga'          => 'required|string|max:100',
        ]);

        $lapangan = $this->readLapangan();

        $lapangan[] = [
            'id'             => Str::uuid()->toString(),
            'venue_id'       => $request->input('venue_id'),
            'nama'           => $request->input('nama'),
            'lokasi'         => $request->input('lokasi', ''),
            'harga'          => $request->input('harga'),
            'jenis_olahraga' => $request->input('jenis_olahraga'),
            'foto'           => $request->input('foto') ?: 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80',
        ];

        $this->writeLapangan($lapangan);

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil ditambahkan!');
    }
}
