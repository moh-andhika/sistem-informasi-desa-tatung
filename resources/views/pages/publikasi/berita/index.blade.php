@extends('layouts.public')

@section('content')
    <section class="bg-blue-900 border-b border-blue-950 relative overflow-hidden text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute inset-0 bg-linear-to-r from-blue-900 to-blue-800 mix-blend-multiply"></div>

        <div class="relative z-10 mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-2">Berita Desa</h1>
            <p class="text-blue-200 text-lg max-w-2xl">
                Informasi kegiatan, program pembangunan, dan pengumuman resmi dari Pemerintah Desa Tatung.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-12 sm:py-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($beritas as $item)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200">
                    <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="h-48 w-full relative overflow-hidden bg-slate-200">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="absolute inset-0 bg-linear-to-tr from-blue-100 to-slate-50 flex items-center justify-center text-slate-400">
                                <flux:icon.photo class="size-10 opacity-50" />
                            </div>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col p-5">
                        <div class="flex items-center gap-2 mb-3 text-xs text-slate-500">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Berita</span>
                            <span>&bull;</span>
                            <time datetime="{{ $item->published_at ?? $item->created_at }}">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</time>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition-colors line-clamp-2 mb-2">
                            <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}">
                                {{ $item->judul }}
                            </a>
                        </h2>
                        <p class="text-sm text-slate-600 line-clamp-3 flex-1 mb-4">{{ $item->ringkasan ?? Str::limit(strip_tags($item->konten), 100) }}</p>

                        <div class="mt-auto border-t border-slate-100 pt-4 flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-500 flex items-center gap-1">
                                <flux:icon.user class="size-3" /> Admin Desa
                            </span>
                            <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800">
                                Baca selengkapnya <span aria-hidden="true" class="ml-1">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-12 text-center">
                    <flux:icon.newspaper class="mx-auto size-12 text-slate-400 mb-4" variant="outline" />
                    <h3 class="text-lg font-bold text-slate-900">Belum Ada Berita</h3>
                    <p class="mt-1 text-slate-500 max-w-md mx-auto">Saat ini belum ada publikasi berita atau pengumuman yang ditambahkan oleh Pemerintah Desa.</p>
                </div>
            @endforelse
        </div>

        @if($beritas->hasPages())
            <div class="mt-10 pt-6 border-t border-slate-200">
                {{ $beritas->links() }}
            </div>
        @endif
    </section>
@endsection
