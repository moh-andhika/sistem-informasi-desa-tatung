@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Infografis Desa Tatung"
        :breadcrumbs="['Statistik' => route('infografis')]"
    />
@endsection

@section('content')
    <div class="space-y-6">
        {{-- Statistik Kependudukan Berdasarkan Jenis Kelamin --}}
        <section aria-labelledby="stats-sex-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="stats-sex-title">Data Penduduk (Jenis Kelamin)</h2>
                <flux:icon.users class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">
                    <div class="space-y-5">
                        @foreach([
                            ['label' => 'Laki-Laki', 'val' => '1.580', 'p' => 49, 'color' => 'bg-sky-500'],
                            ['label' => 'Perempuan', 'val' => '1.634', 'p' => 51, 'color' => 'bg-rose-400'],
                        ] as $item)
                        <div class="space-y-2">
                            <div class="flex justify-between text-[11px] font-black uppercase tracking-normal">
                                <span class="text-slate-600">{{ $item['label'] }}</span>
                                <span class="text-slate-900">{{ $item['val'] }} <span class="text-slate-400 font-bold">Jiwa</span></span>
                            </div>
                            <div class="h-4 w-full bg-slate-100  overflow-hidden  shadow-inner" role="progressbar" aria-valuenow="{{ $item['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase penduduk {{ $item['label'] }}">
                                <div class="{{ $item['color'] }} h-full " style="width: {{ $item['p'] }}%"></div>
                            </div>
                        </div>
                        @endforeach

                        {{-- Total box --}}
                        <div class="mt-4 p-4 bg-blue-50  flex items-center gap-4">
                            <div class="size-12  bg-prt-primary flex items-center justify-center shrink-0">
                                <flux:icon.users class="size-6 text-white" />
                            </div>
                            <div>
                                <p class="text-2xl font-black text-slate-900 leading-none">3.214</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-wide mt-1">Total Penduduk</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative size-44 mx-auto flex items-center justify-center" role="img" aria-label="Grafik lingkaran perbandingan jenis kelamin: 49% Laki-laki, 51% Perempuan">
                        <svg viewBox="0 0 36 36" class="size-full" aria-hidden="true">
                            <circle cx="18" cy="18" r="16" fill="none" class="text-rose-400" stroke-width="4" stroke="currentColor"></circle>
                            <circle cx="18" cy="18" r="16" fill="none" class="text-sky-500" stroke-width="4" stroke-dasharray="49 100" stroke-linecap="round" stroke="currentColor" transform="rotate(-90 18 18)"></circle>
                        </svg>
                        <div class="absolute text-center" aria-hidden="true">
                            <p class="text-xl font-black text-slate-800 leading-none">3.214</p>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-wide mt-1">Jiwa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Statistik Berdasarkan Pendidikan --}}
        <section aria-labelledby="stats-edu-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="stats-edu-title">Data Penduduk (Pendidikan)</h2>
                <flux:icon.academic-cap class="size-5 text-white/70" />
            </div>
            <div class="p-8 space-y-5">
                @foreach([
                    ['label' => 'SD / Sederajat', 'val' => '1.200', 'p' => 37],
                    ['label' => 'SMP / Sederajat', 'val' => '950', 'p' => 29],
                    ['label' => 'SMA / Sederajat', 'val' => '850', 'p' => 26],
                    ['label' => 'Perguruan Tinggi', 'val' => '214', 'p' => 8],
                ] as $item)
                <div class="space-y-2">
                    <div class="flex justify-between text-[10px] font-black uppercase tracking-wide">
                        <h3 class="text-slate-600">{{ $item['label'] }}</h3>
                        <span class="text-slate-900">{{ $item['val'] }} <span class="text-slate-400 font-bold">Jiwa</span></span>
                    </div>
                    <div class="h-3 w-full bg-blue-50  overflow-hidden shadow-inner" role="progressbar" aria-valuenow="{{ $item['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase penduduk dengan pendidikan {{ $item['label'] }}">
                        <div class="bg-prt-primary h-full " style="width: {{ $item['p'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Statistik Berdasarkan Pekerjaan --}}
        <section aria-labelledby="stats-job-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-secondary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="stats-job-title">Data Penduduk (Pekerjaan)</h2>
                <flux:icon.briefcase class="size-5 text-white/70" />
            </div>
            <div class="p-8 space-y-5">
                @foreach([
                    ['label' => 'Petani / Pekebun', 'val' => '1.800', 'p' => 56],
                    ['label' => 'Buruh Harian Lepas', 'val' => '600', 'p' => 18],
                    ['label' => 'Karyawan Swasta', 'val' => '400', 'p' => 12],
                    ['label' => 'Wiraswasta', 'val' => '250', 'p' => 8],
                    ['label' => 'PNS / TNI / POLRI', 'val' => '164', 'p' => 6],
                ] as $item)
                <div class="space-y-2">
                    <div class="flex justify-between text-[10px] font-black uppercase tracking-wide">
                        <h3 class="text-slate-600">{{ $item['label'] }}</h3>
                        <span class="text-slate-900">{{ $item['val'] }} <span class="text-slate-400 font-bold">Jiwa</span></span>
                    </div>
                    <div class="h-3 w-full bg-blue-50  overflow-hidden shadow-inner" role="progressbar" aria-valuenow="{{ $item['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase penduduk dengan pekerjaan {{ $item['label'] }}">
                        <div class="bg-prt-secondary h-full " style="width: {{ $item['p'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Disclaimer sumber data --}}
        <div class="p-5 bg-blue-50  flex gap-3">
            <flux:icon.information-circle class="size-5 text-prt-primary shrink-0 mt-0.5" />
            <p class="text-xs text-blue-900 font-medium leading-relaxed">Data kependudukan bersumber dari Sistem Informasi Administrasi Kependudukan (SIAK) Desa Tatung. Diperbarui secara berkala sesuai data terkini dari operator kependudukan desa.</p>
        </div>
    </div>
@endsection
