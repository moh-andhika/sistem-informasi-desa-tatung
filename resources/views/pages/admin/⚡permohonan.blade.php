<?php

use App\Models\PermohonanSurat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Flux\Flux;
use Livewire\WithPagination;

new #[Layout('layouts.app'), Title('Daftar Permohonan Surat')] class extends Component {
    use WithPagination;

    public string $search = '';
    public string $filterStatus = '';

    public function updateStatus(int $id, string $status)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->update(['status' => $status]);
        
        \Flux::toast(
            variant: 'success',
            heading: 'Status Diperbarui',
            text: "Permohonan {$permohonan->jenis_surat} sekarang berstatus {$status}.",
        );
    }

    public function with(): array
    {
        $query = PermohonanSurat::with('user')->latest();

        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nik', 'like', '%' . $this->search . '%');
            })->orWhere('jenis_surat', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return [
            'permohonans' => $query->paginate(10),
        ];
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Daftar Permohonan Surat</h1>
            <p class="text-sm text-slate-500">Kelola dan proses pengajuan surat dari warga Desa Tatung.</p>
        </div>
    </div>

    <div wire:loading.flex class="hidden flex-col gap-6">
        <x-admin.skeleton variant="table" columns="6" />
    </div>

    <div wire:loading.remove class="flex flex-col gap-6">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-96">
                <flux:input wire:model.live="search" placeholder="Cari nama, NIK, atau jenis surat..." icon="magnifying-glass" />
            </div>
            <div class="flex gap-2">
                <flux:select wire:model.live="filterStatus" placeholder="Semua Status">
                    <flux:select.option value="">Semua Status</flux:select.option>
                    <flux:select.option value="pending">Pending</flux:select.option>
                    <flux:select.option value="proses">Diproses</flux:select.option>
                    <flux:select.option value="selesai">Selesai</flux:select.option>
                    <flux:select.option value="ditolak">Ditolak</flux:select.option>
                </flux:select>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden dark:bg-slate-900 dark:border-slate-700 shadow-sm">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Pemohon</flux:table.column>
                    <flux:table.column>Jenis Surat</flux:table.column>
                    <flux:table.column>Keperluan</flux:table.column>
                    <flux:table.column>Tanggal</flux:table.column>
                    <flux:table.column>Status</flux:table.column>
                    <flux:table.column align="right">Aksi</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse($permohonans as $item)
                        <flux:table.row :key="$item->id">
                            <flux:table.cell>
                                <div class="flex items-center gap-3">
                                    <flux:avatar :name="$item->user->name" :initials="$item->user->initials()" size="sm" />
                                    <div>
                                        <div class="font-medium font-bold">{{ $item->user->name }}</div>
                                        <div class="text-xs text-slate-500">NIK: {{ $item->user->nik }}</div>
                                    </div>
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="font-bold text-slate-900 dark:text-white">{{ $item->jenis_surat }}</div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="max-w-xs truncate" title="{{ $item->keperluan }}">
                                    {{ $item->keperluan }}
                                </div>
                            </flux:table.cell>
                            <flux:table.cell class="text-slate-500 text-xs">
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </flux:table.cell>
                            <flux:table.cell>
                                <span @class([
                                    'px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider',
                                    'bg-amber-100 text-amber-700' => $item->status === 'pending',
                                    'bg-blue-100 text-blue-700' => $item->status === 'proses',
                                    'bg-emerald-100 text-emerald-700' => $item->status === 'selesai',
                                    'bg-red-100 text-red-700' => $item->status === 'ditolak',
                                ])>
                                    {{ $item->status }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell align="right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        @if($item->status === 'pending')
                                            <flux:menu.item icon="arrow-path" wire:click="updateStatus({{ $item->id }}, 'proses')">Proses</flux:menu.item>
                                        @endif
                                        @if($item->status !== 'selesai' && $item->status !== 'ditolak')
                                            <flux:menu.item icon="check-circle" wire:click="updateStatus({{ $item->id }}, 'selesai')">Selesai</flux:menu.item>
                                            <flux:menu.item icon="x-circle" wire:click="updateStatus({{ $item->id }}, 'ditolak')" variant="danger">Tolak</flux:menu.item>
                                        @endif
                                        <flux:menu.item icon="eye">Detail Lengkap</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="6" class="text-center py-10 text-slate-400">
                                Tidak ada pengajuan surat ditemukan.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>

            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $permohonans->links() }}
            </div>
        </div>
    </div>
</div>
