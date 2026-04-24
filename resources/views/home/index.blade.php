@extends('layouts.layout')

@section('title', 'Home - Courtee')

@section('content')

    {{-- Hero: background + form pencarian --}}
    @include('components.home.hero')

    {{-- Section rekomendasi venue --}}
    @include('components.home.rekomendasi')

@endsection