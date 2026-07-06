@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Visi &amp; Misi Desa"
        :breadcrumbs="['Profil' => '#', 'Visi & Misi' => route('publik.profil.visi-misi')]"
    />
@endsection

@section('content')
    <div class="space-y-12">
        {{-- Visi --}}
        <section aria-labelledby="visi-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#2E7D32] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="visi-title">Visi Desa Tatung</h2>
                <flux:icon.eye class="size-5 text-white/70" />
            </div>
            <div class="py-14 text-center px-6 sm:px-16 relative overflow-hidden">
                {{-- Dekorasi background --}}
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%232E7D32\' fill-opacity=\'0.04\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
                <div class="relative z-10">
                    <flux:icon.sparkles class="size-8 text-[#F9A825] mx-auto mb-5" />
                    <p class="text-xl sm:text-2xl font-bold text-slate-900 italic leading-relaxed tracking-tight max-w-3xl mx-auto">
                        "Terwujudnya Desa Tatung yang Mandiri, Sejahtera, Transparan, dan Unggul dalam Pelayanan Berbasis Digital pada Tahun 2029."
                    </p>
                </div>
            </div>
        </section>

        {{-- Misi --}}
        <section aria-labelledby="misi-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#1B5E20] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="misi-title">Misi Desa Tatung</h2>
                <flux:icon.list-bullet class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                <div class="space-y-3" role="list" aria-label="Daftar Misi Desa Tatung">
                    @php
                        $misi = [
                            ['id' => '01', 'title' => 'Tata Kelola Pemerintahan', 'desc' => 'Meningkatkan profesionalisme aparatur desa dalam memberikan pelayanan publik yang cepat, tepat, dan transparan.', 'icon' => 'building-office'],
                            ['id' => '02', 'title' => 'Pembangunan Infrastruktur', 'desc' => 'Melaksanakan pembangunan sarana dan prasarana desa yang berkualitas dan merata di seluruh dusun.', 'icon' => 'wrench-screwdriver'],
                            ['id' => '03', 'title' => 'Ekonomi & UMKM', 'desc' => 'Memberdayakan potensi ekonomi lokal melalui pembinaan UMKM dan optimalisasi peran BUMDes.', 'icon' => 'currency-dollar'],
                            ['id' => '04', 'title' => 'Kualitas SDM', 'desc' => 'Meningkatkan taraf hidup masyarakat melalui program pendidikan, kesehatan, dan pembinaan kepemudaan.', 'icon' => 'academic-cap'],
                            ['id' => '05', 'title' => 'Digitalisasi Desa', 'desc' => 'Mengembangkan sistem informasi desa untuk mempermudah akses data dan layanan administrasi online.', 'icon' => 'computer-desktop'],
                        ];
                    @endphp

                    @foreach($misi as $item)
                    <div class="flex gap-5 group p-5 rounded-lg border border-transparent hover:border-green-100 hover:bg-green-50/40 transition-all" role="listitem">
                        <div class="shrink-0 size-14 rounded-lg bg-green-100 border border-green-200 flex items-center justify-center text-[#2E7D32] font-black text-xl group-hover:bg-[#2E7D32] group-hover:text-white transition-all shadow-sm">
                            {{ $item['id'] }}
                        </div>
                        <div class="pt-1">
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-tight mb-2 group-hover:text-[#2E7D32] transition-colors">{{ $item['title'] }}</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
