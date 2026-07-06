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
        <div class="flex items-center gap-3 mb-6">
            <span class="w-1.5 h-6 bg-[#2E7D32] rounded-full"></span>
            <h2 class="text-base font-black text-slate-800 uppercase tracking-widest">Artikel Terbaru</h2>
        </div>

        <div class="divide-y divide-green-50 bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden" role="list" aria-label="Daftar berita terbaru">
            @forelse ($beritas as $item)
                <article class="group flex flex-col sm:flex-row gap-0 hover:bg-green-50/30 transition-all focus-within:ring-2 focus-within:ring-inset focus-within:ring-[#2E7D32]" role="listitem">
                    {{-- Gambar --}}
                    <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="block sm:w-52 shrink-0 relative overflow-hidden bg-slate-100" tabindex="-1">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="Foto berita: {{ $item->judul }}" class="h-44 sm:h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="h-44 sm:h-full flex items-center justify-center text-slate-300 bg-green-50">
                                <flux:icon.newspaper class="size-12 opacity-50" aria-hidden="true" />
                            </div>
                        @endif
                    </a>
                    {{-- Konten --}}
                    <div class="flex flex-1 flex-col px-6 py-5">
                        <div class="flex items-center gap-3 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            <time datetime="{{ $item->published_at ?? $item->created_at }}" class="flex items-center gap-1.5 text-[#2E7D32]">
                                <flux:icon.calendar class="size-3" aria-hidden="true" /> 
                                {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                            </time>
                            <span class="text-slate-200" aria-hidden="true">|</span>
                            <span>Admin Desa</span>
                        </div>
                        <h2 class="text-base font-black text-slate-900 group-hover:text-[#2E7D32] transition-colors line-clamp-2 mb-2 uppercase leading-tight tracking-tight">
                            <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="focus:outline-none">
                                {{ $item->judul }}
                            </a>
                        </h2>
                        <p class="text-sm text-slate-600 line-clamp-2 flex-1 mb-4 leading-relaxed">{{ $item->ringkasan ?? Str::limit(strip_tags($item->konten), 120) }}</p>

                        <a href="{{ route('publik.publikasi.berita.show', $item->slug) }}" class="inline-flex items-center gap-1.5 text-[10px] font-black text-[#2E7D32] uppercase tracking-widest hover:gap-3 transition-all focus:outline-none" aria-label="Baca selengkapnya mengenai {{ $item->judul }}">
                            Baca Selengkapnya <flux:icon.arrow-right class="size-3" />
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border-2 border-dashed border-green-200 bg-green-50 p-20 text-center m-6">
                    <flux:icon.newspaper class="mx-auto size-16 text-green-300 mb-6" variant="outline" aria-hidden="true" />
                    <h3 class="text-base font-black text-slate-700 uppercase tracking-widest">Belum Ada Publikasi</h3>
                    <p class="mt-2 text-slate-500 text-sm">Saat ini belum ada artikel berita terbaru yang diterbitkan.</p>
                </div>
            @endforelse
        </div>

        @if($beritas->hasPages())
            <div class="mt-8 pt-6 border-t border-green-50">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
@endsection
