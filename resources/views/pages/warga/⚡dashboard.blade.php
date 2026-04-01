<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app'), Title('Dashboard Warga')] class extends Component {

}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Header --}}
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Dashboard Warga</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">
            Selamat datang, {{ auth()->user()->name }}. Ajukan surat dan pantau status layanan desa di sini.
        </p>
    </div>

    {{-- Layanan & Status --}}
    <div class="grid gap-4 md:grid-cols-2">
        @include('partials.ui.stat-card', [
            'title' => 'Pengajuan Surat',
            'value' => 'Segera Hadir',
            'description' => 'Ajukan berbagai surat keterangan tanpa antri.',
            'icon' => 'document-text',
            'trend' => 'Online Service',
            'trendColor' => 'blue',
        ])

        @include('partials.ui.stat-card', [
            'title' => 'Riwayat Pengajuan',
            'value' => 'Segera Hadir',
            'description' => 'Pantau status pengajuan surat Anda secara real-time.',
            'icon' => 'clock',
            'trend' => 'Live Tracking',
            'trendColor' => 'green',
        ])
    </div>

    <flux:separator />

    {{-- Informasi Akun --}}
    <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm shadow-black/5 dark:border-neutral-700 dark:bg-neutral-900">
        <flux:heading size="lg" class="mb-2">Informasi Akun</flux:heading>
        <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">Data profil singkat Anda.</p>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="flex items-center gap-3">
                <div class="flex size-9 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                    <flux:icon.user class="size-4 text-neutral-600 dark:text-neutral-300" variant="outline" />
                </div>
                <div>
                    <p class="text-xs text-neutral-500">Nama Lengkap</p>
                    <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex size-9 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                    <flux:icon.identification class="size-4 text-neutral-600 dark:text-neutral-300" variant="outline" />
                </div>
                <div>
                    <p class="text-xs text-neutral-500">NIK</p>
                    <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->nik ?? '—' }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex size-9 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                    <flux:icon.envelope class="size-4 text-neutral-600 dark:text-neutral-300" variant="outline" />
                </div>
                <div>
                    <p class="text-xs text-neutral-500">Email</p>
                    <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex size-9 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                    <flux:icon.phone class="size-4 text-neutral-600 dark:text-neutral-300" variant="outline" />
                </div>
                <div>
                    <p class="text-xs text-neutral-500">No. HP</p>
                    <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->no_hp ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
