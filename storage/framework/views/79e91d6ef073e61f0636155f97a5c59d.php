<?php $__env->startSection('title', 'My Profile'); ?>
<?php $__env->startSection('page-title', 'My Profile'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('customer.dashboard')); ?>"
       class="nav-link <?php echo e(request()->routeIs('customer.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="<?php echo e(route('customer.bookings')); ?>"
       class="nav-link <?php echo e(request()->routeIs('customer.bookings') ? 'active' : ''); ?>">
        <i class="bi bi-calendar-check"></i> My Bookings
    </a>
    <a href="<?php echo e(route('customer.new-booking')); ?>"
       class="nav-link <?php echo e(request()->routeIs('customer.new-booking') ? 'active' : ''); ?>">
        <i class="bi bi-plus-circle"></i> New Booking
    </a>
    <a href="<?php echo e(route('customer.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> Transaction History
    </a>
    <a href="<?php echo e(route('customer.profile')); ?>" class="nav-link active">
        <i class="bi bi-person"></i> My Profile
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
.profile-wrap {
    max-width: 650px;
    margin: 2rem auto;
}

.profile-card {
    border: none;
    border-radius: 24px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 12px 40px rgba(176, 137, 104, 0.12);
}

.profile-header {
    background: linear-gradient(135deg, #9c7453, #b08968, #ddb892);
    color: #fff;
    padding: 50px 24px 40px;
    text-align: center;
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #ffffff;
    object-fit: cover;
    margin-bottom: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}
.profile-avatar:hover {
    transform: scale(1.05);
}

.avatar-initials {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #ffffff;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    font-weight: 700;
    color: #fff;
    margin: 0 auto 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}
.avatar-initials:hover {
    transform: scale(1.05);
}

.profile-body {
    padding: 35px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fdfbfc;
    border: 1px solid #f2eae1;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 14px;
    transition: all 0.25s ease;
}
.info-row:hover {
    transform: translateY(-2px);
    background: #ffffff;
    border-color: #ddb892;
    box-shadow: 0 6px 16px rgba(176, 137, 104, 0.08);
}

.info-label {
    font-weight: 600;
    color: #8B6B4A;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 10px;
}
.info-label i {
    font-size: 1.1rem;
    opacity: 0.9;
}

.info-value {
    color: #2b2b2b;
    font-size: 0.95rem;
    font-weight: 500;
}

.btn-edit {
    background: #b08968;
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 11px 28px;
    font-weight: 600;
    font-size: 0.95rem;
    box-shadow: 0 4px 14px rgba(176, 137, 104, 0.3);
    transition: all 0.2s ease;
}
.btn-edit:hover { 
    background: #8f6b4f; 
    color: #fff; 
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(176, 137, 104, 0.4);
}

.btn-password {
    background: transparent;
    color: #b08968;
    border: 2px solid #b08968;
    border-radius: 12px;
    padding: 10px 28px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.2s ease;
}
.btn-password:hover { 
    background: #fbf8f5; 
    color: #8B6B4A; 
    border-color: #8B6B4A;
    transform: translateY(-1px);
}
</style>

<div class="profile-wrap">

    
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; border: none; background-color: #d1e7dd; color: #0f5132;">
        <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card profile-card">

        
        <div class="profile-header">
            <?php if(auth()->user()->avatar ?? false): ?>
                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>"
                     class="profile-avatar"
                     alt="Profile">
            <?php else: ?>
                <div class="avatar-initials">
                    <?php echo e(strtoupper(substr(auth()->user()->name ?? 'U', 0, 2))); ?>

                </div>
            <?php endif; ?>

            <h3 class="mb-1" style="font-weight:700; letter-spacing: -0.5px;">
                <?php echo e(auth()->user()->name ?? 'User'); ?>

            </h3>
            <span class="badge" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); font-weight: 500; font-size: 0.8rem; padding: 5px 14px; border-radius: 30px;">
                <?php echo e(ucfirst(auth()->user()->role ?? 'Customer')); ?>

            </span>
        </div>

        
        <div class="profile-body">

            <div class="info-row">
                <span class="info-label">
                    <i class="bi bi-person-vcard-fill"></i> Nama Lengkap
                </span>
                <span class="info-value"><?php echo e(auth()->user()->name ?? '-'); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    <i class="bi bi-envelope-open-fill"></i> Email
                </span>
                <span class="info-value"><?php echo e(auth()->user()->email ?? '-'); ?></span>
            </div>

            <?php if(auth()->user()->phone ?? false): ?>
            <div class="info-row">
                <span class="info-label">
                    <i class="bi bi-telephone-inbound-fill"></i> Nomor HP
                </span>
                <span class="info-value"><?php echo e(auth()->user()->phone); ?></span>
            </div>
            <?php endif; ?>

            <div class="info-row">
                <span class="info-label">
                    <i class="bi bi-shield-lock-fill"></i> Hak Akses
                </span>
                <span class="info-value">
                    <span style="background:#fdf2e9; color:#b08968; padding:5px 14px;
                                 border-radius:20px; font-size:.8rem; font-weight:700; border: 1px solid #f7e1ce;">
                        <?php echo e(ucfirst(auth()->user()->role ?? 'Customer')); ?>

                    </span>
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    <i class="bi bi-calendar-event-fill"></i> Bergabung Sejak
                </span>
                <span class="info-value">
                    <?php echo e(auth()->user()->created_at
                        ? auth()->user()->created_at->format('d M Y')
                        : '-'); ?>

                </span>
            </div>

            
            <div class="d-flex justify-content-between gap-3 mt-4 pt-2">
                <a href="<?php echo e(route('customer.profile.change-password')); ?>"
                   class="btn-password d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-key-fill me-2"></i>Ubah Password
                </a>
                <a href="<?php echo e(route('customer.profile.edit')); ?>"
                   class="btn btn-edit d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-pencil-square me-2"></i>Edit Profil
                </a>
            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/customer/profile.blade.php ENDPATH**/ ?>