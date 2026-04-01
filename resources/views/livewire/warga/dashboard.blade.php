<x-layouts::app :title="__('Dashboard Warga')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- Welcome Banner --}}
        <div class="rounded-xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 dark:border-blue-800 dark:from-blue-950 dark:to-indigo-950">
            <div class="flex items-center gap-4">
                <div class="flex size-14 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                    <flux:icon.user class="size-7 text-blue-600 dark:text-blue-400" variant="outline" />
                </div>
                <div>
                    <flux:heading size="xl">Selamat Datang, {{ auth()->user()->name }}!</flux:heading>
                    <flux:subheading>Portal Warga — Sistem Informasi Desa Tatung</flux:subheading>
                </div>
            </div>
        </div>

        {{-- Layanan Tersedia --}}
        <div>
            <flux:heading size="lg" class="mb-3">Layanan Desa</flux:heading>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex size-10 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900">
                            <flux:icon.document-text class="size-5 text-green-600 dark:text-green-400" variant="outline" />
                        </div>
                        <flux:heading size="base">Pengajuan Surat</flux:heading>
                    </div>
                    <p class="mb-4 text-sm text-neutral-500 dark:text-neutral-400">
                        Ajukan berbagai jenis surat keterangan secara online tanpa perlu antri di kantor desa.
                    </p>
                    <flux:badge color="yellow" size="sm">Segera Hadir</flux:badge>
                </div>

                <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex size-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900">
                            <flux:icon.clock class="size-5 text-blue-600 dark:text-blue-400" variant="outline" />
                        </div>
                        <flux:heading size="base">Riwayat Pengajuan</flux:heading>
                    </div>
                    <p class="mb-4 text-sm text-neutral-500 dark:text-neutral-400">
                        Pantau status pengajuan surat Anda secara real-time dari mana saja.
                    </p>
                    <flux:badge color="yellow" size="sm">Segera Hadir</flux:badge>
                </div>
            </div>
        </div>

        <flux:separator />

        {{-- Informasi Akun --}}
        <div>
            <flux:heading size="lg" class="mb-3">Informasi Akun</flux:heading>
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="flex items-center gap-3">
                        <div class="flex size-8 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                            <flux:icon.user class="size-4 text-neutral-500" variant="outline" />
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">Nama Lengkap</p>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex size-8 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                            <flux:icon.identification class="size-4 text-neutral-500" variant="outline" />
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">NIK</p>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->nik ?? '—' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex size-8 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                            <flux:icon.envelope class="size-4 text-neutral-500" variant="outline" />
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">Email</p>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex size-8 items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800">
                            <flux:icon.phone class="size-4 text-neutral-500" variant="outline" />
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">No. HP</p>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->no_hp ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts::app>
