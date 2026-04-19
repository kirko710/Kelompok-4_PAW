<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    private string $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/venues.json');
    }

    private function readVenues(): array
    {
        if (!file_exists($this->storagePath)) {
            file_put_contents($this->storagePath, json_encode([], JSON_PRETTY_PRINT));
            return [];
        }
        $content = file_get_contents($this->storagePath);
        return json_decode($content, true) ?? [];
    }

    private function writeVenues(array $venues): void
    {
        file_put_contents($this->storagePath, json_encode($venues, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $venues = $this->readVenues();
        return view('admin.venue', compact('venues'));
    }

    public function create()
    {
        return view('admin.venue-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'lokasi' => 'required|string|max:500',
        ]);

        $venues = $this->readVenues();

        $venues[] = [
            'id'       => Str::uuid()->toString(),
            'nama'     => $request->input('nama'),
            'deskripsi'=> $request->input('deskripsi', ''),
            'lokasi'   => $request->input('lokasi'),
            'foto'     => $request->input('foto') ?: 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80',
        ];

        $this->writeVenues($venues);

        return redirect()->route('admin.venue')->with('success', 'Venue berhasil ditambahkan!');
    }
}
