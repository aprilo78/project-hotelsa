<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VANTELLA Hotel — Luxury & Comfort</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --cocoa-dark:#3b2f2f;
  --cocoa:#6f4e37;
  --cocoa-mid:#8b6147;
  --cocoa-light:#c4a484;
  --cocoa-soft:#f5e6d3;
  --cocoa-cream:#fffaf6;
  --gold:#d4a843;
  --gold-light:#e8c87a;
  --white:#ffffff;
  --text-dark:#2a1f1f;
  --text-mid:#5a4a3a;
  --text-muted:#9a8070;
  --shadow-card: 0 8px 40px rgba(59,47,47,.10);
  --shadow-hover: 0 20px 60px rgba(59,47,47,.18);
  --radius-card: 20px;
  --radius-sm: 10px;
}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--cocoa-cream);color:var(--text-dark);overflow-x:hidden;}

/* ═══════════ NAVBAR ═══════════ */
nav{
  position:fixed;top:0;left:0;right:0;z-index:1000;
  display:flex;align-items:center;justify-content:space-between;
  padding:15px 48px;gap:16px;
  background:rgba(43,33,33,.96);
  backdrop-filter:blur(18px);
  border-bottom:1px solid rgba(196,164,132,.12);
}
.nav-logo{font-family:'Playfair Display',serif;font-size:21px;font-style:italic;color:var(--cocoa-light);letter-spacing:.5px;flex-shrink:0;}
.nav-logo span{font-style:normal;font-weight:600;color:#fff;font-size:11px;display:block;letter-spacing:3px;text-transform:uppercase;}
.nav-links{display:flex;gap:24px;list-style:none;}
.nav-links a{color:rgba(255,255,255,.68);text-decoration:none;font-size:13.5px;font-weight:400;letter-spacing:.2px;transition:.2s;}
.nav-links a:hover{color:var(--cocoa-light)}

/* AUTH BUTTONS */
.nav-auth{display:flex;align-items:center;gap:9px;flex-shrink:0;}
.btn-login{
  color:rgba(255,255,255,.78);font-size:13px;font-weight:500;
  padding:8px 18px;border-radius:50px;text-decoration:none;
  border:1.5px solid rgba(196,164,132,.3);background:transparent;transition:.2s;
}
.btn-login:hover{border-color:var(--cocoa-light);color:var(--cocoa-light);background:rgba(196,164,132,.08);}
.btn-register{
  background:linear-gradient(135deg,var(--cocoa-light),var(--gold));
  color:var(--cocoa-dark);font-weight:600;font-size:13px;
  padding:8px 20px;border-radius:50px;text-decoration:none;letter-spacing:.2px;transition:.2s;
}
.btn-register:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(196,164,132,.4);}
.btn-booking-nav{
  background:rgba(196,164,132,.1);
  border:1.5px solid rgba(196,164,132,.35);
  color:var(--cocoa-light);font-weight:600;font-size:13px;
  padding:8px 18px;border-radius:50px;text-decoration:none;letter-spacing:.2px;transition:.2s;
}
.btn-booking-nav:hover{background:rgba(196,164,132,.18);transform:translateY(-2px);}

