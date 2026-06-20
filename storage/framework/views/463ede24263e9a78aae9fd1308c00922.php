<?php $__env->startSection('title', 'Laporan'); ?>
<?php $__env->startSection('page-title', 'Laporan Sistem Hotel'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('admin.dashboard')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="<?php echo e(route('admin.bookings')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.bookings') ? 'active' : ''); ?>">
        <i class="bi bi-calendar-check"></i> Bookings
    </a>

    <a href="<?php echo e(route('admin.rooms')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.rooms') ? 'active' : ''); ?>">
        <i class="bi bi-door-open"></i> Rooms
    </a>

    <a href="<?php echo e(route('admin.guests')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.guests') ? 'active' : ''); ?>">
        <i class="bi bi-people"></i> Guests
    </a>

    <a href="<?php echo e(route('admin.users')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.users') ? 'active' : ''); ?>">
        <i class="bi bi-person-badge"></i> Users
    </a>

    <a href="<?php echo e(route('admin.laporan')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.laporan') ? 'active' : ''); ?>">
        <i class="bi bi-graph-up"></i> Laporan
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    // SINKRONISASI DATA UTAMA DENGAN DASHBOARD KITA SEBELUMNYA
    $totalRevenueSimulation = 154250000;
    $totalBookingsSimulation = 148;

    // Menyesuaikan array agar looping @foreach($paymentStatus as $status => $count) berjalan sempurna
    $paymentStatusSimulation = [
        'Paid' => 65,
        'DP' => 20,
        'Pending' => 10,
        'Unpaid' => 5
    ];
?>

<style>
    .report-card-title { font-size: 0.95rem; color: #6c757d; font-weight: 500; }
    .report-badge { padding: 0.25rem 0.6rem; border-radius: 6px; font-weight: bold; }
</style>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0" style="border-left: 4px solid #8b5e3c !important;">
            <div class="card-body">
                <h5 class="report-card-title mb-2">Total Revenue</h5>
                <h2 class="mb-0 fw-bold text-dark">Rp <?php echo e(number_format($totalRevenueSimulation, 0, ',', '.')); ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0" style="border-left: 4px solid #a67c52 !important;">
            <div class="card-body">
                <h5 class="report-card-title mb-2">Total Bookings</h5>
                <h2 class="mb-0 fw-bold text-dark"><?php echo e($totalBookingsSimulation); ?> <span class="fs-6 text-muted font-normal">Reservations</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-credit-card me-2 text-secondary"></i>Payment Status Distribution</h5>
    </div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <?php $__currentLoopData = $paymentStatusSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                    <span class="fw-medium text-secondary"><?php echo e($status); ?></span>
                    
                    <?php if($status == 'Paid'): ?>
                        <span class="badge bg-success report-badge"><?php echo e($count); ?> Tx</span>
                    <?php elseif($status == 'DP'): ?>
                        <span class="badge bg-info text-dark report-badge"><?php echo e($count); ?> Tx</span>
                    <?php elseif($status == 'Pending'): ?>
                        <span class="badge bg-warning text-dark report-badge"><?php echo e($count); ?> Tx</span>
                    <?php else: ?>
                        <span class="badge bg-danger report-badge"><?php echo e($count); ?> Tx</span>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/laporan/index.blade.php ENDPATH**/ ?>