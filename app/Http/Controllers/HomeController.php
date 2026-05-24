<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class HomeController extends Controller
{
    public function index()
    {
        $venues = Venue::active()->latest()->take(6)->get();
        return view('home.index', compact('venues'));
    }
}