/* ═══════════ HERO ═══════════ */
.hero{
  position:relative;min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  background:
    linear-gradient(160deg,rgba(59,47,47,.82) 0%,rgba(111,78,55,.70) 50%,rgba(59,47,47,.88) 100%),
    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80') center/cover no-repeat;
  text-align:center;padding:120px 24px 80px;
}
.hero::after{content:'';position:absolute;bottom:0;left:0;right:0;height:100px;background:linear-gradient(to bottom,transparent,var(--cocoa-cream));}
.hero-badge{display:inline-block;border:1px solid rgba(196,164,132,.5);color:var(--cocoa-light);font-size:11px;letter-spacing:4px;text-transform:uppercase;padding:7px 20px;border-radius:50px;margin-bottom:28px;}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(42px,6vw,80px);font-weight:700;color:#fff;line-height:1.1;margin-bottom:22px;}
.hero h1 em{color:var(--cocoa-light);font-style:italic}
.hero p{font-size:17px;color:rgba(255,255,255,.78);max-width:540px;margin:0 auto 40px;line-height:1.7;font-weight:300;}
.hero-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;}
.btn-primary{background:linear-gradient(135deg,var(--cocoa-light),var(--gold));color:var(--cocoa-dark);font-weight:600;font-size:14px;padding:14px 32px;border-radius:50px;text-decoration:none;transition:.25s;display:inline-block;letter-spacing:.3px;}
.btn-primary:hover{transform:translateY(-3px);box-shadow:0 12px 35px rgba(212,168,67,.4);}
.btn-outline{border:1.5px solid rgba(255,255,255,.5);color:#fff;font-size:14px;padding:13px 30px;border-radius:50px;text-decoration:none;transition:.25s;display:inline-block;background:rgba(255,255,255,.05);}
.btn-outline:hover{background:rgba(255,255,255,.12);transform:translateY(-2px);}
.hero-scroll{position:absolute;bottom:40px;left:50%;transform:translateX(-50%);color:rgba(255,255,255,.5);font-size:12px;letter-spacing:2px;text-transform:uppercase;display:flex;flex-direction:column;align-items:center;gap:8px;z-index:2;}
.scroll-line{width:1px;height:40px;background:linear-gradient(to bottom,rgba(255,255,255,.5),transparent);animation:scrollPulse 1.8s ease infinite;}
@keyframes scrollPulse{0%,100%{opacity:.4;transform:scaleY(1)}50%{opacity:1;transform:scaleY(1.3)}}

/* ═══════════ SECTION BASE ═══════════ */
.section{padding:90px 0;}
.container{max-width:1200px;margin:0 auto;padding:0 30px;}
.section-label{display:block;font-size:11px;letter-spacing:4px;text-transform:uppercase;color:var(--cocoa-light);font-weight:600;margin-bottom:12px;}
.section-title{font-family:'Playfair Display',serif;font-size:clamp(30px,4vw,44px);font-weight:700;color:var(--cocoa-dark);margin-bottom:16px;}
.section-title em{color:var(--cocoa);font-style:italic}
.section-divider{width:50px;height:2px;background:linear-gradient(90deg,var(--cocoa),var(--cocoa-light));border-radius:2px;margin:0 auto 50px;}
.section-header{text-align:center;margin-bottom:0;}

/* ═══════════ BOOKING STRIP ═══════════ */
.booking-strip{background:var(--cocoa-dark);padding:40px 0;}
.booking-inner{display:flex;align-items:center;gap:14px;flex-wrap:wrap;justify-content:center;}
.booking-inner input,.booking-inner select{padding:13px 18px;border-radius:50px;border:1px solid rgba(196,164,132,.25);background:rgba(255,255,255,.1);color:#fff;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;min-width:160px;}
.booking-inner input::placeholder{color:rgba(255,255,255,.5)}
.booking-inner select option{background:#3b2f2f;color:#fff}
.booking-inner input[type="date"]{color-scheme:dark}
.booking-submit{background:linear-gradient(135deg,var(--cocoa-light),var(--gold));color:var(--cocoa-dark);font-weight:600;font-size:14px;padding:13px 28px;border-radius:50px;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;transition:.2s;letter-spacing:.3px;}
.booking-submit:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(212,168,67,.4);}
.booking-label{color:rgba(255,255,255,.6);font-size:12px;letter-spacing:3px;text-transform:uppercase;margin-right:8px;white-space:nowrap;}

/* ═══════════ STATS ═══════════ */
.stats-section{background:var(--cocoa-soft);padding:60px 0;}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:0;}
.stat-item{text-align:center;padding:30px 20px;border-right:1px solid rgba(111,78,55,.15);}
.stat-item:last-child{border-right:none}
.stat-num{font-family:'Playfair Display',serif;font-size:44px;font-weight:700;color:var(--cocoa-dark);line-height:1;margin-bottom:8px;}
.stat-num span{color:var(--cocoa-light)}
.stat-label{font-size:13px;color:var(--text-muted);letter-spacing:.5px;}

/* ═══════════ ROOMS ═══════════ */
.rooms-section{background:var(--cocoa-cream);}
.rooms-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:28px;}
.room-card{background:#fff;border-radius:var(--radius-card);overflow:hidden;box-shadow:var(--shadow-card);transition:.3s;}
.room-card:hover{transform:translateY(-8px);box-shadow:var(--shadow-hover);}
.room-img{position:relative;overflow:hidden;height:210px;}
.room-img img{width:100%;height:100%;object-fit:cover;transition:.4s;}
.room-card:hover .room-img img{transform:scale(1.05);}
.room-badge{position:absolute;top:14px;left:14px;background:linear-gradient(135deg,var(--cocoa-dark),var(--cocoa));color:#fff;font-size:11px;letter-spacing:2px;text-transform:uppercase;padding:5px 14px;border-radius:50px;}
.room-avail{position:absolute;top:14px;right:14px;background:rgba(255,255,255,.9);backdrop-filter:blur(6px);color:var(--cocoa);font-size:12px;font-weight:600;padding:5px 12px;border-radius:50px;}
.room-body{padding:22px;}
.room-name{font-family:'Playfair Display',serif;font-size:20px;font-weight:600;color:var(--cocoa-dark);margin-bottom:6px;}
.room-price{font-size:16px;font-weight:700;color:var(--cocoa);margin-bottom:14px;}
.room-price span{font-size:13px;font-weight:400;color:var(--text-muted);}
.room-facilities{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:16px;}
.facility-tag{background:var(--cocoa-soft);color:var(--cocoa-dark);font-size:12px;padding:5px 12px;border-radius:50px;font-weight:500;}
.room-cap{font-size:13px;color:var(--text-muted);margin-bottom:18px;}
.btn-book{display:block;text-align:center;background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));color:#fff;text-decoration:none;font-size:14px;font-weight:600;padding:12px;border-radius:50px;transition:.2s;letter-spacing:.3px;}
.btn-book:hover{opacity:.9;transform:translateY(-1px);}

/* ═══════════ RESTAURANT ═══════════ */
.resto-section{background:linear-gradient(160deg,var(--cocoa-dark) 0%,#2a1f1f 100%);position:relative;overflow:hidden;}
.resto-section::before{content:'';position:absolute;top:-80px;right:-80px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(196,164,132,.08),transparent 70%);}
.menu-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:20px;}
.menu-card{background:rgba(255,255,255,.05);border:1px solid rgba(196,164,132,.15);border-radius:var(--radius-card);overflow:hidden;display:flex;transition:.25s;}
.menu-card:hover{background:rgba(255,255,255,.09);transform:translateY(-4px);border-color:rgba(196,164,132,.35);}
.menu-img{width:120px;min-width:120px;overflow:hidden;}
.menu-img img{width:100%;height:100%;object-fit:cover;transition:.4s;}
.menu-card:hover .menu-img img{transform:scale(1.07);}
.menu-info{padding:18px;flex:1;display:flex;flex-direction:column;justify-content:space-between;}
.menu-cat{font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--cocoa-light);font-weight:600;margin-bottom:6px;}
.menu-name{font-family:'Playfair Display',serif;font-size:17px;font-weight:600;color:#fff;margin-bottom:4px;}
.menu-desc{font-size:13px;color:rgba(255,255,255,.5);line-height:1.5;margin-bottom:12px;flex:1;}
.menu-footer{display:flex;align-items:center;justify-content:space-between;}
.menu-price{font-size:16px;font-weight:700;color:var(--gold-light);}
.btn-order{background:transparent;border:1px solid rgba(196,164,132,.4);color:var(--cocoa-light);font-size:12px;font-weight:600;letter-spacing:.5px;padding:7px 16px;border-radius:50px;cursor:pointer;font-family:'DM Sans',sans-serif;transition:.2s;text-decoration:none;}
.btn-order:hover{background:var(--cocoa-light);color:var(--cocoa-dark);}

/* ═══════════ TESTIMONIALS ═══════════ */
.testi-section{background:#fff;}
.testi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;}
.testi-card{background:var(--cocoa-cream);border:1px solid rgba(196,164,132,.2);border-radius:var(--radius-card);padding:28px;position:relative;transition:.2s;}
.testi-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-card);}
.testi-quote{font-size:60px;line-height:.6;font-family:'Playfair Display',serif;color:var(--cocoa-light);opacity:.4;position:absolute;top:20px;right:24px;}
.testi-stars{color:var(--gold);font-size:14px;letter-spacing:2px;margin-bottom:14px;}
.testi-text{font-size:15px;color:var(--text-mid);line-height:1.7;font-style:italic;margin-bottom:18px;}
.testi-author{display:flex;align-items:center;gap:12px;}
.testi-avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;color:#fff;}
.testi-name{font-weight:600;font-size:15px;color:var(--cocoa-dark);}
.testi-meta{font-size:12px;color:var(--text-muted);}

