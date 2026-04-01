<?php

use App\Enums\Role;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app'), Title('Dashboard Admin')] class extends Component {
    public int $totalPengguna = 0;
    public int $totalAdmin = 0;
    public int $totalWarga = 0;

    public function mount(): void
    {
        $this->totalPengguna = User::count();
        $this->totalAdmin = User::where('role', Role::Admin->value)->count();
        $this->totalWarga = User::where('role', Role::Warga->value)->count();
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Header --}}
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Dashboard Admin</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">
            Selamat datang, {{ auth()->user()->name }}. Kelola Sistem Informasi Desa Tatung di sini.
        </p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        @include('partials.ui.stat-card', [
            'title' => 'Total Pengguna',
            'value' => $totalPengguna,
            'description' => 'Semua akun terdaftar',
            'icon' => 'users',
            'trend' => 'Aktif',
            'trendColor' => 'blue',
        ])

        @include('partials.ui.stat-card', [
            'title' => 'Admin Desa',
            'value' => $totalAdmin,
            'description' => 'Pengelola & petugas',
            'icon' => 'shield-check',
            'trend' => 'Stabil',
            'trendColor' => 'red',
        ])

        @include('partials.ui.stat-card', [
            'title' => 'Warga',
            'value' => $totalWarga,
            'description' => 'Akun warga terdaftar',
            'icon' => 'user-group',
            'trend' => 'Bertambah',
            'trendColor' => 'green',
        ])
    </div>

    {{-- Quick Actions --}}
    <section class="grid gap-3 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex cursor-pointer flex-col gap-2 rounded-xl border border-neutral-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-blue-400 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                    <flux:icon.users class="size-5" variant="outline" />
                </div>
                <p class="font-semibold text-neutral-900 dark:text-white">Data Penduduk</p>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400">Kelola data kependudukan desa.</p>
        </div>

        <div class="flex cursor-pointer flex-col gap-2 rounded-xl border border-neutral-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-green-400 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300">
                    <flux:icon.document-text class="size-5" variant="outline" />
                </div>
                <p class="font-semibold text-neutral-900 dark:text-white">Layanan Surat</p>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400">Proses pengajuan surat warga.</p>
        </div>

        <div class="flex cursor-pointer flex-col gap-2 rounded-xl border border-neutral-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-yellow-400 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 dark:bg-yellow-900 dark:text-yellow-300">
                    <flux:icon.newspaper class="size-5" variant="outline" />
                </div>
                <p class="font-semibold text-neutral-900 dark:text-white">Berita Desa</p>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400">Kelola informasi & pengumuman.</p>
        </div>

        <div class="flex cursor-pointer flex-col gap-2 rounded-xl border border-neutral-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-purple-400 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300">
                    <flux:icon.cog-6-tooth class="size-5" variant="outline" />
                </div>
                <p class="font-semibold text-neutral-900 dark:text-white">Pengaturan</p>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400">Konfigurasi sistem dan profil.</p>
        </div>
    </section>

    {{-- Status Info --}}
    <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950 dark:text-green-200">
        <div class="flex items-center gap-2">
            <flux:icon.check-circle class="size-5" variant="outline" />
            <span><strong>Sistem aktif.</strong> Fitur Data Penduduk dan Layanan Surat siap dikembangkan berikutnya.</span>
        </div>
    </div>
</div>
