<?php $__env->startSection('title', 'Bookings'); ?>
<?php $__env->startSection('page-title', 'Data Bookings'); ?>

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
    // MENYUNTIKKAN DATA TAMU YANG SAMA PERSIS DENGAN RECENT BOOKINGS DI DASHBOARD
    $bookingsSimulation = [
        (object)[
            'booking_status' => 'confirmed', 
            'guest' => (object)['name' => 'Nila Aprilia'], 
            'room' => (object)['room_number' => '102'],
            'created_at' => Carbon\Carbon::now()->subDays(0)
        ],
        (object)[
            'booking_status' => 'pending', 
            'guest' => (object)['name' => 'Dimas Saputra'], 
            'room' => (object)['room_number' => '205'],
            'created_at' => Carbon\Carbon::now()->subDays(1)
        ],
        (object)[
            'booking_status' => 'confirmed', 
            'guest' => (object)['name' => 'Siti Rahma'], 
            'room' => (object)['room_number' => '104'],
            'created_at' => Carbon\Carbon::now()->subDays(1)
        ],
        (object)[
            'booking_status' => 'cancelled', 
            'guest' => (object)['name' => 'Budi Santoso'], 
            'room' => (object)['room_number' => '301'],
            'created_at' => Carbon\Carbon::now()->subDays(2)
        ],
        (object)[
            'booking_status' => 'confirmed', 
            'guest' => (object)['name' => 'Citra Dewi'], 
            'room' => (object)['room_number' => '202'],
            'created_at' => Carbon\Carbon::now()->subDays(3)
        ]
    ];
?>

    <style>
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 50rem; font-size: 0.85rem; font-weight: 500; display: inline-block; }
        .status-confirmed { background-color: #d1e7dd; color: #0f5132; }
        .status-pending { background-color: #fff3cd; color: #664d03; }
        .status-cancelled { background-color: #f8d7da; color: #842029; }
    </style>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Data Bookings</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th>Guest</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $bookingsSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><strong><?php echo e($booking->guest->name ?? '-'); ?></strong></td>
                        <td><span class="badge bg-secondary">Room <?php echo e($booking->room->room_number ?? '-'); ?></span></td>
                        <td>
                            <span class="status-badge status-<?php echo e($booking->booking_status); ?>">
                                <?php echo e(ucfirst($booking->booking_status)); ?>

                            </span>
                        </td>
                        <td><?php echo e($booking->created_at->format('d-m-Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Showing 1 to 5 of 5 entries (Simulated)</small>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-item page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/bookings/index.blade.php ENDPATH**/ ?>