/* ═══════════ FOOTER ═══════════ */
footer{
  background:linear-gradient(160deg,#231818 0%,var(--cocoa-dark) 100%);
  color:rgba(255,255,255,.6);
  padding:72px 0 0;
}
.footer-grid{
  display:grid;
  grid-template-columns:1.7fr 1fr 1fr 1.4fr;
  gap:50px;
  margin-bottom:60px;
}

/* Brand Column */
.footer-logo{font-family:'Playfair Display',serif;font-size:32px;font-style:italic;color:var(--cocoa-light);margin-bottom:3px;letter-spacing:.5px;}
.footer-tagline{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.28);margin-bottom:20px;}
.footer-brand p{font-size:14px;line-height:1.75;color:rgba(255,255,255,.48);max-width:280px;margin-bottom:24px;}
.footer-social{display:flex;gap:10px;}
.social-btn{
  width:38px;height:38px;border-radius:50%;
  border:1px solid rgba(196,164,132,.22);
  display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,.45);font-size:12px;font-weight:600;
  text-decoration:none;transition:.2s;letter-spacing:.5px;
}
.social-btn:hover{border-color:var(--cocoa-light);color:var(--cocoa-light);background:rgba(196,164,132,.1);}

/* Nav Columns */
.footer-col h4{
  font-family:'Playfair Display',serif;
  font-size:16px;font-weight:600;color:#fff;
  margin-bottom:22px;padding-bottom:12px;
  border-bottom:1px solid rgba(196,164,132,.18);
}
.footer-links-col{list-style:none;display:flex;flex-direction:column;gap:11px;}
.footer-links-col a{
  color:rgba(255,255,255,.48);text-decoration:none;font-size:14px;transition:.25s;
  display:flex;align-items:center;gap:8px;
}
.footer-links-col a::before{content:'›';color:var(--cocoa-light);font-size:15px;opacity:.5;transition:.2s;}
.footer-links-col a:hover{color:var(--cocoa-light);padding-left:5px;}
.footer-links-col a:hover::before{opacity:1;}

/* Contact Items */
.contact-item{display:flex;gap:14px;margin-bottom:20px;align-items:flex-start;}
.contact-icon{
  width:38px;height:38px;border-radius:10px;flex-shrink:0;
  background:rgba(196,164,132,.1);border:1px solid rgba(196,164,132,.18);
  display:flex;align-items:center;justify-content:center;font-size:16px;
  margin-top:2px;
}
.contact-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.28);margin-bottom:4px;}
.contact-value{font-size:13.5px;color:rgba(255,255,255,.65);line-height:1.6;}
.contact-value a{color:rgba(255,255,255,.65);text-decoration:none;transition:.2s;}
.contact-value a:hover{color:var(--cocoa-light);}

/* Bottom Bar */
.footer-bottom{
  border-top:1px solid rgba(255,255,255,.07);
  padding:22px 30px;
  display:flex;align-items:center;justify-content:space-between;
  flex-wrap:wrap;gap:12px;
}
.footer-bottom p{font-size:12px;color:rgba(255,255,255,.26);}
.footer-bottom-links{display:flex;gap:22px;}
.footer-bottom-links a{font-size:12px;color:rgba(255,255,255,.26);text-decoration:none;transition:.2s;}
.footer-bottom-links a:hover{color:var(--cocoa-light);}

/* ═══════════ HERO ANIMATIONS ═══════════ */
@keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.hero-content > *{opacity:0;animation:fadeUp .8s forwards;}
.hero-badge{animation-delay:.1s}
.hero h1{animation-delay:.3s}
.hero p{animation-delay:.5s}
.hero-btns{animation-delay:.7s}

/* ═══════════ RESPONSIVE ═══════════ */
@media(max-width:1100px){
  nav{padding:14px 24px;}
  .nav-links{display:none;}
  .footer-grid{grid-template-columns:1fr 1fr;}
}
@media(max-width:768px){
  .btn-booking-nav{display:none;}
  .booking-inner{flex-direction:column;align-items:stretch;}
  .booking-inner input,.booking-inner select{min-width:unset;width:100%;}
  .menu-grid{grid-template-columns:1fr;}
  .stats-grid{grid-template-columns:1fr 1fr;}
  .stat-item:nth-child(2n){border-right:none;}
  .stat-item{border-bottom:1px solid rgba(111,78,55,.15);}
  .footer-grid{grid-template-columns:1fr;}
  .footer-bottom{flex-direction:column;text-align:center;}
}
</style>
</head>
<body>

<!-- ═══ NAVBAR ═══ -->
<nav>
  <div class="nav-logo">
    <span>Vantella</span>
    Hotel & Resort
  </div>
  <ul class="nav-links">
    <li><a href="#kamar">Kamar</a></li>
    <li><a href="#restoran">Restoran</a></li>
    <li><a href="#fasilitas">Fasilitas</a></li>
    <li><a href="#testimoni">Ulasan</a></li>
    <li><a href="#kontak">Kontak</a></li>
  </ul>
  <div class="nav-auth">
    <a href="<?php echo e(route('login')); ?>" class="btn-login">Masuk</a>
    <a href="<?php echo e(route('register')); ?>" class="btn-register">Daftar</a>
    <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-booking-nav">✦ Booking</a>
  </div>
</nav>

<!-- ═══ HERO ═══ -->
<section class="hero">
  <div class="hero-content">
    <span class="hero-badge">Luxury & Comfort Experience</span>
    <h1>Selamat Datang di<br><em>VANTELLA Hotel</em></h1>
    <p>Pengalaman menginap mewah, nyaman, dan elegan. Rasakan kehangatan pelayanan premium kami di setiap sudut hotel.</p>
    <div class="hero-btns">
      <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-primary">✦ Booking Sekarang</a>
      <a href="#kamar" class="btn-outline">Lihat Kamar</a>
      <a href="#restoran" class="btn-outline">Menu Restoran</a>
    </div>
  </div>
  <div class="hero-scroll"><div class="scroll-line"></div></div>
</section>

<!-- ═══ QUICK BOOKING ═══ -->
<div class="booking-strip" id="booking">
  <div class="container">
    <div class="booking-inner">
      <span class="booking-label">Cari Kamar</span>
      <input type="date" name="check_in">
      <input type="date" name="check_out">
      <select name="guests">
        <option value="1">1 Tamu</option>
        <option value="2" selected>2 Tamu</option>
        <option value="3">3 Tamu</option>
        <option value="4">4 Tamu</option>
        <option value="5">5 Tamu</option>
        <option value="6">6 Tamu</option>
      </select>
      <select name="room_type">
        <option value="">Semua Tipe</option>
        <option>Deluxe Room</option>
        <option>Executive Room</option>
        <option>Suite Room</option>
        <option>Presidential Suite</option>
      </select>
      <button class="booking-submit" onclick="alert('Silakan login terlebih dahulu untuk melanjutkan booking!')">Cari Kamar →</button>
    </div>
  </div>
