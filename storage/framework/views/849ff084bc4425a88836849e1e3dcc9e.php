<?php $__env->startSection('title', 'Statistik Menu Terlaris'); ?>


<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.restoran.pos')); ?>" class="nav-link">
        <i class="bi bi-cart"></i> POS
    </a>
    <a href="<?php echo e(route('kasir.restoran.order.create')); ?>" class="nav-link">
        <i class="bi bi-plus-circle"></i> Create Order
    </a>
    <a href="<?php echo e(route('kasir.restoran.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> History
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Statistik Menu Terlaris</h4>
        <span class="badge bg-success px-3 py-2 rounded-pill">Data Realtime</span>
    </div>

    
    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Nama Menu Kuliner</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-center">Total Terjual (Qty)</th>
                            <th class="py-3 text-end pe-4">Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4 text-muted fw-bold">
                                <?php echo e($menus->firstItem() + $index); ?>

                            </td>
                            <td>
                                <span class="fw-semibold text-dark d-block"><?php echo e($menu->name); ?></span>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill text-capitalize px-2.5">
                                    <?php echo e($menu->category ?? 'Umum'); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill px-3 py-1.5 fw-bold">
                                    <?php echo e(number_format($menu->total_qty ?? 0)); ?> Porsi
                                </span>
                            </td>
                            <td class="text-end fw-semibold text-secondary pe-4">
                                Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-egg-fried fs-2 d-block mb-2" style="opacity:0.5;"></i>
                                Belum ada riwayat penjualan menu saat ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <?php if(method_exists($menus, 'links')): ?>
        <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
            <?php echo e($menus->links()); ?>

        </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/kasir/restoran/menu_stats.blade.php ENDPATH**/ ?>