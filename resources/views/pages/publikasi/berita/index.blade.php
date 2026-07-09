@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Berita Desa Tatung"
        :breadcrumbs="['Publikasi' => '#', 'Berita' => route('publik.publikasi.berita.index')]"
    />
@endsection

@section('content')
    <div class="space-y-0">
            <div class="flex items-center gap-2 mb-4">
                <span class="w-1 h-5 bg-prt-primary "></span>
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-wide">Artikel Terbaru</h2>
            </div>

            <div class="divide-y divide-blue-50 bg-white  overflow-hidden" role="list" aria-label="Daftar berita terbaru">
                @forelse ($beritas as $item)
                    <article class="group flex flex-col sm:flex-row gap-0 hover:bg-blue-50/30 transition-all focus-within:ring-2 focus-within:ring-inset focus-within:ring-prt-primary" role="listitem">
                        {{-- Gambar --}}
                        <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="block sm:w-40 shrink-0 relative overflow-hidden bg-slate-100" tabindex="-1">
                            @if($item->gambar)
                                <img src="{{ $item->gambar_url }}" alt="Foto berita: {{ $item->judul }}" class="h-32 sm:h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="h-32 sm:h-full flex items-center justify-center text-slate-300 bg-blue-50">
                                <flux:icon.newspaper class="size-8 opacity-50" aria-hidden="true" />
                            </div>
                        @endif
                    </a>
                    {{-- Konten --}}
                    <div class="flex flex-1 flex-col px-4 py-3">
                        <div class="flex items-center gap-2 mb-2 text-[10px] font-bold text-slate-500 uppercase tracking-wide">
                            <time datetime="{{ $item->published_at ?? $item->created_at }}" class="flex items-center gap-1 text-prt-primary">
                                <flux:icon.calendar class="size-3" aria-hidden="true" /> 
                                {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                            </time>
                            <span class="text-slate-200" aria-hidden="true">|</span>
                            <span>Admin Desa</span>
                        </div>
                        <h2 class="text-sm font-black text-slate-900 group-hover:text-prt-primary transition-colors line-clamp-2 mb-1 uppercase leading-tight tracking-normal">
                            <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="focus:outline-none">
                                {{ $item->judul }}
                            </a>
                        </h2>
                        <p class="text-xs text-slate-600 line-clamp-2 flex-1 mb-2 leading-relaxed">{{ $item->ringkasan ?? Str::limit(strip_tags($item->konten), 120) }}</p>

                        <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="inline-flex items-center gap-1.5 text-[10px] font-black text-prt-primary uppercase tracking-wide hover:gap-3 transition-all focus:outline-none" aria-label="Baca selengkapnya mengenai {{ $item->judul }}">
                            Baca Selengkapnya <flux:icon.arrow-right class="size-3" />
                        </a>
                    </div>
                </article>
            @empty
                <div class="   bg-blue-50 p-12 text-center m-4">
                    <flux:icon.newspaper class="mx-auto size-12 text-blue-300 mb-4" variant="outline" aria-hidden="true" />
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-wide">Belum Ada Publikasi</h3>
                    <p class="mt-1 text-slate-500 text-xs">Saat ini belum ada artikel berita terbaru yang diterbitkan.</p>
                </div>
            @endforelse
        </div>

            @if($beritas->hasPages())
                <div class="mt-4 pt-3 
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
@endsection
