@extends('layouts.public')
@php
    $beritaUtama = $beritaUtama ?? ($beritaTerbaru ?? collect())->first();
    $beritaLainnya = $beritaLainnya ?? ($beritaTerbaru ?? collect())->skip(1)->values();
@endphp


@section('title', 'Beranda – Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo')


@section('header_content')
        {{-- JUMBOTRON --}}
        <section class="relative overflow-hidden group bg-prt-navy-dark -mt-[4.5rem] min-h-screen flex items-center" aria-label="Selamat Datang di Desa Tatung">
            <div class="absolute inset-0 z-0 opacity-85" aria-hidden="true">
                <img
                    src="{{ $jumbotron?->gambar_url ?? (asset('assets/images/jumbotron.jpg') . '?v=' . filemtime(public_path('assets/images/jumbotron.jpg'))) }}"
                    alt=""
                    class="w-full h-full object-cover transition-transform duration-[15s] group-hover:scale-105"
                    loading="eager"
                />
            </div>
            <div class="absolute inset-0 bg-prt-navy-dark/50 z-5" aria-hidden="true"></div>

            <x-public.container class="relative z-10 py-8 sm:py-12 lg:py-16">
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
                            class="inline-flex items-center bg-prt-accent px-6 py-3.5 text-sm font-bold tracking-wide text-black transition-all hover:-translate-y-0.5 hover:bg-prt-gold hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] rounded-lg shadow-sm"
                        >
                            <flux:icon.document-text class="size-5 mr-2 shrink-0" aria-hidden="true" />
                            <span>Layanan Surat Online</span>
                        </a>
                        <a
                            href="{{ route('publik.publikasi.berita.index') }}"
                            class="inline-flex items-center px-6 py-3.5 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white text-sm font-bold tracking-wide border border-white/30 transition-all hover:-translate-y-0.5 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/50 min-h-[44px] rounded-lg shadow-sm"
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
                    <div class="ticker__track" aria-live="off">
                        <p class="ticker__text text-lg text-white" id="ticker-text">
                            @forelse ($runningTexts ?? collect() as $item)
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
                        class="ticker__pause text-white hover:bg-prt-accent hover:text-prt-navy-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] min-w-[44px] rounded-lg"
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
@endsection

