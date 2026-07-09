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
            <span class="w-1 h-5 bg-prt-primary" aria-hidden="true"></span>
            <h2 class="text-sm font-bold text-prt-ink uppercase tracking-wide">Artikel Terbaru</h2>
        </div>

        @if ($beritas->count())
            <div class="divide-y divide-prt-primary/8 bg-white" role="list" aria-label="Daftar berita terbaru">
                @foreach ($beritas as $item)
                    <a
                        href="{{ route('publik.publikasi.berita.show', $item->slug) }}"
                        class="group flex flex-col sm:flex-row transition-all hover:bg-prt-primary/[0.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                        role="listitem"
                        aria-labelledby="berita-{{ $item->id }}-title"
                    >
                        {{-- Gambar --}}
                        <div class="sm:w-44 shrink-0 overflow-hidden bg-prt-primary/5" aria-hidden="true">
                            @if($item->gambar)
                                <img src="{{ $item->gambar_url }}" alt="" class="h-36 sm:h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="h-36 sm:h-full flex items-center justify-center text-prt-muted">
                                    <flux:icon.newspaper class="size-10" aria-hidden="true" />
                                </div>
                            @endif
                        </div>
                        {{-- Konten --}}
                        <div class="flex flex-1 flex-col px-5 py-4">
                            <div class="flex items-center gap-2 mb-2 text-xs font-semibold text-prt-muted">
                                <time datetime="{{ $item->published_at ?? $item->created_at }}" class="flex items-center gap-1">
                                    <flux:icon.calendar class="size-3.5 shrink-0" aria-hidden="true" /> 
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                                </time>
                                <span class="text-prt-primary/20" aria-hidden="true">|</span>
                                <span>Admin Desa</span>
                            </div>
                            <h3 class="text-base font-bold text-prt-ink line-clamp-2 mb-1.5 transition-colors group-hover:text-prt-secondary" id="berita-{{ $item->id }}-title">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-sm text-prt-muted leading-relaxed line-clamp-2 flex-1 mb-2">
                                {{ $item->ringkasan ?? Str::limit(strip_tags($item->konten), 120) }}
                            </p>
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-prt-primary transition-all group-hover:gap-3 group-hover:text-prt-secondary" aria-label="Baca selengkapnya mengenai {{ $item->judul }}">
                                Baca Selengkapnya <flux:icon.arrow-right class="size-3.5 shrink-0" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="border border-prt-primary/8 bg-white p-12 text-center">
                <flux:icon.newspaper class="mx-auto size-12 text-prt-muted/50 mb-4" aria-hidden="true" />
                <h3 class="text-base font-bold text-prt-ink uppercase tracking-wide">Belum Ada Publikasi</h3>
                <p class="mt-1 text-sm text-prt-muted">Saat ini belum ada artikel berita terbaru yang diterbitkan.</p>
            </div>
        @endif

        @if($beritas->hasPages())
            <div class="mt-6 pt-4 border-t border-prt-primary/8">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
@endsection
