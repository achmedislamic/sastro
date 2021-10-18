<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MahasiswaForm extends Component
{
    public $modal;

    public function render()
    {
        return view('livewire.mahasiswa-form');
    }
}
