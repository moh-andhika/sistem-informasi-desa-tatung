<?php

use App\Models\Berita;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app'), Title('Manajemen Berita')] class extends Component {
    use WithPagination, WithFileUploads;

    public string $search = '';

    // Form fields
    public $beritaId = null;
    public string $judul = '';
    public string $ringkasan = '';
    public string $konten = '';
    public $gambar = null;
    public $gambar_lama = null;
    public bool $is_published = true;
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
        $berita = Berita::findOrFail($id);
        $this->beritaId = $berita->id;
        $this->judul = $berita->judul;
        $this->ringkasan = $berita->ringkasan ?? '';
        $this->konten = $berita->konten;
        $this->gambar_lama = $berita->gambar;
        $this->is_published = $berita->is_published;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048', // max 2MB
            'is_published' => 'boolean',
        ]);

        $imagePath = $this->gambar_lama;

        if ($this->gambar) {
            if ($this->gambar_lama) {
                Storage::disk('public')->delete($this->gambar_lama);
            }
            $imagePath = $this->gambar->store('berita', 'public');
        }

        $data = [
            'judul' => $this->judul,
            'slug' => Str::slug($this->judul) . '-' . time(),
            'ringkasan' => $this->ringkasan,
            'konten' => $this->konten,
            'gambar' => $imagePath,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? now() : null,
        ];

        if ($this->beritaId) {
            Berita::findOrFail($this->beritaId)->update($data);
            session()->flash('success', 'Berita berhasil diperbarui.');
        } else {
            Berita::create($data);
            session()->flash('success', 'Berita berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        session()->flash('success', 'Berita berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->beritaId = null;
        $this->judul = '';
        $this->ringkasan = '';
        $this->konten = '';
        $this->gambar = null;
        $this->gambar_lama = null;
        $this->is_published = true;
        $this->resetValidation();
    }

    public function with(): array
    {
        $query = Berita::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where('judul', 'like', $searchTerm)
                  ->orWhere('ringkasan', 'like', $searchTerm);
        }

        return [
            'beritas' => $query->latest()->paginate(10),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Manajemen Berita</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola publikasi berita, pengumuman, dan artikel desa.</p>
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
            <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari berita..." />
        </div>

        <!-- Add Button -->
        <div class="w-full sm:w-auto shrink-0">
            <flux:button wire:click="create" variant="primary" icon="plus" class="w-full sm:w-auto">
                Tambah Berita
            </flux:button>
        </div>
    </div>

    <x-table title="Daftar Berita" subtitle="Total data: {{ $beritas->total() }} berita">
        <x-slot:footer>
            <div class="w-full">
                {{ $beritas->links() }}
            </div>
        </x-slot:footer>

        <x-table.thead>
            <x-table.th>Gambar</x-table.th>
            <x-table.th>Judul</x-table.th>
            <x-table.th>Status</x-table.th>
            <x-table.th>Tanggal Publikasi</x-table.th>
            <x-table.th class="text-right">Aksi</x-table.th>
        </x-table.thead>

        <x-table.tbody>
            @forelse ($beritas as $row)
                <x-table.tr>
                    <x-table.td>
                        @if($row->gambar)
                            <img src="{{ Storage::url($row->gambar) }}" alt="{{ $row->judul }}" class="h-10 w-16 object-cover rounded-md border border-slate-200">
                        @else
                            <div class="h-10 w-16 bg-slate-100 rounded-md border border-slate-200 flex items-center justify-center text-slate-400 dark:bg-slate-800 dark:border-slate-700">
                                <flux:icon.photo class="size-5" />
                            </div>
                        @endif
                    </x-table.td>
                    <x-table.td class="font-medium text-slate-900 dark:text-white max-w-[200px] truncate" title="{{ $row->judul }}">
                        {{ $row->judul }}
                    </x-table.td>
                    <x-table.td>
                        @if($row->is_published)
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Publik</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">Draf</span>
                        @endif
                    </x-table.td>
                    <x-table.td>{{ $row->published_at ? $row->published_at->format('d M Y H:i') : '-' }}</x-table.td>
                    <x-table.td class="text-right">
                        <div class="flex justify-end gap-2">
                            <flux:button wire:click="edit({{ $row->id }})" variant="ghost" size="sm" icon="pencil-square" class="text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/50" />
                            <flux:button wire:click="delete({{ $row->id }})" wire:confirm="Apakah Anda yakin ingin menghapus berita ini?" variant="ghost" size="sm" icon="trash" class="text-red-600 hover:bg-red-50 dark:hover:bg-red-900/50" />
                        </div>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="5" class="text-center py-8 text-slate-500">Belum ada data berita.</x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <!-- Modal Form -->
    <flux:modal wire:model="showModal" class="md:w-[700px]">
        <form wire:submit="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ $beritaId ? 'Edit Berita' : 'Tambah Berita Baru' }}</flux:heading>
                    <flux:text class="mt-1">Isi formulir di bawah ini untuk mengelola artikel berita.</flux:text>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 space-y-5">
                        <flux:field>
                            <flux:label>Judul Berita</flux:label>
                            <flux:input wire:model="judul" placeholder="Masukkan judul berita" required />
                            <flux:error name="judul" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Ringkasan Pendek</flux:label>
                            <flux:textarea wire:model="ringkasan" rows="2" placeholder="Tuliskan ringkasan singkat artikel" />
                            <flux:error name="ringkasan" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Konten Lengkap</flux:label>
                            <flux:textarea wire:model="konten" rows="6" placeholder="Tulis konten lengkap berita di sini..." required />
                            <flux:error name="konten" />
                        </flux:field>
                    </div>

                    <div class="space-y-5">
                        <flux:field>
                            <flux:label>Gambar Berita</flux:label>
                            <div class="mt-2 flex flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 p-4 dark:border-slate-600">
                                @if ($gambar)
                                    <img src="{{ $gambar->temporaryUrl() }}" class="mb-3 max-h-32 w-full rounded-md object-cover">
                                @elseif ($gambar_lama)
                                    <img src="{{ Storage::url($gambar_lama) }}" class="mb-3 max-h-32 w-full rounded-md object-cover">
                                @else
                                    <div class="mb-3 rounded-full bg-slate-100 p-3 dark:bg-slate-800">
                                        <flux:icon.photo class="size-6 text-slate-400" />
                                    </div>
                                @endif

                                <flux:input type="file" wire:model="gambar" accept="image/*" class="w-full text-xs" />
                            </div>
                            <flux:error name="gambar" />
                        </flux:field>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                            <flux:switch wire:model="is_published" label="Publikasikan" description="Berita akan langsung tampil di website." />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <flux:button wire:click="$set('showModal', false)" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Simpan Berita</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
