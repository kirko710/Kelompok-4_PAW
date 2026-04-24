<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    private string $venuePath;
    private string $lapanganPath;

    public function __construct()
    {
        $this->venuePath    = storage_path('app/venues.json');
        $this->lapanganPath = storage_path('app/lapangan.json');
    }

    private function readVenues(): array
    {
        if (!file_exists($this->venuePath)) {
            return [];
        }
        $content = file_get_contents($this->venuePath);
        return json_decode($content, true) ?? [];
    }

    private function readLapangan(): array
    {
        if (!file_exists($this->lapanganPath)) {
            return [];
        }
        $content = file_get_contents($this->lapanganPath);
        return json_decode($content, true) ?? [];
    }

    public function index()
    {
        $venues = $this->readVenues();
        return view('guest.venue-search', compact('venues'));
    }

    public function show(string $id)
    {
        $venues = $this->readVenues();

        $venue = collect($venues)->firstWhere('id', $id);

        if (!$venue) {
            abort(404);
        }

        $allLapangan = $this->readLapangan();
        $lapangan    = array_values(array_filter($allLapangan, fn($l) => $l['venue_id'] === $id));

        return view('guest.venue-detail', compact('venue', 'lapangan'));
    }
}
