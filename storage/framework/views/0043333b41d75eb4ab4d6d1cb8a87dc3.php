<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <title><?php echo e($title ?? config('app.name', 'Sistem Informasi Desa Tatung')); ?></title>
</head>
<body class="min-h-screen bg-white text-neutral-900 antialiased">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="mx-auto h-full max-w-6xl opacity-10">
            <div class="absolute -left-12 top-16 size-56 rounded-full bg-yellow-200 blur-3xl"></div>
            <div class="absolute right-0 top-40 size-64 rounded-full bg-orange-200 blur-3xl"></div>
        </div>
    </div>

    <header class="sticky top-0 z-30 border-b border-blue-900/10 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 group">
                    <img src="<?php echo e(asset('assets/ponorogo__sid__60A13U2.png')); ?>" alt="Logo Ponorogo" class="h-9 w-auto transition-transform group-hover:scale-105" />
                    <div class="leading-tight">
                        <p class="text-sm font-bold text-blue-950 uppercase tracking-wide">Sistem Informasi Desa</p>
                        <p class="text-xs font-semibold text-blue-600">Desa Tatung</p>
                    </div>
                </a>
            </div>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-600 sm:flex">
                <a href="<?php echo e(route('home')); ?>" class="py-2 hover:text-blue-700 transition-colors <?php echo e(request()->routeIs('home') ? 'text-blue-700' : ''); ?>">Beranda</a>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none <?php echo e(request()->routeIs('publik.profil.*') ? 'text-blue-700' : ''); ?>">
                        Profil Desa <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['class' => 'size-3 transition-transform group-hover:-rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 transition-transform group-hover:-rotate-180']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="<?php echo e(route('publik.profil.sejarah')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Sejarah Desa</a>
                        <a href="<?php echo e(route('publik.profil.visi-misi')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Visi & Misi</a>
                        <a href="<?php echo e(route('publik.profil.aparatur')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Aparatur Desa</a>
                        <a href="<?php echo e(route('publik.profil.wilayah')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Peta & Wilayah</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none <?php echo e(request()->routeIs('publik.publikasi.*') ? 'text-blue-700' : ''); ?>">
                        Publikasi <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['class' => 'size-3 transition-transform group-hover:-rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 transition-transform group-hover:-rotate-180']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="<?php echo e(route('publik.publikasi.berita.index')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Berita Desa</a>
                        <a href="<?php echo e(route('publik.publikasi.agenda')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Agenda Kegiatan</a>
                        <a href="<?php echo e(route('publik.publikasi.galeri')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Galeri Foto</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none <?php echo e(request()->routeIs('publik.potensi.*') ? 'text-blue-700' : ''); ?>">
                        Potensi <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['class' => 'size-3 transition-transform group-hover:-rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 transition-transform group-hover:-rotate-180']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="<?php echo e(route('publik.potensi.umkm')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Produk UMKM</a>
                        <a href="<?php echo e(route('publik.potensi.pariwisata')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Pariwisata</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none <?php echo e(request()->routeIs('publik.transparansi.*') ? 'text-blue-700' : ''); ?>">
                        Transparansi <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['class' => 'size-3 transition-transform group-hover:-rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 transition-transform group-hover:-rotate-180']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="<?php echo e(route('publik.transparansi.apbdes')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Info APBDes</a>
                    </div>
                </div>

                <div class="group relative py-2">
                    <a href="#" class="flex items-center gap-1 hover:text-blue-700 transition-colors outline-none <?php echo e(request()->routeIs('publik.layanan.*') ? 'text-blue-700' : ''); ?>">
                        Layanan <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['class' => 'size-3 transition-transform group-hover:-rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 transition-transform group-hover:-rotate-180']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
                    </a>
                    <div class="absolute left-0 top-full mt-0 hidden w-48 flex-col rounded-xl border border-slate-200 bg-white p-1.5 shadow-lg group-hover:flex opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="<?php echo e(route('publik.layanan.informasi-surat')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Informasi Surat</a>
                        <div class="my-1 border-t border-slate-200"></div>
                        <a href="<?php echo e(route('login')); ?>" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-blue-700">Pengajuan Online</a>
                    </div>
                </div>

                <a href="<?php echo e(route('infografis')); ?>" class="py-2 hover:text-blue-700 transition-colors <?php echo e(request()->routeIs('infografis') ? 'text-blue-700' : ''); ?>">Infografis</a>
            </nav>            <div class="flex items-center gap-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(auth()->user()->hasAnyRole(['Super Admin', 'Admin Kependudukan']) ? route('admin.dashboard') : route('dashboard')); ?>"
                       class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:border-blue-300 hover:bg-blue-100 transition-colors">
                        <span>Dasbor</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-flex items-center gap-2 rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-blue-300 hover:text-blue-700 transition-colors">
                        Masuk
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 transition-colors">
                        Buat Akun
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </header>

    <main class="relative z-10">
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $slot ?? ''; ?>

    </main>

    <footer class="mt-16 border-t border-slate-200 bg-slate-50">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:px-8 lg:grid-cols-4">
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <img src="<?php echo e(asset('assets/ponorogo__sid__60A13U2.png')); ?>" alt="Logo" class="h-8 w-auto" />
                    <p class="text-lg font-bold text-slate-900">Desa Tatung</p>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">Sistem Informasi Desa resmi untuk layanan publik, transparansi pembangunan, dan kemudahan akses data kependudukan.</p>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Profil & Potensi</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="<?php echo e(route('publik.profil.sejarah')); ?>" class="hover:text-blue-600 transition-colors">Sejarah Desa</a></li>
                    <li><a href="<?php echo e(route('publik.profil.aparatur')); ?>" class="hover:text-blue-600 transition-colors">Aparatur Pemerintahan</a></li>
                    <li><a href="<?php echo e(route('publik.potensi.umkm')); ?>" class="hover:text-blue-600 transition-colors">Produk UMKM</a></li>
                    <li><a href="<?php echo e(route('publik.potensi.pariwisata')); ?>" class="hover:text-blue-600 transition-colors">Pariwisata</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Informasi</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="<?php echo e(route('publik.publikasi.berita.index')); ?>" class="hover:text-blue-600 transition-colors">Berita Terkini</a></li>
                    <li><a href="<?php echo e(route('publik.transparansi.apbdes')); ?>" class="hover:text-blue-600 transition-colors">Transparansi APBDes</a></li>
                    <li><a href="<?php echo e(route('infografis')); ?>" class="hover:text-blue-600 transition-colors">Data Infografis</a></li>
                    <li><a href="<?php echo e(route('publik.layanan.informasi-surat')); ?>" class="hover:text-blue-600 transition-colors">Panduan Layanan</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Kontak</p>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <?php if (isset($component)) { $__componentOriginal0d48bd54d72df81b49ee07c1a3735f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0d48bd54d72df81b49ee07c1a3735f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.map-pin','data' => ['class' => 'size-5 shrink-0 text-slate-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.map-pin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 shrink-0 text-slate-400']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0d48bd54d72df81b49ee07c1a3735f04)): ?>
<?php $attributes = $__attributesOriginal0d48bd54d72df81b49ee07c1a3735f04; ?>
<?php unset($__attributesOriginal0d48bd54d72df81b49ee07c1a3735f04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0d48bd54d72df81b49ee07c1a3735f04)): ?>
<?php $component = $__componentOriginal0d48bd54d72df81b49ee07c1a3735f04; ?>
<?php unset($__componentOriginal0d48bd54d72df81b49ee07c1a3735f04); ?>
<?php endif; ?>
                        <span>Kantor Kepala Desa Tatung, Kecamatan Balong, Kabupaten Ponorogo</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php if (isset($component)) { $__componentOriginal3b273e6b331c9518de08da49e1886441 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b273e6b331c9518de08da49e1886441 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.phone','data' => ['class' => 'size-5 shrink-0 text-slate-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 shrink-0 text-slate-400']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b273e6b331c9518de08da49e1886441)): ?>
<?php $attributes = $__attributesOriginal3b273e6b331c9518de08da49e1886441; ?>
<?php unset($__attributesOriginal3b273e6b331c9518de08da49e1886441); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b273e6b331c9518de08da49e1886441)): ?>
<?php $component = $__componentOriginal3b273e6b331c9518de08da49e1886441; ?>
<?php unset($__componentOriginal3b273e6b331c9518de08da49e1886441); ?>
<?php endif; ?>
                        <span>08xx-xxxx-xxxx</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php if (isset($component)) { $__componentOriginalb2620669e6f3f9a8ec8b91c4a73fca6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2620669e6f3f9a8ec8b91c4a73fca6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.envelope','data' => ['class' => 'size-5 shrink-0 text-slate-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.envelope'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 shrink-0 text-slate-400']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2620669e6f3f9a8ec8b91c4a73fca6f)): ?>
