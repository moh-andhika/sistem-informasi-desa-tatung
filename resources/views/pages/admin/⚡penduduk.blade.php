<?php

use App\Models\penduduk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Flux;

new #[Layout('layouts.app'), Title('Data Penduduk')] class extends Component {
    use WithPagination;

    public string $search = '';

    // Modal state
    public bool $showModal = false;
    public ?int $pendudukId = null;
    public bool $is_edit = false;

    // Form fields
    public string $nik = '';
    public string $no_kk = '';
    public string $nama = '';
    public string $tempat_lahir = '';
    public string $tanggal_lahir = '';
    public string $jenis_kelamin = 'Laki-Laki';
    public string $alamat = '';
    public string $no_rt = '';
    public string $no_rw = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->is_edit = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->is_edit = true;

        $penduduk = penduduk::findOrFail($id);
        $this->pendudukId = $penduduk->id;
        $this->nik = $penduduk->nik;
        $this->no_kk = $penduduk->no_kk;
        $this->nama = $penduduk->nama;
        $this->tempat_lahir = $penduduk->tempat_lahir;
        $this->tanggal_lahir = $penduduk->tanggal_lahir;
        $this->jenis_kelamin = $penduduk->jenis_kelamin;
        $this->alamat = $penduduk->alamat;
        $this->no_rt = $penduduk->no_rt;
        $this->no_rw = $penduduk->no_rw;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'nik' => 'required|numeric|digits:16|unique:penduduk,nik,' . $this->pendudukId,
            'no_kk' => 'required|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'no_rt' => 'required|numeric|digits_between:1,3',
            'no_rw' => 'required|numeric|digits_between:1,3',
        ]);

        $data = [
            'nik' => $this->nik,
            'no_kk' => $this->no_kk,
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_rt' => $this->no_rt,
            'no_rw' => $this->no_rw,
        ];

        if ($this->is_edit) {
            penduduk::findOrFail($this->pendudukId)->update($data);
            Flux::toast('Data penduduk berhasil diperbarui.', variant: 'success');
        } else {
            penduduk::create($data);
            Flux::toast('Data penduduk berhasil ditambahkan.', variant: 'success');
        }

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $penduduk = penduduk::findOrFail($id);
        $penduduk->delete();
        Flux::toast('Data penduduk berhasil dihapus.', variant: 'success');
    }

    public function resetForm()
    {
        $this->pendudukId = null;
        $this->nik = '';
        $this->no_kk = '';
        $this->nama = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->jenis_kelamin = 'Laki-Laki';
        $this->alamat = '';
        $this->no_rt = '';
        $this->no_rw = '';
        $this->resetErrorBag();
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
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Data Penduduk</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Menampilkan data daftar penduduk yang tersimpan dalam sistem.</p>
        </div>
        <flux:button variant="primary" wire:click="create" icon="plus">Tambah Penduduk</flux:button>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-2   bg-blue-50 px-4 py-3 text-sm font-medium text-blue-800 dark: dark:bg-blue-900/30 dark:text-blue-400">
            <flux:icon.check-circle class="size-5" variant="mini" />
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Search -->
            <div class="w-full sm:max-w-xs shrink-0">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari data penduduk..." />
            </div>

            <!-- Import Form -->
            <form action="{{ route('admin.penduduk.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                @csrf
                <div class="w-full sm:w-auto shrink-0">
                    <flux:input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required />
                </div>

                <flux:button type="submit" variant="subtle" icon="arrow-up-tray" class="w-full sm:w-auto shrink-0">
                    Import Data
                </flux:button>
            </form>
        </div>

        <div wire:loading.flex wire:target="search" class="hidden flex-col gap-6">
            <x-admin.skeleton variant="table" columns="7" />
        </div>

        <div wire:loading.remove wire:target="search" class="flex flex-col gap-6">
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
                    <x-table.th>L/P</x-table.th>
                    <x-table.th>Usia</x-table.th>
                    <x-table.th class="text-center">Aksi</x-table.th>
                </x-table.thead>

                <x-table.tbody>
                    @forelse ($penduduk as $row)
                        <x-table.tr wire:key="penduduk-{{ $row->id }}">
                            <x-table.td class="font-mono text-xs">{{ $row->nik }}</x-table.td>
                            <x-table.td class="text-neutral-900 dark:text-white font-medium">{{ $row->nama }}</x-table.td>
                            <x-table.td class="font-mono text-xs text-neutral-500">{{ $row->no_kk }}</x-table.td>
                            <x-table.td>
                                <span class="block text-xs" title="{{ $row->alamat }} RT {{ str_pad($row->no_rt, 2, '0', STR_PAD_LEFT) }}/RW {{ str_pad($row->no_rw, 2, '0', STR_PAD_LEFT) }}">
                                    {{ $row->alamat }} RT {{ str_pad($row->no_rt, 2, '0', STR_PAD_LEFT) }}/RW {{ str_pad($row->no_rw, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </x-table.td>
                            <x-table.td class="text-xs text-center">{{ $row->jenis_kelamin === 'Laki-Laki' ? 'L' : 'P' }}</x-table.td>
                            <x-table.td class="text-xs text-center">{{ $row->tanggal_lahir ? \Carbon\Carbon::parse($row->tanggal_lahir)->age . ' th' : '-' }}</x-table.td>
                            <x-table.td class="text-center">
                                <div class="flex justify-center gap-1">
                                    <flux:button variant="ghost" size="sm" icon="pencil-square" class="!px-2 !py-1 text-blue-600 hover:bg-blue-100" wire:click="edit({{ $row->id }})" />
                                    <flux:button variant="ghost" size="sm" icon="trash" class="!px-2 !py-1 text-red-500 hover:text-red-700 hover:bg-red-100" wire:click="confirmDelete({{ $row->id }})" wire:confirm="Yakin ingin menghapus data penduduk ini?" />
                                </div>
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="7" class="text-center py-4 text-neutral-500">Belum ada data penduduk.</x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
    </div>

    {{-- Modal Tambah / Edit Penduduk --}}
    <flux:modal wire:model="showModal" class="md:w-[500px]">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-4 text-slate-900 dark:text-white flex items-center gap-2  pb-3">
                <flux:icon.identification class="size-5 text-blue-600" />
                {{ $is_edit ? 'Edit Data Penduduk' : 'Tambah Data Penduduk' }}
            </h2>

            <form wire:submit.prevent="save" class="flex flex-col gap-4">
                @if ($errors->any())
                    <div class=" bg-red-50  p-3 mb-2">
                        <div class="flex">
                            <flux:icon.exclamation-triangle class="size-5 text-red-500 mr-2 shrink-0" variant="mini" />
                            <div class="text-sm text-red-600 font-medium">
                                <ul class="list-disc pl-4 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <flux:input
                        wire:model="nik"
                        label="NIK"
                        placeholder="16 digit"
                        type="number"
                        inputmode="numeric"
                        maxlength="16"
                        pattern="[0-9]{16}"
                        x-on:input="if($event.target.value.length > $event.target.maxLength) $event.target.value = $event.target.value.slice(0, $event.target.maxLength)"
                        required
                    />
                    <flux:input
                        wire:model="no_kk"
                        label="No. Kartu Keluarga"
                        placeholder="16 digit"
                        type="number"
                        inputmode="numeric"
                        maxlength="16"
                        pattern="[0-9]{16}"
                        x-on:input="if($event.target.value.length > $event.target.maxLength) $event.target.value = $event.target.value.slice(0, $event.target.maxLength)"
                        required
                    />
                </div>

                <flux:input
                    wire:model="nama"
                    label="Nama Lengkap"
                    placeholder="Sesuai KTP"
                    required
                />

                <div class="grid grid-cols-2 gap-4">
                    <flux:input
                        wire:model="tempat_lahir"
                        label="Tempat Lahir"
                        placeholder="Kota/Kabupaten"
                        required
                    />
                    <flux:input
                        wire:model="tanggal_lahir"
                        label="Tanggal Lahir"
                        type="date"
                        required
                    />
                </div>

                <flux:select wire:model="jenis_kelamin" label="Jenis Kelamin" required>
                    <flux:select.option value="Laki-Laki">Laki-Laki</flux:select.option>
                    <flux:select.option value="Perempuan">Perempuan</flux:select.option>
                </flux:select>

                <flux:input
                    wire:model="alamat"
                    label="Alamat / Dusun"
                    placeholder="Contoh: Dusun Krajan"
                    required
                />

                <div class="grid grid-cols-2 gap-4">
                    <flux:input
                        wire:model="no_rt"
                        label="RT"
                        placeholder="01"
                        type="number"
                        inputmode="numeric"
                        maxlength="3"
                        x-on:input="if($event.target.value.length > $event.target.maxLength) $event.target.value = $event.target.value.slice(0, $event.target.maxLength)"
                        required
                    />
                    <flux:input
                        wire:model="no_rw"
                        label="RW"
                        placeholder="02"
                        type="number"
                        inputmode="numeric"
                        maxlength="3"
                        x-on:input="if($event.target.value.length > $event.target.maxLength) $event.target.value = $event.target.value.slice(0, $event.target.maxLength)"
                        required
                    />
                </div>

                <div class="flex justify-end gap-3 mt-4 pt-4  
                    <flux:button type="button" variant="ghost" wire:click="$set('showModal', false)">Batal</flux:button>
                    <flux:button type="submit" variant="primary">{{ $is_edit ? 'Simpan Perubahan' : 'Simpan Data' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

</div>
