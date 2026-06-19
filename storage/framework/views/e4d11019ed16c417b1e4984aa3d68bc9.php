

<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('page-title', 'Data Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5>Data Users</h5>
    </div>

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

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($users->firstItem() + $key); ?></td>
                        <td><?php echo e($user->name ?? '-'); ?></td>
                        <td><?php echo e($user->email ?? '-'); ?></td>
                        <td><?php echo e($user->role ?? '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data users</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/admin/users/index.blade.php ENDPATH**/ ?>