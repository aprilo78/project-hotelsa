<?php $__env->startSection('title', 'Check In'); ?>
<?php $__env->startSection('page-title', 'Check In'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('resepsionis.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.index')); ?>" class="nav-link active">
        <i class="bi bi-calendar-check"></i> Daftar Booking
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.create')); ?>" class="nav-link">
        <i class="bi bi-plus-circle"></i> Booking Baru
    </a>
    <a href="<?php echo e(route('resepsionis.rooms')); ?>" class="nav-link">
        <i class="bi bi-door-open"></i> Rooms
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h3>Halaman Check-In</h3>
            <p>Fitur check-in resepsionis siap digunakan.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/resepsionis/checkin.blade.php ENDPATH**/ ?>