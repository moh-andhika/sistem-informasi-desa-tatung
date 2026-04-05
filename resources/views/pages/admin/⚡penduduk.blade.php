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
                  ->orWhere('nama', 'like', $searchTerm)
                  ->orWhere('jenis_kelamin', 'like', $searchTerm)
                  ->orWhere('tempat_lahir', 'like', $searchTerm)
                  ->orWhere('tanggal_lahir', 'like', $searchTerm)
                  ->orWhere('alamat', 'like', $searchTerm)
                  ->orWhere('no_rt', 'like', $searchTerm)
                  ->orWhere('no_rw', 'like', $searchTerm);
            });
        }

        return [
            'penduduk' => $query->latest()->paginate(10),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Data Penduduk</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Menampilkan data daftar penduduk yang tersimpan dalam sistem.</p>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-800/30 dark:bg-emerald-900/30 dark:text-emerald-400">
            <flux:icon.check-circle class="size-5" variant="mini" />
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <!-- Search -->
        <div class="w-full sm:max-w-xs shrink-0">
            <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari data penduduk..." />
        </div>

        <!-- Import Form -->
        <form action="{{ route('admin.penduduk.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
            @csrf
            <div class="w-full sm:w-auto shrink-0">
                <flux:input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required />
            </div>

            <flux:button type="submit" variant="primary" icon="arrow-up-tray" class="w-full sm:w-auto shrink-0">
                Import Data
            </flux:button>
        </form>
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