</div>

<!-- ═══ STATS ═══ -->
<div class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num">12<span>+</span></div><div class="stat-label">Tahun Berdiri</div></div>
      <div class="stat-item"><div class="stat-num">48</div><div class="stat-label">Total Kamar</div></div>
      <div class="stat-item"><div class="stat-num">4.9<span>★</span></div><div class="stat-label">Rating Tamu</div></div>
      <div class="stat-item"><div class="stat-num">15<span>k+</span></div><div class="stat-label">Tamu Puas</div></div>
      <div class="stat-item"><div class="stat-num">24<span>/7</span></div><div class="stat-label">Layanan Aktif</div></div>
    </div>
  </div>
</div>

<!-- ═══ KAMAR ═══ -->
<section id="kamar" class="section rooms-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Pilihan Eksklusif</span>
      <h2 class="section-title">Kamar & <em>Suite Premium</em></h2>
      <div class="section-divider"></div>
    </div>
    <div class="rooms-grid">
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80" alt="Deluxe Room">
          <span class="room-badge">Deluxe</span><span class="room-avail">4 Tersedia</span>
        </div>
        <div class="room-body">
          <div class="room-name">Deluxe Room</div>
          <div class="room-price">Rp 450.000 <span>/ malam</span></div>
          <div class="room-facilities">
            <span class="facility-tag">King Bed</span><span class="facility-tag">AC</span><span class="facility-tag">WiFi</span><span class="facility-tag">Bathroom</span><span class="facility-tag">Smart TV</span>
          </div>
          <div class="room-cap">Kapasitas 2 orang · 28 m²</div>
          <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-book">Booking Sekarang</a>
        </div>
      </div>
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80" alt="Executive Room">
          <span class="room-badge">Executive</span><span class="room-avail">3 Tersedia</span>
        </div>
        <div class="room-body">
          <div class="room-name">Executive Room</div>
          <div class="room-price">Rp 750.000 <span>/ malam</span></div>
          <div class="room-facilities">
            <span class="facility-tag">King Bed</span><span class="facility-tag">AC</span><span class="facility-tag">WiFi</span><span class="facility-tag">Bathtub</span><span class="facility-tag">Smart TV</span><span class="facility-tag">Coffee Maker</span>
          </div>
          <div class="room-cap">Kapasitas 2 orang · 38 m²</div>
          <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-book">Booking Sekarang</a>
        </div>
      </div>
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=600&q=80" alt="Suite Room">
          <span class="room-badge">Suite</span><span class="room-avail">2 Tersedia</span>
        </div>
        <div class="room-body">
          <div class="room-name">Suite Room</div>
          <div class="room-price">Rp 1.200.000 <span>/ malam</span></div>
          <div class="room-facilities">
            <span class="facility-tag">King Bed</span><span class="facility-tag">AC</span><span class="facility-tag">WiFi</span><span class="facility-tag">Jacuzzi</span><span class="facility-tag">Smart TV</span><span class="facility-tag">Coffee Maker</span>
          </div>
          <div class="room-cap">Kapasitas 3 orang · 55 m²</div>
          <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-book">Booking Sekarang</a>
        </div>
      </div>
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80" alt="Presidential Suite">
          <span class="room-badge" style="background:linear-gradient(135deg,#b8860b,var(--gold));">Presidential</span><span class="room-avail">1 Tersedia</span>
        </div>
        <div class="room-body">
          <div class="room-name">Presidential Suite</div>
          <div class="room-price">Rp 2.500.000 <span>/ malam</span></div>
          <div class="room-facilities">
            <span class="facility-tag">King Bed</span><span class="facility-tag">AC Premium</span><span class="facility-tag">WiFi</span><span class="facility-tag">Private Pool</span><span class="facility-tag">Smart TV</span><span class="facility-tag">Butler</span>
          </div>
          <div class="room-cap">Kapasitas 4 orang · 90 m²</div>
          <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn-book" style="background:linear-gradient(135deg,#b8860b,var(--gold-light));color:#2a1f1f">Booking Sekarang</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ RESTORAN ═══ -->
<section id="restoran" class="section resto-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label" style="color:var(--cocoa-light)">Kuliner Premium</span>
      <h2 class="section-title" style="color:#fff">Menu <em style="color:var(--cocoa-light)">Restoran</em></h2>
      <div class="section-divider"></div>
    </div>
    <div class="menu-grid">

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/Nasi GS.jpg')); ?>" alt="Nasi Goreng"></div>
        <div class="menu-info">
          <div><div class="menu-cat">⭐ Signature Dish</div><div class="menu-name">Nasi Goreng Special Hotel</div><div class="menu-desc">Nasi goreng premium dengan telur mata sapi, ayam suwir, dan sambal spesial.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 45.000</div>
            <button class="btn-order" onclick="openOrderModal('Nasi Goreng Special Hotel','⭐ Signature Dish',45000,'<?php echo e(url('images/Nasi GS.jpg')); ?>','Nasi goreng premium dengan telur mata sapi, ayam suwir, dan sambal spesial khas hotel.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/steak.jpg')); ?>" alt="Steak"></div>
        <div class="menu-info">
          <div><div class="menu-cat">Premium Beef</div><div class="menu-name">Steak Tenderloin</div><div class="menu-desc">Daging sapi pilihan, dimasak sempurna dengan saus mushroom cream dan roasted veggies.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 120.000</div>
            <button class="btn-order" onclick="openOrderModal('Steak Tenderloin','Premium Beef',120000,'<?php echo e(url('images/steak.jpg')); ?>','Daging sapi pilihan, dimasak sempurna dengan saus mushroom cream dan roasted veggies.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/Spaghetti.jpg')); ?>" alt="Spaghetti"></div>
        <div class="menu-info">
          <div><div class="menu-cat">Italian Cuisine</div><div class="menu-name">Spaghetti Carbonara</div><div class="menu-desc">Pasta creamy dengan keju parmesan asli, telur, dan bacon crispy premium.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 65.000</div>
            <button class="btn-order" onclick="openOrderModal('Spaghetti Carbonara','Italian Cuisine',65000,'<?php echo e(url('images/Spaghetti.jpg')); ?>','Pasta creamy dengan keju parmesan asli, telur, dan bacon crispy premium.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/Teriyaki.jpg')); ?>" alt="Chicken Teriyaki"></div>
        <div class="menu-info">
          <div><div class="menu-cat">Japanese Style</div><div class="menu-name">Chicken Teriyaki</div><div class="menu-desc">Ayam panggang dengan glazing teriyaki homemade, disajikan dengan nasi dan salad.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 55.000</div>
            <button class="btn-order" onclick="openOrderModal('Chicken Teriyaki','Japanese Style',55000,'<?php echo e(url('images/Teriyaki.jpg')); ?>','Ayam panggang dengan glazing teriyaki homemade, disajikan dengan nasi dan salad segar.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/sushi.jpg')); ?>" alt="Sushi"></div>
        <div class="menu-info">
          <div><div class="menu-cat">Premium Sushi</div><div class="menu-name">Sushi Platter</div><div class="menu-desc">20 pcs sushi premium: salmon, tuna, ebi, dan california roll dengan wasabi segar.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 150.000</div>
            <button class="btn-order" onclick="openOrderModal('Sushi Platter','Premium Sushi',150000,'<?php echo e(url('images/sushi.jpg')); ?>','20 pcs sushi premium: salmon, tuna, ebi, dan california roll dengan wasabi dan jahe segar.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-img"><img src="<?php echo e(url('images/salmon.jpg')); ?>" alt="Salmon"></div>
        <div class="menu-info">
          <div><div class="menu-cat">Chef's Special</div><div class="menu-name">Grilled Salmon Fillet</div><div class="menu-desc">Salmon atlantik segar dipanggang dengan lemon butter herb sauce dan mashed potato.</div></div>
          <div class="menu-footer">
            <div class="menu-price">Rp 95.000</div>
            <button class="btn-order" onclick="openOrderModal('Grilled Salmon Fillet','Chef\'s Special',95000,'<?php echo e(url('images/salmon.jpg')); ?>','Salmon atlantik segar dipanggang dengan lemon butter herb sauce dan mashed potato lembut.')">Pesan Sekarang</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══ MODAL PESAN MAKANAN ═══ -->
<div id="orderOverlay" style="display:none;position:fixed;inset:0;background:rgba(20,14,14,.8);backdrop-filter:blur(8px);z-index:9999;align-items:center;justify-content:center;padding:16px;">
  <div style="background:#fff;border-radius:24px;width:100%;max-width:440px;max-height:92vh;overflow-y:auto;box-shadow:0 30px 80px rgba(0,0,0,.4);display:flex;flex-direction:column;">

    <div id="orderFormSection">
      <div style="display:flex;background:linear-gradient(135deg,var(--cocoa-dark),var(--cocoa));height:120px;">
        <img id="om_img" src="" alt="" style="width:110px;min-width:110px;height:100%;object-fit:cover;">
        <div style="padding:14px 18px;flex:1;display:flex;flex-direction:column;justify-content:center;">
          <div id="om_cat" style="font-size:9px;letter-spacing:2px;color:rgba(196,164,132,.8);text-transform:uppercase;font-weight:600;margin-bottom:4px;"></div>
          <div id="om_title" style="font-family:'Playfair Display',serif;font-size:18px;font-weight:700;color:#fff;line-height:1.2;margin-bottom:4px;"></div>
          <div id="om_price" style="font-size:15px;font-weight:700;color:var(--gold-light);"></div>
        </div>
      </div>

      <div style="padding:16px 20px;">
        <p id="om_desc" style="font-size:13px;color:var(--text-mid);line-height:1.5;margin-bottom:14px;"></p>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:12px;">
          <div>
            <label style="display:block;font-size:10px;font-weight:600;letter-spacing:.5px;color:var(--text-muted);text-transform:uppercase;margin-bottom:5px;">Nama Pemesan</label>
            <input id="om_name" type="text" placeholder="Nama lengkap" style="width:100%;padding:9px 14px;border:1.5px solid #e8ddd5;border-radius:50px;font-size:13px;font-family:'DM Sans',sans-serif;outline:none;color:var(--text-dark);" onfocus="this.style.borderColor='var(--cocoa-light)'" onblur="this.style.borderColor='#e8ddd5'">
          </div>
          <div>
            <label style="display:block;font-size:10px;font-weight:600;letter-spacing:.5px;color:var(--text-muted);text-transform:uppercase;margin-bottom:5px;">No. Kamar / Meja</label>
            <input id="om_room" type="text" placeholder="cth. 101 / Meja 5" style="width:100%;padding:9px 14px;border:1.5px solid #e8ddd5;border-radius:50px;font-size:13px;font-family:'DM Sans',sans-serif;outline:none;color:var(--text-dark);" onfocus="this.style.borderColor='var(--cocoa-light)'" onblur="this.style.borderColor='#e8ddd5'">
          </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
          <label style="font-size:10px;font-weight:600;letter-spacing:.5px;color:var(--text-muted);text-transform:uppercase;">Jumlah Porsi</label>
          <div style="display:inline-flex;align-items:center;border:1.5px solid #e8ddd5;border-radius:50px;overflow:hidden;">
            <button type="button" onclick="omQty(-1)" style="width:34px;height:34px;background:none;border:none;font-size:18px;font-weight:300;color:var(--cocoa);cursor:pointer;display:flex;align-items:center;justify-content:center;">−</button>
            <span id="om_qty" style="min-width:36px;text-align:center;font-size:14px;font-weight:700;color:var(--text-dark);">1</span>
            <button type="button" onclick="omQty(1)" style="width:34px;height:34px;background:none;border:none;font-size:18px;font-weight:300;color:var(--cocoa);cursor:pointer;display:flex;align-items:center;justify-content:center;">+</button>
          </div>
        </div>

        <label style="display:block;font-size:10px;font-weight:600;letter-spacing:.5px;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;">
          Metode Pembayaran
        </label>

        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:14px;">
          <label style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid #e8ddd5;border-radius:50px;cursor:pointer;">
            <span style="font-size:13px;color:var(--text-dark);font-weight:600;">QRIS</span>
            <input type="radio" name="payment_method" value="qris" checked style="accent-color:var(--cocoa);margin:0;">
          </label>

          <label style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid #e8ddd5;border-radius:50px;cursor:pointer;">
            <span style="font-size:13px;color:var(--text-dark);font-weight:600;">Transfer BCA</span>
            <input type="radio" name="payment_method" value="bca" style="accent-color:var(--cocoa);margin:0;">
          </label>

          <label style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid #e8ddd5;border-radius:50px;cursor:pointer;">
            <span style="font-size:13px;color:var(--text-dark);font-weight:600;">M-Banking / E-Wallet</span>
            <input type="radio" name="payment_method" value="mbanking" style="accent-color:var(--cocoa);margin:0;">
          </label>
        </div>

        <label style="display:block;font-size:10px;font-weight:600;letter-spacing:.5px;color:var(--text-muted);text-transform:uppercase;margin-bottom:5px;">Catatan Khusus <span style="font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></label>
        <textarea id="om_note" placeholder="cth. tidak pedas, tanpa bawang, extra saus..." style="width:100%;padding:9px 12px;border:1.5px solid #e8ddd5;border-radius:12px;font-size:12px;font-family:'DM Sans',sans-serif;outline:none;resize:none;height:54px;color:var(--text-dark);" onfocus="this.style.borderColor='var(--cocoa-light)'" onblur="this.style.borderColor='#e8ddd5'"></textarea>
      </div>

      <div style="padding:0 20px 20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;background:var(--cocoa-soft);padding:10px 16px;border-radius:12px;margin-bottom:12px;">
          <span style="font-size:12px;font-weight:600;color:var(--cocoa);">Total Pembayaran</span>
          <span id="om_total" style="font-size:18px;font-weight:700;color:var(--cocoa-dark);"></span>
        </div>
        <div style="display:flex;gap:10px;">
          <button type="button" onclick="closeOrderModal()" style="flex:1;padding:11px;border:1.5px solid #e8ddd5;background:none;border-radius:50px;font-size:13px;font-weight:600;cursor:pointer;color:var(--text-muted);font-family:'DM Sans',sans-serif;">Batal</button>
          <button type="button" onclick="prosesPembayaran()" style="flex:2;padding:11px;background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));border:none;border-radius:50px;font-size:13px;font-weight:700;cursor:pointer;color:#fff;font-family:'DM Sans',sans-serif;letter-spacing:.3px;">✦ Pesan Sekarang</button>
        </div>
      </div>
    </div>

    <div id="orderSuccessSection" style="display:none;padding:32px 20px;text-align:center;">
      <div id="payment_content">
        </div>
    </div>

  </div>
</div>

<script>
function prosesPembayaran() {
  // Ambil metode pembayaran terpilih dan total tagihan aktual
  const metode = document.querySelector('input[name="payment_method"]:checked').value;
  const totalHarga = document.getElementById('om_total').innerText || "Rp 0";
  
  // Alihkan tampilan dari Form Input ke Panel Dinamis Pembayaran
  document.getElementById('orderFormSection').style.display = 'none';
  document.getElementById('orderSuccessSection').style.display = 'block';
  
  const paymentContent = document.getElementById('payment_content');
  
  // Kondisi berdasarkan metode pilihan customer
  if (metode === 'qris') {
    paymentContent.innerHTML = `
      <div style="font-size:40px;margin-bottom:10px;">📱</div>
      <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--cocoa-dark);margin-bottom:12px;">Scan QRIS untuk Membayar</div>
      
      <div style="background:#f7f5f3; padding:15px; border-radius:16px; display:inline-block; margin-bottom:14px; border:1px solid #e8ddd5;">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=GrandStayFood" alt="QRIS Code" style="width:180px; height:180px; display:block;">
      </div>
      
      <p style="font-size:13px;color:var(--text-mid);margin-bottom:20px;">Total: <strong style="color:var(--cocoa-dark); font-size:16px;">${totalHarga}</strong></p>
      <button type="button" onclick="notifikasiSudahBayar()" style="background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));color:#fff;border:none;padding:12px 32px;border-radius:50px;font-size:13px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;width:100%;">Konfirmasi Sudah Bayar</button>
    `;
  } else if (metode === 'bca') {
    paymentContent.innerHTML = `
      <div style="font-size:40px;margin-bottom:10px;">🏦</div>
      <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--cocoa-dark);margin-bottom:12px;">Transfer Bank BCA</div>
      <div style="background:#f7f5f3;padding:16px;border-radius:14px;margin-bottom:14px;text-align:left;font-size:13px;">
        <p style="margin:0 0 6px 0; color:var(--text-muted);">Nomor Rekening:</p>
        <p style="margin:0 0 12px 0; font-size:18px; font-weight:700; color:var(--cocoa-dark); letter-spacing:1px;">123-4567-890</p>
        <p style="margin:0 0 4px 0; color:var(--text-muted);">Atas Nama: <strong style="color:#000;">GrandStay Resto</strong></p>
        <p style="margin:0; color:var(--text-muted);">Total Transfer: <strong style="color:var(--cocoa-dark);">${totalHarga}</strong></p>
      </div>
      <button type="button" onclick="notifikasiSudahBayar()" style="background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));color:#fff;border:none;padding:12px 32px;border-radius:50px;font-size:13px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;width:100%;">Konfirmasi Sudah Transfer</button>
    `;
  } else { 
    // Untuk opsi M-Banking / E-Wallet lainnya
    paymentContent.innerHTML = `
      <div style="font-size:40px;margin-bottom:10px;">💳</div>
      <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--cocoa-dark);margin-bottom:12px;">M-Banking / E-Wallet</div>
      <p style="font-size:13px;color:var(--text-mid);margin-bottom:16px;line-height:1.6;">Silakan lakukan transfer sebesar <strong style="color:var(--cocoa-dark);">${totalHarga}</strong> ke akun E-Wallet merchant resmi kami melalui kasir.</p>
      <button type="button" onclick="notifikasiSudahBayar()" style="background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));color:#fff;border:none;padding:12px 32px;border-radius:50px;font-size:13px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;width:100%;">Konfirmasi Sudah Bayar</button>
    `;
  }
}

function notifikasiSudahBayar() {
  const paymentContent = document.getElementById('payment_content');
  
  // Tahap 1: Tampilkan Status Berhasil Bayar (Ada Loader Berputar Singkat)
  paymentContent.innerHTML = `
    <div style="font-size:56px;margin-bottom:16px;">✅</div>
    <div style="font-family:'Playfair Display',serif;font-size:24px;font-weight:700;color:#2e7d32;margin-bottom:10px;">Pembayaran Sukses!</div>
    <p style="font-size:14px;color:var(--text-mid);line-height:1.7;margin-bottom:20px;">Sistem telah memverifikasi pembayaran Anda.</p>
    <div style="display:flex; justify-content:center;"><div style="border: 3px solid #f3f3f3; border-top: 3px solid var(--cocoa); border-radius: 50%; width: 24px; height: 24px; animation: omSpin 1s linear infinite;"></div></div>
    <style>@keyframes omSpin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }</style>
  `;
  
  // Tahap 2: Otomatis berubah setelah 2 detik ke status pengantaran makanan
  setTimeout(function() {
    paymentContent.innerHTML = `
      <div style="font-size:56px;margin-bottom:16px;">🍽️</div>
      <div style="font-family:'Playfair Display',serif;font-size:24px;font-weight:700;color:var(--cocoa-dark);margin-bottom:10px;">Pesanan Diproses!</div>
      <p style="font-size:14px;color:var(--text-mid);line-height:1.7;margin-bottom:28px;">Terima kasih. Makanan Anda sedang disiapkan dan akan segera diantar ke meja/kamar Anda.</p>
      <button type="button" onclick="closeOrderModal(); kembalikanFormAwal();" style="background:linear-gradient(135deg,var(--cocoa),var(--cocoa-light));color:#fff;border:none;padding:14px 36px;border-radius:50px;font-size:14px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;">Tutup</button>
    `;
  }, 2000); 
}

// Fungsi reset: saat modal ditutup, struktur form kembali normal ke halaman input data
function kembalikanFormAwal() {
  setTimeout(function() {
    document.getElementById('orderFormSection').style.display = 'block';
    document.getElementById('orderSuccessSection').style.display = 'none';
    document.getElementById('payment_content').innerHTML = '';
  }, 400); // delay transisi halus saat animasi modal menutup
}
</script>


<!-- ═══ FASILITAS HOTEL ═══ -->
<section id="fasilitas" class="section" style="background:var(--cocoa-soft);">
  <div class="container">

    <div class="section-header">
      <span class="section-label">Kemewahan & Kenyamanan</span>
      <h2 class="section-title">Fasilitas <em>Hotel</em></h2>
      <div class="section-divider"></div>
    </div>

    <div class="rooms-grid">

      <!-- Kolam Renang -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1572331165267-854da2b10ccc?w=600&q=80" alt="Kolam Renang">
          <span class="room-badge">Pool</span>
        </div>
        <div class="room-body">
          <div class="room-name">Kolam Renang Infinity</div>
          <div class="room-cap">Kolam renang luas dengan view elegan dan suasana tenang untuk relaksasi.</div>
        </div>
      </div>

      <!-- Gym -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600&q=80" alt="Gym">
          <span class="room-badge">Fitness</span>
        </div>
        <div class="room-body">
          <div class="room-name">Fitness Center</div>
          <div class="room-cap">Gym modern dengan alat lengkap untuk menjaga kebugaran tubuh.</div>
        </div>
      </div>

      <!-- Restoran -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80" alt="Restoran">
          <span class="room-badge">Dining</span>
        </div>
        <div class="room-body">
          <div class="room-name">Restoran Premium</div>
          <div class="room-cap">Menyediakan menu internasional dan lokal dengan chef profesional.</div>
        </div>
      </div>

      <!-- Meeting Room -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600&q=80" alt="Meeting Room">
          <span class="room-badge">Business</span>
        </div>
        <div class="room-body">
          <div class="room-name">Meeting Room</div>
          <div class="room-cap">Ruang rapat modern untuk bisnis, seminar, dan event perusahaan.</div>
        </div>
      </div>

      <!-- Parking -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?w=600&q=80" alt="Parkir">
          <span class="room-badge">Parking</span>
        </div>
        <div class="room-body">
          <div class="room-name">Area Parkir Luas</div>
          <div class="room-cap">Keamanan 24 jam dengan area parkir yang luas dan nyaman.</div>
        </div>
      </div>

      <!-- WiFi -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=600&q=80" alt="WiFi">
          <span class="room-badge">WiFi</span>
        </div>
        <div class="room-body">
          <div class="room-name">High-Speed WiFi</div>
          <div class="room-cap">Internet cepat tersedia di seluruh area hotel tanpa batasan.</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ═══ ULASAN ═══ -->
<section id="testimoni" class="section testi-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Ulasan Tamu</span>
      <h2 class="section-title">Yang Mereka <em>Katakan</em></h2>
      <div class="section-divider"></div>
    </div>
    <div class="testi-grid">
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Pelayanan yang luar biasa! Kamar sangat bersih, nyaman, dan view-nya memukau. Pasti akan kembali lagi bersama keluarga.</p><div class="testi-author"><div class="testi-avatar">AS</div><div><div class="testi-name">Ahmad Syahrial</div><div class="testi-meta">Jakarta · Presidential Suite</div></div></div></div>
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Menu restorannya enak banget, terutama Steak Tenderloin-nya. Staff sangat ramah dan profesional. Highly recommended!</p><div class="testi-author"><div class="testi-avatar">RP</div><div><div class="testi-name">Rina Pratiwi</div><div class="testi-meta">Bandung · Suite Room</div></div></div></div>
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Fasilitas lengkap, harga sepadan. Lokasi strategis dan suasana hotelnya sangat mewah. Cocok untuk bulan madu!</p><div class="testi-author"><div class="testi-avatar">BN</div><div><div class="testi-name">Budi & Nana</div><div class="testi-meta">Surabaya · Executive Room</div></div></div></div>
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Check-in sangat mudah, kamarnya beyond expectation. Aroma lilin aromaterapi di seluruh lobi bikin rileks banget.</p><div class="testi-author"><div class="testi-avatar">DS</div><div><div class="testi-name">Diana Sari</div><div class="testi-meta">Yogyakarta · Deluxe Room</div></div></div></div>
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Sistem booking online sangat mudah. Kamar langsung siap saat kami tiba. Breakfast buffet-nya lengkap dan lezat!</p><div class="testi-author"><div class="testi-avatar">HW</div><div><div class="testi-name">Hendra Wijaya</div><div class="testi-meta">Medan · Suite Room</div></div></div></div>
      <div class="testi-card"><div class="testi-quote">"</div><div class="testi-stars">★★★★★</div><p class="testi-text">Pengalaman terbaik sepanjang hidup saya menginap di hotel. Interior sangat artistik, foto di sini instagramable abis!</p><div class="testi-author"><div class="testi-avatar">MF</div><div><div class="testi-name">Maya Fitriani</div><div class="testi-meta">Makassar · Executive Room</div></div></div></div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
<footer id="kontak">
  <div class="container">
    <div class="footer-grid">

      <!-- KOLOM 1: BRAND -->
      <div class="footer-brand">
        <div class="footer-logo">VANTELLA</div>
        <div class="footer-tagline">Hotel & Resort · Luxury Since 2012</div>
        <p>Kami menghadirkan pengalaman menginap yang tak terlupakan dengan sentuhan keanggunan dan kehangatan pelayanan khas Indonesia.</p>
        <div class="footer-social">
          <a href="#" class="social-btn" title="Instagram">IG</a>
          <a href="#" class="social-btn" title="Facebook">FB</a>
          <a href="#" class="social-btn" title="Twitter">X</a>
          <a href="#" class="social-btn" title="YouTube">YT</a>
          <a href="#" class="social-btn" title="TikTok">TK</a>
        </div>
      </div>

      <!-- KOLOM 2: NAVIGASI -->
      <div class="footer-col">
        <h4>Navigasi</h4>
        <ul class="footer-links-col">
          <li><a href="#kamar">Kamar & Suite</a></li>
          <li><a href="#restoran">Restoran</a></li>
          <li><a href="#fasilitas">Fasilitas</a></li>
          <li><a href="#testimoni">Ulasan Tamu</a></li>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">Galeri Foto</a></li>
          <li><a href="#">Karir</a></li>
        </ul>
      </div>

      <!-- KOLOM 3: LAYANAN -->
      <div class="footer-col">
        <h4>Layanan</h4>
        <ul class="footer-links-col">
          <li><a href="<?php echo e(route('customer.new-booking')); ?>">Booking Online</a></li>
          <li><a href="#">Room Service</a></li>
          <li><a href="#">Meeting Room</a></li>
          <li><a href="#">Wedding Package</a></li>
          <li><a href="#">Spa & Wellness</a></li>
          <li><a href="#">Airport Transfer</a></li>
          <li><a href="#">Loyalty Program</a></li>
        </ul>
      </div>

      <!-- KOLOM 4: KONTAK -->
      <div class="footer-col">
        <h4>Hubungi Kami</h4>

        <div class="contact-item">
          <div class="contact-icon">📍</div>
          <div>
            <div class="contact-label">Alamat</div>
            <div class="contact-value">Jl. Sudirman Raya No. 88<br>Jakarta Pusat, DKI Jakarta 10220</div>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">📞</div>
          <div>
            <div class="contact-label">Telepon & WhatsApp</div>
            <div class="contact-value">
              <a href="tel:+62215551234">(021) 555-1234</a><br>
              <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
            </div>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">✉️</div>
          <div>
            <div class="contact-label">Email</div>
            <div class="contact-value">
              <a href="mailto:info@vantellahotel.com">info@vantellahotel.com</a><br>
              <a href="mailto:booking@vantellahotel.com">booking@vantellahotel.com</a>
            </div>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">🕐</div>
          <div>
            <div class="contact-label">Jam Operasional</div>
            <div class="contact-value">
              Check-in: 14.00 WIB<br>
              Check-out: 12.00 WIB<br>
              Front Desk: 24 Jam / 7 Hari
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- BOTTOM BAR -->
  <div class="footer-bottom">
    <p>&copy; 2026 VANTELLA Hotel & Resort. All rights reserved.</p>
    <div class="footer-bottom-links">
      <a href="#">Kebijakan Privasi</a>
      <a href="#">Syarat & Ketentuan</a>
      <a href="#">Cookie Policy</a>
      <a href="#">Peta Situs</a>
    </div>
  </div>
</footer>

<script>
document.querySelectorAll('input[type="date"]').forEach(el=>{
  el.min = new Date().toISOString().split('T')[0];
});
const observer = new IntersectionObserver((entries)=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.style.opacity='1';
      e.target.style.transform='translateY(0)';
    }
  });
},{threshold:.1});
document.querySelectorAll('.room-card,.menu-card,.testi-card,.stat-item,.contact-item').forEach(el=>{
  el.style.opacity='0';
  el.style.transform='translateY(24px)';
  el.style.transition='opacity .6s ease, transform .6s ease';
  observer.observe(el);
});

