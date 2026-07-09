@extends('layouts.public')

@section('title', 'Beranda – Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo')

@php
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
        {{-- JUMBOTRON --}}
        <section class="relative overflow-hidden group bg-prt-navy-dark -mt-28" aria-label="Selamat Datang di Desa Tatung">
            <div class="absolute inset-0 z-0 opacity-85" aria-hidden="true">
                <img
                    src="{{ asset('assets/images/jumbotron.jpg') }}"
                    alt=""
                    class="w-full h-full object-cover transition-transform duration-[15s] group-hover:scale-105"
                    loading="eager"
                />
            </div>
            <div class="absolute inset-0 bg-prt-navy-dark/50 z-5" aria-hidden="true"></div>

            <x-public.container class="relative z-10 pt-28 sm:pt-36 lg:pt-44 pb-10 sm:pb-14 lg:pb-20">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-1 w-12 bg-prt-accent" aria-hidden="true"></div>
                        <span class="text-xs font-semibold tracking-wide text-prt-gold-light">Portal Resmi</span>
                    </div>
                    <h1 class="text-3xl sm:text-6xl lg:text-7xl tracking-normal leading-[1.1] mb-4 text-white">
                        Pemerintah Desa Tatung
                    </h1>
                    <p class="text-base sm:text-lg text-white leading-relaxed mb-2 font-medium">
                        Kecamatan Balong, Kabupaten Ponorogo, Jawa Timur
                    </p>
                    <p class="text-base sm:text-lg text-white leading-relaxed mb-6 max-w-2xl font-medium">
                        Melayani dengan transparansi, inovasi, dan komitmen penuh untuk pembangunan desa yang berkelanjutan dan kesejahteraan seluruh warga masyarakat.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a
                            href="{{ route('publik.layanan.informasi-surat') }}"
                            class="inline-flex items-center bg-prt-accent px-6 py-3.5 text-sm font-bold tracking-wide text-black transition-all hover:-translate-y-0.5 hover:bg-prt-gold focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px]"
                        >
                            <flux:icon.document-text class="size-5 mr-2 shrink-0" aria-hidden="true" />
                            <span>Layanan Surat Online</span>
                        </a>
                        <a
                            href="{{ route('publik.publikasi.berita.index') }}"
                            class="inline-flex items-center px-6 py-3.5 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white text-sm font-bold tracking-wide rounded border border-white/30 transition-all hover:-translate-y-0.5 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/50 min-h-[44px]"
                        >
                            <flux:icon.newspaper class="size-5 mr-2 shrink-0" aria-hidden="true" />
                            <span>Berita Terbaru</span>
                        </a>
                    </div>
                </div>
            </x-public.container>
        </section>

        {{-- TICKER --}}
        <section class="ticker bg-prt-navy-dark" aria-labelledby="ticker-heading">
            <h2 id="ticker-heading" class="prt-sr-only">Pengumuman &amp; Informasi Terkini</h2>
            <x-public.container>
                <div class="ticker__inner">
                    <span class="ticker__label text-prt-accent" aria-hidden="true">
                        <flux:icon.megaphone class="size-5 shrink-0" aria-hidden="true" />
                        <span class="ml-2 text-lg font-bold text-white tracking-wide">Sekilas Info</span>
                    </span>
                    <div class="ticker__track" role="marquee" aria-live="off">
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
                    <button
                        class="ticker__pause text-prt-accent hover:bg-prt-accent hover:text-prt-navy-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[36px] min-w-[60px]"
                        id="ticker-pause-btn"
                        type="button"
                        aria-label="Jeda atau lanjutkan pengumuman berjalan"
                    >
                        <span aria-hidden="true">Jeda</span>
                        <span class="prt-sr-only" id="ticker-pause-sr">menjedakan teks pengumuman</span>
                    </button>
                </div>
            </x-public.container>
        </section>
    </div>
@endsection

