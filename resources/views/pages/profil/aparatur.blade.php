@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Struktur Organisasi"
        :breadcrumbs="['Profil' => '#', 'Struktur Organisasi' => route('publik.profil.aparatur')]"
    />
@endsection

@section('content')
    <div class="space-y-12">
        {{-- Bagan Struktur --}}
        <section aria-labelledby="bagan-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="bagan-title">Bagan Struktur Organisasi</h2>
                <flux:icon.chart-pie class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                <div class="  overflow-hidden bg-blue-50/30 p-2 shadow-inner">
                    <img src="{{ asset('assets/image-98.png') }}" class="w-full h-auto" alt="Bagan Struktur Organisasi Desa Tatung">
                </div>
            </div>
        </section>

        {{-- Struktur Aparatur Desa --}}
        <section aria-labelledby="personil-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-secondary px-6 py-4lue-900 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="personil-title">Daftar Aparatur Desa</h2>
                <flux:icon.identification class="size-5 text-blue-400" />
            </div>

            @php
                $kepalaDesa = $aparatur->firstWhere('jabatan', 'Kepala Desa');
                $sekretaris = $aparatur->firstWhere('jabatan', 'Sekretaris Desa');
                $staf = $aparatur->reject(fn ($p) => in_array($p->jabatan, ['Kepala Desa', 'Sekretaris Desa']));
            @endphp

            <div class="flex flex-col items-center py-12" role="list" aria-label="Struktur Organisasi Pemerintah Desa Tatung">
                {{-- Level 1: Kepala Desa --}}
                @if ($kepalaDesa)
                    <article class="w-full max-w-sm flex flex-col items-center p-4 bg-prt-bg relative mb-8 focus-within:ring-2 focus-within:ring-blue-600" role="listitem">
                        <div class="size-24 overflow-hidden mb-3">
                            @if ($kepalaDesa->gambar)
                                <img src="{{ Storage::url($kepalaDesa->gambar) }}" class="w-full h-full object-cover" alt="Foto Kepala Desa: {{ $kepalaDesa->nama }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($kepalaDesa->nama) }}&background=0E3191&color=fff&size=128" class="w-full h-full object-cover" alt="Foto Kepala Desa: {{ $kepalaDesa->nama }}">
                            @endif
                        </div>
                        <h3 class="text-base font-bold text-prt-ink uppercase tracking-normal text-center mb-1 leading-none">{{ $kepalaDesa->nama }}</h3>
                        <p class="text-xs font-medium text-prt-body uppercase tracking-[0.2em] mb-2">{{ $kepalaDesa->jabatan }}</p>
                        <div class="absolute -bottom-12 left-1/2 w-px h-12 bg-blue-200" aria-hidden="true"></div>
                    </article>
                @endif

                {{-- Level 2: Sekretaris Desa --}}
                @if ($sekretaris)
                    <article class="w-full max-w-xs flex flex-col items-center p-4 bg-white relative mb-12 focus-within:ring-2 focus-within:ring-blue-600" role="listitem">
                        <div class="size-20 overflow-hidden mb-3">
                            @if ($sekretaris->gambar)
                                <img src="{{ Storage::url($sekretaris->gambar) }}" class="w-full h-full object-cover" alt="Foto Sekretaris Desa: {{ $sekretaris->nama }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($sekretaris->nama) }}&background=2E7D32&color=fff&size=128" class="w-full h-full object-cover" alt="Foto Sekretaris Desa: {{ $sekretaris->nama }}">
                            @endif
                        </div>
                        <h3 class="text-base font-bold text-prt-ink uppercase tracking-normal text-center mb-1 leading-none">{{ $sekretaris->nama }}</h3>
                        <p class="text-[11px] font-medium text-prt-body uppercase tracking-wide mb-1">{{ $sekretaris->jabatan }}</p>
                        <div class="absolute -bottom-16 left-1/2 w-px h-16 bg-blue-200 hidden lg:block" aria-hidden="true"></div>
                    </article>
                @endif

                {{-- Level 3: Kaur & Kasi --}}
                @if ($staf->isNotEmpty())
                    <div class="w-full px-6">
                        <div class="relative">
                            <div class="absolute -top-16 left-[16.6%] right-[16.6%] h-px bg-blue-200 hidden lg:block" aria-hidden="true"></div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-8 lg:gap-y-10 gap-x-6">
                                @foreach($staf as $person)
                                    <article class="flex flex-col items-center relative group focus-within:ring-2 focus-within:ring-blue-600" role="listitem">
                                        <div class="absolute -top-16 left-1/2 w-px h-16 bg-blue-200 hidden lg:block" aria-hidden="true"></div>
                                        <div class="w-full p-4 bg-prt-bg group-hover:bg-white transition-all flex flex-col items-center">
                                            <div class="size-20 overflow-hidden mb-3">
                                                @if ($person->gambar)
                                                    <img src="{{ Storage::url($person->gambar) }}" class="w-full h-full object-cover" alt="Foto {{ $person->jabatan }}: {{ $person->nama }}">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($person->nama) }}&background=2E7D32&color=fff&size=128" class="w-full h-full object-cover" alt="Foto {{ $person->jabatan }}: {{ $person->nama }}">
                                                @endif
                                            </div>
                                            <h3 class="text-xs font-bold text-prt-ink uppercase tracking-normal text-center mb-1 leading-tight">{{ $person->nama }}</h3>
                                            <p class="text-[10px] font-medium text-prt-body uppercase tracking-wide text-center">{{ $person->jabatan }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-8 text-center text-slate-500">
                        <p>Data perangkat desa belum tersedia.</p>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
