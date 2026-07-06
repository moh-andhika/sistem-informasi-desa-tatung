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
        <section aria-labelledby="gallery-grid-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#2E7D32] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="gallery-grid-title">Album Foto Kegiatan</h2>
                <flux:icon.photo class="size-5 text-white/70" />
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" role="list" aria-label="Grid foto album kegiatan desa">
                    @forelse($galeris as $g)
                        <article class="group focus-within:ring-2 focus-within:ring-[#2E7D32] rounded-lg overflow-hidden border border-green-50 hover:border-green-200 hover:shadow-md transition-all bg-white" role="listitem">
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                <img src="{{ Storage::url($g->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Foto: {{ $g->judul }}">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4" aria-hidden="true">
                                    <flux:icon.magnifying-glass-plus class="text-white size-6 ml-auto" />
                                </div>
                            </div>
                            <div class="px-3 py-3">
                                <h4 class="text-[11px] font-black text-slate-800 uppercase tracking-tight line-clamp-1 group-hover:text-[#2E7D32] transition-colors">{{ $g->judul }}</h4>
                                <p class="text-[9px] font-bold text-slate-400 uppercase mt-1 tracking-widest">{{ $g->created_at->format('d M Y') }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-16 text-center bg-green-50 rounded-lg border-2 border-dashed border-green-200">
                            <flux:icon.photo class="size-12 text-green-300 mx-auto mb-4" aria-hidden="true" />
                            <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">Belum ada koleksi foto dalam album ini.</p>
                        </div>
                    @endforelse
                </div>

                @if($galeris->hasPages())
                    <div class="mt-8 pt-6 border-t border-green-50">
                        {{ $galeris->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
