<?php

use App\Models\Galeri;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app'), Title('Manajemen Galeri')] class extends Component {
    use WithPagination, WithFileUploads;

    public string $search = '';

    // Form fields
    public $galeriId = null;
    public string $judul = '';
    public string $deskripsi = '';
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
        $galeri = Galeri::findOrFail($id);
        $this->galeriId = $galeri->id;
        $this->judul = $galeri->judul;
        $this->deskripsi = $galeri->deskripsi ?? '';
        $this->gambar_lama = $galeri->gambar;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => $this->galeriId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $imagePath = $this->gambar_lama;

        if ($this->gambar) {
            if ($this->gambar_lama) {
                Storage::disk('public')->delete($this->gambar_lama);
            }
            $imagePath = $this->gambar->store('galeri', 'public');
        }

        $data = [
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'gambar' => $imagePath,
        ];

        if ($this->galeriId) {
            Galeri::findOrFail($this->galeriId)->update($data);
            session()->flash('success', 'Foto galeri berhasil diperbarui.');
        } else {
            Galeri::create($data);
            session()->flash('success', 'Foto galeri berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();
        session()->flash('success', 'Foto galeri berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->galeriId = null;
        $this->judul = '';
        $this->deskripsi = '';
        $this->gambar = null;
        $this->gambar_lama = null;
        $this->resetValidation();
    }

    public function with(): array
    {
        $query = Galeri::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where('judul', 'like', $searchTerm)
                  ->orWhere('deskripsi', 'like', $searchTerm);
        }

        return [
            'galeris' => $query->latest()->paginate(12),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Manajemen Galeri</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola koleksi foto kegiatan dan dokumentasi desa.</p>
    </div>

    <x-alert-success />
    <x-alert-error />

    <div class="flex flex-col gap-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="w-full sm:max-w-xs shrink-0">
                <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari foto..." />
            </div>

            <div class="w-full sm:w-auto shrink-0">
                <flux:button wire:click="create" variant="primary" icon="plus" class="w-full sm:w-auto">
                    Tambah Foto
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($galeris as $item)
                <div class="group relative overflow-hidden   bg-white dark:bg-slate-900 ">
                    <div class="aspect-video w-full overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>

                    <div class="p-4">
                        <h3 class="font-medium text-slate-900 dark:text-white truncate">{{ $item->judul }}</h3>
                        @if($item->deskripsi)
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400 line-clamp-2">{{ $item->deskripsi }}</p>
                        @endif

                        <div class="mt-4 flex items-center justify-between gap-2">
                            <flux:button wire:click="edit({{ $item->id }})" variant="ghost" size="sm" icon="pencil-square">Edit</flux:button>
                            <flux:button wire:click="delete({{ $item->id }})" variant="ghost" size="sm" icon="trash" color="red" wire:confirm="Apakah Anda yakin ingin menghapus foto ini?">Hapus</flux:button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 flex flex-col items-center justify-center     ">
                    <flux:icon.photo class="size-12 text-slate-300 dark:text-slate-600 mb-2" />
                    <p class="text-slate-500 dark:text-slate-400">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $galeris->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model="showModal" class="md:w-[500px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $galeriId ? 'Edit Foto' : 'Tambah Foto Baru' }}</flux:heading>
                <flux:subheading>Isi detail foto galeri di bawah ini.</flux:subheading>
            </div>

            <form wire:submit="save" class="space-y-4">
                <flux:input wire:model="judul" label="Judul" placeholder="Judul foto atau kegiatan" />

                <flux:textarea wire:model="deskripsi" label="Deskripsi (Opsional)" placeholder="Penjelasan singkat mengenai foto" rows="3" />

                <div class="space-y-3">
                    <flux:label>Foto</flux:label>

                    <div class="flex items-start gap-4">
                        @if ($gambar)
                            <div class="relative size-32 overflow-hidden
                                <img src="{{ $gambar->temporaryUrl() }}" class="h-full w-full object-cover">
                                <button type="button" wire:click="resetForm" class="absolute top-1 right-1 bg-white/80  p-1 hover:bg-white">
                                    <flux:icon.x-mark class="size-4" />
                                </button>
                            </div>
                        @elseif ($gambar_lama)
                            <div class="size-32 overflow-hidden
                                <img src="{{ Storage::url($gambar_lama) }}" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="size-32 flex flex-col items-center justify-center     ">
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
