<?php

use App\Models\PermohonanSurat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Flux\Flux;

new #[Layout('layouts.app'), Title('Dashboard Warga')] class extends Component {
    public bool $showModal = false;
    public string $jenis_surat = '';
    public string $keperluan = '';

    public function ajukanSurat()
    {
        $this->validate([
            'jenis_surat' => 'required|string|max:255',
            'keperluan' => 'required|string|min:5|max:1000',
        ]);

        PermohonanSurat::create([
            'user_id' => auth()->id(),
            'jenis_surat' => $this->jenis_surat,
            'keperluan' => $this->keperluan,
            'status' => 'pending',
        ]);

        $this->reset(['jenis_surat', 'keperluan', 'showModal']);

        $this->modal('ajukan-surat')->close();

        Flux::toast(
            variant: 'success',
            heading: 'Pengajuan Terkirim',
            text: 'Permohonan surat Anda telah berhasil dikirim ke perangkat desa.',
        );
    }

    public function with(): array
    {
        $userId = auth()->id();

        $statuses = PermohonanSurat::where('user_id', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $total = $statuses->sum();

        return [
            'permohonans' => PermohonanSurat::where('user_id', $userId)->latest()->get(),
            'stats' => [
                'total' => $total,
                'pending' => $statuses->get('pending', 0),
                'proses' => $statuses->get('proses', 0),
                'selesai' => $statuses->get('selesai', 0),
            ]
        ];
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-8">
    <div class=" bg-white  p-6 text-slate-900 dark:bg-slate-900 dark: dark:text-white">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="flex size-14 shrink-0 items-center justify-center  bg-slate-100  dark:bg-slate-800 dark:
                    <flux:icon.home-modern class="size-8 text-teal-600 dark:text-teal-400" />
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-normal text-slate-900 mb-1 dark:text-white">Layanan Mandiri Desa Tatung</h1>
                    <p class="text-slate-500 text-sm max-w-xl dark:text-slate-400">
                        Halo, <span class="font-bold text-teal-600 dark:text-teal-400">{{ auth()->user()->name }}</span>.
                        Gunakan dashboard ini untuk mengajukan permohonan surat secara mandiri dan pantau prosesnya.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <flux:modal.trigger name="ajukan-surat">
                    <flux:button variant="primary" icon="plus" size="sm" class="">
                        Ajukan Surat Baru
                    </flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-4">
        <!-- Stat Box: Info (Biru AdminLTE) -->
        <div class="relative overflow-hidden  bg-cyan-500 text-white transition-all  pb-8 group">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 ">{{ $stats['total'] }}</h3>
                <p class="text-sm font-medium opacity-90 truncate">Total Pengajuan</p>
            </div>
            <div class="absolute right-2 top-2 z-0 opacity-25 transition-transform duration-300 group-hover:scale-110">
                <flux:icon.document-duplicate class="size-20" stroke-width="1.5" />
            </div>
            <a href="#" class="absolute bottom-0 left-0 right-0 py-1.5 bg-black/10 text-center text-xs text-white/90 hover:bg-black/20 hover:text-white flex items-center justify-center gap-1 transition-colors">
                Selengkapnya <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>

        <!-- Stat Box: Warning (Kuning AdminLTE) -->
        <div class="relative overflow-hidden  bg-red-500 text-white transition-all  pb-8 group">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 ">{{ $stats['pending'] }}</h3>
                <p class="text-sm font-medium opacity-90 truncate">Menunggu</p>
            </div>
            <div class="absolute right-2 top-2 z-0 opacity-25 transition-transform duration-300 group-hover:scale-110">
                <flux:icon.clock class="size-20" stroke-width="1.5" />
            </div>
            <a href="#" class="absolute bottom-0 left-0 right-0 py-1.5 bg-black/10 text-center text-xs text-white/90 hover:bg-black/20 hover:text-white flex items-center justify-center gap-1 transition-colors">
                Selengkapnya <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>

        <!-- Stat Box: Primary (Biru Tua AdminLTE) -->
        <div class="relative overflow-hidden  bg-blue-600 text-white transition-all  pb-8 group">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 ">{{ $stats['proses'] }}</h3>
                <p class="text-sm font-medium opacity-90 truncate">Diproses</p>
            </div>
            <div class="absolute right-2 top-2 z-0 opacity-25 transition-transform duration-300 group-hover:scale-110">
                <flux:icon.arrow-path class="size-20 animate-spin-slow" stroke-width="1.5" />
            </div>
            <a href="#" class="absolute bottom-0 left-0 right-0 py-1.5 bg-black/10 text-center text-xs text-white/90 hover:bg-black/20 hover:text-white flex items-center justify-center gap-1 transition-colors">
                Selengkapnya <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>

        <!-- Stat Box: Success (Hijau AdminLTE) -->
        <div class="relative overflow-hidden  bg-blue-500 text-white transition-all  pb-8 group">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 ">{{ $stats['selesai'] }}</h3>
                <p class="text-sm font-medium opacity-90 truncate">Selesai</p>
            </div>
            <div class="absolute right-2 top-2 z-0 opacity-25 transition-transform duration-300 group-hover:scale-110">
                <flux:icon.check-circle class="size-20" stroke-width="1.5" />
            </div>
            <a href="#" class="absolute bottom-0 left-0 right-0 py-1.5 bg-black/10 text-center text-xs text-white/90 hover:bg-black/20 hover:text-white flex items-center justify-center gap-1 transition-colors">
                Selengkapnya <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>
    </div>

    <div class="flex flex-col gap-6">
        <div class=" bg-white  p-0 dark:bg-slate-900">
            <div class="px-5 py-4   flex justify-between items-center">
                <h3 class="font-semibold text-slate-800 dark:text-slate-200">Riwayat Pengajuan Anda</h3>
                <flux:button variant="ghost" icon="arrow-path" size="sm" wire:click="$refresh" class="">Segarkan</flux:button>
            </div>

            <div class="p-5">
                @if($permohonans->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12     dark: bg-slate-50/50 dark:bg-slate-900/50">
                        <div class="size-12  bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                            <flux:icon.document-text class="size-6 text-slate-400" />
                        </div>
                        <h3 class="text-md font-medium text-slate-900 dark:text-white">Belum Ada Pengajuan</h3>
                        <p class="text-slate-500 text-sm mt-1 mb-4">Anda belum pernah mengajukan permohonan surat.</p>
                        <flux:modal.trigger name="ajukan-surat">
                            <flux:button variant="primary" size="sm" icon="plus" class="">Mulai Buat Pengajuan</flux:button>
                        </flux:modal.trigger>
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach($permohonans as $item)
                            <div class="flex items-center justify-between p-4 bg-white   shadow-[0_1px_2px_rgba(0,0,0,0.05)] dark:bg-slate-800/80  hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div @class([
                                        'size-10  shrink-0 flex items-center justify-center text-white',
                                        'bg-red-500' => $item->status === 'pending',
                                        'bg-blue-600' => $item->status === 'proses',
                                        'bg-blue-500' => $item->status === 'selesai',
                                        'bg-red-500' => $item->status === 'ditolak',
                                    ])>
                                        <flux:icon.document-text class="size-5" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $item->jenis_surat }}</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-slate-500 flex items-center gap-1">
                                                <flux:icon.calendar class="size-3" /> {{ $item->created_at->format('d M Y, H:i') }}
                                            </span>
                                            <span @class([
                                                'text-[10px] font-bold uppercase px-1.5 py-0.5  text-white',
                                                'bg-red-500' => $item->status === 'pending',
                                                'bg-blue-600' => $item->status === 'proses',
                                                'bg-blue-500' => $item->status === 'selesai',
                                                'bg-red-500' => $item->status === 'ditolak',
                                            ])>
                                                {{ $item->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    @if($item->keterangan_admin)
                                        <flux:tooltip position="top" content="{{ $item->keterangan_admin }}">
                                            <flux:button variant="ghost" size="sm" icon="information-circle" class="" />
                                        </flux:tooltip>
                                    @endif
                                    <flux:button variant="ghost" size="sm" icon="eye" class="">Detail</flux:button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    {{-- Modal Ajukan Surat --}}
    <flux:modal name="ajukan-surat" class="md:w-[500px]">
        <form wire:submit="ajukanSurat" class="space-y-6">
            <div>
                <flux:heading size="lg">Ajukan Permohonan Surat</flux:heading>
                <flux:subheading>Silakan pilih jenis surat dan jelaskan keperluan Anda.</flux:subheading>
            </div>

            <flux:field>
                <flux:label>Jenis Surat</flux:label>
                <flux:select wire:model="jenis_surat" placeholder="Pilih Jenis Surat..." required>
                    <flux:select.option value="Surat Keterangan Usaha (SKU)">Surat Keterangan Usaha (SKU)</flux:select.option>
                    <flux:select.option value="Surat Keterangan Tidak Mampu (SKTM)">Surat Keterangan Tidak Mampu (SKTM)</flux:select.option>
                    <flux:select.option value="Surat Keterangan Domisili">Surat Keterangan Domisili</flux:select.option>
                    <flux:select.option value="Surat Pengantar Nikah (NA)">Surat Pengantar Nikah (NA)</flux:select.option>
                    <flux:select.option value="Lainnya">Lainnya...</flux:select.option>
                </flux:select>
                <flux:error name="jenis_surat" />
            </flux:field>

            <flux:field>
                <flux:label>Keperluan</flux:label>
                <flux:textarea wire:model="keperluan" rows="4" placeholder="Jelaskan alasan pengajuan surat ini (Contoh: Sebagai syarat pengajuan KUR di Bank BRI)" required />
                <flux:error name="keperluan" />
            </flux:field>

            <div class="bg-red-50 dark:bg-red-900/20 p-4   dark:
                <div class="flex gap-3">
                    <flux:icon.information-circle class="size-5 text-red-600 shrink-0" />
                    <div class="text-xs text-red-800 dark:text-red-400 leading-relaxed">
                        <p class="font-bold mb-1 underline">Catatan Penting:</p>
                        Setelah dikirim, permohonan akan diverifikasi oleh admin desa. Harap pantau dashboard ini secara berkala atau tunggu pemberitahuan selanjutnya.
                    </div>
                </div>
            </div>

            <div class="flex gap-3 justify-end items-center">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Kirim Pengajuan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
