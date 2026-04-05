

<?php
    // Data contoh; nanti bisa diambil dari database/unggahan resmi desa
    $infografis = [
        [
            'judul' => 'Peta Sebaran Penduduk',
            'tanggal' => '31 Maret 2026',
            'keterangan' => 'Distribusi penduduk per dusun dan RT/RW.',
            'gambar' => 'https://images.unsplash.com/photo-1509099836639-18ba02e2e480?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'judul' => 'Data Kependudukan',
            'tanggal' => '30 Maret 2026',
            'keterangan' => 'Jumlah penduduk, KK, dan komposisi usia.',
            'gambar' => 'https://images.unsplash.com/photo-1618004912476-29818d81ae2e?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'judul' => 'Potensi Wilayah',
            'tanggal' => '28 Maret 2026',
            'keterangan' => 'Peta potensi pertanian, perikanan, dan UMKM.',
            'gambar' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'judul' => 'Panduan Layanan Surat',
            'tanggal' => '26 Maret 2026',
            'keterangan' => 'Alur pengajuan surat online dan syarat dokumen.',
            'gambar' => 'https://images.unsplash.com/photo-1581093588401-99be9b396813?auto=format&fit=crop&w=900&q=80',
        ],
    ];
?>

<?php $__env->startSection('content'); ?>
    <section class="bg-orange-50 border-b border-orange-100">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-neutral-900">Infografis Desa</h1>
            <p class="mt-2 text-sm text-neutral-700">
                Kumpulan infografis dan visualisasi data Desa Tatung untuk memudahkan warga memahami informasi penting.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $infografis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="overflow-hidden rounded-lg border border-neutral-200 bg-white shadow-sm">
                    <div class="aspect-[4/3] bg-neutral-100">
                        <img
                            src="<?php echo e($item['gambar']); ?>"
                            alt="<?php echo e($item['judul']); ?>"
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div class="space-y-2 p-4">
                        <p class="text-xs text-neutral-500"><?php echo e($item['tanggal']); ?></p>
                        <h2 class="text-base font-semibold text-neutral-900"><?php echo e($item['judul']); ?></h2>
                        <p class="text-sm text-neutral-600"><?php echo e($item['keterangan']); ?></p>
                        <button class="inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">
                            Lihat detail
                        </button>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website Work\desa-tatung-laravel\resources\views/pages/infografis.blade.php ENDPATH**/ ?>