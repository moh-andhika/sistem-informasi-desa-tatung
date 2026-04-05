

<?php
    $pengumuman = [
        [
            'judul' => 'Penyaluran BLT Tahap 1',
            'tanggal' => '31 Maret 2026',
            'ringkasan' => 'Pembagian bantuan langsung tunai bagi warga terdampak.',
        ],
        [
            'judul' => 'Jalan Usaha Tani Dusun Timur',
            'tanggal' => '30 Maret 2026',
            'ringkasan' => 'Pengerasan jalan untuk mendukung akses pertanian.',
        ],
        [
            'judul' => 'Pelatihan UMKM Desa',
            'tanggal' => '28 Maret 2026',
            'ringkasan' => 'Peningkatan kapasitas pemasaran produk UMKM.',
        ],
    ];

    $layanan = [
        ['nama' => 'Layanan Surat Online', 'keterangan' => 'Ajukan surat keterangan tanpa harus datang ke kantor desa'],
        ['nama' => 'Data Penduduk', 'keterangan' => 'Informasi kependudukan dan kartu keluarga'],
        ['nama' => 'Pengajuan SKTM', 'keterangan' => 'Surat keterangan tidak mampu untuk keperluan sekolah/medis'],
        ['nama' => 'Surat Domisili', 'keterangan' => 'Keterangan tempat tinggal resmi'],
        ['nama' => 'Pengaduan Warga', 'keterangan' => 'Sampaikan aspirasi dan laporan warga'],
        ['nama' => 'Berita Desa', 'keterangan' => 'Informasi kegiatan dan program desa'],
    ];

    $profil = [
        'nama_desa' => 'Desa Tatung',
        'kecamatan' => 'Kecamatan Balong',
        'kabupaten' => 'Kabupaten Ponorogo',
        'provinsi' => 'Provinsi Jawa Timur',
        'penduduk' => '3.214 jiwa',
        'kk' => '812 KK',
        'dusun' => '6 dusun',
        'alamat' => 'Kantor Kepala Desa Tatung, RT 01 / RW 01',
        'telepon' => '08xx-xxxx-xxxx',
        'email' => 'desa@tatung.id',
    ];
?>

