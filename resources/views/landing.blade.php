@extends('layouts.public')

@php
    $pengumuman = [
        [
            'judul' => 'Penyaluran BLT Tahap 1',
            'tanggal' => '31 Maret 2026',
            'ringkasan' => 'Pembagian bantuan langsung tunai bagi warga terdampak.',
        ],
        [
            'judul' => 'Jalan Usaha Tani Dusun Timur',
            'tanggal' => '30 Maret 2026',
            'ringkasan' => 'Pengerasan jalan untuk mendukung akses pertanian.',
        ],
        [
            'judul' => 'Pelatihan UMKM Desa',
            'tanggal' => '28 Maret 2026',
            'ringkasan' => 'Peningkatan kapasitas pemasaran produk UMKM.',
        ],
    ];

    $layanan = [
        ['nama' => 'Layanan Surat Online', 'keterangan' => 'Ajukan surat keterangan tanpa harus datang ke kantor desa'],
        ['nama' => 'Data Penduduk', 'keterangan' => 'Informasi kependudukan dan kartu keluarga'],
        ['nama' => 'Pengajuan SKTM', 'keterangan' => 'Surat keterangan tidak mampu untuk keperluan sekolah/medis'],
        ['nama' => 'Surat Domisili', 'keterangan' => 'Keterangan tempat tinggal resmi'],
        ['nama' => 'Pengaduan Warga', 'keterangan' => 'Sampaikan aspirasi dan laporan warga'],
        ['nama' => 'Berita Desa', 'keterangan' => 'Informasi kegiatan dan program desa'],
    ];

    $profil = [
        'nama_desa' => 'Desa Tatung',
        'kecamatan' => 'Kecamatan Tatung',
        'kabupaten' => 'Kabupaten Tatung',
        'provinsi' => 'Provinsi Kalimantan Tengah',
        'penduduk' => '3.214 jiwa',
        'kk' => '812 KK',
        'dusun' => '6 dusun',
        'alamat' => 'Kantor Desa Tatung, RT 01 / RW 01',
        'telepon' => '08xx-xxxx-xxxx',
        'email' => 'desa@tatung.id',
    ];
@endphp

@section('content')
    {{-- Hero sederhana --}}
    <section class="bg-orange-50 border-b border-orange-100">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <p class="text-sm font-semibold text-orange-700 uppercase tracking-wide">Selamat datang di</p>
                <h1 class="text-3xl font-bold text-neutral-900">Sistem Informasi Desa {{ $profil['nama_desa'] }}</h1>
                <p class="max-w-3xl text-sm text-neutral-700">
                    Portal informasi resmi untuk layanan surat-menyurat, transparansi desa, dan berita kegiatan masyarakat.
                    Warga dapat mengakses layanan dasar tanpa harus datang ke kantor desa.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                        Ajukan Surat Online
                    </a>
                    <a href="#pengumuman" class="inline-flex items-center rounded-md border border-neutral-200 px-4 py-2 text-sm font-semibold text-neutral-800 hover:border-neutral-300">
                        Lihat Pengumuman
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-3 text-sm sm:grid-cols-3">
                    <div class="rounded-lg border border-white/0 bg-white/70 p-3 shadow-sm">
                        <p class="text-base font-bold text-neutral-900">{{ $profil['penduduk'] }}</p>
                        <p class
="text-neutral-600">Jumlah Penduduk</p>
                    </div>
                    <div class="rounded-lg border border-white/0 bg-white/70 p-3 shadow-sm">
                        <p class="text-base font-bold text-neutral-900">{{ $profil['kk'] }}</p>
                        <p class="text-neutral-600">Kartu Keluarga</p>
                    </div>
                    <div class="rounded-lg border border-white/0 bg-white/70 p-3 shadow-sm">
                        <p class="text-base font-bold text-neutral-900">{{ $profil['dusun'] }}</p>
                        <p class="text-neutral-600">Dusun</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pengumuman --}}
    <section id="pengumuman" class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-neutral-900">Pengumuman Terbaru</h2>
            <p class="text-sm text-neutral-600">Informasi resmi dari Pemerintah Desa Tatung.</p>
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ($pengumuman as $item)
                <article class="rounded-lg border border-neutral-200 bg-white p-4 shadow-sm">
                    <p class="text-xs text-neutral-500">{{ $item['tanggal'] }}</p>
                    <h3 class="mt-2 text-base font-semibold text-neutral-900">{{ $item['judul'] }}</h3>
                    <p class="mt-2 text-sm text-neutral-600">{{ $item['ringkasan'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Artikel Berita --}}
    <section id="berita" class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-neutral-900">Artikel & Berita Desa</h2>
            <p class="text-sm text-neutral-600">Kumpulan berita kegiatan dan informasi desa.</p>
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ($pengumuman as $item)
                <article class="rounded-lg border border-neutral-200 bg-white p-4 shadow-sm">
                    <p class="text-xs text-neutral-500">{{ $item['tanggal'] }}</p>
                    <h3 class="mt-2 text-base font-semibold text-neutral-900">{{ $item['judul'] }}</h3>
                    <p class="mt-2 text-sm text-neutral-600 line-clamp-3">{{ $item['ringkasan'] }}</p>
                    <button class="mt-3 inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">Baca selengkapnya</button>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Layanan --}}
    <section id="layanan" class="bg-neutral-50 border-t border-b border-neutral-200">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-neutral-900">Layanan Desa</h2>
                <p class="text-sm text-neutral-600">Akses layanan umum untuk warga.</p>
            </div>
            <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($layanan as $item)
                    <div class="rounded-lg border border-neutral-200 bg-white p-4 shadow-sm">
                        <p class="text-base font-semibold text-neutral-900">{{ $item['nama'] }}</p>
                        <p class="mt-1 text-sm text-neutral-600">{{ $item['keterangan'] }}</p>
                        <button class="mt-3 inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">
                            Selengkapnya
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Profil singkat --}}
    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-neutral-900">Profil Desa</h2>
                <p class="text-sm text-neutral-700">
                    {{ $profil['nama_desa'] }}, {{ $profil['kecamatan'] }}, {{ $profil['kabupaten'] }}, {{ $profil['provinsi'] }}.
                    Portal ini menyediakan informasi dan layanan dasar bagi warga.
                </p>
            </div>
            <div class="rounded-lg border border-neutral-200 bg-white p-4 text-sm shadow-sm">
                <ul class="space-y-1 text-neutral-700">
                    <li><strong>Alamat:</strong> {{ $profil['alamat'] }}</li>
                    <li><strong>Telepon:</strong> {{ $profil['telepon'] }}</li>
                    <li><strong>Email:</strong> {{ $profil['email'] }}</li>
                </ul>
            </div>
        </div>
    </section>
@endsection