@section('content')
        <div class="prt-layout">
            {{-- MAIN CONTENT --}}
            <div class="space-y-8">

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
                        {{-- Lead News — horizontal --}}
                        <a
                            href="{{ route('publik.publikasi.berita.show', $beritaUtama->slug) }}"
                            class="group flex flex-col sm:flex-row border border-prt-primary/8 bg-white transition-all hover:border-prt-primary/20 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent rounded-lg shadow-sm overflow-hidden"
                            aria-labelledby="berita-utama-title"
                        >
                            <div class="shrink-0 w-full sm:w-72 lg:w-80 overflow-hidden bg-prt-primary/5" aria-hidden="true">
                                @if ($beritaUtama->gambar)
                                    <img src="{{ $beritaUtama->gambar_url }}" alt="" class="w-full h-48 sm:h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
                                @else
                                    <div class="w-full h-48 sm:h-full flex items-center justify-center text-prt-muted">
                                        <flux:icon.newspaper class="size-16" aria-hidden="true" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center p-5 min-w-0">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="inline-flex bg-prt-primary px-3 py-1 text-xs font-bold text-white rounded-md">Berita Desa</span>
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

                        {{-- Secondary News — 3-col grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse ($beritaLainnya as $item)
                                <a
                                    href="{{ route('publik.publikasi.berita.show', $item->slug) }}"
                                    class="group flex flex-col border border-prt-primary/8 bg-white transition-all hover:border-prt-primary/20 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent rounded-lg shadow-sm overflow-hidden"
                                    aria-labelledby="berita-item-{{ $item->id }}-title"
                                >
                                    <div class="shrink-0 w-full h-40 overflow-hidden bg-prt-primary/5" aria-hidden="true">
                                        @if ($item->gambar)
                                            <img src="{{ $item->gambar_url }}" alt="" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-prt-muted">
                                                <flux:icon.newspaper class="size-8" aria-hidden="true" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col flex-1 p-4">
                                        <div class="inline-flex bg-prt-secondary px-2 py-0.5 text-xs font-bold text-white mb-1.5 rounded-md w-fit">Artikel Baru</div>
                                        <h3 class="text-base font-bold text-prt-ink mb-1 line-clamp-2 group-hover:text-prt-secondary transition-colors" id="berita-item-{{ $item->id }}-title">{{ $item->judul }}</h3>
                                        <p class="text-sm font-medium text-prt-muted mt-auto">
                                            <time datetime="{{ ($item->published_at ?? $item->created_at)?->toDateString() }}">
                                                {{ ($item->published_at ?? $item->created_at)?->translatedFormat('d F Y') }}
                                            </time>
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <div class="sm:col-span-2 lg:col-span-3 bg-white p-4 text-center text-sm text-prt-muted rounded-lg" role="status">
                                    Berita berikutnya akan tampil otomatis setelah data berita baru dipublikasikan.
                                </div>
                            @endforelse
                        </div>
                    @else
                        <div class="bg-white p-8 text-center rounded-lg shadow-sm" role="status">
                            <flux:icon.newspaper class="mx-auto size-12 text-prt-muted/50" aria-hidden="true" />
                            <h3 class="mt-4 text-base font-bold text-prt-ink">Belum Ada Berita</h3>
                            <p class="mt-2 text-sm text-prt-muted">
                                Data berita terbaru akan muncul di sini setelah dipublikasikan dari panel admin.
                            </p>
                        </div>
                    @endif
                </section>

                {{-- STATS STRIP --}}
                <section aria-label="Statistik kependudukan desa" class="mb-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20 hover:shadow-md rounded-lg shadow-sm">
                            <flux:icon.users class="size-6 text-prt-primary mx-auto mb-2" aria-hidden="true" />
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">2.847</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Total Penduduk</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20 hover:shadow-md rounded-lg shadow-sm">
                            <flux:icon.home class="size-6 text-prt-primary mx-auto mb-2" aria-hidden="true" />
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">1.024</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Kepala Keluarga</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20 hover:shadow-md rounded-lg shadow-sm">
                            <flux:icon.map-pin class="size-6 text-prt-primary mx-auto mb-2" aria-hidden="true" />
                            <p class="text-2xl sm:text-3xl font-bold text-prt-secondary">4</p>
                            <p class="text-[10px] font-semibold text-prt-muted mt-1 uppercase tracking-wide">Dusun</p>
                        </div>
                        <div class="border border-prt-primary/8 bg-white p-4 text-center transition-all hover:border-prt-primary/20 hover:shadow-md rounded-lg shadow-sm">
                            <flux:icon.globe-alt class="size-6 text-prt-primary mx-auto mb-2" aria-hidden="true" />
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
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-md hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px] rounded-lg shadow-sm"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 rounded-lg transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.document-text class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Surat Keterangan</span>
                            </div>
                        </a>
                        <a
                            href="#"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-md hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px] rounded-lg shadow-sm"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 rounded-lg transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.chat-bubble-left class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Pengaduan &amp; Aspirasi</span>
                            </div>
                        </a>
                        <a
                            href="{{ route('publik.publikasi.berita.index') }}"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-md hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px] rounded-lg shadow-sm"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 rounded-lg transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.newspaper class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Berita &amp; Info</span>
                            </div>
                        </a>
                        <a
                            href="{{ route('publik.transparansi.apbdes') }}"
                            class="group border border-prt-primary/8 bg-white p-4 transition-all hover:-translate-y-1 hover:border-prt-primary/30 hover:shadow-md hover:shadow-prt-primary/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[120px] rounded-lg shadow-sm"
                        >
                            <div class="flex flex-col items-center text-center space-y-2.5">
                                <div class="bg-prt-primary/8 p-2.5 rounded-lg transition-colors group-hover:bg-prt-primary/15" aria-hidden="true">
                                    <flux:icon.document-chart-bar class="size-6 text-prt-primary transition-transform group-hover:scale-110" aria-hidden="true" />
                                </div>
                                <span class="text-xs font-bold leading-snug text-prt-ink transition-colors group-hover:text-prt-secondary sm:text-sm">Transparansi APBDes</span>
                            </div>
                        </a>
                    </div>
                </section>

                {{-- TRANSPARANSI ANGGARAN --}}
                <section aria-labelledby="apbdes-heading">
                    <div class="flex flex-wrap items-center gap-3 mb-4 border-b border-prt-primary/15 pb-2">
                        <div class="h-7 w-1 bg-prt-accent" aria-hidden="true"></div>
                        <h2 class="text-lg sm:text-xl font-bold text-prt-ink" id="apbdes-heading">Transparansi Anggaran Desa 2025</h2>
                        <a
                            href="{{ route('publik.transparansi.apbdes') }}"
                            class="ml-auto bg-prt-secondary px-4 py-2 text-xs font-semibold text-white transition-colors hover:bg-prt-navy-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] rounded-lg"
                        >
                            Laporan Lengkap &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        {{-- Revenue --}}
                        <div class="border border-prt-primary/8 bg-white p-4 rounded-lg shadow-sm">
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
                                <div class="bg-prt-primary/5 p-3 rounded-lg">
                                    <span class="mb-1 inline-flex bg-prt-accent/15 px-2.5 py-0.5 text-[10px] font-bold text-prt-gold-dark rounded-md">
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
                                        class="h-3 w-full overflow-hidden bg-prt-primary/8 rounded-full"
                                        role="progressbar"
                                        aria-valuenow="{{ $item['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="{{ $item['label'] }}: {{ $item['p'] }}% realisasi"
                                    >
                                        <div class="h-full bg-prt-accent rounded-full transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Expenditure --}}
                        <div class="border border-prt-primary/8 bg-white p-4 rounded-lg shadow-sm">
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
                                <div class="bg-prt-primary/5 p-3 rounded-lg">
                                    <span class="mb-1 inline-flex bg-prt-primary/10 px-2.5 py-0.5 text-[10px] font-bold text-prt-secondary rounded-md">
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
                                        class="h-3 w-full overflow-hidden bg-prt-primary/8 rounded-full"
                                        role="progressbar"
                                        aria-valuenow="{{ $item['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="{{ $item['label'] }}: {{ $item['p'] }}% realisasi"
                                    >
                                        <div class="h-full bg-prt-primary rounded-full transition-all duration-1000" style="width: {{ $item['p'] }}%"></div>
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
                <div class="border border-prt-primary/8 bg-white rounded-lg shadow-sm overflow-hidden">
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
                                        class="h-2.5 bg-prt-primary/8 overflow-hidden rounded-full"
                                        role="progressbar"
                                        aria-valuenow="{{ $s['p'] }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-label="Proporsi {{ $s['l'] }}: {{ $s['p'] }}%"
                                    >
                                        <div class="{{ $s['bg'] }} h-full rounded-full transition-all duration-1000" style="width: {{ $s['p'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    <a
                        href="{{ route('publik.profil.sejarah') }}"
                        class="block w-full border border-prt-primary/15 bg-prt-primary/5 py-2.5 text-center text-xs font-semibold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] rounded-lg"
                    >
                        Detail Kependudukan
                    </a>
                    </div>
                </div>

                {{-- Perangkat Desa Carousel --}}
                <div
                    class="border border-prt-primary/8 bg-white rounded-lg shadow-sm overflow-hidden"
                    x-data="{
                        items: {{ $perangkatDesa->toJson() }},
                        current: 0,
                        autoplay: null,
                        start() {
                            if (this.items.length < 2) return;
                            this.autoplay = setInterval(() => {
                                this.current = (this.current + 1) % this.items.length;
                            }, 4000);
                        },
                        stop() {
                            clearInterval(this.autoplay);
                        },
                        go(i) { this.current = i; this.stop(); this.start(); }
                    }"
                    x-init="start()"
                    @mouseenter="stop()"
                    @mouseleave="start()"
                    aria-labelledby="perangkat-carousel-title"
                >
                    <div class="flex items-center justify-center bg-prt-secondary px-4 py-3">
                        <h2 class="text-center text-sm font-bold text-white" id="perangkat-carousel-title">Perangkat Desa</h2>
                    </div>

                    <template x-if="items.length === 0">
                        <div class="p-6 text-center text-xs text-prt-muted" role="status">
                            Data perangkat desa belum tersedia.
                        </div>
                    </template>

                    <template x-if="items.length > 0">
                        <div class="relative">
                            <template x-for="(p, i) in items" :key="p.id">
                                <div
                                    x-show="current === i"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-x-4"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-x-0"
                                    x-transition:leave-end="opacity-0 -translate-x-4"
                                    class="relative w-full aspect-[4/5] overflow-hidden"
                                >
                                    <img
                                        :src="p.gambar ? '/storage/' + p.gambar : '{{ asset('assets/images/kepala-desa.png') }}'"
                                        :alt="'Foto: ' + p.nama + ', ' + p.jabatan"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                        <h3 class="text-base font-bold text-white drop-shadow-sm" x-text="p.nama"></h3>
                                        <p class="mt-0.5 text-xs font-semibold text-prt-accent drop-shadow-sm" x-text="p.jabatan"></p>
                                    </div>
                                </div>
                            </template>

                            <div class="flex items-center justify-center gap-1.5 pb-3" x-show="items.length > 1">
                                <template x-for="(p, i) in items" :key="'dot-' + p.id">
                                    <button
                                        type="button"
                                        class="size-2 rounded-full transition-all duration-200"
                                        :class="current === i ? 'bg-prt-secondary w-5' : 'bg-prt-primary/30 hover:bg-prt-primary/50'"
                                        @click="go(i)"
                                        :aria-label="'Lihat ' + p.nama"
                                    ></button>
                                </template>
                            </div>
                        </div>
                    </template>

                    <a
                        href="{{ route('publik.profil.aparatur') }}"
                        class="block w-full border-t border-prt-primary/8 bg-prt-primary/5 py-2.5 text-center text-xs font-semibold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px]"
                    >
                        Lihat Semua Perangkat
                    </a>
                </div>

                {{-- Important Info --}}
                <div class="border border-prt-primary/8 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="flex items-center justify-center bg-prt-secondary px-4 py-3">
                        <h2 class="text-center text-sm font-bold text-white">Informasi Penting</h2>
                    </div>
                    <div class="space-y-2 p-4">
                        <div class="flex items-start gap-3 border-l-2 border-prt-primary bg-prt-primary/5 p-3 rounded-r-lg">
                            <flux:icon.clock class="size-4 text-prt-primary shrink-0 mt-0.5" aria-hidden="true" />
                            <div>
                                <p class="text-xs font-bold text-prt-ink">Jam Layanan</p>
                                <p class="text-sm text-prt-ink font-bold mt-0.5">Senin - Jumat: 08:00 - 16:00</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 border-l-2 border-prt-gold bg-prt-accent/8 p-3 rounded-r-lg">
                            <flux:icon.phone class="size-4 text-prt-gold-dark shrink-0 mt-0.5" aria-hidden="true" />
                            <div>
                                <p class="text-xs font-bold text-prt-ink">Kontak Layanan</p>
                                <p class="text-sm text-prt-ink font-bold mt-0.5">(0352) XXXXXXX</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 border-l-2 border-prt-gold bg-prt-gold/8 p-3 rounded-r-lg">
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
@endsection

