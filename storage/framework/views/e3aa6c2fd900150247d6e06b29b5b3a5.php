<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SAPUTRI Hotel</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* (CSS kamu tetap, aku tidak ubah supaya aman) */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --gold:#E6C76A;
  --gold-soft:#C9A84C;
  --dark:#2c2c2c;
}

body{
  font-family:'Inter',sans-serif;
  min-height:100vh;
  display:grid;
  grid-template-columns:1fr 1fr;
}

.left-panel{
  position:relative;
  background:url("<?php echo e(asset('images/Classical Grand1.jpg')); ?>") center/cover no-repeat;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:60px;
}

.left-panel::before{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.4));
}

.left-content{position:relative;color:#fff;max-width:400px;}

.hotel-logo{
  font-family:'Playfair Display',serif;
  font-size:2.8rem;
  color:var(--gold);
  margin-bottom:10px;
}

.hotel-tagline{
  letter-spacing:.2em;
  font-size:.8rem;
  color:#ddd;
  margin-bottom:40px;
}

.feature-item{margin-bottom:22px;}

.feature-item h4{color:var(--gold);}

.right-panel{
  display:flex;
  align-items:center;
  justify-content:center;
  padding:40px;
  background:linear-gradient(135deg,#f3e9dc,#d2b48c);
}

.login-box{
  width:100%;
  max-width:400px;
  padding:40px;
  border-radius:18px;
  background:rgba(255,255,255,0.8);
  backdrop-filter:blur(10px);
  box-shadow:0 25px 50px rgba(0,0,0,0.15);
}

.login-heading{
  font-family:'Playfair Display',serif;
  font-size:2.2rem;
  background:linear-gradient(135deg,#C9A84C,#E6C76A);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
}

.form-group{margin-bottom:18px;}

label{
  font-size:.75rem;
  text-transform:uppercase;
  color:#6B7280;
  display:block;
  margin-bottom:6px;
}

input{
  width:100%;
  padding:12px 14px;
  border-radius:10px;
  border:1px solid #ddd;
  outline:none;
}

input:focus{
  border-color:var(--gold-soft);
}

.form-row{
  display:flex;
  justify-content:space-between;
  margin-bottom:20px;
  font-size:.85rem;
}

.btn-login{
  width:100%;
  padding:12px;
  border:none;
  border-radius:10px;
  background:linear-gradient(135deg,#C9A84C,#E6C76A);
  color:#fff;
  font-weight:600;
  cursor:pointer;
}

.error{
  color:red;
  font-size:.85rem;
  margin-bottom:10px;
}

@media(max-width:768px){
  body{grid-template-columns:1fr}
  .left-panel{display:none}
}
</style>
</head>

<body>

<!-- LEFT -->
<div class="left-panel">
  <div class="left-content">
    <div class="hotel-logo">VANTELLA Hotel</div>
    <div class="hotel-tagline">LUXURY & COMFORT</div>

    <div class="feature-item">
      <h4>Kamar Premium</h4>
      <p>Kamar nyaman dengan fasilitas lengkap</p>
    </div>

    <div class="feature-item">
      <h4>Restoran Eksklusif</h4>
      <p>Pengalaman kuliner berkualitas tinggi</p>
    </div>

    <div class="feature-item">
      <h4>Reservasi Mudah</h4>
      <p>Pemesanan cepat dan praktis</p>
    </div>
  </div>
</div>

<!-- RIGHT -->
<div class="right-panel">
  <div class="login-box">

    <h1 class="login-heading">Selamat Datang</h1>
    <p>Silakan masuk ke akun Anda</p>

    <!-- ERROR -->
    <?php if($errors->any()): ?>
      <div class="error">
        <?php echo e($errors->first()); ?>

      </div>
    <?php endif; ?>

    <!-- FORM LOGIN -->
    <form method="POST" action="<?php echo e(route('login')); ?>">
      <?php echo csrf_field(); ?>

      <div class="form-group">
        <label>Email</label>
        <input 
          type="email" 
          name="email" 
          value="<?php echo e(old('email')); ?>" 
          required
        >
      </div>

      <div class="form-group">
        <label>Password</label>
        <input 
          type="password" 
          name="password" 
          required
        >
      </div>

      <div class="form-row">
        <label>
          <input type="checkbox" name="remember">
          Ingat saya
        </label>

        <a href="#" style="color:#C9A84C;text-decoration:none;">
          Lupa password?
        </a>
      </div>

      <button type="submit" class="btn-login">
        Masuk
      </button>
    </form>

  </div>
</div>

</body>
</html><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>