<?php $attributes = $__attributesOriginalb2620669e6f3f9a8ec8b91c4a73fca6f; ?>
<?php unset($__attributesOriginalb2620669e6f3f9a8ec8b91c4a73fca6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2620669e6f3f9a8ec8b91c4a73fca6f)): ?>
<?php $component = $__componentOriginalb2620669e6f3f9a8ec8b91c4a73fca6f; ?>
<?php unset($__componentOriginalb2620669e6f3f9a8ec8b91c4a73fca6f); ?>
<?php endif; ?>
                        <span>desa@tatung.id</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 text-sm text-slate-500 sm:flex-row sm:px-6 lg:px-8">
                <p>&copy; <?php echo e(now()->year); ?> Pemerintah Desa Tatung. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4">
                    <span>Portal e-Government</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                        <span class="size-1.5 rounded-full bg-emerald-500"></span> Online
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <?php if (isset($component)) { $__componentOriginal6e0689304ed9fe6f1f826bea0820c41b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6e0689304ed9fe6f1f826bea0820c41b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::toast.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6e0689304ed9fe6f1f826bea0820c41b)): ?>
<?php $attributes = $__attributesOriginal6e0689304ed9fe6f1f826bea0820c41b; ?>
<?php unset($__attributesOriginal6e0689304ed9fe6f1f826bea0820c41b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6e0689304ed9fe6f1f826bea0820c41b)): ?>
<?php $component = $__componentOriginal6e0689304ed9fe6f1f826bea0820c41b; ?>
<?php unset($__componentOriginal6e0689304ed9fe6f1f826bea0820c41b); ?>
<?php endif; ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('confirm-modal', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2028413570-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

</body>
</html>
<?php /**PATH D:\Website Work\desa-tatung-laravel\resources\views/layouts/public.blade.php ENDPATH**/ ?>