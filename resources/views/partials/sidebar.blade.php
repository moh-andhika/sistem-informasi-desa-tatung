@php
    $profil = [
        'nama_desa' => 'DESA TATUNG',
        'kecamatan' => 'Kecamatan Balong',
        'kabupaten' => 'Kabupaten Ponorogo',
        'penduduk' => '3.214',
        'lk' => '1.580',
        'pr' => '1.634',
        'kk' => '812',
    ];

    $pengumuman = \App\Models\Pengumuman::where("is_active", true)
        ->latest("published_at")
        ->take(4)
        ->get();
@endphp

<div class="space-y-8 pb-12">
    {{-- Layanan Mandiri (Login Widget) --}}
    <section class="overflow-hidden  bg-white " aria-labelledby="widget-login-title">
        <div class="flex items-center justify-betweenlue-900/10 bg-linear-to-r from-[#0e3191] to-[#024ad8] px-6 py-4">
            <h3 class="text-xs font-black text-white uppercase tracking-widest" id="widget-login-title">Layanan Mandiri</h3>
            <flux:icon.user-circle class="size-5 text-[#ff5050]" aria-hidden="true" />
        </div>
        <div class="p-8">
            <form action="{{ route('login') }}" class="space-y-5">
                <div class="space-y-2">
                    <label for="sidebar-nik" class="text-[11px] font-black text-slate-500 uppercase tracking-widest">NIK / Nomor KTP</label>
                    <input type="text" id="sidebar-nik" name="nik" placeholder="Masukkan 16 digit NIK" class="w-full  bg-white p-3.5 text-sm outline-none transition-all focus: focus:ring-2 focus:ring-[#ff5050]/40  required>
                </div>
                <div class="space-y-2">
                    <label for="sidebar-pin" class="text-[11px] font-black text-slate-500 uppercase tracking-widest">PIN / Password</label>
                    <input type="password" id="sidebar-pin" name="password" placeholder="********" class="w-full  bg-white p-3.5 text-sm outline-none transition-all focus: focus:ring-2 focus:ring-[#ff5050]/40  required>
                </div>
                <button type="submit" class="w-full  bg-[#0e3191] py-4 text-xs font-black uppercase tracking-widest text-white transition-colors hover:bg-[#0a2465] focus:ring-2 focus:ring-[#ff5050] focus:ring-offset-2">Masuk Sekarang</button>
            </form>
            <div class="mt-6  pt-6 text-center text-xs font-medium italic leading-relaxed text-slate-500">
                Belum memiliki akun? Silakan hubungi operator desa dengan membawa KTP & KK asli.
            </div>
        </div>
    </section>

    {{-- Pengumuman Widget --}}
    <section class="overflow-hidden  bg-white " aria-labelledby="widget-announcement-title">
        <div class="flex items-center justify-betweenlue-900/10 bg-[#0a2465] px-6 py-4">
            <h3 class="text-xs font-black text-white uppercase tracking-widest" id="widget-announcement-title">Pengumuman Terkini</h3>
            <flux:icon.megaphone class="size-5 text-[#ff5050]" aria-hidden="true" />
        </div>
        <div class="divide-y divide-blue-50" role="list">
            @forelse($pengumuman as $item)
                <div class="group cursor-pointer p-5 transition-all hover:bg-blue-50" role="listitem">
                    <div class="mb-1.5 flex items-center gap-2 text-[10px] font-black uppercase tracking-tighter text-[#024ad8]">
                        <flux:icon.clock class="size-3.5" aria-hidden="true" /> 
                        <time datetime="{{ $item->published_at ?? $item->created_at }}">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                        </time>
                    </div>
                    <h4 class="text-sm font-bold uppercase leading-normal tracking-tight text-slate-800 group-hover:text-[#0e3191]">{{ $item->judul }}</h4>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-sm italic">Belum ada pengumuman saat ini.</div>
            @endforelse
        </div>
        <a href="#" class="block  bg-blue-50 py-3.5 text-center text-[10px] font-black uppercase tracking-widest text-[#024ad8] transition-colors hover:bg-blue-100 hover:text-[#0e3191]">Arsip Pengumuman &rarr;</a>
    </section>

    {{-- Statistik Penduduk Widget --}}
    <section class="overflow-hidden  bg-white " aria-labelledby="widget-stats-title">
        <div class="flex items-center justify-betweenlue-900/10 bg-linear-to-r from-[#0e3191] to-[#024ad8] px-6 py-4">
            <h3 class="text-xs font-black text-white uppercase tracking-widest" id="widget-stats-title">Statistik Penduduk</h3>
            <flux:icon.users class="size-5 text-[#ff5050]" aria-hidden="true" />
        </div>
        <div class="p-8 space-y-6">
            @foreach([
                ['label' => 'Total Penduduk', 'val' => $profil['penduduk'], 'color' => 'bg-[#0e3191]', 'p' => 100],
                ['label' => 'Laki-Laki', 'val' => $profil['lk'], 'color' => 'bg-[#024ad8]', 'p' => 49],
                ['label' => 'Perempuan', 'val' => $profil['pr'], 'color' => 'bg-[#ff5050]', 'p' => 51],
                ['label' => 'Kepala Keluarga', 'val' => $profil['kk'], 'color' => 'bg-[#0a2465]', 'p' => 100],
            ] as $stat)
            <div class="space-y-2">
                <div class="flex justify-between text-xs font-black uppercase tracking-tight">
                    <span class="text-slate-600">{{ $stat['label'] }}</span>
                    <span class="text-slate-900 text-base">{{ $stat['val'] }} <span class="text-slate-400 font-bold text-xs">Jiwa</span></span>
                </div>
                <div class="h-2 w-full overflow-hidden  bg-slate-100 shadow-inner" role="progressbar" aria-valuenow="{{ $stat['p'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="Statistik {{ $stat['label'] }}">
                    <div class="{{ $stat['color'] }} h-full transition-all duration-1000 " style="width: {{ $stat['p'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('infografis') }}" class="block  bg-blue-50 py-3.5 text-center text-[10px] font-black uppercase tracking-widest text-[#024ad8] transition-colors hover:bg-blue-100 hover:text-[#0e3191]">Detail Infografis &rarr;</a>
    </section>

    {{-- Lokasi Widget --}}
    <section class="overflow-hidden  bg-white " aria-labelledby="widget-location-title">
        <div class="flex items-center justify-betweenlue-100 bg-blue-50 px-6 py-4">
            <h3 class="text-xs font-black uppercase tracking-widest text-[#0a2465]" id="widget-location-title">Wilayah Desa</h3>
            <flux:icon.map-pin class="size-5 text-[#024ad8]" aria-hidden="true" />
        </div>
        <div class="h-64 bg-slate-100">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.717148560377!2d111.442841!3d-7.928424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790f9b5a0a1a1b%3A0x5a0a1a1b5a0a1a1b!2sDesa%20Tatung!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" title="Peta Lokasi Desa Tatung" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="p-5 text-center text-[10px] font-bold uppercase leading-relaxed tracking-tight text-slate-600">
            Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo
        </div>
    </section>
</div>
