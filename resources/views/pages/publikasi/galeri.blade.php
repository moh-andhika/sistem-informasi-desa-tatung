@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Galeri Dokumentasi"
        :breadcrumbs="['Publikasi' => '#', 'Galeri Foto' => route('publik.publikasi.galeri')]"
    />
@endsection

@section('content')
    <div class="space-y-6">
        <section aria-labelledby="gallery-grid-title" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-prt-primary px-4 py-3 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-wide" id="gallery-grid-title">Album Foto Kegiatan</h2>
                <flux:icon.photo class="size-4 text-white/70" />
            </div>
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2" role="list" aria-label="Grid foto album kegiatan desa">
                    @forelse($galeris as $g)
                        <article class="group focus-within:ring-2 focus-within:ring-prt-primary rounded-lg overflow-hidden shadow-sm transition-all bg-white" role="listitem">
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                <img src="{{ Storage::url($g->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Foto: {{ $g->judul }}">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4" aria-hidden="true">
                                    <flux:icon.magnifying-glass-plus class="text-white size-6 ml-auto" />
                                </div>
                            </div>
                            <div class="px-2 py-2">
                                <h4 class="text-[10px] font-black text-prt-ink uppercase tracking-normal line-clamp-1 group-hover:text-prt-primary transition-colors">{{ $g->judul }}</h4>
                                <p class="text-[8px] font-bold text-prt-muted uppercase mt-0.5 tracking-wide">{{ $g->created_at->format('d M Y') }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center bg-blue-50">
                            <flux:icon.photo class="size-10 text-blue-300 mx-auto mb-3" aria-hidden="true" />
                            <p class="text-slate-500 font-bold uppercase tracking-wide text-xs">Belum ada koleksi foto dalam album ini.</p>
                        </div>
                    @endforelse
                </div>

                @if($galeris->hasPages())
                    <div class="mt-4 pt-3 border-t border-slate-100">
                        {{ $galeris->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
