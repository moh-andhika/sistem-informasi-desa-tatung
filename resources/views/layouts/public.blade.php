<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <title>{{ $title ?? config('app.name', 'Sistem Informasi Desa Tatung') }}</title>
</head>
<body class="min-h-screen bg-white text-neutral-900 antialiased">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="mx-auto h-full max-w-6xl opacity-10">
            <div class="absolute -left-12 top-16 size-56 rounded-full bg-yellow-200 blur-3xl"></div>
            <div class="absolute right-0 top-40 size-64 rounded-full bg-orange-200 blur-3xl"></div>
        </div>
    </div>

    <header class="sticky top-0 z-30 border-b border-blue-900/10 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo Ponorogo" class="h-9 w-auto transition-transform group-hover:scale-105" />
                    <div class="leading-tight">
                        <p class="text-sm font-bold text-blue-950 uppercase tracking-wide">Sistem Informasi Desa</p>
                        <p class="text-xs font-semibold text-blue-600">Desa Tatung</p>
                    </div>
                </a>
            </div>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-600 sm:flex">
                <a href="{{ route('home') }}" class="py-2 hover:text-blue-700 transition-colors {{ request()->routeIs('home') ? 'text-blue-700' : '' }}">Beranda</a>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none {{ request()->routeIs('publik.profil.*') ? 'text-blue-700' : '' }}">
                        Profil Desa <flux:icon.chevron-down class="size-3 transition-transform group-hover:-rotate-180" />
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('publik.profil.sejarah') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Sejarah Desa</a>
                        <a href="{{ route('publik.profil.visi-misi') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Visi & Misi</a>
                        <a href="{{ route('publik.profil.aparatur') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Aparatur Desa</a>
                        <a href="{{ route('publik.profil.wilayah') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Peta & Wilayah</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none {{ request()->routeIs('publik.publikasi.*') ? 'text-blue-700' : '' }}">
                        Publikasi <flux:icon.chevron-down class="size-3 transition-transform group-hover:-rotate-180" />
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Berita Desa</a>
                        <a href="{{ route('publik.publikasi.agenda') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Agenda Kegiatan</a>
                        <a href="{{ route('publik.publikasi.galeri') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Galeri Foto</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none {{ request()->routeIs('publik.potensi.*') ? 'text-blue-700' : '' }}">
                        Potensi <flux:icon.chevron-down class="size-3 transition-transform group-hover:-rotate-180" />
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('publik.potensi.umkm') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Produk UMKM</a>
                        <a href="{{ route('publik.potensi.pariwisata') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Pariwisata</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none {{ request()->routeIs('publik.transparansi.*') ? 'text-blue-700' : '' }}">
                        Transparansi <flux:icon.chevron-down class="size-3 transition-transform group-hover:-rotate-180" />
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('publik.transparansi.apbdes') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Info APBDes</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none {{ request()->routeIs('publik.layanan.*') ? 'text-blue-700' : '' }}">
                        Layanan <flux:icon.chevron-down class="size-3 transition-transform group-hover:-rotate-180" />
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('publik.layanan.informasi-surat') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Informasi Surat</a>
                        <div class="my-1 border-t border-slate-200"></div>
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Pengajuan Online</a>
                    </div>
                </div>

                <a href="{{ route('infografis') }}" class="py-2 hover:text-blue-700 transition-colors {{ request()->routeIs('infografis') ? 'text-blue-700' : '' }}">Infografis</a>
            </nav>            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ auth()->user()->hasAnyRole(['Super Admin', 'Admin Kependudukan']) ? route('admin.dashboard') : route('dashboard') }}"
                       class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:border-blue-300 hover:bg-blue-100 transition-colors">
                        <span>Dasbor</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-blue-300 hover:text-blue-700 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 transition-colors">
                        Buat Akun
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="relative z-10">
        @yield('content')
        {!! $slot ?? '' !!}
    </main>

    <footer class="mt-16 border-t border-slate-200 bg-slate-50">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:px-8 lg:grid-cols-4">
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo" class="h-8 w-auto" />
                    <p class="text-lg font-bold text-slate-900">Desa Tatung</p>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">Sistem Informasi Desa resmi untuk layanan publik, transparansi pembangunan, dan kemudahan akses data kependudukan.</p>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Profil & Potensi</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="{{ route('publik.profil.sejarah') }}" class="hover:text-blue-600 transition-colors">Sejarah Desa</a></li>
                    <li><a href="{{ route('publik.profil.aparatur') }}" class="hover:text-blue-600 transition-colors">Aparatur Pemerintahan</a></li>
                    <li><a href="{{ route('publik.potensi.umkm') }}" class="hover:text-blue-600 transition-colors">Produk UMKM</a></li>
                    <li><a href="{{ route('publik.potensi.pariwisata') }}" class="hover:text-blue-600 transition-colors">Pariwisata</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Informasi</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="{{ route('publik.publikasi.berita.index') }}" class="hover:text-blue-600 transition-colors">Berita Terkini</a></li>
                    <li><a href="{{ route('publik.transparansi.apbdes') }}" class="hover:text-blue-600 transition-colors">Transparansi APBDes</a></li>
                    <li><a href="{{ route('infografis') }}" class="hover:text-blue-600 transition-colors">Data Infografis</a></li>
                    <li><a href="{{ route('publik.layanan.informasi-surat') }}" class="hover:text-blue-600 transition-colors">Panduan Layanan</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Kontak</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <flux:icon.map-pin class="size-5 shrink-0 text-slate-400" />
                        <span>Kantor Kepala Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <flux:icon.phone class="size-5 shrink-0 text-slate-400" />
                        <span>08xx-xxxx-xxxx</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <flux:icon.envelope class="size-5 shrink-0 text-slate-400" />
                        <span>desa@tatung.id</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 text-sm text-slate-500 sm:flex-row sm:px-6 lg:px-8">
                <p>&copy; {{ now()->year }} Pemerintah Desa Tatung. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4">
                    <span>Portal e-Government</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                        <span class="size-1.5 rounded-full bg-emerald-500"></span> Online
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <flux:toast />
    <livewire:confirm-modal />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxScripts
</body>
</html>