@section('content')
    <div class="portal-page">
        <div class="prt-layout pt-3">
            {{-- MAIN CONTENT --}}
            <div class="space-y-8">

                {{-- STATS STRIP --}}
                <section aria-label="Statistik kependudukan desa">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20">
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">2.847</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Total Penduduk</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20">
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">1.024</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Kepala Keluarga</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20">
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">4</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Dusun</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20">
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">12,5 km²</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Luas Wilayah</p>
                        </div>
                    </div>
                </section>

                {{-- LAYANAN UNGGULAN --}}
                <section aria-labelledby="layanan-heading">
                    <div class="flex items-center gap-3 border-b border-prt-primary/15 pb-2 mb-3">
                        <div class="h-7 w-1 bg-prt-primary" aria-hidden="true"></div>
                        <h2 class="text-xl sm:text-2xl font-bold text-prt-ink" id="layanan-heading">Layanan Unggulan</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <a
                            href="{{ route('publik.layanan.informasi-surat') }}"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-sm hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px]"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.document-text class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Surat Keterangan</span>
                            </div>
                        </a>
                        <a
                            href="#"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-sm hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px]"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.chat-bubble-left class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Pengaduan &amp; Aspirasi</span>
                            </div>
                        </a>
                        <a
                            href="{{ route('publik.publikasi.berita.index') }}"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-sm hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px]"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.newspaper class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Berita &amp; Info</span>
                            </div>
                        </a>
                        <a
                            href="{{ route('publik.transparansi.apbdes') }}"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-sm hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px]"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.document-chart-bar class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Transparansi APBDes</span>
                            </div>
                        </a>
                    </div>
                </section>

                {{-- NEWS --}}
                <section aria-labelledby="berita-heading" class="space-y-4">
                    <div class="flex items-center justify-between border-b border-prt-primary/15 pb-2">
                        <div class="flex items-center gap-3">
                            <div class="h-7 w-1 bg-prt-primary" aria-hidden="true"></div>
                            <h2 class="text-xl sm:text-2xl font-bold text-prt-ink" id="berita-heading">Berita Terbaru</h2>
                        </div>
                        <a
                            href="{{ route('publik.publikasi.berita.index') }}"
                            class="inline-flex items-center gap-1.5 text-sm font-semibold text-prt-primary transition-colors hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                        >
                            Lihat Semua
                            <flux:icon.arrow-right class="size-4" aria-hidden="true" />
                        </a>
                    </div>

                    @if ($beritaUtama)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Lead News --}}
                            <a
                                href="{{ route('publik.publikasi.berita.show', $beritaUtama->slug) }}"
                                class="group block border border-prt-primary/8 bg-white transition-all hover:border-prt-primary/20 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                                aria-labelledby="berita-utama-title"
                            >
                                <div class="w-full overflow-hidden bg-prt-primary/5" aria-hidden="true">
                                    @if ($beritaUtama->gambar)
                                        <img src="{{ $beritaUtama->gambar_url }}" alt="" class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
                                    @else
                                        <div class="w-full aspect-video flex items-center justify-center text-prt-muted">
                                            <flux:icon.newspaper class="size-16" aria-hidden="true" />
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <div class="flex flex-wrap items-center gap-3 mb-2">
                                        <span class="inline-flex bg-prt-primary px-3 py-1 text-xs font-bold text-white">Berita Desa</span>
                                        <time datetime="{{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->toDateString() }}" class="text-sm font-semibold text-prt-muted">
                                            {{ ($beritaUtama->published_at ?? $beritaUtama->created_at)?->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                    <h3 class="text-lg font-bold text-prt-ink mb-1.5 line-clamp-2 group-hover:text-prt-secondary transition-colors" id="berita-utama-title">{{ $beritaUtama->judul }}</h3>
                                    <p class="text-base text-prt-muted leading-relaxed line-clamp-3">
                                        {{ $beritaUtama->ringkasan ?? Str::limit(strip_tags($beritaUtama->konten), 160) }}
                                    </p>
                                </div>
                            </a>

                            {{-- Secondary News --}}
                            <div class="flex flex-col gap-4">
                                @forelse ($beritaLainnya as $item)
                                    <a
                                        href="{{ route('publik.publikasi.berita.show', $item->slug) }}"
                                        class="group flex gap-4 border border-prt-primary/8 bg-white p-4 transition-all hover:border-prt-primary/20 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                                        aria-labelledby="berita-item-{{ $item->id }}-title"
                                    >
                                        <div class="shrink-0 w-28 h-28 overflow-hidden bg-prt-primary/5" aria-hidden="true">
                                            @if ($item->gambar)
                                                <img src="{{ $item->gambar_url }}" alt="" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-prt-muted">
                                                    <flux:icon.newspaper class="size-8" aria-hidden="true" />
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="inline-flex bg-prt-secondary px-2 py-0.5 text-xs font-bold text-white mb-1.5">Artikel Baru</div>
                                            <h3 class="text-base font-bold text-prt-ink mb-1 line-clamp-2 group-hover:text-prt-secondary transition-colors" id="berita-item-{{ $item->id }}-title">{{ $item->judul }}</h3>
                                            <p class="text-sm font-medium text-prt-muted">
                                                <time datetime="{{ ($item->published_at ?? $item->created_at)?->toDateString() }}">
                                                    {{ ($item->published_at ?? $item->created_at)?->translatedFormat('d F Y') }}
                                                </time>
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="bg-white p-4 text-center text-sm text-prt-muted" role="status">
                                        Berita berikutnya akan tampil otomatis setelah data berita baru dipublikasikan.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="bg-white p-8 text-center" role="status">
                            <flux:icon.newspaper class="mx-auto size-12 text-prt-muted/50" aria-hidden="true" />
                            <h3 class="mt-4 text-base font-bold text-prt-ink">Belum Ada Berita</h3>
                            <p class="mt-2 text-sm text-prt-muted">
                                Data berita terbaru akan muncul di sini setelah dipublikasikan dari panel admin.
                            </p>
                        </div>
                    @endif
                </section>

                {{-- TRANSPARANSI ANGGARAN --}}
                <section aria-labelledby="apbdes-heading" class="bg-prt-primary/[0.02] -mx-3 px-3 py-4">
                    <div class="flex flex-wrap items-center gap-3 mb-4 border-b border-prt-primary/15 pb-2">
                        <div class="h-7 w-1 bg-prt-accent" aria-hidden="true"></div>
                        <h2 class="text-lg sm:text-xl font-bold text-prt-ink" id="apbdes-heading">Transparansi Anggaran Desa 2025</h2>
                        <a
                            href="{{ route('publik.transparansi.apbdes') }}"
                            class="ml-auto bg-prt-secondary px-4 py-2 text-xs font-semibold text-white transition-colors hover:bg-prt-navy-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[36px]"
                        >
                            Laporan Lengkap &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        {{-- Revenue --}}
                        <div class="border border-prt-primary/8 bg-white p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h3 class="text-sm font-bold text-prt-secondary">Pendapatan Desa</h3>
                                    <p class="mt-0.5 text-[11px] font-semibold text-prt-primary">Ringkasan Pendapatan</p>
                                </div>
                                <div class="bg-prt-primary/8 p-1.5" aria-hidden="true">
                                    <flux:icon.arrow-down-tray class="size-5 text-prt-primary" aria-hidden="true" />
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="bg-prt-primary/5 p-3">
                                    <span class="mb-1 inline-flex bg-prt-accent/15 px-2.5 py-0.5 text-[10px] font-bold text-prt-gold-dark">
                                        Target Pendapatan
                                    </span>
                                    <p class="text-2xl font-bold text-prt-secondary mt-1">Rp 1,77 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Dana Desa (DD)', 'val' => '850 Juta', 'p' => 72],
                                    ['label' => 'Alokasi Dana Desa (ADD)', 'val' => '320 Juta', 'p' => 65],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center gap-2 mb-1.5">
                                        <span class="text-sm font-bold text-prt-ink">{{ $item['label'] }}</span>
                                        <div class="text-right shrink-0">
                                            <p class="text-sm font-bold text-prt-ink">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-prt-secondary">{{ $item['p'] }}%</p>
                                        </div>
                                    </div>
                                    <div
                                        class="h-3 w-full overflow-hidden bg-prt-primary/8"
                                        role="progressbar"
                                        aria-valuenow="{{ $item['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="{{ $item['label'] }}: {{ $item['p'] }}% realisasi"
                                    >
                                        <div class="h-full bg-prt-accent transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Expenditure --}}
                        <div class="border border-prt-primary/8 bg-white p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h3 class="text-sm font-bold text-prt-secondary">Belanja Desa</h3>
                                    <p class="mt-0.5 text-[11px] font-semibold text-prt-primary">Ringkasan Belanja</p>
                                </div>
                                <div class="bg-prt-primary/8 p-1.5" aria-hidden="true">
                                    <flux:icon.arrow-up-tray class="size-5 text-prt-primary" aria-hidden="true" />
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="bg-prt-primary/5 p-3">
                                    <span class="mb-1 inline-flex bg-prt-primary/10 px-2.5 py-0.5 text-[10px] font-bold text-prt-secondary">
                                        Realisasi Belanja
                                    </span>
                                    <p class="text-2xl font-bold text-prt-secondary mt-1">Rp 1,50 Miliar</p>
                                </div>

                                @foreach([
                                    ['label' => 'Pembangunan Infrastruktur', 'val' => '520 Juta', 'p' => 60],
                                    ['label' => 'Pemberdayaan Masyarakat', 'val' => '195 Juta', 'p' => 45],
                                ] as $item)
                                <div>
                                    <div class="flex justify-between items-center gap-2 mb-1.5">
                                        <span class="text-sm font-bold text-prt-ink">{{ $item['label'] }}</span>
                                        <div class="text-right shrink-0">
                                            <p class="text-sm font-bold text-prt-ink">Rp {{ $item['val'] }}</p>
                                            <p class="text-xs font-bold text-prt-primary">{{ $item['p'] }}%</p>
                                        </div>
                                    </div>
                                    <div
                                        class="h-3 w-full overflow-hidden bg-prt-primary/8"
                                        role="progressbar"
                                        aria-valuenow="{{ $item['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="{{ $item['label'] }}: {{ $item['p'] }}% realisasi"
                                    >
                                        <div class="h-full bg-prt-primary transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- SIDEBAR --}}
            <aside class="space-y-3" aria-label="Informasi tambahan">
                {{-- Population Stats --}}
                <div class="border border-prt-primary/8 bg-white">
                    <div class="flex items-center justify-center bg-prt-secondary px-4 py-3">
                        <h2 class="text-center text-sm font-bold text-white">Kependudukan</h2>
                    </div>
                    <div class="space-y-4 p-4">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-prt-secondary">2.847</p>
                            <p class="text-xs font-semibold text-prt-muted mt-1" style="letter-spacing: 0.04em">TOTAL PENDUDUK</p>
                        </div>
                        <div class="space-y-3">
                            @foreach([['l' => 'Laki-laki', 'p' => 51, 'bg' => 'bg-prt-primary'], ['l' => 'Perempuan', 'p' => 49, 'bg' => 'bg-prt-accent']] as $s)
                                <div class="space-y-1.5">
                                    <div class="flex justify-between text-xs font-semibold text-prt-muted">
                                        <span>{{ $s['l'] }}</span>
                                        <span>{{ $s['p'] }}%</span>
                                    </div>
                                    <div
                                        class="h-2.5 bg-prt-primary/8 overflow-hidden"
                                        role="progressbar"
                                        aria-valuenow="{{ $s['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="Proporsi {{ $s['l'] }}: {{ $s['p'] }}%"
                                    >
                                        <div class="{{ $s['bg'] }} h-full transition-all duration-1000" style="width: {{ $s['p'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a
                            href="{{ route('infografis') }}"
                            class="block w-full border border-prt-primary/15 bg-prt-primary/5 py-2.5 text-center text-xs font-semibold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[36px]"
                        >
                            Lihat Infografis →
                        </a>
                    </div>
                </div>

                {{-- Head of Village --}}
                <div class="border border-prt-primary/8 bg-white">
                    <div class="flex items-center justify-center bg-prt-secondary px-4 py-3">
                        <h2 class="text-center text-sm font-bold text-white">Kepala Desa</h2>
                    </div>
                    <div class="space-y-3 p-4 text-center">
                        <div class="mx-auto h-48 w-48 overflow-hidden">
                            <img src="{{ asset('assets/images/kepala-desa.png') }}" class="w-full h-full object-cover" alt="Potret Kepala Desa Tatung, Bapak Rudianto">
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-prt-ink">Bapak Rudianto</h3>
                            <p class="mt-0.5 text-xs font-semibold text-prt-primary">Masa Jabatan 2020-2026</p>
                        </div>
                        <div class="pt-2 border-t border-prt-primary/8">
                            <p class="text-xs text-prt-muted font-medium italic leading-relaxed">"Melayani dengan hati, membangun dengan bukti demi Desa Tatung yang mandiri."</p>
                        </div>
                    </div>
                </div>

                {{-- Important Info --}}
                <div class="border border-prt-primary/8 bg-white">
                    <div class="flex items-center justify-center bg-prt-secondary px-4 py-3">
                        <h2 class="text-center text-sm font-bold text-white">Informasi Penting</h2>
                    </div>
                    <div class="space-y-2 p-4">
                        <div class="flex items-start gap-3 border-l-2 border-prt-primary bg-prt-primary/5 p-3">
                            <flux:icon.clock class="size-4 text-prt-primary shrink-0 mt-0.5" aria-hidden="true" />
                            <div>
                                <p class="text-xs font-bold text-prt-ink">Jam Layanan</p>
                                <p class="text-sm text-prt-ink font-bold mt-0.5">Senin - Jumat: 08:00 - 16:00</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 border-l-2 border-prt-gold bg-prt-accent/8 p-3">
                            <flux:icon.phone class="size-4 text-prt-gold-dark shrink-0 mt-0.5" aria-hidden="true" />
                            <div>
                                <p class="text-xs font-bold text-prt-ink">Kontak Layanan</p>
                                <p class="text-sm text-prt-ink font-bold mt-0.5">(0352) XXXXXXX</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 border-l-2 border-prt-gold bg-prt-gold/8 p-3">
                            <flux:icon.envelope class="size-4 text-prt-gold-dark shrink-0 mt-0.5" aria-hidden="true" />
                            <div>
                                <p class="text-xs font-bold text-prt-ink">Email</p>
                                <p class="text-sm text-prt-ink font-bold mt-0.5 break-all">info@tatung.desa.id</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        {{-- CTA BANNER --}}
        <section aria-label="Ajakan menggunakan layanan desa" class="bg-prt-secondary mt-4">
            <x-public.container class="flex flex-col items-center text-center py-8 sm:py-10">
                <h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Butuh Surat Keterangan Desa?</h2>
                <p class="text-sm sm:text-base text-prt-blue-light max-w-lg mb-4">Ajukan permohonan secara online tanpa harus datang ke kantor. Proses cepat, transparan, dan terpantau.</p>
                <a
                    href="{{ route('publik.layanan.informasi-surat') }}"
                    class="inline-flex items-center bg-prt-accent px-6 py-3 text-sm font-bold text-black transition-all hover:bg-prt-gold hover:-translate-y-0.5 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px]"
                >
                    <flux:icon.document-text class="size-5 mr-2 shrink-0" aria-hidden="true" />
                    <span>Ajukan Sekarang</span>
                </a>
            </x-public.container>
        </section>

        {{-- APARATUR STRIP --}}
        <section class="bg-prt-primary/[0.02] py-5" aria-labelledby="aparatur-heading">
            <div class="text-center mb-4">
                <h2 class="text-xl sm:text-2xl font-bold text-prt-ink" id="aparatur-heading">Perangkat Pemerintah Desa Tatung</h2>
            </div>
            <div class="max-w-full overflow-hidden">
                <div class="aparatur-strip" role="list" aria-label="Daftar perangkat desa">
                @forelse ($perangkatDesa as $p)
                    <article class="group w-56 shrink-0 text-center sm:w-64" role="listitem">
                        <div class="mx-auto mb-2 aspect-4/5 w-full overflow-hidden transition-all">
                            @if ($p->gambar)
                                <img src="{{ Storage::url($p->gambar) }}" alt="Foto: {{ $p->nama }}, {{ $p->jabatan }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-prt-primary/5 text-prt-muted" aria-hidden="true">
                                    <flux:icon.user class="size-12" aria-hidden="true" />
                                </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-bold text-prt-ink transition-colors group-hover:text-prt-secondary">{{ $p->nama }}</h3>
                        <p class="mt-1 text-xs font-medium text-prt-primary">{{ $p->jabatan }}</p>
                    </article>
                @empty
                    <div class="flex items-center justify-center w-full py-8 text-prt-muted" role="status">
                        <p>Data perangkat desa belum tersedia.</p>
                    </div>
                @endforelse
                @if ($perangkatDesa->isNotEmpty())
                    @foreach ($perangkatDesa as $p)
                        <article class="group w-56 shrink-0 text-center sm:w-64" aria-hidden="true">
                            <div class="mx-auto mb-2 aspect-4/5 w-full overflow-hidden transition-all">
                                @if ($p->gambar)
                                    <img src="{{ Storage::url($p->gambar) }}" alt="" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-prt-primary/5 text-prt-muted" aria-hidden="true">
                                        <flux:icon.user class="size-12" aria-hidden="true" />
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-sm font-bold text-prt-ink transition-colors group-hover:text-prt-secondary">{{ $p->nama }}</h3>
                            <p class="mt-1 text-xs font-medium text-prt-primary">{{ $p->jabatan }}</p>
                        </article>
                    @endforeach
                @endif
                </div>
            </div>
        </section>

        {{-- GALERI & POTENSI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            {{-- Photo Gallery --}}
            <section class="space-y-3" aria-labelledby="galeri-heading">
                <div class="flex items-center gap-3 border-b border-prt-primary/15 pb-2">
                    <div class="h-5 w-1 bg-prt-primary" aria-hidden="true"></div>
                    <h2 class="text-lg font-bold text-prt-ink" id="galeri-heading">Galeri Foto</h2>
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    @forelse ($galeri->take(4) as $g)
                        <div class="group relative overflow-hidden border border-prt-primary/8 transition-shadow hover:shadow-sm">
                            <img src="{{ Storage::url($g->gambar) }}" alt="" class="aspect-square object-cover w-full group-hover:scale-110 transition-transform duration-300" loading="lazy">
                            <div class="absolute inset-0 bg-prt-secondary/0 transition-colors duration-300 group-hover:bg-prt-secondary/20" aria-hidden="true"></div>
                        </div>
                    @empty
                        <div class="col-span-2 py-8 text-center text-prt-muted" role="status">
                            <p>Belum ada galeri foto.</p>
                        </div>
                    @endforelse
                </div>
                <a
                    href="{{ route('publik.profil.sejarah') }}"
                    class="block w-full border border-prt-primary/15 bg-prt-primary/5 py-2.5 text-center text-xs font-semibold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[36px]"
                >
                    Lihat Semua Galeri
                </a>
            </section>

            {{-- Potensi --}}
            <section class="space-y-3" aria-labelledby="potensi-heading">
                <div class="flex items-center gap-3 border-b border-prt-primary/15 pb-2">
                    <div class="h-5 w-1 bg-prt-primary" aria-hidden="true"></div>
                    <h2 class="text-lg font-bold text-prt-ink" id="potensi-heading">Potensi Desa</h2>
                </div>
                <div class="space-y-2.5">
                    <a
                        href="{{ route('publik.potensi.umkm') }}"
                        class="group block relative overflow-hidden h-40 border border-prt-primary/8 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                    >
                        <img src="{{ asset('assets/images/background.jpg') }}" alt="Kunjungi halaman UMKM Tatung" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy">
                        <div class="absolute inset-0 flex items-end bg-prt-secondary/70 p-4" aria-hidden="true">
                            <span class="text-white font-bold text-sm tracking-wide drop-shadow-sm">UMKM Tatung</span>
                        </div>
                    </a>
                    <a
                        href="{{ route('publik.potensi.pariwisata') }}"
                        class="group block relative overflow-hidden h-40 border border-prt-primary/8 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                    >
                        <img src="{{ asset('assets/images/background.jpg') }}" alt="Kunjungi halaman Pariwisata Tatung" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy">
                        <div class="absolute inset-0 flex items-end bg-prt-secondary/70 p-4" aria-hidden="true">
                            <span class="text-white font-bold text-sm tracking-wide drop-shadow-sm">Pariwisata</span>
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
    var ticker = document.getElementById('ticker-text');
    var pauseBtn = document.getElementById('ticker-pause-btn');
    if (ticker && pauseBtn) {
        var paused = false;
        pauseBtn.addEventListener('click', function () {
            paused = !paused;
            ticker.style.animationPlayState = paused ? 'paused' : 'running';
            pauseBtn.querySelector('[aria-hidden]').textContent = paused ? 'Lanjut' : 'Jeda';
            pauseBtn.querySelector('.prt-sr-only').textContent = paused
                ? 'melanjutkan teks pengumuman'
                : 'menjedakan teks pengumuman';
        });
    }
})();
</script>
@endpush
