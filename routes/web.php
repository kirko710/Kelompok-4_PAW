<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/venue',     function () { return view('home.index'); })->name('venue.index');
Route::get('/community', function () { return view('home.index'); })->name('community.index');
Route::get('/login',     function () { return view('home.index'); })->name('login');
Route::get('/register',  function () { return view('home.index'); })->name('register');