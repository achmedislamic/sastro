<?php

use App\Http\Livewire\MahasiswaTable;
use Illuminate\Support\Facades\Route;

Route::get('/', MahasiswaTable::class)->name('mahasiswa');
