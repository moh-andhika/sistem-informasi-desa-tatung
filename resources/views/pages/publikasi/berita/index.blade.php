@extends('layouts.public')

@php
    // Data contoh; nanti bisa diambil dari database/feeds desa
    $berita = [
        [
            'judul' => 'Penyaluran BLT Tahap 1',
            'tanggal' => '31 Maret 2026',
            'penulis' => 'Pemerintah Desa Tatung',
            'ringkasan' => 'Pembagian bantuan langsung tunai bagi warga terdampak.',
            'gambar' => 'https://placehold.co/600x400/f97316/white?text=Berita+1',
        ],
        [
            'judul' => 'Pengerasan Jalan Usaha Tani Dusun Timur',
            'tanggal' => '30 Maret 2026',
            'penulis' => 'Pemerintah Desa Tatung',
            'ringkasan' => 'Peningkatan akses produksi dan distribusi hasil pertanian.',
            'gambar' => 'https://placehold.co/600x400/f97316/white?text=Berita+2',
        ],
        [
            'judul' => 'Pelatihan UMKM dan Digitalisasi Produk',
            'tanggal' => '28 Maret 2026',
            'penulis' => 'Bumdes Tatung Jaya',
            'ringkasan' => 'Pelatihan pemasaran digital untuk pelaku UMKM desa.',
            'gambar' => 'https://placehold.co/600x400/f97316/white?text=Berita+3',
        ],
        [
            'judul' => 'Posyandu Balita Dusun Barat',
            'tanggal' => '25 Maret 2026',
            'penulis' => 'Kader Kesehatan Desa',
            'ringkasan' => 'Pemeriksaan tumbuh kembang balita dan penyuluhan gizi.',
            'gambar' => 'https://placehold.co/600x400/f97316/white?text=Berita+4',
        ],
    ];
@endphp

@section('content')
    <section class="bg-orange-50 border-b border-orange-100">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-neutral-900">Berita Desa</h1>
            <p class="mt-2 text-sm text-neutral-700">
                Informasi kegiatan, program, dan pengumuman resmi Desa Tatung.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($berita as $item)
                <article class="flex flex-col overflow-hidden rounded-lg border border-neutral-200 bg-white shadow-sm">
                    <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}" class="h-48 w-full object-cover">
                    <div class="flex flex-1 flex-col p-4">
                        <p class="text-xs text-neutral-500">{{ $item['tanggal'] }}</p>
                        <h2 class="mt-2 text-base font-semibold text-neutral-900">{{ $item['judul'] }}</h2>
                        <p class="text-xs text-neutral-500">{{ $item['penulis'] }}</p>
                        <p class="mt-2 text-sm text-neutral-600 line-clamp-3">{{ $item['ringkasan'] }}</p>
                        <div class="mt-auto pt-3">
                            <button class="inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">
                                Baca selengkapnya
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