@section('footer_content')
        {{-- CTA BANNER --}}
        <section aria-label="Ajakan menggunakan layanan desa" class="bg-prt-secondary">
            <x-public.container class="flex flex-col items-center text-center py-8 sm:py-10">
                <h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Butuh Surat Keterangan Desa?</h2>
                <p class="text-sm sm:text-base text-prt-blue-light max-w-lg mb-4">Ajukan permohonan secara online tanpa harus datang ke kantor. Proses cepat, transparan, dan terpantau.</p>
                <a
                    href="{{ route('publik.layanan.informasi-surat') }}"
                    class="inline-flex items-center bg-prt-accent px-6 py-3 text-sm font-bold text-black transition-all hover:bg-prt-gold hover:-translate-y-0.5 hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] rounded-lg shadow-sm"
                >
                    <flux:icon.document-text class="size-5 mr-2 shrink-0" aria-hidden="true" />
                    <span>Ajukan Sekarang</span>
                </a>
            </x-public.container>
        </section>

        {{-- GALERI & POTENSI --}}
        <x-public.container class="py-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Photo Gallery --}}
                <section class="md:col-span-2 space-y-3" aria-labelledby="galeri-heading">
                    <div class="flex items-center gap-3 border-b border-prt-primary/15 pb-2">
                        <div class="h-5 w-1 bg-prt-primary" aria-hidden="true"></div>
                        <h2 class="text-lg font-bold text-prt-ink" id="galeri-heading">Galeri Foto</h2>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                        @forelse ($galeri->shuffle()->take(6) as $i => $g)
                            <div class="group relative overflow-hidden border border-prt-primary/8 transition-shadow hover:shadow-md rounded-lg aspect-[4/3]">
                                <img src="{{ Storage::url($g->gambar) }}" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy">
                                <div class="absolute inset-0 bg-prt-secondary/0 transition-colors duration-300 group-hover:bg-prt-secondary/20" aria-hidden="true"></div>
                            </div>
                        @empty
                            <div class="col-span-3 py-8 text-center text-prt-muted" role="status">
                                <p>Belum ada galeri foto.</p>
                            </div>
                        @endforelse
                    </div>
                    <a
                        href="{{ route('publik.profil.sejarah') }}"
                        class="block w-full border border-prt-primary/15 bg-prt-primary/5 py-2.5 text-center text-xs font-semibold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent min-h-[44px] rounded-lg"
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
        </x-public.container>
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
