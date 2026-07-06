<?php

use App\Models\penduduk;
use App\Models\User;
use App\Models\PermohonanSurat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app'), Title('Dashboard Admin')] class extends Component {
    public int $totalPengguna = 0;
    public int $totalAdmin = 0;
    public int $totalPenduduk = 0;
    public int $totalSuratPending = 0;

    public function mount(): void
    {
        $this->totalPengguna = User::count();
        $this->totalAdmin = User::whereHas('roles', fn ($q) => $q->where('name', 'Super Admin')->orWhere('name', 'Admin Kependudukan'))->count();
        $this->totalPenduduk = penduduk::count();
        $this->totalSuratPending = PermohonanSurat::where('status', 'pending')->count();
    }

    public function with(): array
    {
        return [
            'recentActivities' => PermohonanSurat::with('user')->latest()->take(5)->get(),
        ];
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-8">
    <div class="rounded-lg border border-green-100 border-t-4 border-t-[#2E7D32] bg-white p-6 text-slate-900 shadow-sm shadow-green-50 dark:border-slate-700 dark:border-t-[#F9A825] dark:bg-slate-900 dark:text-white">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="flex size-14 shrink-0 items-center justify-center rounded-lg border border-green-100 bg-green-50 dark:border-slate-600 dark:bg-slate-800">
                    <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo" class="h-8 w-auto" />
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 mb-1 dark:text-white">Administrasi website desa</h1>
                    <p class="text-slate-500 text-sm max-w-xl dark:text-slate-400">
                        Selamat datang kembali, <span class="font-bold text-[#2E7D32] dark:text-[#F9A825]">{{ auth()->user()->name }}</span>.
                        Pantau statistik terkini dan aktivitas administrasi warga Desa Tatung hari ini.
                    </p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-2">
                <flux:button variant="ghost" size="sm" class="rounded-md border border-green-100 shadow-sm hover:bg-green-50 hover:text-[#1B5E20] focus-visible:ring-[#F9A825]" href="{{ route('home') }}" icon="globe-alt" wire:navigate>
                    Lihat Situs
                </flux:button>
                <flux:button variant="primary" size="sm" class="rounded-md bg-[#1B5E20] text-white shadow-sm hover:bg-[#163d1d] focus-visible:ring-[#F9A825]">
                    Buat Laporan Baru
                </flux:button>
            </div>
        </div>
    </div>
    <div wire:loading.grid class="hidden gap-6 md:grid-cols-3">
        <x-admin.skeleton variant="stats" />
    </div>

    <div wire:loading.remove class="grid gap-6 md:grid-cols-3">
        <!-- Stat Box: Penduduk -->
        <div class="group relative overflow-hidden rounded-lg border border-green-100 border-t-4 border-t-[#2E7D32] bg-white pb-10 text-slate-900 shadow-sm shadow-green-50 transition-all hover:-translate-y-0.5 hover:border-green-200 hover:shadow-md hover:shadow-green-100 dark:border-slate-700 dark:border-t-[#2E7D32] dark:bg-slate-900 dark:text-white">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 text-[#1B5E20] dark:text-[#F9A825]">{{ $totalPenduduk }}</h3>
                <p class="text-sm font-bold text-slate-600 truncate uppercase tracking-wider dark:text-slate-300">Total Penduduk</p>
            </div>
            <div class="absolute right-2 top-2 z-0 text-[#2E7D32]/15 transition-transform duration-300 group-hover:scale-110 dark:text-[#F9A825]/20">
                <flux:icon.users class="size-20" stroke-width="1.5" />
            </div>
            <a href="{{ route('admin.penduduk') }}" class="absolute bottom-0 left-0 right-0 flex items-center justify-center gap-1 border-t border-green-100 bg-green-50 py-1.5 text-center text-[10px] font-bold uppercase text-[#1B5E20] transition-colors hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-inset dark:border-slate-700 dark:bg-slate-800 dark:text-[#F9A825]">
                Kelola Data <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>

        <!-- Stat Box: Pengguna -->
        <div class="group relative overflow-hidden rounded-lg border border-green-100 border-t-4 border-t-[#F9A825] bg-white pb-10 text-slate-900 shadow-sm shadow-green-50 transition-all hover:-translate-y-0.5 hover:border-green-200 hover:shadow-md hover:shadow-green-100 dark:border-slate-700 dark:border-t-[#F9A825] dark:bg-slate-900 dark:text-white">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 text-[#1B5E20] dark:text-[#F9A825]">{{ $totalPengguna }}</h3>
                <p class="text-sm font-bold text-slate-600 truncate uppercase tracking-wider dark:text-slate-300">Akun Warga Aktif</p>
            </div>
            <div class="absolute right-2 top-2 z-0 text-[#F9A825]/20 transition-transform duration-300 group-hover:scale-110">
                <flux:icon.check-badge class="size-20" stroke-width="1.5" />
            </div>
            <a href="{{ route('admin.pengguna') }}" class="absolute bottom-0 left-0 right-0 flex items-center justify-center gap-1 border-t border-green-100 bg-green-50 py-1.5 text-center text-[10px] font-bold uppercase text-[#1B5E20] transition-colors hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-inset dark:border-slate-700 dark:bg-slate-800 dark:text-[#F9A825]">
                Manajemen Akun <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>

        <!-- Stat Box: Permohonan -->
        <div class="group relative overflow-hidden rounded-lg border border-green-100 border-t-4 border-t-[#1B5E20] bg-white pb-10 text-slate-900 shadow-sm shadow-green-50 transition-all hover:-translate-y-0.5 hover:border-green-200 hover:shadow-md hover:shadow-green-100 dark:border-slate-700 dark:border-t-[#2E7D32] dark:bg-slate-900 dark:text-white">
            <div class="relative z-10 px-4 py-4">
                <h3 class="text-4xl font-bold mb-1 text-[#1B5E20] dark:text-[#F9A825]">{{ $totalSuratPending }}</h3>
                <p class="text-sm font-bold text-slate-600 truncate uppercase tracking-wider dark:text-slate-300">Surat Menunggu Aksi</p>
            </div>
            <div class="absolute right-2 top-2 z-0 text-[#1B5E20]/15 transition-transform duration-300 group-hover:scale-110 dark:text-[#F9A825]/20">
                <flux:icon.document-text class="size-20" stroke-width="1.5" />
            </div>
            <a href="{{ route('admin.permohonan') }}" class="absolute bottom-0 left-0 right-0 flex items-center justify-center gap-1 border-t border-green-100 bg-green-50 py-1.5 text-center text-[10px] font-bold uppercase text-[#1B5E20] transition-colors hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-inset dark:border-slate-700 dark:bg-slate-800 dark:text-[#F9A825]">
                Proses Sekarang <flux:icon.arrow-right-circle class="size-3" stroke-width="2" />
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Section Kiri: Aktivitas Tabel (2 Kolom) --}}
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="rounded-lg border border-green-100 border-t-4 border-t-[#1B5E20] bg-white p-0 shadow-sm shadow-green-50 dark:border-slate-700 dark:border-t-[#2E7D32] dark:bg-slate-900">
                <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="font-bold text-sm uppercase tracking-wider text-slate-800 dark:text-slate-200">Aktivitas Administrasi Terbaru</h3>
                    <flux:button variant="ghost" size="sm" icon="arrow-path" class="rounded-md hover:bg-green-50 hover:text-[#1B5E20] focus-visible:ring-[#F9A825]">Segarkan</flux:button>
                </div>
                <div class="p-5 overflow-x-auto">
                    <x-table>
                <x-table.thead>
                    <x-table.tr>
                        <x-table.th>Jenis Layanan</x-table.th>
                        <x-table.th>Pemohon</x-table.th>
                        <x-table.th>Tanggal</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th class="text-right">Aksi</x-table.th>
                    </x-table.tr>
                </x-table.thead>

                <x-table.tbody>
                    @forelse($recentActivities as $activity)
                    <x-table.tr>
                        <x-table.td>
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded bg-green-50 text-[#2E7D32] dark:bg-green-900/30 dark:text-[#F9A825]">
                                    <flux:icon.document-text class="size-4" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $activity->jenis_surat }}</p>
                                    <p class="text-xs text-slate-500 truncate max-w-xs">{{ $activity->keperluan }}</p>
                                </div>
                            </div>
                        </x-table.td>
                        <x-table.td class="font-medium">{{ $activity->user->name ?? 'Pengguna Dihapus' }}</x-table.td>
                        <x-table.td class="text-slate-500 text-sm whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</x-table.td>
                        <x-table.td>
                            @if($activity->status === 'pending')
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2 py-1 text-xs font-bold text-[#9a6a05] ring-1 ring-inset ring-[#F9A825]/30 dark:bg-amber-900/40 dark:text-amber-300">Menunggu</span>
                            @elseif($activity->status === 'proses')
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-bold text-[#2E7D32] ring-1 ring-inset ring-green-600/20 dark:bg-green-900/40 dark:text-green-300">Diproses</span>
                            @elseif($activity->status === 'selesai')
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-bold text-[#1B5E20] ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-900/40 dark:text-emerald-300">Selesai</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/20 dark:bg-red-900/40 dark:text-red-400">{{ ucfirst($activity->status) }}</span>
                            @endif
                        </x-table.td>
                        <x-table.td class="text-right">
                            <flux:button variant="ghost" size="sm" class="rounded-md text-[#2E7D32] hover:bg-green-50 hover:text-[#1B5E20] focus-visible:ring-[#F9A825]" href="{{ route('admin.permohonan') ?? '#' }}">Tinjau</flux:button>
                        </x-table.td>
                    </x-table.tr>
                    @empty
                    <x-table.tr>
                        <x-table.td colspan="5" class="text-center text-slate-500 py-6">
                            Belum ada aktivitas administrasi permohonan surat.
                        </x-table.td>
                    </x-table.tr>
                    @endforelse
                </x-table.tbody>
                    </x-table>
                </div>
                <div class="px-5 py-3 border-t border-green-100 dark:border-slate-700 bg-green-50/60 dark:bg-slate-800/50 text-center">
                    <a href="{{ route('admin.permohonan') ?? '#' }}" class="text-sm text-[#2E7D32] hover:text-[#1B5E20] font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">Lihat seluruh riwayat aktivitas &rarr;</a>
                </div>
            </div>
        </div>

        {{-- Section Kanan: Pintasan & Pengumuman (1 Kolom) --}}
        <div class="flex flex-col gap-6">
            <div class="rounded-lg border border-green-100 border-t-4 border-t-[#2E7D32] bg-white shadow-sm shadow-green-50 dark:border-slate-700 dark:border-t-[#2E7D32] dark:bg-slate-900">
                <div class="px-4 py-3 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="font-bold text-sm uppercase tracking-wider text-slate-800 dark:text-slate-200 flex items-center gap-2">
                        <flux:icon.bolt class="size-4 text-[#F9A825]" /> Akses Cepat
                    </h3>
                </div>
                <div class="p-4 grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.penduduk') ?? '#' }}" class="group flex flex-col items-center justify-center rounded-lg border border-green-100 bg-green-50/60 p-4 text-center transition-colors hover:border-[#2E7D32] hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.user-group class="size-6 text-[#2E7D32] mb-2 transition-transform group-hover:scale-110" />
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#1B5E20]">Data Penduduk</span>
                    </a>
                    <a href="#" class="group flex flex-col items-center justify-center rounded-lg border border-green-100 bg-green-50/60 p-4 text-center transition-colors hover:border-[#2E7D32] hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.document-plus class="size-6 text-[#2E7D32] mb-2 transition-transform group-hover:scale-110" />
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#1B5E20]">Buat Surat</span>
                    </a>
                    <a href="{{ route('admin.berita') }}" class="group flex flex-col items-center justify-center rounded-lg border border-green-100 bg-green-50/60 p-4 text-center transition-colors hover:border-[#2E7D32] hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.megaphone class="size-6 text-[#2E7D32] mb-2 transition-transform group-hover:scale-110" />
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#1B5E20]">Berita Desa</span>
                    </a>
                    <a href="{{ route('admin.galeri') }}" class="group flex flex-col items-center justify-center rounded-lg border border-green-100 bg-green-50/60 p-4 text-center transition-colors hover:border-[#2E7D32] hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.photo class="size-6 text-[#2E7D32] mb-2 transition-transform group-hover:scale-110" />
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#1B5E20]">Galeri Foto</span>
                    </a>
                    <a href="{{ route('profile.edit') ?? '#' }}" class="group flex flex-col items-center justify-center rounded-lg border border-green-100 bg-green-50/60 p-4 text-center transition-colors hover:border-[#2E7D32] hover:bg-green-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.cog-6-tooth class="size-6 text-[#2E7D32] mb-2 transition-transform group-hover:scale-110" />
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#1B5E20]">Pengaturan</span>
                    </a>
                </div>
            </div>

            <div class="rounded-lg bg-[#163d1d] text-white shadow-sm p-0 border-t-4 border-[#F9A825]">
                <div class="px-4 py-3 border-b border-white/10 flex items-center gap-2 font-bold uppercase text-[10px] tracking-widest">
                    <flux:icon.information-circle class="size-5 text-[#F9A825]" />
                    Pemberitahuan Sistem
                </div>
                <div class="p-4 text-sm bg-[#102f15] text-green-50">
                    <p class="leading-relaxed font-medium text-[11px]">Sistem sinkronisasi data kependudukan ke server kabupaten berjalan normal. Pencadangan data (backup) terakhir dilakukan hari ini pukul 02:00 WIB.</p>
                </div>
            </div>
        </div>
    </div>
</div>

