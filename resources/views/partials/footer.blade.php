<footer class="mt-8 bg-[#1B5E20] text-white">
    {{-- Divider strip kuning emas --}}
    <div class="h-1 bg-[#F9A825]"></div>

    <x-public.container as="div" class="grid gap-8 py-10 lg:grid-cols-4">
        {{-- Brand --}}
        <div class="space-y-5">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo Kabupaten Ponorogo" class="h-12 w-auto " />
                <div>
                    <p class="text-base font-black text-white uppercase tracking-widest leading-none">Desa Tatung</p>
                    <p class="text-[10px] font-semibold text-green-300 uppercase tracking-widest mt-1">Kab. Ponorogo, Jawa Timur</p>
                </div>
            </div>
            <p class="text-sm text-green-100 leading-relaxed">Sistem Informasi Desa resmi untuk layanan publik, transparansi pembangunan, dan kemudahan akses data kependudukan bagi seluruh warga Desa Tatung.</p>
            <div class="flex items-center gap-2 pt-1">
                <span class="size-2 rounded-full bg-[#F9A825] animate-pulse"></span>
                <span class="text-[11px] font-bold text-green-200 uppercase tracking-widest">Sistem Online</span>
            </div>
        </div>

        {{-- Profil & Potensi --}}
        <div>
            <p class="text-[10px] font-black text-[#F9A825] uppercase tracking-[0.2em] mb-5 pb-2 border-b border-green-700">Profil &amp; Potensi</p>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('publik.profil.sejarah') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Sejarah Desa</a></li>
                <li><a href="{{ route('publik.profil.aparatur') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Aparatur Pemerintahan</a></li>
                <li><a href="{{ route('publik.potensi.umkm') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Produk UMKM Unggulan</a></li>
                <li><a href="{{ route('publik.potensi.pariwisata') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Destinasi Pariwisata</a></li>
            </ul>
        </div>

        {{-- Informasi Publik --}}
        <div>
            <p class="text-[10px] font-black text-[#F9A825] uppercase tracking-[0.2em] mb-5 pb-2 border-b border-green-700">Informasi Publik</p>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('publik.publikasi.berita.index') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Berita &amp; Pengumuman</a></li>
                <li><a href="{{ route('publik.transparansi.apbdes') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Transparansi Anggaran</a></li>
                <li><a href="{{ route('infografis') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Statistik Kependudukan</a></li>
                <li><a href="{{ route('publik.layanan.informasi-surat') }}" class="text-green-100 hover:text-[#F9A825] hover:translate-x-1 transition-all inline-flex items-center gap-2"><flux:icon.chevron-right class="size-3 text-green-500" />Panduan Layanan Surat</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <p class="text-[10px] font-black text-[#F9A825] uppercase tracking-[0.2em] mb-5 pb-2 border-b border-green-700">Kontak Kami</p>
            <ul class="space-y-4 text-sm">
                <li class="flex items-start gap-3">
                    <flux:icon.map-pin class="size-5 shrink-0 text-[#F9A825] mt-0.5" />
                    <span class="text-green-100 leading-relaxed">Kantor Kepala Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo, Jawa Timur</span>
                </li>
                <li class="flex items-center gap-3">
                    <flux:icon.phone class="size-5 shrink-0 text-[#F9A825]" />
                    <span class="text-green-100">(0352) xxxxxxx</span>
                </li>
                <li class="flex items-center gap-3">
                    <flux:icon.envelope class="size-5 shrink-0 text-[#F9A825]" />
                    <span class="text-green-100">pemdes@@tatung.desa.id</span>
                </li>
            </ul>
        </div>
    </x-public.container>

    {{-- Bottom bar --}}
    <div class="border-t border-green-800 bg-[#1B5E20]/80">
        <x-public.container class="flex flex-col items-center justify-between gap-3 py-5 text-xs text-green-300 sm:flex-row">
            <p>&copy; {{ now()->year }} Pemerintah Desa Tatung &mdash; Seluruh hak cipta dilindungi undang-undang.</p>
            <span class="uppercase tracking-widest font-black text-green-500">e-Government Portal Desa</span>
        </x-public.container>
    </div>
</footer>
