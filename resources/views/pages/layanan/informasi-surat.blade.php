@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Panduan Layanan Surat"
        :breadcrumbs="['Layanan' => '#', 'Panduan Surat' => route('publik.layanan.informasi-surat')]"
    />
@endsection

@section('content')
    <div class="space-y-10">
        {{-- Banner info jam pelayanan --}}
        <div class="bg-blue-50  p-6  ">
            <div class="flex gap-4">
                <flux:icon.information-circle class="size-6 text-[#024ad8] shrink-0 mt-0.5" />
                <div>
                    <h4 class="text-sm font-black text-blue-900 uppercase tracking-normal mb-1">Jam Pelayanan</h4>
                    <p class="text-sm text-blue-800 font-medium leading-relaxed">Pastikan Anda membawa dokumen asli dan fotokopi yang diperlukan. Pelayanan di kantor desa dibuka setiap hari kerja <strong>Senin – Jumat, pukul 08:00 – 15:00 WIB</strong>.</p>
                </div>
            </div>
        </div>

        {{-- Jenis Layanan Surat (Accordion) --}}
        @php
            $layanans = [
                ['judul' => 'Surat Keterangan Tidak Mampu (SKTM)', 'syarat' => ['Fotokopi KTP & KK', 'Surat Pengantar RT/RW', 'Surat Pernyataan Bermaterai (jika perlu)']],
                ['judul' => 'Surat Keterangan Domisili', 'syarat' => ['Fotokopi KTP & KK', 'Surat Pengantar RT/RW']],
                ['judul' => 'Surat Keterangan Usaha (SKU)', 'syarat' => ['Fotokopi KTP & KK', 'Surat Pengantar RT/RW', 'Foto Tempat Usaha']],
                ['judul' => 'Pengantar Akta Kelahiran/Kematian', 'syarat' => ['Fotokopi KK', 'Surat Keterangan dari RS/Bidan', 'Fotokopi KTP Saksi']],
            ];
        @endphp

        <section aria-labelledby="accordion-title" class="bg-white  overflow-hidden">
            <div class="bg-[#024ad8] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-wide" id="accordion-title">Jenis Layanan Surat</h2>
                <flux:icon.document-text class="size-5 text-white/70" />
            </div>
            <div class="divide-y divide-blue-50">
                @foreach($layanans as $index => $item)
                <div x-data="{ open: false }" class="transition-all focus-within:ring-2 focus-within:ring-[#024ad8] focus-within:ring-inset">
                    <button 
                        @click="open = !open" 
                        class="w-full py-5 flex items-center justify-between hover:bg-blue-50 transition-colors focus:outline-none px-6"
                        :aria-expanded="open"
                        aria-controls="content-{{ $index }}"
                        id="trigger-{{ $index }}"
                    >
                        <span class="flex items-center gap-3">
                            <span class="size-7  bg-blue-100 flex items-center justify-center text-[10px] font-black text-[#024ad8]">{{ str_pad($index+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wide text-left">{{ $item['judul'] }}</h3>
                        </span>
                        <flux:icon.chevron-down class="size-4 text-blue-400 transition-transform duration-300 shrink-0 ml-4" x-bind:class="open ? 'rotate-180' : ''" aria-hidden="true" />
                    </button>
                    <div 
                        x-show="open" 
                        x-collapse 
                        id="content-{{ $index }}"
                        role="region"
                        aria-labelledby="trigger-{{ $index }}"
                    >
                        <div class="px-8 pb-7 pt-2 bg-blue-50/30">
                            <p class="text-[10px] font-black text-[#024ad8] uppercase tracking-[0.2em] mb-4">Persyaratan Dokumen:</p>
                            <ul class="space-y-3 mb-6" role="list">
                                @foreach($item['syarat'] as $s)
                                <li class="flex items-center gap-3 text-sm text-slate-700 font-medium">
                                    <flux:icon.check-circle class="size-4 text-[#024ad8] shrink-0" aria-hidden="true" />
                                    {{ $s }}
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-black text-white uppercase tracking-wide bg-[#024ad8] px-5 py-2.5  hover:bg-[#0e3191] focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#024ad8] transition-all ">
                                <flux:icon.arrow-right class="size-4" />
                                Ajukan Online Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Alur Pengajuan --}}
        <section aria-labelledby="alur-title" class="bg-white  overflow-hidden">
            <div class="bg-[#0e3191] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-wide" id="alur-title">Alur Pengajuan Surat</h2>
                <flux:icon.arrow-path class="size-5 text-white/70" />
            </div>
            <div class="p-8">
                <div class="relative">
                    <div class="absolute left-5 top-5 bottom-5 w-0.5 bg-blue-100 hidden sm:block"></div>
                    <div class="space-y-6">
                        @foreach([
                            ['step' => '01', 'title' => 'Ketua RT/RW', 'desc' => 'Meminta surat pengantar dari Ketua RT dan RW setempat.'],
                            ['step' => '02', 'title' => 'Kantor Desa', 'desc' => 'Menuju loket pelayanan desa dengan membawa persyaratan lengkap.'],
                            ['step' => '03', 'title' => 'Verifikasi', 'desc' => 'Petugas memverifikasi kelengkapan dokumen dan menginput data.'],
                            ['step' => '04', 'title' => 'Tanda Tangan', 'desc' => 'Penandatanganan dokumen oleh Kepala Desa atau Sekretaris Desa.'],
                            ['step' => '05', 'title' => 'Selesai', 'desc' => 'Surat dapat diambil di loket pelayanan desa.'],
                        ] as $step)
                        <div class="relative flex items-start gap-5 group">
                            <div class="size-10  bg-[#024ad8] flex items-center justify-center text-white font-black text-xs shrink-0 z-10 group-hover:scale-110 transition-transform">
                                {{ $step['step'] }}
                            </div>
                            <div class="pt-2 pb-2">
                                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wide mb-1 group-hover:text-[#024ad8] transition-colors">{{ $step['title'] }}</h4>
                                <p class="text-sm text-slate-600 leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
