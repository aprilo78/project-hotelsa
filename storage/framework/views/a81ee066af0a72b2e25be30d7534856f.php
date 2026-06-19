

<?php $__env->startSection('title', 'Guests'); ?>
<?php $__env->startSection('page-title', 'Data Guests'); ?>

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
    // MENYUNTIKKAN DATA TAMU YANG SINKRON DENGAN DATA BOOKINGS & DASHBOARD
    $guestsSimulation = [
        (object)['name' => 'Nila Aprilia', 'email' => 'nila.aprilia@example.com', 'phone' => '0812-3456-7890'],
        (object)['name' => 'Dimas Saputra', 'email' => 'dimas.saputra@example.com', 'phone' => '0813-9876-5432'],
        (object)['name' => 'Siti Rahma', 'email' => 'siti.rahma@example.com', 'phone' => '0857-1122-3344'],
        (object)['name' => 'Budi Santoso', 'email' => 'budi.santoso@example.com', 'phone' => '0819-5566-7788'],
        (object)['name' => 'Citra Dewi', 'email' => 'citra.dewi@example.com', 'phone' => '0821-9988-7766'],
    ];
?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Data Guests</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $guestsSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><strong><?php echo e($guest->name ?? '-'); ?></strong></td>
                        <td><span class="text-primary"><?php echo e($guest->email ?? '-'); ?></span></td>
                        <td><code><?php echo e($guest->phone ?? '-'); ?></code></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data guests</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Showing 1 to 5 of 5 entries (Simulated)</small>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/admin/guests/index.blade.php ENDPATH**/ ?>