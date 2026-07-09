@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Profil Wilayah Desa"
        :breadcrumbs="['Profil' => '#', 'Profil Wilayah' => route('publik.profil.wilayah')]"
    />
@endsection

@section('content')
    <div class="space-y-8">
        {{-- Peta Interaktif --}}
        <section aria-labelledby="map-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="map-title">Peta Administrasi Desa</h2>
                <flux:icon.map class="size-5 text-white/70" />
            </div>
            <div class="h-[400px] bg-slate-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.717148560377!2d111.442841!3d-7.928424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790f9b5a0a1a1b%3A0x5a0a1a1b5a0a1a1b!2sDesa%20Tatung!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>

        {{-- Statistik Cepat --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach([
                ['val' => '412,5 Ha', 'label' => 'Luas Wilayah', 'icon' => 'map'],
                ['val' => '3.214 Jiwa', 'label' => 'Total Penduduk', 'icon' => 'users'],
                ['val' => '5 Dusun', 'label' => 'Wilayah Dusun', 'icon' => 'rectangle-group'],
                ['val' => '105 mdpl', 'label' => 'Ketinggian', 'icon' => 'arrow-trending-up'],
            ] as $stat)
            <div class="bg-white  p-5 flex flex-col items-center text-center group hover:  transition-all">
                <div class="size-10  bg-blue-100 flex items-center justify-center mb-3 group-hover:bg-prt-primary transition-colors">
                    <flux:icon :name="$stat['icon']" class="size-5 text-prt-primary group-hover:text-white transition-colors" />
                </div>
                <p class="text-xl font-black text-slate-900 leading-none mb-1">{{ $stat['val'] }}</p>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Batas Wilayah & Geografis --}}
        <div class="grid sm:grid-cols-2 gap-6">
            <section aria-labelledby="borders-title" class="bg-white  overflow-hidden">
                <div class="bg-prt-secondary px-6 py-4lue-900 flex items-center justify-between">
                    <h3 class="text-sm font-black text-white uppercase tracking-wide" id="borders-title">Batas Wilayah</h3>
                    <flux:icon.arrows-right-left class="size-4 text-blue-400" />
                </div>
                <div class="p-6">
                    <ul class="space-y-0 divide-y divide-blue-50">
                        @foreach([
                            ['arah' => 'Utara', 'desa' => 'Desa Balong'],
                            ['arah' => 'Selatan', 'desa' => 'Desa Singgahan'],
                            ['arah' => 'Timur', 'desa' => 'Kecamatan Jetis'],
                            ['arah' => 'Barat', 'desa' => 'Desa Ngasinan'],
                        ] as $batas)
                        <li class="flex justify-between items-center py-3 px-1">
                            <span class="inline-flex items-center gap-2">
                                <span class="size-2  bg-prt-primary"></span>
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-wide">{{ $batas['arah'] }}</span>
                            </span>
                            <span class="text-sm font-bold text-slate-700">{{ $batas['desa'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section aria-labelledby="geo-title" class="bg-white  overflow-hidden">
                <div class="bg-prt-primary px-6 py-4lue-900 flex items-center justify-between">
                    <h3 class="text-sm font-black text-white uppercase tracking-wide" id="geo-title">Orbitasi &amp; Geografis</h3>
                    <flux:icon.globe-asia-australia class="size-4 text-white/70" />
                </div>
                <div class="p-6">
                    <ul class="space-y-0 divide-y divide-blue-50">
                        @foreach([
                            ['label' => 'Luas Wilayah', 'val' => '412,5 Ha'],
                            ['label' => 'Jarak ke Kec.', 'val' => '3 Km'],
                            ['label' => 'Jarak ke Kab.', 'val' => '12 Km'],
                            ['label' => 'Ketinggian', 'val' => '105 mdpl'],
                        ] as $geo)
                        <li class="flex justify-between items-center py-3 px-1">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-wide">{{ $geo['label'] }}</span>
                            <span class="text-sm font-bold text-slate-700">{{ $geo['val'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>

        {{-- Pembagian Wilayah Dusun --}}
        <section aria-labelledby="dusun-title" class="bg-white  overflow-hidden">
            <div class="bg-prt-primary px-6 py-4lue-700 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="dusun-title">Wilayah Administratif Dusun</h2>
                <flux:icon.rectangle-group class="size-5 text-white/70" />
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left text-xs font-bold uppercase tracking-wide">
                    <caption class="sr-only">Daftar wilayah administratif dusun di Desa Tatung</caption>
                    <thead class="bg-blue-50  text-blue-800">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nama Dusun</th>
                            <th scope="col" class="px-6 py-4">Jumlah RT</th>
                            <th scope="col" class="px-6 py-4">Kepala Dusun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50 text-slate-700">
                        @foreach([
                            ['nama' => 'Dusun Tatung I', 'rt' => '4', 'kadun' => 'Sukirman'],
                            ['nama' => 'Dusun Tatung II', 'rt' => '5', 'kadun' => 'Wahyudi'],
                            ['nama' => 'Dusun Krajan', 'rt' => '6', 'kadun' => 'Sujatno'],
                            ['nama' => 'Dusun Mulyorejo', 'rt' => '4', 'kadun' => 'Anto S.'],
                            ['nama' => 'Dusun Sidomulyo', 'rt' => '5', 'kadun' => 'Bambang'],
                        ] as $dusun)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">{{ $dusun['nama'] }}</td>
                            <td class="px-6 py-4">{{ $dusun['rt'] }} RT</td>
                            <td class="px-6 py-4">{{ $dusun['kadun'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
