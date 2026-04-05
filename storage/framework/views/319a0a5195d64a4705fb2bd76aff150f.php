

<?php $__env->startSection('content'); ?>
    <section class="bg-blue-900 border-b border-blue-950 relative overflow-hidden text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute inset-0 bg-linear-to-r from-blue-900 to-blue-800 mix-blend-multiply"></div>

        <div class="relative z-10 mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-2">Berita Desa</h1>
            <p class="text-blue-200 text-lg max-w-2xl">
                Informasi kegiatan, program pembangunan, dan pengumuman resmi dari Pemerintah Desa Tatung.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-12 sm:py-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200">
                    <a href="<?php echo e(route('publik.publikasi.berita.show', $item->slug)); ?>" class="h-48 w-full relative overflow-hidden bg-slate-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->gambar): ?>
                            <img src="<?php echo e(Storage::url($item->gambar)); ?>" alt="<?php echo e($item->judul); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <?php else: ?>
                            <div class="absolute inset-0 bg-linear-to-tr from-blue-100 to-slate-50 flex items-center justify-center text-slate-400">
                                <?php if (isset($component)) { $__componentOriginal2d7605e1adbee8a1737ebec29a91da61 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d7605e1adbee8a1737ebec29a91da61 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.photo','data' => ['class' => 'size-10 opacity-50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.photo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-10 opacity-50']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2d7605e1adbee8a1737ebec29a91da61)): ?>
<?php $attributes = $__attributesOriginal2d7605e1adbee8a1737ebec29a91da61; ?>
<?php unset($__attributesOriginal2d7605e1adbee8a1737ebec29a91da61); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d7605e1adbee8a1737ebec29a91da61)): ?>
<?php $component = $__componentOriginal2d7605e1adbee8a1737ebec29a91da61; ?>
<?php unset($__componentOriginal2d7605e1adbee8a1737ebec29a91da61); ?>
<?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                    <div class="flex flex-1 flex-col p-5">
                        <div class="flex items-center gap-2 mb-3 text-xs text-slate-500">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Berita</span>
                            <span>&bull;</span>
                            <time datetime="<?php echo e($item->published_at ?? $item->created_at); ?>"><?php echo e($item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y')); ?></time>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition-colors line-clamp-2 mb-2">
                            <a href="<?php echo e(route('publik.publikasi.berita.show', $item->slug)); ?>">
                                <?php echo e($item->judul); ?>

                            </a>
                        </h2>
                        <p class="text-sm text-slate-600 line-clamp-3 flex-1 mb-4"><?php echo e($item->ringkasan ?? Str::limit(strip_tags($item->konten), 100)); ?></p>

                        <div class="mt-auto border-t border-slate-100 pt-4 flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-500 flex items-center gap-1">
                                <?php if (isset($component)) { $__componentOriginalcbe89caa4ae8c58f7efd0ed6343c35ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbe89caa4ae8c58f7efd0ed6343c35ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.user','data' => ['class' => 'size-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3']); ?>
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
<?php endif; ?> Admin Desa
                            </span>
                            <a href="<?php echo e(route('publik.publikasi.berita.show', $item->slug)); ?>" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800">
                                Baca selengkapnya <span aria-hidden="true" class="ml-1">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-12 text-center">
                    <?php if (isset($component)) { $__componentOriginal3d0a70d072fa6b627f042c4d339e90b0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d0a70d072fa6b627f042c4d339e90b0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.newspaper','data' => ['class' => 'mx-auto size-12 text-slate-400 mb-4','variant' => 'outline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.newspaper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mx-auto size-12 text-slate-400 mb-4','variant' => 'outline']); ?>
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
                    <h3 class="text-lg font-bold text-slate-900">Belum Ada Berita</h3>
                    <p class="mt-1 text-slate-500 max-w-md mx-auto">Saat ini belum ada publikasi berita atau pengumuman yang ditambahkan oleh Pemerintah Desa.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($beritas->hasPages()): ?>
            <div class="mt-10 pt-6 border-t border-slate-200">
                <?php echo e($beritas->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website Work\desa-tatung-laravel\resources\views/pages/publikasi/berita/index.blade.php ENDPATH**/ ?>