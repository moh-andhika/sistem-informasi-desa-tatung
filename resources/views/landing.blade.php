@extends('layouts.public')

@section('title', 'Beranda – Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo')

@php
    // Use DB-driven data passed from the route closure, with safe fallbacks
    $runningTexts = $runningTexts ?? collect();
    $pengumuman = $pengumuman ?? collect();
    $galeri = $galeri ?? collect();
    $beritaTerbaru = $beritaTerbaru ?? collect();
    $beritaUtama = $beritaTerbaru->first();
    $beritaLainnya = $beritaTerbaru->slice(1, 3);
    $tickerItems = $runningTexts->isNotEmpty() ? $runningTexts : $pengumuman;
@endphp

@section('header_content')
    <div class="portal-page">
        {{-- ═══════════════════════════════════════════
             PROFESSIONAL GOVERNMENT JUMBOTRON
        ═══════════════════════════════════════════ --}}
        <section class="relative overflow-hidden group bg-linear-to-br from-[#163d1d] via-[#1B5E20] to-[#2E7D32] -mt-28" aria-label="Selamat Datang di Desa Tatung">
            <div class="absolute inset-0 z-0 opacity-85">
                <img
                    src="{{ asset('assets/images/jumbotron.jpg') }}"
                    alt="Foto bersama Perangkat Desa Tatung"
                    class="w-full h-full object-cover transition-transform duration-[15s] group-hover:scale-105"
                    loading="eager"
                />
            </div>
            <div class="absolute inset-0 bg-linear-to-b from-[#1B5E20]/5 via-[#163d1d]/48 to-[#102f15]/60 z-5"></div>

            <x-public.container class="relative z-10 pt-28 sm:pt-36 lg:pt-44 pb-10 sm:pb-14 lg:pb-20 text-white">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-1 w-12 rounded-full bg-[#F9A825]"></div>
                        <span class="text-xs font-semibold tracking-wide text-[#fde3a5]">Portal Resmi</span>
                    </div>
                    <h1 class="text-3xl sm:text-6xl text-white lg:text-7xl tracking-normal leading-[1.1] mb-4">
                        Pemerintah Desa Tatung
                    </h1>
                    <p class="text-base sm:text-lg text-white  leading-relaxed mb-2 font-medium">
                        Kecamatan Balong, Kabupaten Ponorogo, Jawa Timur
                    </p>
                    <p class="text-base sm:text-lg text-white tracking-wider leading-relaxed mb-6 max-w-2xl font-medium">
                        Melayani dengan transparansi, inovasi, dan komitmen penuh untuk pembangunan desa yang berkelanjutan dan kesejahteraan seluruh warga masyarakat.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('publik.layanan.informasi-surat') }}" class="inline-flex items-center rounded bg-[#F9A825] px-6 py-3 text-xs font-semibold tracking-wide text-slate-900 transition-all hover:-translate-y-0.5 hover:bg-[#e3a31a] hover:shadow-lg hover:shadow-[#F9A825]/30 focus:ring-2 focus:ring-[#F9A825] focus:ring-offset-2">
                            <flux:icon.document-text class="size-5 mr-2" />
                            Layanan Surat Online
                        </a>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white text-xs font-semibold tracking-wide rounded border border-white/30 transition-all hover:-translate-y-0.5 focus:ring-2 focus:ring-offset-2 focus:ring-white/50">
                            <flux:icon.newspaper class="size-5 mr-2" />
                            Berita Terbaru
                        </a>
                    </div>
                </div>
            </x-public.container>
        </section>

        {{-- ═══════════════════════════════════════════
             ANNOUNCEMENT TICKER
        ═══════════════════════════════════════════ --}}
        <section class="ticker bg-[#163d1d] border-b-4 border-[#F9A825]" aria-label="Pengumuman penting">
            <x-public.container>
                <div class="ticker__inner">
                    <span class="ticker__label text-[#F9A825]">
                        <flux:icon.megaphone class="size-5" />
                        <span class="ml-2 text-lg font-bold text-white tracking-wide">Pengumuman</span>
                    </span>
                    <div class="ticker__track" aria-live="off">
                        <p class="ticker__text text-lg text-white" id="ticker-text">
                            @forelse ($tickerItems as $item)
                                ✦ {{ Str::limit($item->ringkasan ?: $item->judul, 120) }}
                                @if ($item->published_at || $item->created_at)
                                    - {{ ($item->published_at ?? $item->created_at)?->translatedFormat('d F Y') }}
                                @endif
                                @unless ($loop->last)
                                    &nbsp;|&nbsp;
                                @endunless
                            @empty
                                ✦ Belum ada pengumuman aktif saat ini. Informasi terbaru akan tampil otomatis dari database setelah dipublikasikan.
                            @endforelse
                        </p>
                    </div>
                    <button class="ticker__pause !border-[#F9A825]/70 !text-[#F9A825] hover:!bg-[#F9A825] hover:!text-[#163d1d]" id="ticker-pause-btn" type="button">Jeda</button>
                </div>
            </x-public.container>
        </section>
    </div>
@endsection

@section('content')
    <div class="portal-page">
        <div class="prt-layout pt-3">
            {{-- ─────────── LEFT: Main content column ─────────── --}}
            <div class="space-y-6">

                {{-- QUICK ACCESS SERVICES --}}
                <section aria-label="Layanan publik cepat">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <a href="{{ route('publik.layanan.informasi-surat') }}" class="group rounded-lg border-2 border-slate-200 bg-white p-4 transition-all hover:-translate-y-1 hover:border-[#2E7D32] hover:shadow-lg hover:shadow-green-100">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="rounded-lg bg-green-50 p-2.5 transition-colors group-hover:bg-green-100">
                                    <flux:icon.document-text class="size-6 text-[#2E7D32] transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-[#1B5E20] sm:text-sm">Surat Keterangan</span>
                            </div>
                        </a>
                        <a href="#" class="group rounded-lg border-2 border-slate-200 bg-white p-4 transition-all hover:-translate-y-1 hover:border-[#2E7D32] hover:shadow-lg hover:shadow-green-100">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="rounded-lg bg-green-50 p-2.5 transition-colors group-hover:bg-green-100">
                                    <flux:icon.chat-bubble-left class="size-6 text-[#2E7D32] transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-[#1B5E20] sm:text-sm">Pengaduan & Aspirasi</span>
                            </div>
                        </a>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="group rounded-lg border-2 border-slate-200 bg-white p-4 transition-all hover:-translate-y-1 hover:border-[#2E7D32] hover:shadow-lg hover:shadow-green-100">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="rounded-lg bg-green-50 p-2.5 transition-colors group-hover:bg-green-100">
                                    <flux:icon.newspaper class="size-6 text-[#2E7D32] transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-[#1B5E20] sm:text-sm">Berita & Info</span>
                            </div>
                        </a>
                        <a href="{{ route('publik.transparansi.apbdes') }}" class="group rounded-lg border-2 border-slate-200 bg-white p-4 transition-all hover:-translate-y-1 hover:border-[#2E7D32] hover:shadow-lg hover:shadow-green-100">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="rounded-lg bg-green-50 p-2.5 transition-colors group-hover:bg-green-100">
                                    <flux:icon.document-chart-bar class="size-6 text-[#2E7D32] transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-[#1B5E20] sm:text-sm">Transparansi APBDes</span>
                            </div>
                        </a>
                    </div>
                </section>

                {{-- LATEST NEWS SECTION --}}
                <section aria-labelledby="berita-heading" class="space-y-4">
                    <div class="flex items-center justify-between border-b-2 border-[#2E7D32] pb-2">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 rounded-full bg-[#2E7D32]"></div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-wide" id="berita-heading">Berita Terbaru</h2>
                        </div>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold tracking-wide text-[#2E7D32] transition-transform hover:translate-x-1">
                            Lihat Semua <flux:icon.arrow-right class="size-4" />
                        </a>
                    </div>

                    @if ($beritaUtama)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Lead News Item --}}
                            <article class="overflow-hidden rounded-lg bg-white transition-shadow hover:shadow-lg hover:shadow-green-100">
                                <a href="{{ route('publik.publikasi.berita.show', $beritaUtama->slug) }}" class="block">
                                    <div class="aspect-video overflow-hidden bg-slate-100">
                                        @if ($beritaUtama->gambar)
                                            <img src="{{ Storage::url($beritaUtama->gambar) }}" alt="Foto berita: {{ $beritaUtama->judul }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <flux:icon.newspaper class="size-16" aria-hidden="true" />
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="inline-block rounded-full bg-[#2E7D32] px-3 py-1 text-xs font-bold text-white">Berita Desa</span>
                                        <time datetime="{{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->toDateString() }}" class="text-xs text-slate-500 font-medium">
                                            {{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-900 mb-2 line-clamp-2">
                                        <a href="{{ route('publik.publikasi.berita.show', $beritaUtama->slug) }}" class="transition-colors hover:text-[#1B5E20]">
                                            {{ $beritaUtama->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-slate-600 line-clamp-3">
                                        {{ $beritaUtama->ringkasan ?? Str::limit(strip_tags($beritaUtama->konten), 160) }}
                                    </p>
                                </div>
                            </article>

                            {{-- Secondary News Items --}}
                            <div class="space-y-3">
                                @forelse ($beritaLainnya as $item)
                                    <article class="group flex gap-3 rounded-lg bg-white p-3 transition-shadow hover:shadow-md hover:shadow-green-100">
                                        <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden bg-slate-100 block">
                                            @if ($item->gambar)
                                                <img src="{{ Storage::url($item->gambar) }}" alt="Foto berita: {{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <flux:icon.newspaper class="size-8" aria-hidden="true" />
                                                </div>
                                            @endif
                                            </a>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <span class="inline-block rounded bg-[#1B5E20] px-2 py-0.5 text-[10px] font-bold text-white">Artikel Baru</span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-900 mb-1 line-clamp-2">
                                                <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="transition-colors hover:text-[#1B5E20]">
                                                    {{ $item->judul }}
                                                </a>
                                            </h4>
                                            <p class="text-xs text-slate-500">
                                                {{ ($item->published_at ?? $item->created_at)?->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </article>
                                @empty
                                    <div class="bg-white rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
                                        Berita berikutnya akan tampil otomatis setelah data berita baru dipublikasikan.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="rounded-lg border-2 border-dashed border-slate-300 bg-white p-6 text-center">
                            <flux:icon.newspaper class="mx-auto size-12 text-slate-300" aria-hidden="true" />
                            <h3 class="mt-4 text-sm font-bold tracking-wide text-slate-700">Belum Ada Berita</h3>
                            <p class="mt-2 text-sm text-slate-500">
                                Data berita terbaru akan muncul di sini setelah dipublikasikan dari panel admin.
                            </p>
                        </div>
                    @endif
                </section>

                {{-- TRANSPARENCY SECTION --}}
                <section aria-labelledby="apbdes-heading">
                    <div class="mb-4 flex items-center gap-3 border-b-2 border-[#2E7D32] pb-2">
                        <div class="h-8 w-2 rounded-full bg-[#F9A825]"></div>
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-wide" id="apbdes-heading">Transparansi Anggaran Desa 2025</h2>
                        <a href="{{ route('publik.transparansi.apbdes') }}" class="ml-auto rounded bg-[#1B5E20] px-4 py-2 text-xs font-semibold tracking-wide text-white transition-colors hover:bg-[#163d1d]">
                            Laporan Lengkap &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        {{-- Revenue Section --}}
                        <div class="rounded-lg border border-green-100 bg-white p-4 shadow-sm shadow-green-50">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-sm font-bold tracking-wide text-[#1B5E20]">Pendapatan Desa</h3>
                                    <p class="mt-1 text-[11px] font-semibold tracking-wide text-[#2E7D32]">Ringkasan Pendapatan</p>
                                </div>
                                <div class="rounded-lg border border-green-100 bg-green-50 p-2">
                                    <flux:icon.arrow-down-tray class="size-6 text-[#2E7D32]" />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="rounded-lg border border-green-100 border-l-4 border-[#2E7D32] bg-gradient-to-r from-green-50 to-white p-3">
                                    <div class="mb-2 inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-bold tracking-wide text-[#9a6a05]">
                                        Target Pendapatan
                                    </div>
                                    <p class="text-2xl font-bold text-[#1B5E20]">Rp 1,77 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Dana Desa (DD)', 'val' => '850 Juta', 'p' => 72],
                                    ['label' => 'Alokasi Dana Desa (ADD)', 'val' => '320 Juta', 'p' => 65],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-bold text-slate-700">{{ $item['label'] }}</span>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-[#1B5E20]">{{ $item['p'] }}% Realisasi</p>
                                        </div>
                                    </div>
                                    <div class="h-3 w-full overflow-hidden rounded-full border border-green-100 bg-slate-100">
                                        <div class="h-full bg-gradient-to-r from-[#F9A825] to-[#d89a14] transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Expenditure Section --}}
                        <div class="rounded-lg border border-green-100 bg-white p-4 shadow-sm shadow-green-50">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-sm font-bold tracking-wide text-[#1B5E20]">Belanja Desa</h3>
                                    <p class="mt-1 text-[11px] font-semibold tracking-wide text-[#2E7D32]">Ringkasan Belanja</p>
                                </div>
                                <div class="rounded-lg border border-green-100 bg-green-50 p-2">
                                    <flux:icon.arrow-up-tray class="size-6 text-[#2E7D32]" />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="rounded-lg border border-green-100 border-l-4 border-[#2E7D32] bg-gradient-to-r from-green-50 to-white p-3">
                                    <div class="mb-2 inline-flex rounded-full bg-green-100 px-2.5 py-1 text-[10px] font-bold tracking-wide text-[#1B5E20]">
                                        Realisasi Belanja
                                    </div>
                                    <p class="text-2xl font-bold text-[#1B5E20]">Rp 1,50 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Pembangunan Infrastruktur', 'val' => '520 Juta', 'p' => 60],
                                    ['label' => 'Pemberdayaan Masyarakat', 'val' => '195 Juta', 'p' => 45],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-bold text-slate-700">{{ $item['label'] }}</span>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-[#2E7D32]">{{ $item['p'] }}% Realisasi</p>
                                        </div>
                                    </div>
                                    <div class="h-3 w-full overflow-hidden rounded-full border border-green-100 bg-slate-100">
                                        <div class="h-full bg-linear-to-r from-[#2E7D32] to-[#1B5E20] transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- ─────────── RIGHT: Sidebar ─────────── --}}
            <aside class="space-y-3">
                {{-- Population Statistics Widget --}}
                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <div class="flex items-center justify-center bg-linear-to-r from-[#1B5E20] to-[#2E7D32] px-4 py-2.5">
                        <h2 class="text-center text-xs font-bold tracking-wide text-white">Kependudukan</h2>
                    </div>
                    <div class="space-y-4 p-3">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-[#1B5E20]">2.847</p>
                            <p class="text-xs font-semibold text-slate-600 tracking-wide mt-2">Total Penduduk Desa</p>
                        </div>
                        <div class="space-y-3">
                            @foreach([['l' => 'Laki-laki', 'p' => 51, 'c' => 'from-[#2E7D32] to-[#1B5E20]'], ['l' => 'Perempuan', 'p' => 49, 'c' => 'from-[#F9A825] to-[#d89a14]']] as $s)
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-semibold text-slate-600 tracking-wide">
                                        <span>{{ $s['l'] }}</span>
                                        <span>{{ $s['p'] }}%</span>
                                    </div>
                                    <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                                        <div class="bg-gradient-to-r {{ $s['c'] }} h-full transition-all duration-1000" style="width: {{ $s['p'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('infografis') }}" class="block w-full rounded border border-green-100 bg-green-50 py-2.5 text-center text-xs font-semibold tracking-wide text-[#2E7D32] transition-colors hover:bg-green-100 hover:text-[#1B5E20]">
                            Lihat Infografis →
                        </a>
                    </div>
                </div>

                {{-- Head of Village Widget --}}
                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <div class="flex items-center justify-center bg-linear-to-r from-[#1B5E20] to-[#2E7D32] px-4 py-2.5">
                        <h2 class="text-center text-xs font-bold tracking-wide text-white">Kepala Desa</h2>
                    </div>
                    <div class="space-y-3 p-3 text-center">
                        <div class="mx-auto h-52 w-52 overflow-hidden rounded-lg">
                            <img src="{{ asset('assets/images/kepala-desa.png') }}" class="w-full h-full object-cover" alt="Kepala Desa">
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 tracking-tight">Bapak Rudianto</h3>
                            <p class="mt-1 text-xs font-semibold tracking-wide text-[#2E7D32]">Masa Jabatan 2020-2026</p>
                        </div>
                        <div class="pt-3 border-t border-slate-200">
                            <p class="text-xs text-slate-600 font-medium italic leading-relaxed">"Melayani dengan hati, membangun dengan bukti demi Desa Tatung yang mandiri."</p>
                        </div>
                    </div>
                </div>

                {{-- Important Information Widget --}}
                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <div class="flex items-center justify-center bg-gradient-to-r from-[#1B5E20] to-[#2E7D32] px-4 py-2.5">
                        <h2 class="text-center text-xs font-bold tracking-wide text-[#163d1d]">Informasi Penting</h2>
                    </div>
                    <div class="space-y-2.5 p-3">
                        <div class="rounded-lg border-l-4 border-[#2E7D32] bg-green-50 p-2.5">
                            <p class="text-xs font-bold text-slate-700">Jam Layanan</p>
                            <p class="text-sm text-slate-900 font-bold mt-1">Senin - Jumat: 08:00 - 16:00</p>
                        </div>
                        <div class="rounded-lg border-l-4 border-[#1B5E20] bg-emerald-50 p-2.5">
                            <p class="text-xs font-bold text-slate-700">Kontak Layanan</p>
                            <p class="text-sm text-slate-900 font-bold mt-1">(0352) XXXXXXX</p>
                        </div>
                        <div class="rounded-lg border-l-4 border-[#F9A825] bg-amber-50 p-2.5">
                            <p class="text-xs font-bold text-slate-700">Email</p>
                            <p class="text-sm text-slate-900 font-bold mt-1 break-all">info@tatung.desa.id</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        {{-- GOVERNMENT STAFF SECTION --}}
        <section class="mt-8">
            <div class="text-center mb-5">
                <h2 class="text-2xl font-bold text-slate-900 tracking-wide">Perangkat Pemerintah Desa Tatung</h2>
            </div>
            <div class="max-w-full overflow-hidden">
                <div class="aparatur-strip">
                @php
                    $aparaturStrip = [
                        ['name' => 'Rudianto', 'role' => 'Kepala Desa', 'img' => 'assets/images/kepala-desa.png'],
                        ['name' => 'Latif', 'role' => 'Sekretaris Desa', 'img' => 'assets/images/SnapInsta.to_69145198_2415937335192228_144255934130185137_n.jpg'],
                        ['name' => 'Musrikah', 'role' => 'Bendahara Desa', 'img' => 'assets/images/SnapInsta.to_69259426_2232909180341810_1330224165033982587_n.jpg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/WhatsApp Image 2026-05-11 at 11.22.22.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/WhatsApp Image 2026-05-11 at 11.22.23.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/WhatsApp Image 2026-05-11 at 11.22.2454.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/WhatsApp Image 2026-05-11 at 11.23.46.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.00.55.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.00.56.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.00.57.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.02.03.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.06.48.jpeg'],
                        ['name' => 'Perangkat Desa', 'role' => 'Pemerintah Desa Tatung', 'img' => 'assets/images/WhatsApp Image 2026-05-01 at 20.08.53.jpeg'],
                    ];
                @endphp
                @foreach($aparaturStrip as $p)
                    <article class="group w-56 shrink-0 text-center sm:w-64">
                        <div class="mx-auto mb-2 aspect-[4/5] w-full overflow-hidden rounded-lg transition-all group-hover:shadow-md group-hover:shadow-green-100">
                            <img src="{{ asset($p['img']) }}" alt="{{ $p['name'] }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 transition-colors group-hover:text-[#1B5E20]">{{ $p['name'] }}</h3>
                        <p class="mt-1 text-xs font-medium text-[#2E7D32]">{{ $p['role'] }}</p>
                    </article>
                @endforeach
                </div>
            </div>
        </section>

        {{-- GALLERY & FEATURED SECTIONS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            {{-- Photo Gallery Section --}}
            <section class="space-y-3">
                <div class="flex items-center gap-3 border-b-2 border-[#2E7D32] pb-2">
                    <div class="h-6 w-1.5 rounded-full bg-[#2E7D32]"></div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-wide">Galeri Foto</h2>
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    @foreach(['SnapInsta.to_69145198_2415937335192228_144255934130185137_n.jpg', 'background.jpg', 'background.jpg', 'SnapInsta.to_315862432_494817482623285_4773791494567302958_n.jpg'] as $img)
                        <div class="group relative overflow-hidden rounded-lg shadow-sm transition-shadow hover:shadow-md hover:shadow-green-100">
                            <img src="{{ asset('assets/images/' . $img) }}" alt="Foto Galeri" class="aspect-square object-cover w-full group-hover:scale-110 transition-transform duration-300" loading="lazy">
                            <div class="absolute inset-0 bg-[#1B5E20]/0 transition-colors duration-300 group-hover:bg-[#1B5E20]/20"></div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('publik.profil.sejarah') }}" class="block w-full rounded bg-[#1B5E20] py-2.5 text-center text-xs font-semibold tracking-wide text-white transition-colors hover:bg-[#163d1d]">
                    Lihat Semua Galeri
                </a>
            </section>

            {{-- Potential Section --}}
            <section class="space-y-3">
                <div class="flex items-center gap-3 border-b-2 border-[#2E7D32] pb-2">
                    <div class="h-6 w-1.5 rounded-full bg-[#2E7D32]"></div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-wide">Potensi Desa</h2>
                </div>
                <div class="space-y-2.5">
                    <a href="{{ route('publik.potensi.umkm') }}" class="group block relative rounded-lg overflow-hidden h-40">
                        <img src="{{ asset('assets/images/background.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 flex items-end bg-linear-to-t from-[#1B5E20]/90 to-[#2E7D32]/25 p-4">
                            <span class="text-white font-bold text-sm tracking-wide">UMKM Tatung</span>
                        </div>
                    </a>
                    <a href="{{ route('publik.potensi.pariwisata') }}" class="group block relative rounded-lg overflow-hidden h-40">
                        <img src="{{ asset('assets/images/background.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 flex items-end bg-linear-to-t from-[#1B5E20]/90 to-[#2E7D32]/25 p-4">
                            <span class="text-white font-bold text-sm tracking-wide">Pariwisata</span>
                        </div>
                    </a>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const ticker = document.getElementById('ticker-text');
    const pauseBtn = document.getElementById('ticker-pause-btn');
    if (ticker && pauseBtn) {
        let paused = false;
        pauseBtn.addEventListener('click', () => {
            paused = !paused;
            ticker.style.animationPlayState = paused ? 'paused' : 'running';
            pauseBtn.textContent = paused ? 'Lanjut' : 'Jeda';
        });
    }
})();
</script>
@endpush
