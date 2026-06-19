

<?php $__env->startSection('title', 'Rooms'); ?>
<?php $__env->startSection('page-title', 'Data Rooms'); ?>

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
    // MENYUNTIKKAN DATA KAMUR YANG SINKRON DENGAN DATA TRANSAKSI SEBELUMNYA
    $roomsSimulation = [
        (object)['room_number' => '102', 'room_type' => 'Deluxe Room', 'status' => 'occupied'],
        (object)['room_number' => '104', 'room_type' => 'Deluxe Room', 'status' => 'occupied'],
        (object)['room_number' => '202', 'room_type' => 'Executive Suite', 'status' => 'occupied'],
        (object)['room_number' => '205', 'room_type' => 'Executive Suite', 'status' => 'booked'],
        (object)['room_number' => '301', 'room_type' => 'Standard Room', 'status' => 'available'],
        (object)['room_number' => '302', 'room_type' => 'Standard Room', 'status' => 'available'],
        (object)['room_number' => '303', 'room_type' => 'Standard Room', 'status' => 'maintenance'],
    ];
?>

    <style>
        .room-status { padding: 0.25rem 0.75rem; border-radius: 50rem; font-size: 0.85rem; font-weight: 500; display: inline-block; text-transform: capitalize; }
        .status-occupied { background-color: #f8d7da; color: #842029; }      /* Terisi - Merah */
        .status-booked { background-color: #fff3cd; color: #664d03; }        /* Dipesan/Pending - Kuning */
        .status-available { background-color: #d1e7dd; color: #0f5132; }     /* Kosong - Hijau */
        .status-maintenance { background-color: #e2e3e5; color: #41464b; }   /* Perbaikan - Abu-abu */
    </style>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Data Rooms</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th>Room Number</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $roomsSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><strong>Kamar <?php echo e($room->room_number ?? '-'); ?></strong></td>
                        <td><?php echo e($room->room_type ?? '-'); ?></td>
                        <td>
                            <span class="room-status status-<?php echo e($room->status); ?>">
                                <?php echo e($room->status); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data rooms</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Showing 1 to 7 of 50 entries (Simulated)</small>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/admin/rooms/index.blade.php ENDPATH**/ ?>