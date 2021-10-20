<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use Illuminate\Validation\Rule;

class MahasiswaTable extends Component
{
    public $modal;
    public $mahasiswa;
    public $mahasiswa_id = null;
    // protected $listeners = ['mahasiswaDitambah' => 'render'];

    public function rules()
    {
        if (is_null($this->mahasiswa_id)) {
            return [
                'mahasiswa.nim' => 'required|unique:mahasiswas,nim',
                'mahasiswa.nama' => 'required'
            ];
        }

        return [
            'mahasiswa.nim' => ['required', Rule::unique('mahasiswas', 'nim')->ignore($this->mahasiswa->nim, 'nim')],
            'mahasiswa.nama' => 'required'
        ];
    }

    public function mount($id = null)
    {
        $this->mahasiswa_id = $id;
        $this->mahasiswa = new Mahasiswa();
    }

    private function bukaModal()
    {
        $this->modal = true;
    }

    public function tambah()
    {
        $this->mahasiswa = new Mahasiswa();

        $this->bukaModal();
    }

    public function ubah(Mahasiswa $mahasiswa)
    {
        $this->mahasiswa_id = $mahasiswa->id;

        $this->mahasiswa = $mahasiswa;

        $this->bukaModal();
    }

    public function simpan()
    {
        $this->validate();

        $this->mahasiswa->save();

        $this->modal = null;
        $this->mahasiswa_id = null;

        $this->render();
    }

    public function render()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        return view('livewire.mahasiswa-table', compact('mahasiswas'));
    }
}
