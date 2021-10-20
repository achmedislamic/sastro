<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h2 class="text-blue-500 font-bold text-xl">Tabel Mahasiswa</h2>
        </div>

        <x-card cardClasses="mt-5">
            <form wire:submit.prevent="simpan">
                <x-modal.card title="Tambah Mahasiswa" blur wire:model.defer="modal">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input label="NIM" wire:model="mahasiswa.nim"/>
                        <x-input label="Nama" wire:model="mahasiswa.nama"/>
                    </div>

                    <x-slot name="footer">
                        <div class="flex justify-between gap-x-4">
                            <div class="flex">
                                <x-button primary label="Simpan" type="submit"/>
                                <x-button flat label="Tutup" x-on:click="close" />
                            </div>
                        </div>
                    </x-slot>
                </x-modal.card>
            </form>
            <div class="flex flex-row mx-auto justify-between mb-5">
                <x-button positive label="Tambah" wire:click="tambah()" wire:loading.attr="disabled"/>
                <x-input icon="search" placeholder="Pencarian"></x-input>
            </div>
            <table class="table-auto border-solid border-gray-500">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>
                                <x-button positive label="Ubah" wire:click="ubah({{ $mahasiswa->id }})"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Tidak ada data</td>
                        </tr>
                    @endforelse
                    <tr></tr>
                </tbody>
            </table>
        </x-card>

    </div>
</div>
