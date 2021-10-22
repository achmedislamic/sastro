<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <x-notifications />
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h2 class="text-blue-500 font-bold text-xl mt-4">
                <a href="{{ route('mahasiswa') }}">Tabel Mahasiswa</a>
            </h2>
        </div>

        <x-card cardClasses="mt-5">
            <form wire:submit.prevent="simpan">
                <x-modal.card title="Mahasiswa" blur wire:model.defer="modal">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input label="NIM" hint="Maksimal 9 Angka" wire:model="mahasiswa.nim"/>
                        <x-input label="Nama" wire:model="mahasiswa.nama"/>
                    </div>

                    <x-slot name="footer">
                        <div class="flex justify-between gap-x-4">
                            <div class="flex">
                                <x-button primary label="Simpan" type="submit"/>
                                <x-button flat label="Tutup" x-on:click="close" />
                                <x-loading />
                            </div>
                        </div>
                    </x-slot>
                </x-modal.card>
            </form>
            <div class="flex flex-row mx-auto justify-between mb-5">
                <x-button positive label="Tambah" wire:click="tambah()" spinner="tambah"/>

            </div>
            <div class="flex-col">
                <div class="flex flex-row mx-auto justify-between mb-5">
                    <x-select
                        placeholder="Pilih Jumlah Baris"
                        wire:model="rows"
                        searchable="false"
                    >
                        <x-select.option label="10" value="10" />
                        <x-select.option label="25" value="25" />
                        <x-select.option label="50" value="50" />
                        <x-select.option label="100" value="100" />
                    </x-select>
                    <div>
                        <x-input wire:model="search" icon="search" placeholder="Pencarian">
                            <x-slot name="append">
                                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                    <x-button
                                        class="rounded-r-md h-full"
                                        icon="backspace"
                                        wire:click="bersihkanPencarian()"
                                        primary
                                        flat
                                        squared
                                    />
                                </div>
                            </x-slot>
                        </x-input>
                    </div>
                </div>

                <table class="w-full border-collapse table-fixed border border-1 border-green-600 dark:text-white text-left">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="w-10 border border-1 border-green-600 p-2">
                                No.
                            </th>
                            <th class="w-1/3 border border-1 border-green-600 p-2">
                                <x-button flat spinner="sortBy('nim')" wire:click="sortBy('nim')"><div class="text-black dark:text-white font-bold">NIM</div><x-sort-icon field="nim" :sortField="$sortField" :sortAsc="$sortAsc" /></x-button>
                            </th>
                            <th class="w-1/3 border border-1 border-green-600 p-2">
                                <x-button flat spinner="sortBy('nama')" wire:click="sortBy('nama')"><div class="text-black dark:text-white font-bold">Nama</div><x-sort-icon field="nama" :sortField="$sortField" :sortAsc="$sortAsc" /></x-button>
                            </th>
                            <th class="w-auto border border-1 border-green-600 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="space-y-11">
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr class="transition duration-200 ease-in-out hover:bg-green-100 dark:hover:bg-gray-600">
                                <td class="border border-1 border-green-600 p-2">{{ $loop->index + 1 }}</td>
                                <td class="border border-1 border-green-600 p-2">{{ $mahasiswa->nim }}</td>
                                <td class="border border-1 border-green-600 p-2">{{ $mahasiswa->nama }}</td>
                                <td class="flex border-b border-green-600 p-2">
                                    <x-button spinner="ubah({{ $mahasiswa->id }})" warning label="Ubah" wire:click="ubah({{ $mahasiswa->id }})" class="mr-3"/>
                                    @if($confirming === $mahasiswa->id)
                                        <x-button spinner="destroy({{ $mahasiswa->id }})" negative wire:click="destroy({{ $mahasiswa->id }})" label="Anda Yakin?"/>
                                    @else
                                        <x-button spinner="confirmDelete({{ $mahasiswa->id }})" dark wire:click="confirmDelete({{ $mahasiswa->id }})" label="Hapus"/>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4">Tidak ada data</td>
                            </tr>
                        @endforelse
                        <tr></tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $mahasiswas->links() }}
                    <x-loading />
                </div>
            </div>

        </x-card>

    </div>
</div>
