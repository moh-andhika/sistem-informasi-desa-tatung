@extends('layouts.public')

@section('header_content')
    <x-public.page-header
        title="Pariwisata Desa"
        :breadcrumbs="['Potensi' => '#', 'Pariwisata' => route('publik.potensi.pariwisata')]"
    />
@endsection

@section('content')
    <div class="space-y-8">
        {{-- Intro Banner --}}
        <div class="bg-blue-50   p-5 flex gap-4 items-start">
            <flux:icon.map-pin class="size-6 text-prt-primary shrink-0 mt-0.5" />
            <div>
                <h4 class="text-sm font-black text-blue-900 uppercase tracking-normal mb-1">Jelajahi Keindahan Desa Tatung</h4>
                <p class="text-sm text-blue-800 leading-relaxed">Desa Tatung menyimpan potensi wisata alam dan budaya yang indah. Nikmati ketenangan pedesaan sambil mengenal tradisi dan kearifan lokal masyarakat setempat.</p>
            </div>
        </div>

        {{-- Daftar Destinasi --}}
        <section aria-labelledby="wisata-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="wisata-title">Destinasi Wisata Unggulan</h2>
                <flux:icon.map class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                @php
                    $destinasi = [
                        [
                            'nama' => 'Embung Tatung',
                            'kategori' => 'Wisata Alam',
                            'deskripsi' => 'Waduk alami kecil yang dikelilingi pepohonan rindang, menawarkan pemandangan indah terutama saat matahari terbit. Cocok untuk memancing dan piknik keluarga.',
                            'jam' => '06:00 – 18:00 WIB',
                            'tiket' => 'Gratis',
                            'img' => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&q=80&w=800',
                        ],
                        [
                            'nama' => 'Kebun Durian Tatung',
                            'kategori' => 'Agrowisata',
                            'deskripsi' => 'Perkebunan durian lokal yang buka untuk umum saat musim panen. Pengunjung dapat memetik langsung dan menikmati durian segar langsung dari pohonnya.',
                            'jam' => '08:00 – 17:00 WIB (Musim Panen)',
                            'tiket' => 'Rp 10.000/orang',
                            'img' => 'https://images.unsplash.com/photo-1562181831-e3cfa2e1ca8b?auto=format&fit=crop&q=80&w=800',
                        ],
                        [
                            'nama' => 'Sanggar Seni Reog Mini',
                            'kategori' => 'Wisata Budaya',
                            'deskripsi' => 'Sanggar seni yang aktif melatih generasi muda dalam seni Reog Ponorogo. Pengunjung dapat menyaksikan latihan dan pertunjukan budaya khas Ponorogo.',
                            'jam' => 'Sabtu & Minggu, 15:00 – 17:00 WIB',
                            'tiket' => 'Bebas',
                            'img' => 'https://images.unsplash.com/photo-1518998053901-5348d3961a04?auto=format&fit=crop&q=80&w=800',
                        ],
                    ];
                @endphp

                <div class="space-y-8" role="list" aria-label="Daftar destinasi wisata Desa Tatung">
                    @foreach($destinasi as $tempat)
                    <article class="group  overflow-hidden   transition-all" role="listitem">
                        <div class="grid sm:grid-cols-5 gap-0">
                            {{-- Gambar --}}
                            <div class="sm:col-span-2 h-52 sm:h-auto bg-slate-100 overflow-hidden relative">
                                <img src="{{ $tempat['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Foto {{ $tempat['nama'] }}">
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 bg-prt-primary text-white text-[9px] font-black  uppercase tracking-wide shadow">{{ $tempat['kategori'] }}</span>
                                </div>
                            </div>
                            {{-- Konten --}}
                            <div class="sm:col-span-3 p-6 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-normal mb-3 group-hover:text-prt-primary transition-colors">{{ $tempat['nama'] }}</h3>
                                    <p class="text-sm text-slate-600 leading-relaxed mb-5">{{ $tempat['deskripsi'] }}</p>
                                </div>
                                <div class="flex flex-wrap gap-4 pt-4 
                                    <div class="flex items-center gap-2">
                                        <flux:icon.clock class="size-4 text-prt-primary" aria-hidden="true" />
                                        <span class="text-[11px] font-bold text-slate-600 uppercase tracking-wide">{{ $tempat['jam'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <flux:icon.ticket class="size-4 text-prt-primary" aria-hidden="true" />
                                        <span class="text-[11px] font-bold text-slate-600 uppercase tracking-wide">Tiket: {{ $tempat['tiket'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Info kontak wisata --}}
        <div class="p-6 bg-prt-primary  text-white flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="font-black text-base uppercase tracking-normal mb-1">Butuh Informasi Lebih Lanjut?</h3>
                <p class="text-blue-200 text-sm">Hubungi perangkat desa untuk panduan wisata dan paket kunjungan khusus rombongan.</p>
            </div>
            <a href="{{ route('publik.layanan.informasi-surat') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-prt-accent text-prt-secondary text-xs font-black uppercase tracking-wide  hover:bg-yellow-400 transition-colors ">
                <flux:icon.phone class="size-4" />
                Hubungi Desa
            </a>
        </div>
    </div>
@endsection