// ── ORDER MODAL ──
let _omPrice = 0, _omQty = 1;

function fmtRp(n) {
  return 'Rp ' + n.toLocaleString('id-ID');
}

function openOrderModal(title, cat, price, img, desc) {
  _omPrice = price;
  _omQty = 1;
  document.getElementById('om_title').textContent = title;
  document.getElementById('om_cat').textContent = cat;
  document.getElementById('om_price').textContent = fmtRp(price);
  document.getElementById('om_img').src = img;
  document.getElementById('om_desc').textContent = desc;
  document.getElementById('om_qty').textContent = 1;
  document.getElementById('om_total').textContent = fmtRp(price);
  document.getElementById('om_name').value = '';
  document.getElementById('om_room').value = '';
  document.getElementById('om_note').value = '';
  document.getElementById('orderFormSection').style.display = '';
  document.getElementById('orderSuccessSection').style.display = 'none';
  const ov = document.getElementById('orderOverlay');
  ov.style.display = 'flex';
}

function closeOrderModal() {
  document.getElementById('orderOverlay').style.display = 'none';
}

function omQty(d) {
  _omQty = Math.max(1, _omQty + d);
  document.getElementById('om_qty').textContent = _omQty;
  document.getElementById('om_total').textContent = fmtRp(_omPrice * _omQty);
}

function submitOrder() {
  const name = document.getElementById('om_name').value.trim();
  const room = document.getElementById('om_room').value.trim();
  if (!name) { document.getElementById('om_name').focus(); return; }
  if (!room) { document.getElementById('om_room').focus(); return; }
  const title = document.getElementById('om_title').textContent;
  const note = document.getElementById('om_note').value.trim();
  document.getElementById('orderFormSection').style.display = 'none';
  document.getElementById('orderSuccessSection').style.display = 'block';
  document.getElementById('om_success_msg').innerHTML =
    `<strong>${_omQty}x ${title}</strong> untuk <strong>${name}</strong><br>
     No. Kamar / Meja: <strong>${room}</strong><br>
     ${note ? 'Catatan: ' + note + '<br>' : ''}
     Total: <strong>${fmtRp(_omPrice * _omQty)}</strong><br><br>
     Pesanan Anda sedang diproses oleh dapur kami.<br>
     Estimasi waktu: <strong>15–25 menit</strong>`;
}

// Tutup modal jika klik background
document.getElementById('orderOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeOrderModal();
});
</script>
</body>
</html><?php /**PATH /var/www/resources/views/landing/index.blade.php ENDPATH**/ ?>