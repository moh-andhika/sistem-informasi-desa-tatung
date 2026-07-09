<?php

use App\Models\perangkat_desa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app'), Title('Perangkat Desa')] class extends Component {
    use WithPagination, WithFileUploads;

    public string $search = '';

    public $perangkatId = null;
    public string $nama = '';
    public string $jabatan = '';
    public int $urutan = 0;
    public $gambar = null;
    public $gambar_lama = null;
    public bool $showModal = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $perangkat = perangkat_desa::findOrFail($id);
        $this->perangkatId = $perangkat->id;
        $this->nama = $perangkat->nama;
        $this->jabatan = $perangkat->jabatan;
        $this->urutan = $perangkat->urutan;
        $this->gambar_lama = $perangkat->gambar;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->gambar_lama;

        if ($this->gambar) {
            if ($this->gambar_lama) {
                Storage::disk('public')->delete($this->gambar_lama);
            }
            $imagePath = $this->gambar->store('perangkat-desa', 'public');
        }

        $data = [
            'nama' => $this->nama,
            'jabatan' => $this->jabatan,
            'urutan' => $this->urutan,
            'gambar' => $imagePath,
        ];

        if ($this->perangkatId) {
            perangkat_desa::findOrFail($this->perangkatId)->update($data);
            session()->flash('success', 'Perangkat desa berhasil diperbarui.');
        } else {
            perangkat_desa::create($data);
            session()->flash('success', 'Perangkat desa berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $perangkat = perangkat_desa::findOrFail($id);
        if ($perangkat->gambar) {
            Storage::disk('public')->delete($perangkat->gambar);
        }
        $perangkat->delete();
        session()->flash('success', 'Perangkat desa berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->perangkatId = null;
        $this->nama = '';
        $this->jabatan = '';
        $this->urutan = 0;
        $this->gambar = null;
        $this->gambar_lama = null;
        $this->resetValidation();
    }

    public function with(): array
    {
        $query = perangkat_desa::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where('nama', 'like', $searchTerm)
                  ->orWhere('jabatan', 'like', $searchTerm);
        }

        return [
            'items' => $query->orderBy('urutan')->paginate(10),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Perangkat Desa</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola data aparatur dan perangkat pemerintahan desa.</p>
    </div>

    <x-alert-success />
    <x-alert-error />

    <div class="flex flex-col gap-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="w-full sm:max-w-xs shrink-0">
                <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari perangkat desa..." />
            </div>

            <div class="w-full sm:w-auto shrink-0">
                <flux:button wire:click="create" variant="primary" icon="plus" class="w-full sm:w-auto">
                    Tambah Perangkat
                </flux:button>
            </div>
        </div>

        <x-table :title="'Daftar Perangkat Desa'" :subtitle="'Total data: ' . $items->total() . ' perangkat'">
            <x-slot:footer>
                {{ $items->links() }}
            </x-slot:footer>

            <x-table.thead>
                <x-table.th>Foto</x-table.th>
                <x-table.th>Nama</x-table.th>
                <x-table.th>Jabatan</x-table.th>
                <x-table.th>Urutan</x-table.th>
                <x-table.th class="text-right">Aksi</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($items as $item)
                    <x-table.tr>
                        <x-table.td>
                            <div class="size-10 overflow-hidden bg-slate-100 dark:bg-slate-800">
                                @if ($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama }}" class="size-full object-cover">
                                @else
                                    <div class="size-full flex items-center justify-center text-slate-300">
                                        <flux:icon.user class="size-5" />
                                    </div>
                                @endif
                            </div>
                        </x-table.td>
                        <x-table.td class="font-medium">{{ $item->nama }}</x-table.td>
                        <x-table.td>{{ $item->jabatan }}</x-table.td>
                        <x-table.td>{{ $item->urutan }}</x-table.td>
                        <x-table.td class="text-right">
                            <flux:button wire:click="edit({{ $item->id }})" variant="ghost" size="sm" icon="pencil-square">Edit</flux:button>
                            <flux:button wire:click="delete({{ $item->id }})" variant="ghost" size="sm" icon="trash" color="red" wire:confirm="Apakah Anda yakin ingin menghapus {{ $item->nama }}?">Hapus</flux:button>
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td colspan="5" class="text-center py-8 text-slate-500">
                            Belum ada data perangkat desa.
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>

    <flux:modal wire:model="showModal" class="md:w-[500px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $perangkatId ? 'Edit Perangkat' : 'Tambah Perangkat Baru' }}</flux:heading>
                <flux:subheading>Isi data perangkat desa di bawah ini.</flux:subheading>
            </div>

            <form wire:submit="save" class="space-y-4">
                <flux:input wire:model="nama" label="Nama" placeholder="Nama lengkap" />
                <flux:input wire:model="jabatan" label="Jabatan" placeholder="Contoh: Kepala Desa" />
                <flux:input wire:model="urutan" label="Urutan" type="number" min="0" placeholder="0" />

                <div class="space-y-3">
                    <flux:label>Foto</flux:label>

                    <div class="flex items-start gap-4">
                        @if ($gambar)
                            <div class="relative size-32 overflow-hidden">
                                <img src="{{ $gambar->temporaryUrl() }}" class="h-full w-full object-cover">
                                <button type="button" wire:click="$set('gambar', null)" class="absolute top-1 right-1 bg-white/80 p-1 hover:bg-white">
                                    <flux:icon.x-mark class="size-4" />
                                </button>
                            </div>
                        @elseif ($gambar_lama)
                            <div class="size-32 overflow-hidden">
                                <img src="{{ Storage::url($gambar_lama) }}" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="size-32 flex flex-col items-center justify-center">
                                <flux:icon.cloud-arrow-up class="size-8 text-slate-400" />
                            </div>
                        @endif

                        <div class="flex-1">
                            <flux:input type="file" wire:model="gambar" />
                            <p class="mt-1 text-xs text-slate-500">JPG, PNG max 2MB.</p>
                            @error('gambar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
