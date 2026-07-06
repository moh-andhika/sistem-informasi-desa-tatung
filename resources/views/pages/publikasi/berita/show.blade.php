@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="{{ $berita->judul }}"
        :breadcrumbs="['Publikasi' => '#', 'Berita' => route('publik.publikasi.berita.index'), 'Detail Berita' => '#']"
    />
@endsection

@section('content')
    <article class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden mb-10">
        {{-- Featured Image --}}
        @if($berita->gambar)
            <div class="w-full relative aspect-video overflow-hidden border-b border-green-50">
                <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-8 sm:p-12">
            {{-- Prose/Text --}}
            <div class="prose prose-slate prose-sm sm:prose-base max-w-none prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tight prose-a:text-[#2E7D32] hover:prose-a:text-[#1B5E20] prose-img:rounded-lg prose-strong:text-slate-900 leading-relaxed text-slate-700">
                @if($berita->ringkasan)
                    <p class="text-lg text-slate-800 font-bold mb-10 border-l-4 border-[#2E7D32] pl-6 py-2 italic leading-relaxed bg-green-50 rounded-r-lg">
                        "{{ $berita->ringkasan }}"
                    </p>
                @endif

                <div class="article-content">
                    {!! nl2br(e($berita->konten)) !!}
                </div>
            </div>

            {{-- Share & Footer --}}
            <div class="mt-16 pt-10 border-t border-green-50 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Bagikan:</span>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="size-9 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-sm" aria-label="Bagikan ke Facebook">
                            <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}" target="_blank" rel="noopener" class="size-9 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-sm" aria-label="Bagikan ke WhatsApp">
                            <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    </div>
                </div>

                <a href="{{ route('publik.publikasi.berita.index') }}" class="inline-flex items-center gap-2 text-xs font-black text-[#2E7D32] uppercase tracking-widest hover:gap-3 transition-all border border-green-200 rounded-lg px-4 py-2 hover:bg-green-50">
                    <flux:icon.arrow-left class="size-3.5" /> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </article>
@endsection
