<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h2 class="text-blue-500 font-bold text-xl">Tabel Mahasiswa
                <x-loading />
            </h2>
        </div>

        <x-card cardClasses="mt-5">
            <form wire:submit.prevent="simpan">
                <x-modal.card title="Mahasiswa" blur wire:model.defer="modal">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input label="NIM" wire:model="mahasiswa.nim"/>
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
                <x-button positive label="Tambah" wire:click="tambah()" wire:loading.attr="disabled"/>

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
                        <x-input wire:model="search" icon="search" placeholder="Pencarian"></x-input>
                    </div>
                </div>

                <table class="w-full border-collapse table-fixed border border-1 border-green-600 text-left">
                    <thead>
                        <tr>
                            <th class="w-10 border border-1 border-green-600 p-2">No.</th>
                            <th class="w-1/3 border border-1 border-green-600 p-2">NIM</th>
                            <th class="w-1/3 border border-1 border-green-600 p-2">Nama</th>
                            <th class="w-auto border border-1 border-green-600 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="space-y-11">
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr class="transition duration-200 ease-in-out hover:bg-green-100">
                                <td class="border border-1 border-green-600 p-2">{{ $loop->index + 1 }}</td>
                                <td class="border border-1 border-green-600 p-2">{{ $mahasiswa->nim }}</td>
                                <td class="border border-1 border-green-600 p-2">{{ $mahasiswa->nama }}</td>
                                <td class="flex border-b border-green-600 p-2">
                                    <x-button warning label="Ubah" wire:click="ubah({{ $mahasiswa->id }})" class="mr-3"/>
                                    @if($confirming === $mahasiswa->id)
                                        <x-button negative wire:click="destroy({{ $mahasiswa->id }})" label="Anda Yakin?"/>
                                    @else
                                        <x-button dark wire:click="confirmDelete({{ $mahasiswa->id }})" label="Hapus"/>
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
                </div>
            </div>

        </x-card>

    </div>
</div>
