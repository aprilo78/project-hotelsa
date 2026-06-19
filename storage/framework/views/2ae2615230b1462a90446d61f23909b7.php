<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — VANTELLA Hotel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
  :root {
    --gold: #C9A84C;
    --dark: #1A1A2E;
    --sidebar-w: 260px;
    --font-serif: 'Playfair Display', serif;
    --font-sans: 'DM Sans', sans-serif;
  }
  body { font-family: var(--font-sans); background: #F5F4F0; }

  /* SIDEBAR */
  .sidebar {
    position: fixed; 
    top: 0; 
    left: 0;
    width: var(--sidebar-w); 
    height: 100vh;

    background: linear-gradient(
        180deg,
        #3E2C23 0%,
        #5A3E2B 40%,
        #8B6A4F 100%
    );

    display: flex;
    flex-direction: column; 
    z-index: 100;
    overflow-y: auto;
}
  .sidebar-brand {
    padding: 22px 24px 18px;
    font-family: var(--font-serif);
    font-size: 1.25rem; color: var(--gold);
    font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.08);
    text-decoration: none; display: block;
  }
  .sidebar-brand:hover { color: var(--gold); }
  .sidebar-role {
    padding: 10px 24px 14px;
    font-size: 0.72rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.12em;
    color: rgba(255,255,255,0.35);
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }
  .sidebar-nav { padding: 12px 10px; flex: 1; }
  .sidebar-nav .nav-link {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 14px; border-radius: 7px;
    color: rgba(255,255,255,0.68); font-size: 0.88rem;
    font-weight: 500; transition: all 0.18s;
    margin-bottom: 2px;
  }
  .sidebar-nav .nav-link:hover,
  .sidebar-nav .nav-link.active {
    background: rgba(201,168,76,0.15);
    color: var(--gold);
  }
  .sidebar-nav .nav-link i { font-size: 1rem; width: 20px; }
  .sidebar-footer {
    padding: 16px 14px;
    border-top: 1px solid rgba(255,255,255,0.08);
  }
  .sidebar-footer form button {
    display: flex; align-items: center; gap: 8px;
    width: 100%; padding: 9px 14px; border-radius: 7px;
    background: rgba(255,255,255,0.06); border: none;
    color: rgba(255,255,255,0.6); font-size: 0.88rem;
    cursor: pointer; transition: all 0.18s;
  }
  .sidebar-footer form button:hover {
    background: rgba(220,53,69,0.2); color: #ff6b6b;
  }

  /* TOPBAR */
  .topbar {
    height: 60px; background: #fff;
    box-shadow: 0 1px 8px rgba(0,0,0,0.07);
    display: flex; align-items: center;
    justify-content: space-between;
    padding: 0 28px; margin-bottom: 0;
    position: sticky; top: 0; z-index: 50;
  }
  .topbar-title {
    font-family: var(--font-serif);
    font-size: 1.15rem; font-weight: 600;
    color: var(--dark);
  }
  .topbar-user {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.88rem; color: #555;
  }
  .topbar-user strong { color: var(--dark); }

  /* MAIN WRAPPER */
  .dash-wrapper {
    margin-left: var(--sidebar-w);
    min-height: 100vh;
    display: flex; flex-direction: column;
  }
  .dash-content { padding: 28px 32px; flex: 1; }

  /* CARD */
  .card { border: 1px solid #EDE8DC; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
  .card-header { background: #fff; border-bottom: 1px solid #EDE8DC; font-weight: 600; }

  /* STATUS BADGE */
  .status-badge {
    display: inline-block; padding: 3px 10px;
    border-radius: 50px; font-size: 0.72rem;
    font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
  }
  .status-pending   { background:#FEF3C7; color:#92400E; }
  .status-confirmed { background:#D1FAE5; color:#065F46; }
  .status-cancelled { background:#FEE2E2; color:#991B1B; }
  .status-checkin   { background:#DBEAFE; color:#1E40AF; }
  .status-checkout  { background:#EDE9FE; color:#4C1D95; }
  .status-paid      { background:#D1FAE5; color:#065F46; }
  .status-unpaid    { background:#FEE2E2; color:#991B1B; }
</style>
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<div class="sidebar">
    <a href="<?php echo e(route('landing')); ?>" class="sidebar-brand">VANTELLA Hotel</a>
    <div class="sidebar-role"><?php echo e(auth()->user()->role->name ?? 'User'); ?></div>
    <nav class="sidebar-nav">
        <?php echo $__env->yieldContent('sidebar'); ?>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>


<div class="dash-wrapper">
    <div class="topbar">
        <span class="topbar-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></span>
        <div class="topbar-user">
            <i class="bi bi-person-circle fs-5"></i>
            <div>
                <strong><?php echo e(auth()->user()->name ?? ''); ?></strong>
                <br><small><?php echo e(auth()->user()->email ?? ''); ?></small>
            </div>
        </div>
    </div>

    <div class="dash-content">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>