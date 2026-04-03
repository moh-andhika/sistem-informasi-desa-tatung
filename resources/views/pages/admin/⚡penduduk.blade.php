<?php

use App\Models\penduduk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app'), Title('Data Penduduk')] class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $query = penduduk::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nik', 'like', $searchTerm)
                  ->orWhere('no_kk', 'like', $searchTerm)
                  ->orWhere('nama', 'like', $searchTerm);
            });
        }

        return [
            'penduduk' => $query->latest()->paginate(10),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Data Penduduk</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">Menampilkan data daftar penduduk yang tersimpan dalam sistem.</p>
    </div>
    <div class="mb-6 rounded-xl border border-neutral-200 bg-white p-5 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
        <div class="mb-4">
            <h2 class="text-base font-semibold text-neutral-900 dark:text-white">Import Data Penduduk</h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">Upload file format .xlsx, .xls, atau .csv untuk menambahkan data secara massal.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 dark:border-green-800/30 dark:bg-green-900/30 dark:text-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.penduduk.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 sm:flex-row sm:items-end">
            @csrf
            <div class="w-full flex-1 sm:max-w-md">
                <flux:field>
                    <flux:input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required />
                </flux:field>
            </div>
            
            <flux:button type="submit" variant="primary" icon="arrow-up-tray" class="w-full sm:w-auto">
                Upload & Proses Data
            </flux:button>
        </form>
    </div>

    <div class="flex items-center justify-between gap-4">
        <div class="w-full sm:max-w-xs">
            <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari NIK, KK, atau Nama..." />
        </div>
    </div>

    <x-table title="Daftar Penduduk" subtitle="Total data: {{ $penduduk->total() }} orang">
        <x-slot:footer>
            <div class="w-full">
                {{ $penduduk->links() }}
            </div>
        </x-slot:footer>

        <x-table.thead>
            <x-table.th>NIK</x-table.th>
            <x-table.th>Nama</x-table.th>
            <x-table.th>No. KK</x-table.th>
            <x-table.th>Alamat</x-table.th>
            <x-table.th>Jenis Kelamin</x-table.th>
            <x-table.th>Usia</x-table.th>
        </x-table.thead>
        
        <x-table.tbody>
            @forelse ($penduduk as $row)
                <x-table.tr>
                    <x-table.td class="font-mono text-xs">{{ $row->nik }}</x-table.td>
                    <x-table.td class="text-neutral-900 dark:text-white">{{ $row->nama }}</x-table.td>
                    <x-table.td class="font-mono text-xs">{{ $row->no_kk }}</x-table.td>
                    <x-table.td>{{ $row->alamat }} RT {{ str_pad($row->no_rt, 2, '0', STR_PAD_LEFT) }}/RW {{ str_pad($row->no_rw, 2, '0', STR_PAD_LEFT) }}</x-table.td>
                    <x-table.td>{{ $row->jenis_kelamin }}</x-table.td>
                    <x-table.td>{{ $row->tanggal_lahir ? \Carbon\Carbon::parse($row->tanggal_lahir)->age . ' th' : '-' }}</x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="6" class="text-center py-4 text-neutral-500">Belum ada data penduduk.</x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>
</div>
