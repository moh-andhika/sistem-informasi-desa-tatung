@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Lapak UMKM Desa"
        :breadcrumbs="['Potensi' => '#', 'UMKM' => route('publik.potensi.umkm')]"
    />
@endsection

@section('content')
    <div class="space-y-8">
        {{-- Banner promosi lokal --}}
        <div class="bg-blue-50 rounded-lg shadow-sm p-5 flex gap-4 items-start">
            <flux:icon.shopping-bag class="size-6 text-prt-primary shrink-0 mt-0.5" />
            <div>
                <h4 class="text-sm font-black text-blue-900 uppercase tracking-normal mb-1">Beli Lokal, Dukung UMKM Desa</h4>
                <p class="text-sm text-blue-800 leading-relaxed">Dengan membeli produk UMKM warga Desa Tatung, Anda turut menggerakkan roda perekonomian masyarakat dan melestarikan kearifan lokal.</p>
            </div>
        </div>

        <section aria-labelledby="umkm-grid-title" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="umkm-grid-title">Produk Unggulan Masyarakat</h2>
                <flux:icon.shopping-bag class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                @php
                    $umkms = [
                        ['nama' => 'Kerajinan Anyaman Bambu', 'pemilik' => 'Ibu Sumiati', 'harga' => 'Rp 25.000 – 150.000', 'kategori' => 'Kerajinan', 'img' => 'https://images.unsplash.com/photo-1590540179852-2110a54f813a?auto=format&fit=crop&q=80&w=600'],
                        ['nama' => 'Kripik Tempe Renyah', 'pemilik' => 'Bpk. Sugeng', 'harga' => 'Rp 15.000 / bungkus', 'kategori' => 'Makanan', 'img' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&q=80&w=600'],
                        ['nama' => 'Madu Hutan Alami', 'pemilik' => 'Kelompok Tani Lestari', 'harga' => 'Rp 85.000 / botol', 'kategori' => 'Pertanian', 'img' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&q=80&w=600'],
                        ['nama' => 'Batik Tulis Tatung', 'pemilik' => 'Sanggar Seni Barokah', 'harga' => 'Mulai Rp 250.000', 'kategori' => 'Kain & Busana', 'img' => 'https://images.unsplash.com/photo-1584184924103-e310d9dc85fc?auto=format&fit=crop&q=80&w=600'],
                    ];
                @endphp

                <div class="grid gap-8 sm:grid-cols-2" role="list" aria-label="Daftar produk unggulan UMKM Desa Tatung">
                    @foreach($umkms as $umkm)
                    <article class="group rounded-lg overflow-hidden shadow-sm transition-all bg-white" role="listitem">
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden relative">
                            <img src="{{ $umkm['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Produk: {{ $umkm['nama'] }}">
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 bg-prt-primary text-white text-[9px] font-black  uppercase tracking-wide shadow">{{ $umkm['kategori'] }}</span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 bg-white/95 backdrop-blur-sm text-prt-primary text-[9px] font-black  shadow uppercase tracking-wide">{{ $umkm['harga'] }}</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-normal mb-1 group-hover:text-prt-primary transition-colors">{{ $umkm['nama'] }}</h3>
                            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-wide mb-4">
                                <flux:icon.user class="size-3 text-prt-primary" aria-hidden="true" />
                                <span>{{ $umkm['pemilik'] }}</span>
                            </div>
                            <button class="w-full py-2.5 bg-prt-primary text-white text-[10px] font-black uppercase tracking-wide  hover:bg-prt-secondary transition-all focus:outline-none focus:ring-2 focus:ring-prt-primary focus:ring-offset-2 shadow" aria-label="Hubungi penjual {{ $umkm['nama'] }}">
                                Hubungi Penjual
                            </button>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA Daftar UMKM --}}
        <div class="p-8 bg-prt-secondary  text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="relative z-10 text-center max-w-xl mx-auto">
                <flux:icon.plus-circle class="size-10 text-prt-accent mx-auto mb-4" />
                <h3 class="text-lg font-black uppercase tracking-normal mb-3">Ingin Produk Anda Ditampilkan?</h3>
                <p class="text-sm text-blue-200 leading-relaxed mb-6">Bagi warga Desa Tatung yang memiliki produk UMKM dan ingin dipromosikan di website resmi desa, silakan hubungi operator desa atau datang langsung ke kantor desa.</p>
                <a href="#" class="inline-block px-8 py-3 bg-prt-accent text-prt-secondary text-xs font-black uppercase tracking-wide  hover:bg-yellow-400 transition-colors ">
                    Daftarkan Produk UMKM
                </a>
            </div>
        </div>
    </div>
@endsection
