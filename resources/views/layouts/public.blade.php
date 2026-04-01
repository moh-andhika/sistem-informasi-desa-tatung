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

    <header class="sticky top-0 z-30 border-b border-neutral-200 bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-app-logo class="h-8 w-auto" />
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-neutral-900">Sistem Informasi Desa</p>
                        <p class="text-xs text-neutral-500">Desa Tatung</p>
                    </div>
                </a>
            </div>
            <nav class="hidden items-center gap-6 text-sm font-medium text-neutral-700 sm:flex">
                <a href="{{ route('berita') }}" class="hover:text-orange-600">Berita</a>
                <a href="{{ route('infografis') }}" class="hover:text-orange-600">Infografis</a>
                <a href="#media" class="hover:text-orange-600">Konten Media</a>
                <a href="#video" class="hover:text-orange-600">Video</a>
                <a href="#layanan" class="hover:text-orange-600">Layanan</a>
            </nav>
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                       class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-700 hover:border-orange-300 hover:bg-orange-100">
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-neutral-200 px-4 py-2 text-sm font-semibold hover:border-neutral-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="relative z-10">
        @yield('content')
        {!! $slot ?? '' !!}
    </main>

    <footer class="mt-16 border-t border-neutral-200 bg-neutral-50/80">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:px-8 lg:grid-cols-4">
            <div class="space-y-2">
                <p class="text-base font-semibold text-neutral-900">Desa Tatung</p>
                <p class="text-sm text-neutral-600">Sistem Informasi Desa untuk layanan publik, transparansi, dan data kependudukan.</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-neutral-900">Navigasi</p>
                <ul class="mt-3 space-y-2 text-sm text-neutral-600">
                    <li><a href="#berita" class="hover:text-orange-600">Berita</a></li>
                    <li><a href="#infografis" class="hover:text-orange-600">Infografis</a></li>
                    <li><a href="#media" class="hover:text-orange-600">Konten Sosial Media</a></li>
                    <li><a href="#video" class="hover:text-orange-600">Video</a></li>
                    <li><a href="#layanan" class="hover:text-orange-600">Layanan Desa</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold text-neutral-900">Kontak</p>
                <ul class="mt-3 space-y-2 text-sm text-neutral-600">
                    <li>Alamat: Kantor Desa Tatung</li>
                    <li>Telepon: 08xx-xxxx-xxxx</li>
                    <li>Email: desa@tatung.id</li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold text-neutral-900">Tautan Cepat</p>
                <ul class="mt-3 space-y-2 text-sm text-neutral-600">
                    <li><a href="{{ route('login') }}" class="hover:text-orange-600">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-orange-600">Daftar Warga</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-orange-600">Status Pengajuan</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-neutral-200 bg-white/60">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-4 text-xs text-neutral-500 sm:flex-row sm:px-6 lg:px-8">
                <p>© {{ now()->year }} Desa Tatung. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <span>Versi Publik</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 font-semibold text-green-700">Online</span>
                </div>
            </div>
        </div>
    </footer>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
