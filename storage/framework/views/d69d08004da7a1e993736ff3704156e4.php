<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logout — VANTELLA Hotel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --cocoa-dark:#3b2f2f;
  --cocoa:#6f4e37;
  --cocoa-light:#c4a484;
  --cocoa-soft:#f5e6d3;
  --cocoa-cream:#fffaf6;
  --gold:#d4a843;
  --gold-light:#e8c87a;
  --text-dark:#2a1f1f;
  --text-muted:#9a8070;
}
html,body{height:100%}
body{
  font-family:'DM Sans',sans-serif;
  background:var(--cocoa-cream);
  color:var(--text-dark);
  display:flex;
  align-items:center;
  justify-content:center;
  min-height:100vh;
  padding:24px;
  position:relative;
  overflow:hidden;
}

/* Background dekoratif */
body::before{
  content:'';
  position:fixed;
  top:-120px;right:-120px;
  width:500px;height:500px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(196,164,132,.18),transparent 70%);
  pointer-events:none;
}
body::after{
  content:'';
  position:fixed;
  bottom:-100px;left:-100px;
  width:400px;height:400px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(111,78,55,.1),transparent 70%);
  pointer-events:none;
}

/* Card */
.logout-card{
  background:#fff;
  border-radius:28px;
  box-shadow:0 20px 70px rgba(59,47,47,.13);
  padding:52px 48px 44px;
  width:100%;max-width:420px;
  text-align:center;
  position:relative;
  z-index:1;
  animation:fadeUp .5s ease forwards;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}

/* Logo */
.logo{
  display:inline-block;
  margin-bottom:28px;
}
.logo-text{
  font-family:'Playfair Display',serif;
  font-style:italic;
  font-size:26px;
  color:var(--cocoa-light);
  letter-spacing:.5px;
  line-height:1;
}
.logo-sub{
  font-size:10px;
  letter-spacing:3px;
  text-transform:uppercase;
  color:var(--text-muted);
  font-style:normal;
  display:block;
  margin-top:3px;
}

/* Icon lingkaran */
.icon-wrap{
  width:80px;height:80px;
  border-radius:50%;
  background:var(--cocoa-soft);
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 24px;
  font-size:34px;
}

/* Teks */
h1{
  font-family:'Playfair Display',serif;
  font-size:24px;font-weight:700;
  color:var(--text-dark);
  margin-bottom:10px;
}
p{
  font-size:15px;
  color:var(--text-muted);
  line-height:1.7;
  margin-bottom:32px;
}
p strong{
  color:var(--cocoa);
  font-weight:600;
}

/* Info role badge */
.role-badge{
  display:inline-flex;
  align-items:center;
  gap:8px;
  background:var(--cocoa-soft);
  border:1px solid rgba(196,164,132,.4);
  color:var(--cocoa);
  font-size:13px;
  font-weight:600;
  padding:7px 16px;
  border-radius:50px;
  margin-bottom:32px;
}
.role-dot{
  width:8px;height:8px;
  border-radius:50%;
  background:var(--cocoa-light);
}

/* Tombol */
.btn-wrap{display:flex;flex-direction:column;gap:12px;}
.btn-logout{
  display:block;
  width:100%;
  padding:14px;
  background:linear-gradient(135deg,var(--cocoa-dark),var(--cocoa));
  color:#fff;
  font-family:'DM Sans',sans-serif;
  font-size:15px;
  font-weight:600;
  border:none;
  border-radius:50px;
  cursor:pointer;
  letter-spacing:.3px;
  transition:.25s;
}
.btn-logout:hover{
  opacity:.9;
  transform:translateY(-2px);
  box-shadow:0 10px 30px rgba(59,47,47,.25);
}
.btn-cancel{
  display:block;
  width:100%;
  padding:13px;
  background:transparent;
  color:var(--text-muted);
  font-family:'DM Sans',sans-serif;
  font-size:15px;
  font-weight:500;
  border:1.5px solid #e8ddd5;
  border-radius:50px;
  cursor:pointer;
  text-decoration:none;
  transition:.2s;
}
.btn-cancel:hover{
  background:var(--cocoa-soft);
  color:var(--cocoa);
  border-color:rgba(196,164,132,.5);
}

/* Divider */
.divider{
  display:flex;align-items:center;gap:12px;
  margin:8px 0;
  color:var(--text-muted);
  font-size:12px;
}
.divider::before,.divider::after{
  content:'';flex:1;
  height:1px;
  background:#e8ddd5;
}

/* Footer note */
.footer-note{
  margin-top:28px;
  padding-top:20px;
  border-top:1px solid #f0e8e0;
  font-size:12px;
  color:var(--text-muted);
}
.footer-note a{
  color:var(--cocoa-light);
  text-decoration:none;
  font-weight:500;
}
.footer-note a:hover{color:var(--cocoa);}
</style>
</head>
<body>

<div class="logout-card">

  
  <a href="<?php echo e(route('landing')); ?>" class="logo">
    <span class="logo-text">VANTELLA</span>
    <span class="logo-sub">Hotel & Resort</span>
  </a>

  
  <div class="icon-wrap">👋</div>

  
  <h1>Keluar dari Akun?</h1>
  <p>
    Halo, <strong><?php echo e(auth()->user()->name); ?></strong>.<br>
    Apakah Anda yakin ingin keluar dari sesi ini?
  </p>

  
  <div class="role-badge">
    <span class="role-dot"></span>
    <?php
      $roleLabel = match(auth()->user()->role) {
        'admin'          => 'Administrator',
        'owner'          => 'Owner',
        'ceo'            => 'CEO',
        'resepsionis'    => 'Resepsionis',
        'kasir_hotel'    => 'Kasir Hotel',
        'kasir_restoran' => 'Kasir Restoran',
        default          => 'Customer',
      };
    ?>
    <?php echo e($roleLabel); ?> · <?php echo e(auth()->user()->email); ?>

  </div>

  
  <div class="btn-wrap">
    
    <form method="POST" action="<?php echo e(route('logout')); ?>">
      <?php echo csrf_field(); ?>
      <button type="submit" class="btn-logout">
        Ya, Keluar Sekarang
      </button>
    </form>

    <div class="divider">atau</div>

    
    <?php
      $dashRoute = match(auth()->user()->role) {
        'admin'          => 'admin.dashboard',
        'owner'          => 'owner.dashboard',
        'ceo'            => 'ceo.dashboard',
        'resepsionis'    => 'resepsionis.dashboard',
        'kasir_hotel'    => 'kasir.hotel.dashboard',
        'kasir_restoran' => 'kasir.restoran.dashboard',
        default          => 'customer.dashboard',
      };
    ?>
    <a href="<?php echo e(route($dashRoute)); ?>" class="btn-cancel">
      Batal, Kembali ke Dashboard
    </a>
  </div>

  
  <div class="footer-note">
    Butuh bantuan? <a href="mailto:info@vantellahotel.com">Hubungi Support</a>
  </div>

</div>

</body>
</html><?php /**PATH /var/www/resources/views/auth/logout.blade.php ENDPATH**/ ?>