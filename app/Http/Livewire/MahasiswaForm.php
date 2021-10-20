<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;

class MahasiswaForm extends Component
{
    public function render()
    {
        return view('livewire.mahasiswa-form');
    }
}
