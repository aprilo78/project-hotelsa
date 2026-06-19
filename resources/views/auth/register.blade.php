<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun — DRG Hotel</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --gold:#E6C76A;
  --gold-soft:#C9A84C;
  --dark:#2c2c2c;
  --cream:#f5efe6;
}

/* BODY */
body{
  font-family:'Inter',sans-serif;
  min-height:100vh;

  background:url("{{ asset('images/regis2.jpg') }}") center/cover no-repeat;
  background-attachment:fixed;

  display:flex;
  align-items:center;
  justify-content:center;
  padding:40px 16px;
  position:relative;
}

/* OVERLAY (LEBIH HALUS & MENYATU) */
body::before{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(
    rgba(44,44,44,0.6),
    rgba(44,44,44,0.4),
    rgba(44,44,44,0.7)
  );
  backdrop-filter:blur(4px);
}

/* CARD (LEBIH NATURAL, TIDAK PUTIH TERANG) */
.card{
  position:relative;
  z-index:1;

  width:100%;
  max-width:480px;
  border-radius:20px;
  overflow:hidden;

  background:rgba(245,239,230,0.95); /* cream */
  backdrop-filter:blur(10px);

  box-shadow:0 25px 60px rgba(0,0,0,0.5);
}

/* TOP */
.card-top{
  padding:35px;
  text-align:center;
  background:linear-gradient(135deg,#2c2c2c,#1f1f1f);
}

.logo{
  font-family:'Playfair Display',serif;
  font-size:2rem;
  color:var(--gold);
  margin-bottom:8px;
}

.card-top p{
  font-size:.8rem;
  color:#bbb;
  letter-spacing:.15em;
}

/* BODY */
.card-body{
  padding:35px;
}

/* TITLE */
.form-title{
  font-family:'Playfair Display',serif;
  font-size:1.8rem;
  background:linear-gradient(135deg,#C9A84C,#E6C76A);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  margin-bottom:5px;
}

.form-subtitle{
  color:#6b6b6b;
  font-size:.9rem;
  margin-bottom:25px;
}

/* FORM */
.form-group{
  margin-bottom:18px;
}

.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:16px;
}

label{
  font-size:.75rem;
  text-transform:uppercase;
  letter-spacing:.1em;
  color:#7a6f60;
  margin-bottom:6px;
  display:block;
}

/* INPUT LEBIH SOFT */
input{
  width:100%;
  padding:12px 14px;
  border-radius:10px;
  border:1px solid #e0d6c8;
  font-size:.9rem;
  outline:none;
  transition:.2s;
  background:#fdfaf6; /* tidak putih terang */
}

input:focus{
  border-color:var(--gold-soft);
  box-shadow:0 0 0 3px rgba(201,168,76,.2);
}

input.is-invalid{
  border-color:#EF4444;
}

/* ERROR */
.error-msg{
  color:#EF4444;
  font-size:.8rem;
  margin-top:5px;
}

/* ALERT */
.alert-box{
  background:#FEE2E2;
  border:1px solid #FECACA;
  border-radius:10px;
  padding:12px;
  margin-bottom:18px;
  font-size:.85rem;
}

/* BUTTON */
.btn-register{
  width:100%;
  padding:13px;
  border:none;
  border-radius:10px;

  background:linear-gradient(135deg,#C9A84C,#E6C76A);
  color:#fff;

  font-weight:600;
  cursor:pointer;
  transition:.3s;

  box-shadow:0 8px 20px rgba(201,168,76,0.4);
}

.btn-register:hover{
  transform:translateY(-2px);
}

/* LOGIN LINK */
.login-link{
  text-align:center;
  margin-top:20px;
  font-size:.9rem;
  color:#5f5f5f;
}

.login-link a{
  color:var(--gold-soft);
  text-decoration:none;
  font-weight:600;
}

.login-link a:hover{
  text-decoration:underline;
}

/* MOBILE */
@media(max-width:480px){
  .form-grid{grid-template-columns:1fr}
  .card-body{padding:25px}
}
</style>
</head>

<body>

<div class="card">

  <div class="card-top">
    <div class="logo">VANTELLA Hotel</div>
    <p>LUXURY & COMFORT</p>
  </div>

  <div class="card-body">

    <h2 class="form-title">Buat Akun</h2>
    <p class="form-subtitle">Daftar untuk menikmati layanan terbaik kami</p>

    @if ($errors->any())
      <div class="alert-box">
        <ul>
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
        @error('name')<span class="error-msg">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
        @error('email')<span class="error-msg">{{ $message }}</span>@enderror
      </div>

      <div class="form-grid">
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
          @error('password')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label>Konfirmasi Password</label>
          <input type="password" name="password_confirmation" required>
        </div>
      </div>

      <button type="submit" class="btn-register">Daftar</button>

    </form>

    <div class="login-link">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
    </div>

  </div>
</div>

</body>
</html>