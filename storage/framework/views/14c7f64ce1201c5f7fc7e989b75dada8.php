<nav class="navbar">
    <a href="<?php echo e(route('landing')); ?>" class="navbar-brand">🏨 DRG Hotel</a>

    <ul class="navbar-nav">
        <li><a href="<?php echo e(route('landing')); ?>">Beranda</a></li>
        <li><a href="<?php echo e(route('landing')); ?>#kamar">Kamar</a></li>
        <li><a href="<?php echo e(route('landing')); ?>#restoran">Restoran</a></li>
        <li><a href="<?php echo e(route('landing')); ?>#tentang">Tentang</a></li>

        <?php if(auth()->guard()->check()): ?>
            <?php $role = auth()->user()->role->name ?? ''; ?>
            <?php if($role === 'admin'): ?>
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php elseif($role === 'ceo'): ?>
                <li><a href="<?php echo e(route('ceo.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php elseif($role === 'resepsionis'): ?>
                <li><a href="<?php echo e(route('resepsionis.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php elseif($role === 'kasir_hotel'): ?>
                <li><a href="<?php echo e(route('kasir.hotel.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php elseif($role === 'kasir_restoran'): ?>
                <li><a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php else: ?>
                <li><a href="<?php echo e(route('customer.dashboard')); ?>" style="color:var(--gold)">Dashboard</a></li>
            <?php endif; ?>

            <li>
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm"
                        style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.25);padding:6px 16px;border-radius:6px;cursor:pointer;font-size:0.85rem">
                        Logout
                    </button>
                </form>
            </li>
        <?php else: ?>
            <li><a href="<?php echo e(route('login')); ?>" style="color:rgba(255,255,255,0.85)">Login</a></li>
            <li>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-gold btn-sm"
                   style="padding:7px 18px;font-size:0.85rem">Daftar</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH /var/www/resources/views/components/navbar.blade.php ENDPATH**/ ?>