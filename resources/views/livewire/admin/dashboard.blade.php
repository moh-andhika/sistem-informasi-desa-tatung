<x-layouts::app :title="__('Dashboard Admin')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- Page Header --}}
        <div>
            <flux:heading size="xl">Dashboard Admin</flux:heading>
            <flux:subheading>Selamat datang, {{ auth()->user()->name }}. Kelola Sistem Informasi Desa Tatung di sini.</flux:subheading>
        </div>

        <flux:separator />

        {{-- Statistik Pengguna --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Pengguna</p>
                    <flux:icon.users class="size-5 text-neutral-400" variant="outline" />
                </div>
                <p class="mt-3 text-3xl font-bold text-neutral-900 dark:text-white">{{ $totalPengguna }}</p>
                <p class="mt-1 text-xs text-neutral-500">Semua pengguna terdaftar</p>
            </div>

            <div class="rounded-xl border border-red-200 bg-red-50 p-6 dark:border-red-800 dark:bg-red-950">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-red-600 dark:text-red-400">Admin Desa</p>
                    <flux:icon.shield-check class="size-5 text-red-400" variant="outline" />
                </div>
                <p class="mt-3 text-3xl font-bold text-red-700 dark:text-red-300">{{ $totalAdmin }}</p>
                <p class="mt-1 text-xs text-red-500">Petugas & admin desa</p>
            </div>

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-6 dark:border-blue-800 dark:bg-blue-950">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Warga</p>
                    <flux:icon.user-group class="size-5 text-blue-400" variant="outline" />
                </div>
                <p class="mt-3 text-3xl font-bold text-blue-700 dark:text-blue-300">{{ $totalWarga }}</p>
                <p class="mt-1 text-xs text-blue-500">Warga terdaftar</p>
            </div>
        </div>

        {{-- Menu Cepat --}}
        <div>
            <flux:heading size="lg" class="mb-3">Menu Cepat</flux:heading>
            <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-4">
                <div class="cursor-pointer rounded-xl border border-neutral-200 bg-white p-5 transition-all hover:border-blue-400 hover:shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                    <flux:icon.users class="mb-3 size-8 text-blue-500" variant="outline" />
                    <p class="font-semibold text-neutral-800 dark:text-white">Data Penduduk</p>
                    <p class="mt-1 text-xs text-neutral-500">Kelola data kependudukan desa</p>
                </div>
                <div class="cursor-pointer rounded-xl border border-neutral-200 bg-white p-5 transition-all hover:border-green-400 hover:shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                    <flux:icon.document-text class="mb-3 size-8 text-green-500" variant="outline" />
                    <p class="font-semibold text-neutral-800 dark:text-white">Layanan Surat</p>
                    <p class="mt-1 text-xs text-neutral-500">Proses pengajuan surat warga</p>
                </div>
                <div class="cursor-pointer rounded-xl border border-neutral-200 bg-white p-5 transition-all hover:border-yellow-400 hover:shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                    <flux:icon.newspaper class="mb-3 size-8 text-yellow-500" variant="outline" />
                    <p class="font-semibold text-neutral-800 dark:text-white">Berita Desa</p>
                    <p class="mt-1 text-xs text-neutral-500">Kelola informasi & berita desa</p>
                </div>
                <div class="cursor-pointer rounded-xl border border-neutral-200 bg-white p-5 transition-all hover:border-purple-400 hover:shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                    <flux:icon.cog-6-tooth class="mb-3 size-8 text-purple-500" variant="outline" />
                    <p class="font-semibold text-neutral-800 dark:text-white">Pengaturan</p>
                    <p class="mt-1 text-xs text-neutral-500">Konfigurasi sistem desa</p>
                </div>
            </div>
        </div>

        {{-- Info Status --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-950">
            <div class="flex items-center gap-3">
                <flux:icon.check-circle class="size-5 text-green-600 dark:text-green-400" variant="outline" />
                <p class="text-sm text-green-700 dark:text-green-300">
                    <strong>Sistem aktif.</strong> Fitur Data Penduduk dan Layanan Surat akan segera tersedia.
                </p>
            </div>
        </div>

    </div>
</x-layouts::app>
