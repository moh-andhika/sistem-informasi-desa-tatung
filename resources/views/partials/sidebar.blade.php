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

<div class="space-y-3 pb-12">
    {{-- Layanan Mandiri (Login Widget) --}}
    <section class="border border-prt-primary/8 bg-white" aria-labelledby="widget-login-title">
        <div class="flex items-center justify-between bg-prt-secondary px-4 py-3">
            <h3 class="text-sm font-bold text-white" id="widget-login-title">Layanan Mandiri</h3>
            <flux:icon.user-circle class="size-5 text-prt-accent" aria-hidden="true" />
        </div>
        <div class="p-4">
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label for="sidebar-nik" class="text-xs font-bold text-prt-muted">NIK / Nomor KTP</label>
                    <input
                        type="text"
                        id="sidebar-nik"
                        name="nik"
                        placeholder="16 digit NIK"
                        autocomplete="username"
                        inputmode="numeric"
                        pattern="[0-9]{16}"
                        maxlength="16"
                        required
                        class="w-full border border-prt-primary/15 bg-white p-3 text-sm text-prt-ink outline-none transition-all focus:border-prt-primary focus:ring-2 focus:ring-prt-primary/20"
                    >
                </div>
                <div class="space-y-1.5">
                    <label for="sidebar-pin" class="text-xs font-bold text-prt-muted">Password</label>
                    <input
                        type="password"
                        id="sidebar-pin"
                        name="password"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                        autocomplete="current-password"
                        required
                        class="w-full border border-prt-primary/15 bg-white p-3 text-sm text-prt-ink outline-none transition-all focus:border-prt-primary focus:ring-2 focus:ring-prt-primary/20"
                    >
                </div>
                <button
                    type="submit"
                    class="w-full bg-prt-secondary py-3 text-xs font-bold text-white transition-colors hover:bg-prt-navy-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent"
                >
                    Masuk
                </button>
            </form>
            <p class="mt-4 text-center text-xs font-medium leading-relaxed text-prt-muted">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-prt-primary underline hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent">Daftar di sini</a>
            </p>
        </div>
    </section>

    {{-- Pengumuman Widget --}}
    <section class="border border-prt-primary/8 bg-white" aria-labelledby="widget-announcement-title">
        <div class="flex items-center justify-between bg-prt-secondary px-4 py-3">
            <h3 class="text-sm font-bold text-white" id="widget-announcement-title">Pengumuman Terkini</h3>
            <flux:icon.megaphone class="size-5 text-prt-accent" aria-hidden="true" />
        </div>
        <div class="divide-y divide-prt-primary/8" role="list">
            @forelse($pengumuman as $item)
                <div class="group p-4 transition-all hover:bg-prt-primary/5" role="listitem">
                    <div class="mb-1.5 flex items-center gap-2 text-xs font-semibold text-prt-muted">
                        <flux:icon.clock class="size-3.5 shrink-0" aria-hidden="true" /> 
                        <time datetime="{{ $item->published_at ?? $item->created_at }}">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                        </time>
                    </div>
                    <h4 class="text-sm font-bold text-prt-ink transition-colors group-hover:text-prt-secondary">{{ $item->judul }}</h4>
                </div>
            @empty
                <div class="p-6 text-center text-sm text-prt-muted">Belum ada pengumuman saat ini.</div>
            @endforelse
        </div>
        <a href="{{ route('publik.publikasi.berita.index') }}" class="block border-t border-prt-primary/8 bg-prt-primary/5 py-3 text-center text-xs font-bold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent">Arsip Pengumuman &rarr;</a>
    </section>

    {{-- Statistik Penduduk Widget --}}
    <section class="border border-prt-primary/8 bg-white" aria-labelledby="widget-stats-title">
        <div class="flex items-center justify-between bg-prt-secondary px-4 py-3">
            <h3 class="text-sm font-bold text-white" id="widget-stats-title">Statistik Penduduk</h3>
            <flux:icon.users class="size-5 text-prt-accent" aria-hidden="true" />
        </div>
        <div class="space-y-4 p-4">
            @foreach([
                ['label' => 'Total Penduduk', 'val' => $profil['penduduk']],
                ['label' => 'Laki-Laki', 'val' => $profil['lk']],
                ['label' => 'Perempuan', 'val' => $profil['pr']],
                ['label' => 'Kepala Keluarga', 'val' => $profil['kk']],
            ] as $stat)
            <div class="space-y-1.5">
                <div class="flex justify-between items-baseline text-xs font-bold">
                    <span class="text-prt-muted">{{ $stat['label'] }}</span>
                    <span class="text-prt-ink text-sm font-bold">{{ $stat['val'] }} <span class="text-prt-muted text-xs font-semibold">Jiwa</span></span>
                </div>
                @if ($stat['label'] !== 'Kepala Keluarga')
                <div
                    class="h-3 w-full overflow-hidden bg-prt-primary/12"
                    role="progressbar"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    aria-label="Total {{ $stat['label'] }}: {{ $stat['val'] }} jiwa"
                >
                    <div class="bg-prt-primary h-full" style="width: 100%"></div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <a href="{{ route('infografis') }}" class="block border-t border-prt-primary/8 bg-prt-primary/5 py-3 text-center text-xs font-bold text-prt-primary transition-colors hover:bg-prt-primary/10 hover:text-prt-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-prt-accent">Detail Infografis &rarr;</a>
    </section>

    {{-- Lokasi Widget --}}
    <section class="border border-prt-primary/8 bg-white" aria-labelledby="widget-location-title">
        <div class="flex items-center justify-between bg-prt-secondary px-4 py-3">
            <h3 class="text-sm font-bold text-white" id="widget-location-title">Wilayah Desa</h3>
            <flux:icon.map-pin class="size-5 text-prt-accent" aria-hidden="true" />
        </div>
        <div class="h-56 bg-prt-primary/5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.717148560377!2d111.442841!3d-7.928424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790f9b5a0a1a1b%3A0x5a0a1a1b5a0a1a1b!2sDesa%20Tatung!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" title="Peta Lokasi Desa Tatung" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="border-t border-prt-primary/8 p-3 text-center text-xs text-prt-muted">
            Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo
        </div>
    </section>
</div>
