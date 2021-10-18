<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h2 class="text-blue-500 font-bold text-xl">Tabel Mahasiswa</h2>
                </div>

                <x-card cardClasses="mt-5">
                    <div class="flex flex-row mx-auto justify-between mb-5">
                        <x-button primary label="Tambah" onclick="$openModal('modal')"/>
                        @livewire('mahasiswa-form')
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

        @livewireScripts
        @wireUiScripts
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