<?php $__env->startSection('content'); ?>
    
    <section class="bg-blue-900 border-b border-blue-950 relative overflow-hidden text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute inset-0 bg-linear-to-r from-blue-900 to-blue-800 mix-blend-multiply"></div>

        <div class="relative z-10 mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start justify-between">
                <div class="space-y-6 max-w-2xl text-center md:text-left scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                    <div class="flex items-center justify-center md:justify-start gap-4">
                        <img src="<?php echo e(asset('assets/ponorogo__sid__60A13U2.png')); ?>" alt="Logo Ponorogo" class="h-16 w-auto" />
                        <div class="flex flex-col text-left">
                            <span class="text-sm font-semibold text-blue-300 uppercase tracking-wider">PEMERINTAH KABUPATEN PONOROGO</span>
                            <span class="text-lg font-bold">KECAMATAN BALONG</span>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">
                            Sistem Informasi <br class="hidden sm:block"/>
                            <span class="text-blue-400">Desa Tatung</span>
                        </h1>
                        <p class="mt-4 text-lg text-blue-100 max-w-xl mx-auto md:mx-0 leading-relaxed">
                            Portal informasi resmi untuk layanan administrasi, transparansi pembangunan, dan informasi kemasyarakatan yang cepat dan akuntabel.
                        </p>
                    </div>

                    <div class="flex flex-wrap justify-center md:justify-start gap-4 pt-2">
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Akses Layanan (Masuk)
                        </a>
                        <a href="#layanan" class="inline-flex items-center justify-center rounded-md bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm hover:bg-white/20 transition-colors">
                            Lihat Semua Layanan
                        </a>
                    </div>
                </div>

                <!-- Statistik Card -->
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-1 gap-4 w-full md:w-64">
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-md scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-100">
                        <p class="text-xs text-blue-300 uppercase tracking-wider mb-1">Jumlah Penduduk</p>
                        <p class="text-2xl font-bold text-white"><?php echo e($profil['penduduk']); ?></p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-md scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200">
                        <p class="text-xs text-blue-300 uppercase tracking-wider mb-1">Kartu Keluarga</p>
                        <p class="text-2xl font-bold text-white"><?php echo e($profil['kk']); ?></p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-md scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-300">
                        <p class="text-xs text-blue-300 uppercase tracking-wider mb-1">Wilayah Administrasi</p>
                        <p class="text-2xl font-bold text-white"><?php echo e($profil['dusun']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="relative py-20 sm:py-32 overflow-hidden border-b border-slate-200">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo e(asset('assets/images/background.jpg')); ?>" alt="Pemerintahan Desa Tatung" class="h-full w-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1577493340887-b7bfff550145?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'" />
            <div class="absolute inset-0 bg-slate-900/75 mix-blend-multiply"></div>
            <!-- Extra gradient for better text readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/50 to-transparent"></div>
        </div>

        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out text-center sm:text-left mx-auto sm:mx-0">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-bold tracking-wider uppercase mb-6 backdrop-blur-sm shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-400"></span>
                    </span>
                    Selamat Datang
                </div>

                <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight mb-6">
                    Portal Resmi Pemerintah <br class="hidden sm:block"/> <span class="text-blue-400">Desa Tatung</span>
                </h2>

                <div class="space-y-4 text-slate-200 leading-relaxed text-base sm:text-lg mb-10">
                    <p>
                        Kami menyambut baik kehadiran portal Sistem Informasi Desa (SID) ini sebagai wujud komitmen Pemerintah Desa Tatung dalam mengedepankan transparansi publik dan pelayanan prima kepada seluruh masyarakat.
                    </p>
                    <p>
                        Melalui platform <em>e-Government</em> ini, warga dapat mengakses berbagai layanan administrasi persuratan secara mandiri, memantau program pembangunan, hingga melihat ragam potensi desa mulai dari UMKM hingga sektor pariwisata yang terus kami kembangkan bersama.
                    </p>
                </div>

                <div class="flex items-center justify-center sm:justify-start gap-4 border-t border-white/10 pt-6">
                    <div class="h-14 w-14 rounded-full bg-slate-800 border-2 border-blue-500 shadow-lg overflow-hidden flex items-center justify-center shrink-0">
                        <?php if (isset($component)) { $__componentOriginalcbe89caa4ae8c58f7efd0ed6343c35ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbe89caa4ae8c58f7efd0ed6343c35ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.user','data' => ['class' => 'size-8 text-slate-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-8 text-slate-400']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbe89caa4ae8c58f7efd0ed6343c35ff)): ?>
<?php $attributes = $__attributesOriginalcbe89caa4ae8c58f7efd0ed6343c35ff; ?>
<?php unset($__attributesOriginalcbe89caa4ae8c58f7efd0ed6343c35ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbe89caa4ae8c58f7efd0ed6343c35ff)): ?>
<?php $component = $__componentOriginalcbe89caa4ae8c58f7efd0ed6343c35ff; ?>
<?php unset($__componentOriginalcbe89caa4ae8c58f7efd0ed6343c35ff); ?>
<?php endif; ?>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-white text-lg tracking-wide">Rudianto</p>
                        <p class="text-sm font-medium text-blue-300">Kepala Desa Tatung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="bg-white py-12 sm:py-16 border-b border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 border-l-4 border-blue-600 pl-3">Galeri Kegiatan Desa</h2>
                    <p class="mt-2 text-sm text-slate-600">Potret aktivitas dan program pembangunan di Desa Tatung.</p>
                </div>
                <a href="#" class="hidden sm:block text-sm font-semibold text-blue-600 hover:text-blue-800">Lihat Semua Foto &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Large featured photo -->
                <div class="col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group aspect-square md:aspect-auto cursor-pointer scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-100">
                    <img src="<?php echo e(asset('assets/images/SnapInsta.to_69145198_2415937335192228_144255934130185137_n.jpg')); ?>" alt="Kegiatan Desa 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <span class="inline-flex items-center rounded-md bg-blue-600/90 px-2 py-1 text-xs font-medium text-white mb-3 backdrop-blur-sm">Pembangunan</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-white leading-tight group-hover:text-blue-200 transition-colors">Kerja Bakti Pembersihan Saluran Irigasi Pertanian</h3>
                    </div>
                </div>

                <!-- Smaller photos -->
                <div class="relative rounded-2xl overflow-hidden group aspect-square cursor-pointer scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200">
                    <img src="<?php echo e(asset('assets/images/SnapInsta.to_69259426_2232909180341810_1330224165033982587_n.jpg')); ?>" alt="Kegiatan Desa 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1589309736404-2e142a2acdf0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight group-hover:text-blue-200 transition-colors">Penyaluran Bantuan Sosial</h3>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden group aspect-square cursor-pointer scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-300">
                    <img src="<?php echo e(asset('assets/images/SnapInsta.to_315862432_494817482623285_4773791494567302958_n.jpg')); ?>" alt="Kegiatan Desa 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1551041777-ed277b8dd348?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight group-hover:text-blue-200 transition-colors">Musyawarah Desa</h3>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden group aspect-square cursor-pointer scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-100">
                    <img src="<?php echo e(asset('assets/images/SnapInsta.to_316002942_126881736859024_3656151483480131743_n.jpg')); ?>" alt="Kegiatan Desa 4" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1532372579178-8316e2586df1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight group-hover:text-blue-200 transition-colors">Pelatihan UMKM</h3>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden group aspect-square cursor-pointer scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200">
                    <img src="<?php echo e(asset('assets/images/SnapInsta.to_316272919_962975085087580_7655945414486993464_n.jpg')); ?>" alt="Kegiatan Desa 5" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1505364132034-73d722d43e11?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight group-hover:text-blue-200 transition-colors">Panen Raya Kelompok Tani</h3>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center sm:hidden scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Lihat Semua Foto &rarr;</a>
            </div>
        </div>
    </section>

    
    <section id="layanan" class="bg-slate-50 border-b border-slate-200">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="mb-10 text-center max-w-2xl mx-auto scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Layanan Publik Digital</h2>
                <div class="mt-2 h-1 w-20 bg-blue-600 mx-auto rounded"></div>
                <p class="mt-4 text-base text-slate-600">Akses berbagai layanan administrasi kependudukan tanpa perlu antre di kantor desa. Cepat, mudah, dan transparan.</p>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="group relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200 scroll-reveal opacity-0 translate-y-8 ease-out delay-[<?php echo e($index * 100); ?>ms]" style="transition-duration: 700ms;">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition-colors"><?php echo e($item['nama']); ?></h3>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed"><?php echo e($item['keterangan']); ?></p>
                        <div class="mt-4 flex items-center text-sm font-semibold text-blue-600 group-hover:text-blue-800">
                            Mulai Ajukan <span aria-hidden="true" class="ml-1">&rarr;</span>
                        </div>
                        <a href="<?php echo e(route('login')); ?>" class="absolute inset-0 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                            <span class="sr-only">Akses layanan <?php echo e($item['nama']); ?></span>
                        </a>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="bg-white mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">

            <!-- Pengumuman Column (Left, Narrower) -->
            <div id="pengumuman" class="lg:col-span-4 scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900 border-l-4 border-orange-500 pl-3">Papan Pengumuman</h2>
                </div>
                <div class="flex flex-col gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index < 3): ?> <!-- Limit to 3 items -->
                        <div class="relative rounded-xl bg-orange-50/50 p-4 border border-orange-100 hover:bg-orange-50 transition-colors">
                            <div class="flex items-center gap-2 mb-2 text-xs font-medium text-orange-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
                                </svg>
                                <?php echo e($item['tanggal']); ?>

                            </div>
                            <h3 class="text-base font-bold text-slate-900 leading-snug"><?php echo e($item['judul']); ?></h3>
                            <p class="mt-2 text-sm text-slate-600"><?php echo e($item['ringkasan']); ?></p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <div class="mt-4 text-center">
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Lihat Semua Pengumuman &rarr;</a>
                </div>
            </div>

            <!-- Berita Column (Right, Wider) -->
            <div id="berita" class="lg:col-span-8 scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900 border-l-4 border-blue-600 pl-3">Kabar Desa Terkini</h2>
                    <a href="#" class="hidden sm:block text-sm font-semibold text-blue-600 hover:text-blue-800">Indeks Berita &rarr;</a>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $beritaTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index < 4): ?> <!-- Limit to 4 items -->
                        <article class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Image -->
                            <div class="h-40 bg-slate-200 w-full relative overflow-hidden">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->gambar): ?>
                                    <img src="<?php echo e(Storage::url($item->gambar)); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <?php else: ?>
                                    <div class="absolute inset-0 bg-linear-to-tr from-blue-100 to-slate-50 flex items-center justify-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3 text-xs text-slate-500">
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Berita</span>
                                    <span>&bull;</span>
                                    <span><?php echo e($item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y')); ?></span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a href="<?php echo e(route('publik.publikasi.berita.show', $item->slug)); ?>">
                                        <span class="absolute inset-0"></span>
                                        <?php echo e($item->judul); ?>

                                    </a>
                                </h3>
                                <p class="mt-2 text-sm text-slate-600 line-clamp-3 flex-1"><?php echo e($item->ringkasan ?? Str::limit(strip_tags($item->konten), 100)); ?></p>
                            </div>
                        </article>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="col-span-2 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                            <?php if (isset($component)) { $__componentOriginal3d0a70d072fa6b627f042c4d339e90b0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d0a70d072fa6b627f042c4d339e90b0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.newspaper','data' => ['class' => 'mx-auto size-8 text-slate-400 mb-3','variant' => 'outline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.newspaper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mx-auto size-8 text-slate-400 mb-3','variant' => 'outline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d0a70d072fa6b627f042c4d339e90b0)): ?>
<?php $attributes = $__attributesOriginal3d0a70d072fa6b627f042c4d339e90b0; ?>
<?php unset($__attributesOriginal3d0a70d072fa6b627f042c4d339e90b0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d0a70d072fa6b627f042c4d339e90b0)): ?>
<?php $component = $__componentOriginal3d0a70d072fa6b627f042c4d339e90b0; ?>
<?php unset($__componentOriginal3d0a70d072fa6b627f042c4d339e90b0); ?>
<?php endif; ?>
                            <p class="text-sm font-medium text-slate-900">Belum ada berita</p>
                            <p class="mt-1 text-xs text-slate-500">Kabar desa akan segera diperbarui.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="mt-6 text-center sm:hidden">
                    <a href="<?php echo e(route('publik.publikasi.berita.index')); ?>" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Indeks Berita &rarr;</a>
                </div>
            </div>

        </div>
    </section>

    
    <section class="bg-slate-900 border-t border-slate-800 text-slate-300">
        <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2 scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out">
                    <div class="flex items-center gap-3">
                        <img src="<?php echo e(asset('assets/ponorogo__sid__60A13U2.png')); ?>" alt="Logo Ponorogo" class="h-10 w-auto opacity-90" />
                        <h2 class="text-xl font-bold text-white">PEMERINTAH DESA <?php echo e(strtoupper($profil['nama_desa'])); ?></h2>
                    </div>
                    <p class="text-sm text-slate-400 max-w-lg leading-relaxed">
                        <?php echo e($profil['kecamatan']); ?>, <?php echo e($profil['kabupaten']); ?>, <?php echo e($profil['provinsi']); ?>.
                        <br/>Portal ini menyediakan informasi resmi dan layanan administrasi dasar berbasis digital (e-Government) bagi seluruh masyarakat desa.
                    </p>
                </div>
                <div class="rounded-xl bg-slate-800/50 p-6 text-sm scroll-reveal opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200">
                    <h3 class="text-base font-semibold text-white mb-4">Kontak Resmi</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 shrink-0 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span><?php echo e($profil['alamat']); ?></span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 shrink-0 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.09-7.261-6.966l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <span><?php echo e($profil['telepon']); ?></span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 shrink-0 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span><?php echo e($profil['email']); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Reveal animation
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        // Unobserve after showing
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-reveal').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website Work\desa-tatung-laravel\resources\views/landing.blade.php ENDPATH**/ ?>