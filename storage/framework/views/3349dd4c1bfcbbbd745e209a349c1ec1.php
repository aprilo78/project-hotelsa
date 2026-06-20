<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('page-title', 'Daftar Orders'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Daftar Orders</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($order->id); ?></td>

                                <td>
                                    Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

                                </td>

                                <td>
                                    <?php if($order->status == 'paid'): ?>
                                        <span class="badge bg-success">Paid</span>
                                    <?php elseif($order->status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo e($order->status); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php echo e($order->created_at->format('d-m-Y H:i')); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Tidak ada data order
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/kasir/restoran/orders/index.blade.php ENDPATH**/ ?>