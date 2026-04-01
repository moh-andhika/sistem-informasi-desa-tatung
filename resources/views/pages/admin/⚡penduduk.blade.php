<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app'), Title('Data Penduduk')] class extends Component {

    public array $penduduk = [];

    public function mount(): void
    {
        // Data contoh; ganti dengan query database saat modul penduduk siap.
        $this->penduduk = [
            [
                'nik' => '6201010101010001',
                'nama' => 'Budi Santoso',
                'kk' => '3201010101010001',
                'alamat' => 'RT 01 / RW 01, Dusun Timur',
                'gender' => 'Laki-laki',
                'usia' => 34,
            ],
            [
                'nik' => '6201010101010002',
                'nama' => 'Siti Aminah',
                'kk' => '3201010101010002',
                'alamat' => 'RT 02 / RW 01, Dusun Timur',
                'gender' => 'Perempuan',
                'usia' => 29,
            ],
            [
                'nik' => '6201010101010003',
                'nama' => 'Dewi Lestari',
                'kk' => '3201010101010003',
                'alamat' => 'RT 01 / RW 02, Dusun Barat',
                'gender' => 'Perempuan',
                'usia' => 42,
            ],
        ];
    }

}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Data Penduduk</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">Contoh tampilan tabel. Nanti diganti dengan data dari database.</p>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm shadow-black/5 dark:border-neutral-700 dark:bg-neutral-900">
        <div class="flex items-center justify-between border-b border-neutral-200 px-4 py-3 text-sm font-semibold text-neutral-700 dark:border-neutral-700 dark:text-neutral-200">
            <span>Daftar Penduduk</span>
            <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">
                Total contoh: {{ count($penduduk) }} orang
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
                <thead class="bg-neutral-50 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">NIK</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold">No. KK</th>
                        <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                        <th class="px-4 py-3 text-left font-semibold">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left font-semibold">Usia</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-800 dark:bg-neutral-900">
                    @foreach ($penduduk as $row)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/60">
                            <td class="px-4 py-3 font-mono text-xs text-neutral-700 dark:text-neutral-200">{{ $row['nik'] }}</td>
                            <td class="px-4 py-3 text-neutral-900 dark:text-white">{{ $row['nama'] }}</td>
                            <td class="px-4 py-3 font-mono text-xs text-neutral-700 dark:text-neutral-200">{{ $row['kk'] }}</td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $row['alamat'] }}</td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $row['gender'] }}</td>
                            <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $row['usia'] }} th</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between border-t border-neutral-200 bg-neutral-50 px-4 py-3 text-xs text-neutral-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
            <span>Data ini masih contoh statis.</span>
            <span>Integrasi database & filter akan ditambahkan.</span>
        </div>
    </div>
</div>
