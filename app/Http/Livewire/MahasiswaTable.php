<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class MahasiswaTable extends Component
{
    use WithPagination, WithSorting;

    public $modal;
    public $mahasiswa;
    public $mahasiswa_id = null;
    public $confirming;
    public $search;
    public $rows;
    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function rules()
    {
        if (is_null($this->mahasiswa_id)) {
            return [
                'mahasiswa.nim' => 'required|unique:mahasiswas,nim|max:9|numeric',
                'mahasiswa.nama' => 'required'
            ];
        }

        return [
            'mahasiswa.nim' => ['required', 'numeric', Rule::unique('mahasiswas', 'nim')->ignore($this->mahasiswa->nim, 'nim')],
            'mahasiswa.nama' => 'required'
        ];
    }

    public function mount($id = null)
    {
        $this->rows = 10;
        $this->mahasiswa_id = $id;
        $this->mahasiswa = new Mahasiswa();
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
        $this->mahasiswa = new Mahasiswa();

        $this->render();
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        $this->confirming = null;
        $this->mahasiswa_id = null;
        $this->mahasiswa = new Mahasiswa();
    }

    public function render()
    {
        $mahasiswas = Mahasiswa::when($this->search, function ($query) {
            $query->where('mahasiswas.nama', 'like', '%' . $this->search . '%')
                ->orWhere('mahasiswas.nim', 'like', '%' . $this->search . '%');
        })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })
            ->orderBy('id', 'DESC')->paginate($this->rows);
        return view('livewire.mahasiswa-table', compact('mahasiswas'));
    }
}
