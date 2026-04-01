@extends('layouts.public')

@php
    // Data contoh; nanti bisa diambil dari database/feeds desa
    $berita = [
        [
            'judul' => 'Penyaluran BLT Tahap 1',
            'tanggal' => '31 Maret 2026',
            'penulis' => 'Pemerintah Desa Tatung',
            'ringkasan' => 'Pembagian bantuan langsung tunai bagi warga terdampak.',
        ],
        [
            'judul' => 'Pengerasan Jalan Usaha Tani Dusun Timur',
            'tanggal' => '30 Maret 2026',
            'penulis' => 'Pemerintah Desa Tatung',
            'ringkasan' => 'Peningkatan akses produksi dan distribusi hasil pertanian.',
        ],
        [
            'judul' => 'Pelatihan UMKM dan Digitalisasi Produk',
            'tanggal' => '28 Maret 2026',
            'penulis' => 'Bumdes Tatung Jaya',
            'ringkasan' => 'Pelatihan pemasaran digital untuk pelaku UMKM desa.',
        ],
        [
            'judul' => 'Posyandu Balita Dusun Barat',
            'tanggal' => '25 Maret 2026',
            'penulis' => 'Kader Kesehatan Desa',
            'ringkasan' => 'Pemeriksaan tumbuh kembang balita dan penyuluhan gizi.',
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
                <article class="rounded-lg border border-neutral-200 bg-white p-4 shadow-sm">
                    <p class="text-xs text-neutral-500">{{ $item['tanggal'] }}</p>
                    <h2 class="mt-2 text-base font-semibold text-neutral-900">{{ $item['judul'] }}</h2>
                    <p class="text-xs text-neutral-500">{{ $item['penulis'] }}</p>
                    <p class="mt-2 text-sm text-neutral-600 line-clamp-3">{{ $item['ringkasan'] }}</p>
                    <button class="mt-3 inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">
                        Baca selengkapnya
                    </button>
                </article>
            @endforeach
        </div>
    </section>
@endsection
