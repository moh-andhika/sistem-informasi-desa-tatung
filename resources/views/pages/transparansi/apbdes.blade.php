@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Anggaran Desa (APBDes)"
        :breadcrumbs="['Transparansi' => '#', 'APBDes' => route('publik.transparansi.apbdes')]"
    />
@endsection

@section('content')
    <div class="space-y-8">
        {{-- Ringkasan Anggaran --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="p-6 flex items-center gap-5 bg-white rounded-lg border border-green-100 shadow-sm hover:shadow-md transition-all group">
                <div class="size-14 rounded-lg bg-[#2E7D32] text-white flex items-center justify-center shadow-md shrink-0">
                    <flux:icon.arrow-down-tray class="size-7" />
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Pendapatan</p>
                    <p class="text-2xl font-black text-slate-900">Rp 1.770.000.000</p>
                    <p class="text-[10px] font-bold text-[#2E7D32] uppercase mt-1">Tahun Anggaran 2025</p>
                </div>
            </div>
            <div class="p-6 flex items-center gap-5 bg-white rounded-lg border border-green-100 shadow-sm hover:shadow-md transition-all group">
                <div class="size-14 rounded-lg bg-[#1B5E20] text-white flex items-center justify-center shadow-md shrink-0">
                    <flux:icon.arrow-up-tray class="size-7" />
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Belanja</p>
                    <p class="text-2xl font-black text-slate-900">Rp 1.500.000.000</p>
                    <p class="text-[10px] font-bold text-[#1B5E20] uppercase mt-1">Tahun Anggaran 2025</p>
                </div>
            </div>
        </div>

        {{-- Detail Pendapatan --}}
        <section aria-labelledby="income-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#2E7D32] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="income-title">Realisasi Pendapatan</h2>
                <span class="text-[10px] font-black text-white/70 uppercase">T.A 2025</span>
            </div>
            <div class="p-8 space-y-7">
                @foreach([
                    ['label' => 'Dana Desa (DD)', 'anggaran' => '1.200.000.000', 'realisasi' => '1.020.000.000', 'p' => 85],
                    ['label' => 'Alokasi Dana Desa (ADD)', 'anggaran' => '450.000.000', 'realisasi' => '405.000.000', 'p' => 90],
                    ['label' => 'Pendapatan Asli Desa (PAD)', 'anggaran' => '120.000.000', 'realisasi' => '72.000.000', 'p' => 60],
                ] as $item)
                <div class="space-y-2">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wide mb-1">{{ $item['label'] }}</h3>
                            <p class="text-[10px] font-bold text-slate-500 uppercase">Anggaran: Rp {{ $item['anggaran'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-base font-black text-[#2E7D32]">Rp {{ $item['realisasi'] }}</p>
                            <p class="text-[10px] font-black text-slate-500 uppercase">{{ $item['p'] }}% Tercapai</p>
                        </div>
                    </div>
                    <div class="h-3 w-full bg-green-50 rounded-full overflow-hidden border border-green-100 shadow-inner" role="progressbar" aria-valuenow="{{ $item['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase realisasi {{ $item['label'] }}">
                        <div class="bg-[#2E7D32] h-full shadow-sm transition-all duration-1000 rounded-full" style="width: {{ $item['p'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Detail Belanja --}}
        <section aria-labelledby="expense-title" class="bg-white rounded-lg border border-green-100 shadow-sm overflow-hidden">
            <div class="bg-[#1B5E20] px-6 py-4 flex items-center justify-between">
                <h2 class="text-sm font-black text-white uppercase tracking-widest" id="expense-title">Realisasi Belanja Per Bidang</h2>
                <flux:icon.chart-bar class="size-5 text-white/70" aria-hidden="true" />
            </div>
            <div class="p-8 space-y-7">
                @foreach([
                    ['label' => 'Bidang Pembangunan Desa', 'anggaran' => '1.000.000.000', 'realisasi' => '800.000.000', 'p' => 80],
                    ['label' => 'Penyelenggaraan Pemerintahan', 'anggaran' => '450.000.000', 'realisasi' => '450.000.000', 'p' => 100],
                    ['label' => 'Pembinaan Kemasyarakatan', 'anggaran' => '200.000.000', 'realisasi' => '160.000.000', 'p' => 80],
                    ['label' => 'Pemberdayaan Masyarakat', 'anggaran' => '120.000.000', 'realisasi' => '60.000.000', 'p' => 50],
                ] as $item)
                <div class="space-y-2">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wide mb-1">{{ $item['label'] }}</h3>
                            <p class="text-[10px] font-bold text-slate-500 uppercase">Anggaran: Rp {{ $item['anggaran'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-base font-black text-[#1B5E20]">Rp {{ $item['realisasi'] }}</p>
                            <p class="text-[10px] font-black text-slate-500 uppercase">{{ $item['p'] }}% Terealisasi</p>
                        </div>
                    </div>
                    <div class="h-3 w-full bg-green-50 rounded-full overflow-hidden border border-green-100 shadow-inner" role="progressbar" aria-valuenow="{{ $item['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase realisasi {{ $item['label'] }}">
                        <div class="bg-[#1B5E20] h-full shadow-sm transition-all duration-1000 rounded-full" style="width: {{ $item['p'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Disclaimer --}}
        <div class="p-5 bg-green-50 rounded-lg border border-green-100 flex gap-3">
            <flux:icon.shield-check class="size-5 text-[#2E7D32] shrink-0 mt-0.5" />
            <p class="text-xs text-green-900 font-medium leading-relaxed">Data APBDes ini dipublikasikan sebagai bentuk komitmen transparansi dan akuntabilitas Pemerintah Desa Tatung kepada seluruh masyarakat. Data diperbarui secara berkala setiap triwulan.</p>
        </div>
    </div>
@endsection
