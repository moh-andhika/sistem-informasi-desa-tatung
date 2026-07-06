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

    public function removeGambar()
    {
        $this->gambar = null;
    }

    public function removeGambarLama()
    {
        if ($this->beritaId) {
            $berita = Berita::findOrFail($this->beritaId);
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
                $berita->update(['gambar' => null]);
            }
        }
        $this->gambar_lama = null;
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

    <x-alert-success />
    <x-alert-error />

    <div wire:loading.flex class="hidden flex-col gap-6">
        <x-admin.skeleton variant="table" columns="5" />
    </div>

    <div wire:loading.remove class="flex flex-col gap-6">
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
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model="showModal" class="w-full max-w-5xl">
        <form wire:submit="save" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $beritaId ? 'Edit Berita' : 'Tambah Berita Baru' }}</flux:heading>
                <flux:subheading>Isi formulir di bawah ini untuk mengelola artikel berita di website desa.</flux:subheading>
            </div>

            <flux:separator />

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Kolom Utama (Konten) -->
                <div class="md:col-span-8 space-y-6">
                    <flux:field>
                        <flux:label>Judul Berita</flux:label>
                        <flux:input wire:model="judul" placeholder="Contoh: Gotong Royong Kebersihan Lingkungan Desa..." required />
                        <flux:error name="judul" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Ringkasan Pendek</flux:label>
                        <flux:textarea wire:model="ringkasan" rows="3" placeholder="Tuliskan ringkasan singkat agar pembaca tertarik..." />
                        <flux:error name="ringkasan" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Konten Lengkap</flux:label>
                        <div wire:ignore class="mt-2" x-data="{ 
                            value: @entangle('konten'),
                            initQuill() {
                                if (typeof Quill === 'undefined') {
                                    setTimeout(() => this.initQuill(), 100);
                                    return;
                                }
                                const quill = new Quill(this.$refs.quillEditor, {
                                    theme: 'snow',
                                    placeholder: 'Tulis rincian berita secara lengkap di sini...',
                                    modules: { toolbar: [
                                        [{ 'header': [1, 2, 3, false] }],
                                        ['bold', 'italic', 'underline', 'link', 'blockquote'],
                                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                        ['clean']
                                    ]}
                                });
                                
                                quill.root.innerHTML = this.value || '';
                                
                                quill.on('text-change', () => {
                                    // Set value directly via $wire to avoid loop
                                    this.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                                });
                                
                                this.$watch('value', (val) => {
                                    if (val !== quill.root.innerHTML && val !== undefined) {
                                        quill.root.innerHTML = val || '';
                                    }
                                });
                            }
                        }" x-init="initQuill()">
                            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                            <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
                            <style>
                                .ql-toolbar.ql-snow { border-color: #e2e8f0; border-top-left-radius: 0.2rem; border-top-right-radius: 0.2rem; background: #f8fafc; }
                                .ql-container.ql-snow { border-color: #e2e8f0; border-bottom-left-radius: 0.2rem; border-bottom-right-radius: 0.2rem; background: #ffffff; min-height: 300px; font-family: inherit; font-size: inherit; }
                                .dark .ql-toolbar.ql-snow { border-color: #334155; background: #1e293b; color: #fff; }
                                .dark .ql-container.ql-snow { border-color: #334155; background: #0f172a; color: #f8fafc; }
                                .dark .ql-snow .ql-stroke { stroke: #cbd5e1; }
                                .dark .ql-snow .ql-fill { fill: #cbd5e1; }
                                .dark .ql-snow .ql-picker { color: #cbd5e1; }
                                .dark .ql-snow .ql-picker-options { background: #1e293b; border-color: #334155; }
                            </style>
                            <div x-ref="quillEditor"></div>
                        </div>
                        <flux:error name="konten" />
                    </flux:field>
                </div>

                <!-- Sidebar (Media & Status) -->
                <div class="md:col-span-4 space-y-6">
                    <div class="space-y-4">
                        <flux:label>Gambar Utama</flux:label>
                        
                        <div class="relative group">
                            <div class="flex flex-col items-center justify-center w-full px-6 py-8 border-2 border-dashed rounded-2xl transition-all duration-200 bg-slate-50/50 border-slate-200 dark:bg-slate-900/50 dark:border-slate-800 group-hover:border-blue-400 dark:group-hover:border-blue-500 overflow-hidden">
                                <div class="flex flex-col items-center justify-center space-y-2 text-center">
                                    <div class="p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
                                        <flux:icon.photo class="size-6 text-slate-500 dark:text-slate-400" />
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Pilih gambar utama</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-500 px-4">Seret gambar ke sini atau klik untuk mencari file</p>
                                    </div>
                                </div>
                                <input type="file" wire:model="gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                            </div>
                        </div>

                        <div class="space-y-3">
                            @if ($gambar)
                                <div class="flex items-center gap-4 p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                                    <img src="{{ $gambar->temporaryUrl() }}" class="size-14 rounded-lg object-cover ring-1 ring-slate-200 dark:ring-slate-700" />
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ $gambar->getClientOriginalName() }}</p>
                                        <p class="text-xs text-slate-500">{{ round($gambar->getSize() / 1024) }} KB</p>
                                    </div>
                                    <flux:button variant="ghost" size="sm" icon="x-mark" wire:click="removeGambar" class="text-slate-400 hover:text-red-500" />
                                </div>
                            @elseif ($gambar_lama)
                                <div class="flex items-center gap-4 p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                                    <img src="{{ Storage::url($gambar_lama) }}" class="size-14 rounded-lg object-cover ring-1 ring-slate-200 dark:ring-slate-700" />
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">Gambar saat ini</p>
                                        <p class="text-xs text-slate-500">Tersimpan di server</p>
                                    </div>
                                    <flux:button variant="ghost" size="sm" icon="trash" wire:click="removeGambarLama" class="text-slate-400 hover:text-red-500" />
                                </div>
                            @endif
                        </div>
                        <flux:error name="gambar" />
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-5 dark:border-slate-800 dark:bg-slate-900/50 space-y-4">
                        <flux:heading size="sm">Setelan Publikasi</flux:heading>
                        
                        <flux:switch wire:model="is_published" 
                            label="Publikasikan Sekarang" 
                            description="Jika aktif, berita akan langsung tampil di halaman depan website." 
                        />
                    </div>
                </div>
            </div>

            <flux:separator />

            <div class="flex items-center justify-end gap-3">
                <flux:button wire:click="$set('showModal', false)" variant="ghost">Batal</flux:button>
                <flux:button type="submit" variant="primary">
                    {{ $beritaId ? 'Perbarui Berita' : 'Simpan Berita' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
