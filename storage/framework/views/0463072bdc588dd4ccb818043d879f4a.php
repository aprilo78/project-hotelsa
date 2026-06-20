<?php $__env->startSection('title','Check-in/out'); ?>

<?php $__env->startSection('content'); ?>
<h4>Halaman Check-in & Check-out</h4>

<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div>
        <?php echo e($booking->id); ?> - <?php echo e($booking->booking_status); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/resepsionis/checkin/index.blade.php ENDPATH**/ ?>