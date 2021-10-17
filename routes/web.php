<?php

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $mahasiswas = Mahasiswa::orderBy('nama')->get();
    return view('welcome', compact('mahasiswas'));
});
