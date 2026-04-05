<?php

use App\Models\penduduk;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app'), Title('Dashboard Admin')] class extends Component {
    public int $totalPengguna = 0;
    public int $totalAdmin = 0;
    public int $totalPenduduk = 0;

    public function mount(): void
    {
        $this->totalPengguna = User::count();
        $this->totalAdmin = User::whereHas('roles', fn ($q) => $q->where('name', 'Super Admin')->orWhere('name', 'Admin Kependudukan'))->count();
        $this->totalPenduduk = penduduk::count();
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-8">
    {{-- Header Banner Terinspirasi dari Mosaic/TailAdmin Theme --}}
    <div class="relative overflow-hidden rounded-2xl bg-white border border-slate-200 p-8 text-slate-900 shadow-sm dark:bg-slate-900 dark:border-slate-700 dark:text-white">
        <div class="absolute right-0 top-0 -mt-16 -mr-16 size-64 rounded-full bg-blue-100/50 blur-3xl dark:bg-blue-900/20"></div>
        <div class="absolute bottom-0 left-0 -mb-16 -ml-16 size-48 rounded-full bg-blue-50/50 blur-3xl dark:bg-blue-900/10"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] dark:opacity-[0.02]"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="flex size-16 shrink-0 items-center justify-center rounded-xl bg-blue-50 backdrop-blur-md border border-blue-100 shadow-inner dark:bg-slate-800 dark:border-slate-600">
                    <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo" class="h-10 w-auto" />
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 mb-1 dark:text-white">Pusat Kendali Sistem Desa</h1>
                    <p class="text-slate-500 text-sm sm:text-base leading-snug max-w-xl dark:text-slate-400">
                        Selamat datang kembali, <span class="font-bold text-blue-700 dark:text-blue-400">{{ auth()->user()->name }}</span>.
                        Pantau statistik terkini dan aktivitas administrasi warga Desa Tatung hari ini.
                    </p>
                </div>
            </div>
            <div class="hidden md:flex flex-col items-end">
                <flux:button variant="primary" class="shadow-sm">
                    Buat Laporan Baru
                </flux:button>
            </div>
        </div>
    </div>
    {{-- Stat Cards --}}
    <div class="grid gap-6 md:grid-cols-3">
        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Total Penduduk</h3>
                <div class="p-2 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                    <flux:icon.users class="size-5" />
                </div>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalPenduduk }}</span>
                <span class="text-sm font-medium text-emerald-600 flex items-center">
                    <flux:icon.arrow-up-right class="size-3 mr-1" /> 2.5%
                </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Dibandingkan bulan lalu</p>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Akun Warga Aktif</h3>
                <div class="p-2 rounded-lg bg-teal-50 text-teal-600 dark:bg-teal-900/50 dark:text-teal-400">
                    <flux:icon.check-badge class="size-5" />
                </div>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalPengguna }}</span>
                <span class="text-sm font-medium text-emerald-600 flex items-center">
                    <flux:icon.arrow-up-right class="size-3 mr-1" /> 12 Baru
                </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Warga terverifikasi aplikasi</p>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider dark:text-slate-400">Surat Tertunda</h3>
                <div class="p-2 rounded-lg bg-amber-50 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400">
                    <flux:icon.document-text class="size-5" />
                </div>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="text-3xl font-extrabold text-slate-900 dark:text-white">5</span>
                <span class="text-sm font-medium text-amber-600">Perlu Tindakan</span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Menunggu tanda tangan Kades</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Section Kiri: Aktivitas Tabel (2 Kolom) --}}
        <div class="lg:col-span-2 flex flex-col gap-6">
            <x-table title="Aktivitas Administrasi Terbaru" subtitle="Daftar pengajuan surat dan pendaftaran warga 24 jam terakhir">
                <x-slot:actions>
                    <flux:button variant="ghost" size="sm" icon="arrow-path">Segarkan</flux:button>
                </x-slot:actions>

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
                    <!-- Row 1 -->
                    <x-table.tr>
                        <x-table.td>
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded bg-blue-50 text-blue-600">
                                    <flux:icon.document-text class="size-4" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">Surat Keterangan Tidak Mampu</p>
                                    <p class="text-xs text-slate-500">Keperluan Pendidikan</p>
                                </div>
                            </div>
                        </x-table.td>
                        <x-table.td class="font-medium">Siti Aminah</x-table.td>
                        <x-table.td class="text-slate-500">Hari ini, 09:30</x-table.td>
                        <x-table.td>
                            <span class="inline-flex items-center rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">Menunggu</span>
                        </x-table.td>
                        <x-table.td class="text-right">
                            <flux:button variant="ghost" size="sm" class="text-blue-600">Tinjau</flux:button>
                        </x-table.td>
                    </x-table.tr>

                    <!-- Row 2 -->
                    <x-table.tr>
                        <x-table.td>
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded bg-teal-50 text-teal-600">
                                    <flux:icon.user-plus class="size-4" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">Pendaftaran Akun Baru</p>
                                    <p class="text-xs text-slate-500">Verifikasi NIK</p>
                                </div>
                            </div>
                        </x-table.td>
                        <x-table.td class="font-medium">Budi Santoso</x-table.td>
                        <x-table.td class="text-slate-500">Kemarin, 15:45</x-table.td>
                        <x-table.td>
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Selesai</span>
                        </x-table.td>
                        <x-table.td class="text-right">
                            <flux:button variant="ghost" size="sm" class="text-blue-600">Tinjau</flux:button>
                        </x-table.td>
                    </x-table.tr>

                    <!-- Row 3 -->
                    <x-table.tr>
                        <x-table.td>
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded bg-blue-50 text-blue-600">
                                    <flux:icon.document-text class="size-4" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">Surat Keterangan Usaha</p>
                                    <p class="text-xs text-slate-500">Pengajuan KUR</p>
                                </div>
                            </div>
                        </x-table.td>
                        <x-table.td class="font-medium">Ahmad Fauzi</x-table.td>
                        <x-table.td class="text-slate-500">Kemarin, 11:20</x-table.td>
                        <x-table.td>
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Selesai</span>
                        </x-table.td>
                        <x-table.td class="text-right">
                            <flux:button variant="ghost" size="sm" class="text-blue-600">Tinjau</flux:button>
                        </x-table.td>
                    </x-table.tr>
                </x-table.tbody>

                <x-slot:footer>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Lihat seluruh riwayat aktivitas &rarr;</a>
                </x-slot:footer>
            </x-table>
        </div>

        {{-- Section Kanan: Pintasan & Pengumuman (1 Kolom) --}}
        <div class="flex flex-col gap-6">
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <h3 class="font-semibold text-slate-800 dark:text-slate-200 mb-4 flex items-center gap-2">
                    <flux:icon.bolt class="size-5 text-amber-500" /> Akses Cepat
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.penduduk') ?? '#' }}" class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors text-center group">
                        <flux:icon.user-group class="size-6 text-slate-400 group-hover:text-blue-600 mb-2" />
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700">Data Penduduk</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors text-center group">
                        <flux:icon.document-plus class="size-6 text-slate-400 group-hover:text-blue-600 mb-2" />
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700">Buat Surat</span>
                    </a>
                    <a href="{{ route('admin.berita') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors text-center group">
                        <flux:icon.megaphone class="size-6 text-slate-400 group-hover:text-blue-600 mb-2" />
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700">Pengumuman</span>
                    </a>
                    <a href="{{ route('profile.edit') ?? '#' }}" class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors text-center group">
                        <flux:icon.cog-6-tooth class="size-6 text-slate-400 group-hover:text-blue-600 mb-2" />
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700">Pengaturan</span>
                    </a>
                </div>
            </div>

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-5 shadow-sm dark:border-blue-800/50 dark:bg-blue-900/20 text-sm text-blue-800 dark:text-blue-300">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <flux:icon.information-circle class="size-5 text-blue-600 dark:text-blue-400" />
                    Pemberitahuan Sistem
                </div>
                <p class="leading-relaxed">Sistem sinkronisasi data kependudukan ke server kabupaten berjalan normal. Pencadangan data (backup) terakhir dilakukan hari ini pukul 02:00 WIB.</p>
            </div>
        </div>
    </div>
</div>
