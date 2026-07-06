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
        <section aria-labelledby="bagan-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#2E7D32] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="bagan-title">Bagan Struktur Organisasi</h2>
                <flux:icon.chart-pie class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                <div class="rounded-lg border border-green-50 overflow-hidden bg-green-50/30 p-2 shadow-inner">
                    <img src="{{ asset('assets/image-98.png') }}" class="w-full h-auto" alt="Bagan Struktur Organisasi Desa Tatung">
                </div>
            </div>
        </section>

        {{-- Struktur Aparatur Desa --}}
        <section aria-labelledby="personil-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#1B5E20] px-6 py-4 border-b border-green-900 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="personil-title">Daftar Aparatur Desa</h2>
                <flux:icon.identification class="size-5 text-green-400" />
            </div>

            @php
                $aparatur = [
                    ['nama' => 'Rudianto', 'jabatan' => 'Kepala Desa', 'nip' => '19700101XXXXXXXX'],
                    ['nama' => 'Siti Aminah', 'jabatan' => 'Sekretaris Desa', 'nip' => '19820512XXXXXXXX'],
                    ['nama' => 'Budi Santoso', 'jabatan' => 'Kaur Keuangan', 'nip' => '-'],
                    ['nama' => 'Agus Wijaya', 'jabatan' => 'Kasi Pemerintahan', 'nip' => '-'],
                    ['nama' => 'Luluk Farida', 'jabatan' => 'Kaur Umum', 'nip' => '-'],
                    ['nama' => 'Heri Prasetyo', 'jabatan' => 'Kaur Perencanaan', 'nip' => '-'],
                    ['nama' => 'Slamet Riadi', 'jabatan' => 'Kasi Kesejahteraan', 'nip' => '-'],
                    ['nama' => 'Mulyono', 'jabatan' => 'Kasi Pelayanan', 'nip' => '-'],
                ];
                $kepalaDesa = $aparatur[0];
                $sekretarisDesa = $aparatur[1];
                $staf = array_slice($aparatur, 2);
            @endphp

            <div class="flex flex-col items-center py-12" role="list" aria-label="Struktur Organisasi Pemerintah Desa Tatung">
                {{-- Level 1: Kepala Desa --}}
                <article class="w-full max-w-sm flex flex-col items-center p-8 border-2 border-[#2E7D32] bg-green-50/40 rounded-lg relative mb-12 focus-within:ring-2 focus-within:ring-green-600" role="listitem">
                    <div class="size-28 rounded-lg overflow-hidden border-4 border-white shadow-md mb-4">
                        <img src="{{ asset('assets/images/kepala-desa.png') }}" class="w-full h-full object-cover" alt="Foto Kepala Desa: {{ $kepalaDesa['nama'] }}">
                    </div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight text-center mb-1 leading-none">{{ $kepalaDesa['nama'] }}</h3>
                    <p class="text-xs font-bold text-[#2E7D32] uppercase tracking-[0.2em] mb-3">{{ $kepalaDesa['jabatan'] }}</p>
                    @if($kepalaDesa['nip'] !== '-')
                        <p class="text-[10px] font-medium text-slate-500">NIP. {{ $kepalaDesa['nip'] }}</p>
                    @endif
                    
                    {{-- Vertical Line Down --}}
                    <div class="absolute -bottom-12 left-1/2 w-px h-12 bg-green-200" aria-hidden="true"></div>
                </article>

                {{-- Level 2: Sekretaris Desa --}}
                <article class="w-full max-w-xs flex flex-col items-center p-6 border border-green-100 bg-white rounded-lg relative mb-16 focus-within:ring-2 focus-within:ring-green-600 shadow-sm" role="listitem">
                    <div class="size-24 rounded-lg overflow-hidden border-2 border-green-100 shadow-sm mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($sekretarisDesa['nama']) }}&background=2E7D32&color=fff&size=128" class="w-full h-full object-cover" alt="Foto Sekretaris Desa: {{ $sekretarisDesa['nama'] }}">
                    </div>
                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight text-center mb-1 leading-none">{{ $sekretarisDesa['nama'] }}</h3>
                    <p class="text-[11px] font-bold text-[#2E7D32] uppercase tracking-widest mb-2">{{ $sekretarisDesa['jabatan'] }}</p>
                    @if($sekretarisDesa['nip'] !== '-')
                        <p class="text-[10px] font-medium text-slate-400">NIP. {{ $sekretarisDesa['nip'] }}</p>
                    @endif

                    {{-- Vertical Line Down --}}
                    <div class="absolute -bottom-16 left-1/2 w-px h-16 bg-green-200 hidden lg:block" aria-hidden="true"></div>
                </article>

                {{-- Level 3: Kaur & Kasi --}}
                <div class="w-full px-6">
                    <div class="relative">
                        {{-- Horizontal Connector Line --}}
                        <div class="absolute -top-16 left-[16.6%] right-[16.6%] h-px bg-green-200 hidden lg:block" aria-hidden="true"></div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 lg:gap-y-16 gap-x-8">
                            @foreach($staf as $person)
                            <article class="flex flex-col items-center relative group focus-within:ring-2 focus-within:ring-green-600" role="listitem">
                                {{-- Vertical Line Up to Connector --}}
                                <div class="absolute -top-16 left-1/2 w-px h-16 bg-green-200 hidden lg:block" aria-hidden="true"></div>
                                
                                <div class="w-full p-6 border border-green-50 bg-green-50/20 rounded-lg group-hover:border-green-200 group-hover:bg-white group-hover:shadow-md transition-all flex flex-col items-center">
                                    <div class="size-20 rounded-lg overflow-hidden border-2 border-white shadow-sm mb-4 group-hover:border-green-400 transition-colors">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($person['nama']) }}&background=2E7D32&color=fff&size=128" class="w-full h-full object-cover" alt="Foto {{ $person['jabatan'] }}: {{ $person['nama'] }}">
                                    </div>
                                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-tight text-center mb-1 leading-tight group-hover:text-[#2E7D32] transition-colors">{{ $person['nama'] }}</h3>
                                    <p class="text-[10px] font-bold text-[#2E7D32] uppercase tracking-widest text-center">{{ $person['jabatan'] }}</p>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
