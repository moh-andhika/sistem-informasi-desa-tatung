@extends('layouts.public')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('header_content')
    <x-public.page-header
        title="Sejarah Desa Tatung"
        :breadcrumbs="['Profil' => '#', 'Sejarah Desa' => route('publik.profil.sejarah')]"
    />
@endsection

@section('content')
    <div class="space-y-6">
        <section aria-labelledby="history-title" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="history-title">Sejarah &amp; Asal-usul Desa</h2>
                <flux:icon.book-open class="size-5 text-white/70" />
            </div>
            <div class="p-8 sm:p-12">
                <div class="prose prose-slate prose-sm sm:prose-base max-w-none prose-headings:font-black prose-headings:uppercase prose-headings:tracking-normal prose-headings:text-blue-900 prose-p:text-slate-700 prose-p:leading-relaxed">
                    <p>
                        Desa Tatung memiliki sejarah yang kaya dan berakar pada masa lalu yang legendaris di wilayah Kabupaten Ponorogo. Menurut cerita turun-temurun dari para sesepuh desa, nama "Tatung" diyakini berasal dari kata dalam bahasa Jawa kuno yang menggambarkan kondisi geografis atau peristiwa penting pada saat pembukaan lahan pertama kali.
                    </p>

                    <img src="{{ asset('assets/images/background.jpg') }}" alt="Pemandangan Alam Desa Tatung" class="  my-8 w-full h-[400px] object-cover">

                    <h3>Masa Kepemimpinan</h3>
                    <p>
                        Sejak berdirinya, Desa Tatung telah dipimpin oleh beberapa tokoh masyarakat yang berdedikasi tinggi untuk memajukan kesejahteraan warga. Setiap kepemimpinan memberikan warna dan fondasi bagi perkembangan desa hingga menjadi desa yang mandiri seperti saat ini.
                    </p>

                    <div class="not-prose my-10 overflow-x-auto  ">
                        <table class="w-full text-left text-xs uppercase tracking-wide font-black">
                            <caption class="sr-only">Daftar Kepala Desa Tatung dari masa ke masa</caption>
                            <thead class="bg-blue-50lue-100 text-blue-800">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Periode</th>
                                    <th scope="col" class="px-6 py-4">Nama Kepala Desa</th>
                                    <th scope="col" class="px-6 py-4">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-50 text-slate-700">
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-blue-900">1998 - 2006</td>
                                    <td class="px-6 py-4">Bpk. Soedjono</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Pembangunan Dasar</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-blue-900">2006 - 2014</td>
                                    <td class="px-6 py-4">Bpk. Mulyono</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Pengembangan Pertanian</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-blue-900">2014 - Sekarang</td>
                                    <td class="px-6 py-4">Bpk. Rudianto</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Modernisasi &amp; Digitalisasi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Perkembangan Desa</h3>
                    <p>
                        Dari sebuah wilayah yang mayoritas penduduknya bergantung sepenuhnya pada sektor pertanian tradisional, kini Desa Tatung telah bertransformasi menjadi desa yang mulai mengadopsi teknologi digital dalam pelayanan publik, sambil tetap melestarikan kearifan lokal dan gotong royong sebagai identitas utama.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('header_content')
    <x-public.page-header
        title="Sejarah Desa Tatung"
        :breadcrumbs="['Profil' => '#', 'Sejarah Desa' => route('publik.profil.sejarah')]"
    />
@endsection

@section('content')
    <div class="space-y-6">
        <section aria-labelledby="history-title" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-prt-primary px-6 py-4 flex items-center justify-between">
                <h2 class="text-base font-black text-white uppercase tracking-wide" id="history-title">Sejarah & Asal-usul Desa</h2>
                <flux:icon.book-open class="size-5 text-white/70" />
            </div>
            <div class="p-8 sm:p-12">
                <div class="prose prose-slate prose-sm sm:prose-base max-w-none prose-headings:font-black prose-headings:uppercase prose-headings:tracking-normal prose-headings:text-slate-900 prose-p:text-slate-800 prose-p:leading-relaxed">
                    <p>
                        Desa Tatung memiliki sejarah yang kaya dan berakar pada masa lalu yang legendaris di wilayah Kabupaten Ponorogo. Menurut cerita turun-temurun dari para sesepuh desa, nama "Tatung" diyakini berasal dari kata dalam bahasa Jawa kuno yang menggambarkan kondisi geografis atau peristiwa penting pada saat pembukaan lahan pertama kali.
                    </p>

                    <img src="{{ asset('assets/images/background.jpg') }}" alt="Pemandangan Alam Desa Tatung" class="   my-8 w-full h-[400px] object-cover">

                    <h3>Masa Kepemimpinan</h3>
                    <p>
                        Sejak berdirinya, Desa Tatung telah dipimpin oleh beberapa tokoh masyarakat yang berdedikasi tinggi untuk memajukan kesejahteraan warga. Setiap kepemimpinan memberikan warna dan fondasi bagi perkembangan desa hingga menjadi desa yang mandiri seperti saat ini.
                    </p>

                    <div class="not-prose my-10 overflow-x-auto  
                        <table class="w-full text-left text-xs uppercase tracking-wide font-black">
                            <caption class="sr-only">Daftar Kepala Desa Tatung dari masa ke masa</caption>
                            <thead class="bg-slate-50  text-slate-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Periode</th>
                                    <th scope="col" class="px-6 py-4">Nama Kepala Desa</th>
                                    <th scope="col" class="px-6 py-4">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold">1998 - 2006</td>
                                    <td class="px-6 py-4">Bpk. Soedjono</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Pembangunan Dasar</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold">2006 - 2014</td>
                                    <td class="px-6 py-4">Bpk. Mulyono</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Pengembangan Pertanian</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-bold">2014 - Sekarang</td>
                                    <td class="px-6 py-4">Bpk. Rudianto</td>
                                    <td class="px-6 py-4 font-medium normal-case tracking-normal text-slate-500">Modernisasi & Digitalisasi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Perkembangan Desa</h3>
                    <p>
                        Dari sebuah wilayah yang mayoritas penduduknya bergantung sepenuhnya pada sektor pertanian tradisional, kini Desa Tatung telah bertransformasi menjadi desa yang mulai mengadopsi teknologi digital dalam pelayanan publik, sambil tetap melestarikan kearifan lokal dan gotong royong sebagai identitas utama.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
