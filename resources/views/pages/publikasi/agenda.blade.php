@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Agenda Kegiatan Desa"
        :breadcrumbs="['Publikasi' => '#', 'Agenda' => route('publik.publikasi.agenda')]"
    />
@endsection

@section('content')
    <div class="space-y-6">
        <section aria-labelledby="agenda-list-title" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-prt-primary px-4 py-3 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-wide" id="agenda-list-title">Kalender Kegiatan Desa</h2>
                <flux:icon.calendar-days class="size-4 text-white/70" />
            </div>

            @php
                $agendas = [
                    ['tgl' => '20', 'bln' => 'APR', 'thn' => '2025', 'judul' => 'Musyawarah Desa Penetapan RPJM Desa 2025-2030', 'jam' => '09:00 WIB', 'lokasi' => 'Balai Desa Tatung'],
                    ['tgl' => '24', 'bln' => 'APR', 'thn' => '2025', 'judul' => 'Rapat Koordinasi Pengurus BPD Tatung', 'jam' => '19:30 WIB', 'lokasi' => 'Ruang Pertemuan BPD'],
                    ['tgl' => '05', 'bln' => 'MEI', 'thn' => '2025', 'judul' => 'Sosialisasi Program Ketahanan Pangan Nabati', 'jam' => '08:30 WIB', 'lokasi' => 'Gedung Serbaguna Desa'],
                    ['tgl' => '12', 'bln' => 'MEI', 'thn' => '2025', 'judul' => 'Pelatihan Digital Marketing untuk Pelaku UMKM', 'jam' => '13:00 WIB', 'lokasi' => 'Laboratorium Komputer Desa'],
                ];
            @endphp

            <div class="divide-y divide-blue-50" role="list" aria-label="Daftar agenda kegiatan mendatang">
                @foreach($agendas as $event)
                <article class="flex flex-col sm:flex-row gap-0 hover:bg-blue-50/40 transition-colors group" role="listitem">
                    {{-- Tanggal box --}}
                    <div class="bg-prt-secondary text-white sm:w-20 flex flex-row sm:flex-col items-center sm:justify-center gap-2 sm:gap-0 px-3 py-3 sm:py-4 shrink-0" aria-hidden="true">
                        <span class="text-2xl font-black leading-none">{{ $event['tgl'] }}</span>
                        <div class="sm:text-center">
                            <span class="text-[9px] font-black tracking-wide uppercase block">{{ $event['bln'] }}</span>
                            <span class="text-[9px] font-medium text-blue-300 tracking-wide uppercase block">{{ $event['thn'] }}</span>
                        </div>
                    </div>
                    {{-- Detail --}}
                    <div class="flex-1 px-4 py-3">
                        <div class="sr-only">Tanggal Kegiatan: {{ $event['tgl'] }} {{ $event['bln'] }} {{ $event['thn'] }}</div>
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-normal mb-2 leading-snug group-hover:text-prt-primary transition-colors">{{ $event['judul'] }}</h3>
                        <div class="flex flex-wrap gap-x-4 gap-y-1">
                            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-wide">
                                <flux:icon.clock class="size-3.5 text-prt-primary" aria-hidden="true" />
                                <span><span class="sr-only">Waktu:</span> {{ $event['jam'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-wide">
                                <flux:icon.map-pin class="size-3.5 text-prt-primary" aria-hidden="true" />
                                <span><span class="sr-only">Lokasi:</span> {{ $event['lokasi'] }}</span>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </section>

        {{-- Disclaimer --}}
        <div class="p-4 bg-blue-50 rounded-lg flex gap-2">
            <flux:icon.information-circle class="size-5 text-prt-primary shrink-0 mt-0.5" />
            <p class="text-xs text-blue-900 font-medium leading-relaxed">Jadwal kegiatan dapat berubah sewaktu-waktu menyesuaikan dengan kondisi di lapangan. Untuk konfirmasi lebih lanjut, silakan hubungi perangkat desa terkait.</p>
        </div>
    </div>
@endsection
