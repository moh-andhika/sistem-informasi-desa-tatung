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
        <section class="relative overflow-hidden group bg-linear-to-br from-prt-navy-dark via-prt-secondary to-prt-primary -mt-28" aria-label="Selamat Datang di Desa Tatung">
            <div class="absolute inset-0 z-0 opacity-85">
                <img
                    src="{{ asset('assets/images/jumbotron.jpg') }}"
                    alt="Foto bersama Perangkat Desa Tatung"
                    class="w-full h-full object-cover transition-transform duration-[15s] group-hover:scale-105"
                    loading="eager"
                />
            </div>
            <div class="absolute inset-0 bg-linear-to-b from-prt-secondary/5 via-prt-navy-dark/48 to-prt-navy-dark/60 z-5"></div>

            <x-public.container class="relative z-10 pt-28 sm:pt-36 lg:pt-44 pb-10 sm:pb-14 lg:pb-20 text-white">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-1 w-12  bg-prt-accent"></div>
                        <span class="text-xs font-semibold tracking-wide text-prt-gold-light">Portal Resmi</span>
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
                        <a href="{{ route('publik.layanan.informasi-surat') }}" class="inline-flex items-center  bg-prt-accent px-6 py-3 text-xs font-semibold tracking-wide text-slate-900 transition-all hover:-translate-y-0.5 hover:bg-prt-gold  hover:shadow-prt-accent/30 focus:ring-2 focus:ring-prt-accent focus:ring-offset-2">
                            <flux:icon.document-text class="size-5 mr-2" />
                            Layanan Surat Online
                        </a>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white text-xs font-semibold tracking-wide   transition-all hover:-translate-y-0.5 focus:ring-2 focus:ring-offset-2 focus:ring-white/50">
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
        <section class="ticker bg-prt-navy-dark-4  aria-label="Pengumuman penting">
            <x-public.container>
                <div class="ticker__inner">
                    <span class="ticker__label text-prt-accent">
                        <flux:icon.megaphone class="size-5" />
                        <span class="ml-2 text-lg font-bold text-black tracking-wide">Sekilas Info</span>
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
                    <button class="ticker__pause ! !text-prt-accent hover:!bg-prt-accent hover:!text-prt-navy-dark" id="ticker-pause-btn" type="button">Jeda</button>
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
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        <a href="{{ route('publik.layanan.informasi-surat') }}" class="group bg-white p-2 transition-all hover:-translate-y-0.5">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="bg-blue-50 p-2 transition-colors group-hover:bg-blue-100">
                                    <flux:icon.document-text class="size-5 text-prt-primary transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-prt-secondary sm:text-sm">Surat Keterangan</span>
                            </div>
                        </a>
                        <a href="#" class="group bg-white p-2 transition-all hover:-translate-y-0.5">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="bg-blue-50 p-2 transition-colors group-hover:bg-blue-100">
                                    <flux:icon.chat-bubble-left class="size-5 text-prt-primary transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-prt-secondary sm:text-sm">Pengaduan & Aspirasi</span>
                            </div>
                        </a>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="group bg-white p-2 transition-all hover:-translate-y-0.5">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="bg-blue-50 p-2 transition-colors group-hover:bg-blue-100">
                                    <flux:icon.newspaper class="size-5 text-prt-primary transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-prt-secondary sm:text-sm">Berita & Info</span>
                            </div>
                        </a>
                        <a href="{{ route('publik.transparansi.apbdes') }}" class="group bg-white p-2 transition-all hover:-translate-y-0.5">
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div class="bg-blue-50 p-2 transition-colors group-hover:bg-blue-100">
                                    <flux:icon.document-chart-bar class="size-5 text-prt-primary transition-transform group-hover:scale-110" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-slate-900 transition-colors group-hover:text-prt-secondary sm:text-sm">Transparansi APBDes</span>
                            </div>
                        </a>
                    </div>
                </section>

                <section aria-labelledby="berita-heading" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-prt-primary"></div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-wide" id="berita-heading">Berita Terbaru</h2>
                        </div>
                        <a href="{{ route('publik.publikasi.berita.index') }}" class="inline-flex items-center gap-1.5 min-h-11 px-3 py-2 text-sm font-semibold tracking-wide text-white bg-prt-primary transition-colors hover:bg-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-primary">
                            Lihat Semua <flux:icon.arrow-right class="size-4" />
                        </a>
                    </div>

                    @if ($beritaUtama)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Lead News Item — entire card is a single link --}}
                            <a href="{{ route('publik.publikasi.berita.show', $beritaUtama->slug) }}"
                               class="group block bg-white transition-shadow focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-primary">
                                <div class="w-full overflow-hidden bg-slate-100">
                                    @if ($beritaUtama->gambar)
                                        <img src="{{ $beritaUtama->gambar_url }}" alt="" class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
                                    @else
                                        <div class="w-full aspect-video flex items-center justify-center text-slate-300">
                                            <flux:icon.newspaper class="size-16" aria-hidden="true" />
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="inline-flex bg-prt-primary px-3 py-1 text-xs font-bold text-white">Berita Desa</span>
                                        <time datetime="{{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->toDateString() }}" class="text-sm font-semibold text-slate-600">
                                            {{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1.5 line-clamp-2 group-hover:text-prt-secondary transition-colors">{{ $beritaUtama->judul }}</h3>
                                    <p class="text-base text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $beritaUtama->ringkasan ?? Str::limit(strip_tags($beritaUtama->konten), 160) }}
                                    </p>
                                </div>
                            </a>

                            {{-- Secondary News Items --}}
                            <div class="flex flex-col gap-4">
                                @forelse ($beritaLainnya as $item)
                                    <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}"
                                       class="group flex gap-4 bg-white p-3 transition-shadow focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-primary">
                                        <div class="shrink-0 w-28 h-28 overflow-hidden bg-slate-100">
                                            @if ($item->gambar)
                                                <img src="{{ $item->gambar_url }}" alt="" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <flux:icon.newspaper class="size-8" aria-hidden="true" />
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="inline-flex bg-prt-secondary px-2 py-0.5 text-xs font-bold text-white mb-1.5">Artikel Baru</div>
                                            <h4 class="text-base font-bold text-slate-900 mb-1 line-clamp-2 group-hover:text-prt-secondary transition-colors">{{ $item->judul }}</h4>
                                            <p class="text-sm font-medium text-slate-600">
                                                {{ ($item->published_at ?? $item->created_at)?->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="bg-white p-4 text-center text-sm text-slate-600">
                                        Berita berikutnya akan tampil otomatis setelah data berita baru dipublikasikan.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="bg-white p-8 text-center">
                            <flux:icon.newspaper class="mx-auto size-12 text-slate-400" aria-hidden="true" />
                            <h3 class="mt-4 text-base font-bold tracking-wide text-slate-700">Belum Ada Berita</h3>
                            <p class="mt-2 text-sm text-slate-600">
                                Data berita terbaru akan muncul di sini setelah dipublikasikan dari panel admin.
                            </p>
                        </div>
                    @endif
                </section>

                {{-- TRANSPARENCY SECTION --}}
                <section aria-labelledby="apbdes-heading">
                    <div class="mb-2 flex items-center gap-3 pb-1">
                        <div class="h-8 w-2 bg-prt-accent"></div>
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-wide" id="apbdes-heading">Transparansi Anggaran Desa 2025</h2>
                        <a href="{{ route('publik.transparansi.apbdes') }}" class="ml-auto bg-prt-secondary px-4 py-2 text-xs font-semibold tracking-wide text-white transition-colors hover:bg-prt-navy-dark">
                            Laporan Lengkap &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                        {{-- Revenue Section --}}
                        <div class="bg-white p-2">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h3 class="text-sm font-bold tracking-wide text-prt-secondary">Pendapatan Desa</h3>
                                    <p class="mt-0.5 text-[11px] font-semibold tracking-wide text-prt-primary">Ringkasan Pendapatan</p>
                                </div>
                                <div class="bg-blue-50 p-1">
                                    <flux:icon.arrow-down-tray class="size-6 text-prt-primary" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="bg-gradient-to-r from-blue-50 to-white p-1.5">
                                    <div class="mb-1 inline-flex bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold tracking-wide text-prt-gold-dark">
                                        Target Pendapatan
                                    </div>
                                    <p class="text-2xl font-bold text-prt-secondary">Rp 1,77 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Dana Desa (DD)', 'val' => '850 Juta', 'p' => 72],
                                    ['label' => 'Alokasi Dana Desa (ADD)', 'val' => '320 Juta', 'p' => 65],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-bold text-slate-700">{{ $item['label'] }}</span>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-prt-secondary">{{ $item['p'] }}% Realisasi</p>
                                        </div>
                                    </div>
                                    <div class="h-3 w-full overflow-hidden bg-slate-100">
                                        <div class="h-full bg-gradient-to-r from-prt-accent to-prt-gold-dark transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Expenditure Section --}}
                        <div class="bg-white p-2">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h3 class="text-sm font-bold tracking-wide text-prt-secondary">Belanja Desa</h3>
                                    <p class="mt-0.5 text-[11px] font-semibold tracking-wide text-prt-primary">Ringkasan Belanja</p>
                                </div>
                                <div class="bg-blue-50 p-1">
                                    <flux:icon.arrow-up-tray class="size-6 text-prt-primary" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="bg-gradient-to-r from-blue-50 to-white p-1.5">
                                    <div class="mb-1 inline-flex bg-blue-100 px-2.5 py-0.5 text-[10px] font-bold tracking-wide text-prt-secondary">
                                        Realisasi Belanja
                                    </div>
                                    <p class="text-2xl font-bold text-prt-secondary">Rp 1,50 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Pembangunan Infrastruktur', 'val' => '520 Juta', 'p' => 60],
                                    ['label' => 'Pemberdayaan Masyarakat', 'val' => '195 Juta', 'p' => 45],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-bold text-slate-700">{{ $item['label'] }}</span>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-prt-primary">{{ $item['p'] }}% Realisasi</p>
                                        </div>
                                    </div>
                                    <div class="h-3 w-full overflow-hidden bg-slate-100">
                                        <div class="h-full bg-linear-to-r from-prt-primary to-prt-secondary transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- ─────────── RIGHT: Sidebar ─────────── --}}
            <aside class="space-y-2">
                {{-- Population Statistics Widget --}}
                <div class="overflow-hidden bg-white">
                    <div class="flex items-center justify-center bg-linear-to-r from-prt-secondary to-prt-primary px-3 py-2">
                        <h2 class="text-center text-sm font-bold tracking-wide text-white">Kependudukan</h2>
                    </div>
                    <div class="space-y-3 p-2">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-prt-secondary">2.847</p>
                            <p class="text-xs font-semibold text-slate-600 tracking-wide mt-1">Total Penduduk Desa</p>
                        </div>
                        <div class="space-y-2">
                            @foreach([['l' => 'Laki-laki', 'p' => 51, 'c' => 'from-prt-primary to-prt-secondary'], ['l' => 'Perempuan', 'p' => 49, 'c' => 'from-prt-accent to-prt-gold-dark']] as $s)
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-semibold text-slate-600 tracking-wide">
                                        <span>{{ $s['l'] }}</span>
                                        <span>{{ $s['p'] }}%</span>
                                    </div>
                                    <div class="h-2.5 bg-slate-100 overflow-hidden">
                                        <div class="bg-gradient-to-r {{ $s['c'] }} h-full transition-all duration-1000" style="width: {{ $s['p'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('infografis') }}" class="block w-full bg-blue-50 py-2 text-center text-xs font-semibold tracking-wide text-prt-primary transition-colors hover:bg-blue-100 hover:text-prt-secondary">
                            Lihat Infografis →
                        </a>
                    </div>
                </div>

                {{-- Head of Village Widget --}}
                <div class="overflow-hidden bg-white">
                    <div class="flex items-center justify-center bg-linear-to-r from-prt-secondary to-prt-primary px-3 py-2">
                        <h2 class="text-center text-sm font-bold tracking-wide text-white">Kepala Desa</h2>
                    </div>
                    <div class="space-y-2 p-2 text-center">
                        <div class="mx-auto h-52 w-52 overflow-hidden">
                            <img src="{{ asset('assets/images/kepala-desa.png') }}" class="w-full h-full object-cover" alt="Kepala Desa">
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 tracking-normal">Bapak Rudianto</h3>
                            <p class="mt-0.5 text-xs font-semibold tracking-wide text-prt-primary">Masa Jabatan 2020-2026</p>
                        </div>
                        <div class="pt-2">
                            <p class="text-xs text-slate-600 font-medium italic leading-relaxed">"Melayani dengan hati, membangun dengan bukti demi Desa Tatung yang mandiri."</p>
                        </div>
                    </div>
                </div>

                {{-- Important Information Widget --}}
                <div class="overflow-hidden bg-white">
                    <div class="flex items-center justify-center bg-gradient-to-r from-prt-secondary to-prt-primary px-3 py-2">
                        <h2 class="text-center text-sm font-bold tracking-wide text-white">Informasi Penting</h2>
                    </div>
                    <div class="space-y-2 p-2">
                        <div class="bg-blue-50 p-2">
                            <p class="text-xs font-bold text-slate-700">Jam Layanan</p>
                            <p class="text-sm text-slate-900 font-bold mt-0.5">Senin - Jumat: 08:00 - 16:00</p>
                        </div>
                        <div class="bg-emerald-50 p-2">
                            <p class="text-xs font-bold text-slate-700">Kontak Layanan</p>
                            <p class="text-sm text-slate-900 font-bold mt-0.5">(0352) XXXXXXX</p>
                        </div>
                        <div class="bg-amber-50 p-2">
                            <p class="text-xs font-bold text-slate-700">Email</p>
                            <p class="text-sm text-slate-900 font-bold mt-0.5 break-all">info@tatung.desa.id</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        {{-- GOVERNMENT STAFF SECTION --}}
        <section class="mt-4">
            <div class="text-center mb-2">
                <h2 class="text-2xl font-bold text-slate-900 tracking-wide">Perangkat Pemerintah Desa Tatung</h2>
            </div>
            <div class="max-w-full overflow-hidden">
                <div class="aparatur-strip">
                @forelse ($perangkatDesa as $p)
                    <article class="group w-56 shrink-0 text-center sm:w-64">
                        <div class="mx-auto mb-2 aspect-4/5 w-full overflow-hidden transition-all">
                            @if ($p->gambar)
                                <img src="{{ Storage::url($p->gambar) }}" alt="{{ $p->nama }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-slate-100 text-slate-300">
                                    <flux:icon.user class="size-12" />
                                </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 transition-colors group-hover:text-prt-secondary">{{ $p->nama }}</h3>
                        <p class="mt-1 text-xs font-medium text-prt-primary">{{ $p->jabatan }}</p>
                    </article>
                @empty
                    <div class="flex items-center justify-center w-full py-8 text-slate-400">
                        <p>Data perangkat desa belum tersedia.</p>
                    </div>
                @endforelse
                {{-- Duplicate for infinite scroll marquee effect --}}
                @if ($perangkatDesa->isNotEmpty())
                    @foreach ($perangkatDesa as $p)
                        <article class="group w-56 shrink-0 text-center sm:w-64" aria-hidden="true">
                            <div class="mx-auto mb-2 aspect-4/5 w-full overflow-hidden transition-all">
                                @if ($p->gambar)
                                    <img src="{{ Storage::url($p->gambar) }}" alt="" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-slate-100 text-slate-300">
                                        <flux:icon.user class="size-12" />
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 transition-colors group-hover:text-prt-secondary">{{ $p->nama }}</h3>
                            <p class="mt-1 text-xs font-medium text-prt-primary">{{ $p->jabatan }}</p>
                        </article>
                    @endforeach
                @endif
                </div>
            </div>
        </section>

        {{-- GALLERY & FEATURED SECTIONS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            {{-- Photo Gallery Section --}}
            <section class="space-y-2">
                <div class="flex items-center gap-3 pb-1">
                    <div class="h-6 w-1.5 bg-prt-primary"></div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-wide">Galeri Foto</h2>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    @forelse ($galeri->take(4) as $g)
                        <div class="group relative overflow-hidden transition-shadow">
                            <img src="{{ Storage::url($g->gambar) }}" alt="{{ $g->judul }}" class="aspect-square object-cover w-full group-hover:scale-110 transition-transform duration-300" loading="lazy">
                            <div class="absolute inset-0 bg-prt-secondary/0 transition-colors duration-300 group-hover:bg-prt-secondary/20"></div>
                        </div>
                    @empty
                        <div class="col-span-2 py-8 text-center text-slate-400">
                            <p>Belum ada galeri foto.</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('publik.profil.sejarah') }}" class="block w-full bg-prt-secondary py-2 text-center text-xs font-semibold tracking-wide text-white transition-colors hover:bg-prt-navy-dark">
                    Lihat Semua Galeri
                </a>
            </section>

            {{-- Potential Section --}}
            <section class="space-y-2">
                <div class="flex items-center gap-3 pb-1">
                    <div class="h-6 w-1.5 bg-prt-primary"></div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-wide">Potensi Desa</h2>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('publik.potensi.umkm') }}" class="group block relative overflow-hidden h-40">
                        <img src="{{ asset('assets/images/background.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 flex items-end bg-linear-to-t from-prt-secondary/90 to-prt-primary/25 p-4">
                            <span class="text-white font-bold text-sm tracking-wide">UMKM Tatung</span>
                        </div>
                    </a>
                    <a href="{{ route('publik.potensi.pariwisata') }}" class="group block relative overflow-hidden h-40">
                        <img src="{{ asset('assets/images/background.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 flex items-end bg-linear-to-t from-prt-secondary/90 to-prt-primary/25 p-4">
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
