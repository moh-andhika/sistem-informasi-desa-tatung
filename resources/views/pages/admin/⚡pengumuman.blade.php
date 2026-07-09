<?php

use App\Models\Pengumuman;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app'), Title('Manajemen Pengumuman')] class extends Component {
    use WithPagination;

    public string $search = '';

    // Form fields
    public $pengumumanId = null;
    public string $judul = '';
    public string $ringkasan = '';
    public string $published_at = '';
    public bool $is_active = true;
    public bool $is_running_text = false;
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
        $pengumuman = Pengumuman::findOrFail($id);
        $this->pengumumanId = $pengumuman->id;
        $this->judul = $pengumuman->judul;
        $this->ringkasan = $pengumuman->ringkasan ?? '';
        $this->published_at = $pengumuman->published_at ? $pengumuman->published_at->format('Y-m-d\TH:i') : '';
        $this->is_active = $pengumuman->is_active;
        $this->is_running_text = $pengumuman->is_running_text ?? false;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'is_running_text' => 'boolean',
        ]);

        try {
            $data = [
                'judul' => $this->judul,
                'ringkasan' => $this->ringkasan,
                'is_active' => $this->is_active,
                'is_running_text' => $this->is_running_text,
                'published_at' => !empty($this->published_at) ? \Carbon\Carbon::parse($this->published_at) : now(),
            ];

            if ($this->pengumumanId) {
                Pengumuman::findOrFail($this->pengumumanId)->update($data);
                session()->flash('success', 'Pengumuman berhasil diperbarui.');
            } else {
                Pengumuman::create($data);
                session()->flash('success', 'Pengumuman berhasil ditambahkan.');
            }

            $this->showModal = false;
            $this->resetForm();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan pengumuman: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        Pengumuman::findOrFail($id)->delete();
        session()->flash('success', 'Pengumuman berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->pengumumanId = null;
        $this->judul = '';
        $this->ringkasan = '';
        $this->published_at = '';
        $this->is_active = true;
        $this->resetValidation();
    }

    public function with(): array
    {
        $query = Pengumuman::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where('judul', 'like', $searchTerm)
                  ->orWhere('ringkasan', 'like', $searchTerm);
        }

        return [
            'pengumuman' => $query->latest()->paginate(10),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Papan Pengumuman</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola informasi papan pengumuman singkat untuk ditampilkan di halaman beranda.</p>
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
                <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Cari pengumuman..." />
            </div>

            <!-- Add Button -->
            <div class="w-full sm:w-auto shrink-0">
                <flux:button wire:click="create" variant="primary" icon="plus" class="w-full sm:w-auto">
                    Tambah
                </flux:button>
            </div>
        </div>

        <x-table title="Daftar Pengumuman" subtitle="Total data: {{ $pengumuman->total() }} pengumuman">
            <x-slot:footer>
                <div class="w-full">
                    {{ $pengumuman->links() }}
                </div>
            </x-slot:footer>

            <x-table.thead>
                <x-table.th>Judul</x-table.th>
                <x-table.th>Ringkasan</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Running Text</x-table.th>
                <x-table.th>Tanggal Publikasi</x-table.th>
                <x-table.th class="text-right">Aksi</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($pengumuman as $row)
                    <x-table.tr>
                        <x-table.td class="font-medium text-slate-900 dark:text-white max-w-[200px] truncate" title="{{ $row->judul }}">
                            {{ $row->judul }}
                        </x-table.td>
                        <x-table.td class="max-w-[300px] truncate" title="{{ $row->ringkasan }}">
                            {{ $row->ringkasan }}
                        </x-table.td>
                        <x-table.td>
                            @if($row->is_active)
                                <span class="inline-flex items-center  bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">Aktif</span>
                            @else
                                <span class="inline-flex items-center  bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">Nonaktif</span>
                            @endif
                        </x-table.td>
                        <x-table.td>
                            @if($row->is_running_text)
                                <flux:badge color="blue" size="sm" icon="bolt" class="">Tampil</flux:badge>
                            @else
                                <span class="text-slate-400 text-xs">-</span>
                            @endif
                        </x-table.td>
                        <x-table.td>{{ $row->published_at ? $row->published_at->format('d M Y H:i') : '-' }}</x-table.td>
                        <x-table.td class="text-right">
                            <div class="flex justify-end gap-2">
                                <flux:button wire:click="edit({{ $row->id }})" variant="ghost" size="sm" icon="pencil-square" class="text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/50" />
                                <flux:button wire:click="delete({{ $row->id }})" wire:confirm="Apakah Anda yakin ingin menghapus pengumuman ini?" variant="ghost" size="sm" icon="trash" class="text-red-600 hover:bg-red-50 dark:hover:bg-red-900/50" />
                            </div>
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td colspan="5" class="text-center py-8 text-slate-500">Belum ada data pengumuman.</x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model="showModal" class="w-full max-w-2xl">
        <form wire:submit="save" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $pengumumanId ? 'Edit Pengumuman' : 'Tambah Pengumuman' }}</flux:heading>
                <flux:subheading>Isi formulir untuk menambahkan pengumuman ke halaman depan.</flux:subheading>
            </div>

            <flux:separator />

            <div class="space-y-5">
                <flux:field>
                    <flux:label>Judul Pengumuman</flux:label>
                    <flux:input wire:model="judul" placeholder="Contoh: Penyaluran BLT Tahap 1" required />
                    <flux:error name="judul" />
                </flux:field>

                <flux:field>
                    <flux:label>Isi/Ringkasan</flux:label>
                    <flux:textarea wire:model="ringkasan" rows="4" placeholder="Tuliskan informasi pengumuman..." required />
                    <flux:error name="ringkasan" />
                </flux:field>

                <flux:field>
                    <flux:label>Waktu Publikasi</flux:label>
                    <flux:input type="datetime-local" wire:model="published_at" />
                    <div class="text-xs text-slate-500 mt-2 font-medium">Biarkan kosong untuk menggunakan waktu dan tanggal saat ini.</div>
                    <flux:error name="published_at" />
                </flux:field>

                <flux:field>
                    <flux:switch wire:model="is_active" label="Aktifkan Pengumuman" description="Tampilkan pengumuman ini di beranda website" />
                </flux:field>

                <flux:field>
                    <flux:switch wire:model="is_running_text" label="Tampilkan di Running Text" description="Munculkan judul pengumuman di baris berjalan bagian paling atas" />
                </flux:field>
            </div>

            <flux:separator />

            <div class="flex items-center justify-end gap-3">
                <flux:button wire:click="$set('showModal', false)" variant="ghost">Batal</flux:button>
                <flux:button type="submit" variant="primary">
                    {{ $pengumumanId ? 'Perbarui' : 'Simpan' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
