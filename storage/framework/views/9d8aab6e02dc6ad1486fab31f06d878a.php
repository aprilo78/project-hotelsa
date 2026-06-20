<?php $__env->startSection('title', 'Customer Dashboard'); ?>
<?php $__env->startSection('page-title', 'My Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
:root{
  --brown:#8B6B4A;
  --brown-soft:#C8A27A;
  --cream:#F5EFE6;
  --gold:#C9A84C;
}

body{
  background:linear-gradient(135deg,#f5efe6,#e8dcc8);
  font-family:'Inter',sans-serif;
}

.card{
  border:none;
  border-radius:18px;
  background:#fffaf5;
  box-shadow:0 15px 40px rgba(0,0,0,0.08);
  transition:.3s;
}

.card:hover{
  transform:translateY(-4px);
}

.card-header{
  background:transparent;
  border-bottom:1px solid #f0e6dc;
  font-weight:600;
  color:var(--brown);
  padding:16px 20px;
}

.card-stats{
  background:linear-gradient(135deg,#fffaf5,#f3e6d6);
  border-left:5px solid var(--brown-soft);
}

.card-stats h6{ color:#7a6f60; font-size:.8rem; text-transform:uppercase; letter-spacing:.05em; }
.card-stats h3{ color:var(--brown); font-weight:700; margin:4px 0 0; }
.card-stats i{ color:var(--brown-soft) !important; }

.table thead{ background:#f3e6d6; color:var(--brown); }
.table tbody tr:hover{ background:#faf3ea; }

.status-badge{
  padding:4px 12px;
  border-radius:20px;
  font-size:.72rem;
  font-weight:700;
}
.status-pending{ background:#fff3cd; color:#856404; }
.status-confirmed{ background:#d4edda; color:#155724; }
.status-cancelled{ background:#f8d7da; color:#721c24; }
.status-checked_in{ background:#cfe2ff; color:#084298; }
.status-checkout{ background:#e2d9f3; color:#432874; }

.btn-brown{
  background:linear-gradient(135deg,#C8A27A,#8B6B4A);
  border:none;
  color:#fff;
  border-radius:8px;
  font-size:.85rem;
}
.btn-brown:hover{ background:linear-gradient(135deg,#b8906a,#7a5a3a); color:#fff; }

.btn-gold{
  background:#C9A84C;
  color:#1A1A2E;
  border:none;
  border-radius:8px;
  font-weight:600;
  font-size:.85rem;
}
.btn-gold:hover{ background:#b8962e; color:#1A1A2E; }

.form-control{
  border-radius:10px;
  border:1px solid #e0d6c8;
  background:#fffaf5;
}
.form-control:focus{
  border-color:var(--brown-soft);
  box-shadow:0 0 0 3px rgba(200,162,122,.15);
}

.nav-link{ color:#6b5e4f; border-radius:10px; margin-bottom:5px; }
.nav-link:hover{ background:#f3e6d6; }
.nav-link.active{ background:linear-gradient(135deg,#C8A27A,#8B6B4A); color:#fff !important; }

/* ROOM CARD SEARCH RESULT */
.room-result-card{
  border-radius:14px;
  border:1px solid #ede8dc;
  background:#fff;
  transition:.2s;
}
.room-result-card:hover{
  box-shadow:0 10px 25px rgba(0,0,0,0.09);
  transform:translateY(-2px);
}

#searchResults{ display:none; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('sidebar'); ?>
<a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-link active">
    <i class="bi bi-house"></i> Dashboard
</a>
<a href="<?php echo e(route('customer.bookings')); ?>" class="nav-link">
    <i class="bi bi-calendar-check"></i> My Bookings
</a>
<a href="<?php echo e(route('customer.new-booking')); ?>" class="nav-link">
    <i class="bi bi-plus-circle"></i> New Booking
</a>
<a href="<?php echo e(route('customer.history')); ?>" class="nav-link">
    <i class="bi bi-clock-history"></i> Transaction History
</a>
<a href="<?php echo e(route('customer.profile')); ?>" class="nav-link">
    <i class="bi bi-person"></i> My Profile
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php
    $totalBookings = $totalBookings ?? 12; 
    $upcomingBookings = $upcomingBookings ?? 2;
    $totalSpent = $totalSpent ?? 8450000;

    if (!isset($recentBookings) || count($recentBookings) === 0) {
        $dummy1 = new \stdClass();
        $dummy1->id = 1024;
        $dummy1->check_in = date('Y-m-d');
        $dummy1->check_out = date('Y-m-d', strtotime('+3 days'));
        $dummy1->status = 'checked_in';
        $dummy1->room = new \stdClass();
        $dummy1->room->room_number = 'Suite 302';
        $dummy1->room->roomType = new \stdClass();
        $dummy1->room->roomType->name = 'Luxury King Suite';

        $dummy2 = new \stdClass();
        $dummy2->id = 1023;
        $dummy2->check_in = date('Y-m-d', strtotime('-2 days'));
        $dummy2->check_out = date('Y-m-d');
        $dummy2->status = 'checkout';
        $dummy2->room = new \stdClass();
        $dummy2->room->room_number = 'Deluxe 105';
        $dummy2->room->roomType = new \stdClass();
        $dummy2->room->roomType->name = 'Deluxe Double Room';

        $dummy3 = new \stdClass();
        $dummy3->id = 1025;
        $dummy3->check_in = date('Y-m-d', strtotime('+5 days'));
        $dummy3->check_out = date('Y-m-d', strtotime('+7 days'));
        $dummy3->status = 'confirmed';
        $dummy3->room = new \stdClass();
        $dummy3->room->room_number = 'Executive 201';
        $dummy3->room->roomType = new \stdClass();
        $dummy3->room->roomType->name = 'Executive Club';

        $recentBookings = [$dummy1, $dummy2, $dummy3];
    }
?>


<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card card-stats h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Bookings</h6>
                    <h3><?php echo e($totalBookings); ?></h3>
                </div>
                <i class="bi bi-calendar-check fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card card-stats h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Upcoming Stays</h6>
                    <h3><?php echo e($upcomingBookings); ?></h3>
                </div>
                <i class="bi bi-calendar-heart fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card card-stats h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Spent</h6>
                    <h3>Rp <?php echo e(number_format($totalSpent, 0, ',', '.')); ?></h3>
                </div>
                <i class="bi bi-wallet2 fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span>Booking Terbaru</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Kamar</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th class="pe-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3">#<?php echo e($booking->id); ?></td>
                            <td>
                                <?php echo e($booking->room->room_number ?? '-'); ?>

                                <small class="text-muted d-block"><?php echo e($booking->room->roomType->name ?? ''); ?></small>
                            </td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d M Y')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d M Y')); ?></td>
                            <td class="pe-3">
                                <span class="status-badge status-<?php echo e($booking->status); ?>">
                                    <?php echo e(ucfirst(str_replace('_',' ',$booking->status))); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color:#8B6B4A;">
                                <i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-50"></i>
                                Belum ada booking
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-search me-2"></i>Cari Kamar Tersedia
            </div>
            <div class="card-body">

                <div id="searchError" class="alert alert-warning d-none py-2 small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    <span id="searchErrorMsg"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Tanggal Check-in</label>
                    <input type="date" id="dashCheckIn" class="form-control" min="<?php echo e(date('Y-m-d')); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Tanggal Check-out</label>
                    <input type="date" id="dashCheckOut" class="form-control" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Jumlah Tamu</label>
                    <input type="number" id="dashGuests" class="form-control" value="1" min="1" max="10">
                </div>

                <button onclick="searchRooms()" class="btn btn-gold w-100">
                    <i class="bi bi-search me-1"></i> Cari Kamar
                </button>

            </div>
        </div>
    </div>

</div>


<div id="searchResults" class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 style="font-family:'Playfair Display',serif;color:#1A1A2E;margin:0">
            Kamar Tersedia
        </h6>
        <span id="resultCount" class="badge" style="background:#f3e6d6;color:#8B6B4A;font-size:.8rem"></span>
    </div>

    <div id="roomList" class="row g-3"></div>
</div>

<script>
function searchRooms() {
    const checkIn  = document.getElementById('dashCheckIn').value;
    const checkOut = document.getElementById('dashCheckOut').value;
    const guests   = document.getElementById('dashGuests').value;
    const errBox   = document.getElementById('searchError');
    const errMsg   = document.getElementById('searchErrorMsg');

    errBox.classList.add('d-none');

    if (!checkIn || !checkOut) {
        errMsg.textContent = 'Pilih tanggal check-in dan check-out terlebih dahulu.';
        errBox.classList.remove('d-none');
        return;
    }

    if (checkOut <= checkIn) {
        errMsg.textContent = 'Tanggal check-out harus setelah check-in.';
        errBox.classList.remove('d-none');
        return;
    }

    const btn = event.currentTarget;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Mencari...';
    btn.disabled = true;

    const url = `<?php echo e(route('customer.search-rooms')); ?>?check_in=${checkIn}&check_out=${checkOut}&guests=${guests}&ajax=1`;

    fetch(url, { headers:{ 'X-Requested-With':'XMLHttpRequest' } })
        .then(r => r.json())
        .then(data => {
            renderRooms(data.rooms ?? [], checkIn, checkOut, guests);
        })
        .catch(() => {
            /* Fallback: redirect to full search page */
            window.location.href = `<?php echo e(route('customer.search-rooms')); ?>?check_in=${checkIn}&check_out=${checkOut}&guests=${guests}`;
        })
        .finally(() => {
            btn.innerHTML = '<i class="bi bi-search me-1"></i> Cari Kamar';
            btn.disabled = false;
        });
}

function renderRooms(rooms, checkIn, checkOut, guests) {
    const results = document.getElementById('searchResults');
    const list    = document.getElementById('roomList');
    const count   = document.getElementById('resultCount');

    results.style.display = 'block';
    count.textContent = rooms.length + ' kamar ditemukan';

    if (rooms.length === 0) {
        list.innerHTML = `
          <div class="col-12">
            <div class="text-center py-5" style="background:#fffaf5;border-radius:14px;border:1px solid #ede8dc">
              <i class="bi bi-door-closed fs-2 text-muted d-block mb-2"></i>
              <strong style="color:#1A1A2E">Tidak ada kamar tersedia</strong>
              <p class="text-muted small mt-1 mb-0">Coba tanggal lain atau kurangi jumlah tamu.</p>
            </div>
          </div>`;
        return;
    }

    const nights = Math.max(1, Math.round((new Date(checkOut) - new Date(checkIn)) / 86400000));

    list.innerHTML = rooms.map(r => {
        const total = (r.price * nights).toLocaleString('id-ID');
        return `
        <div class="col-md-6">
          <div class="room-result-card p-3">
            <div class="fw-semibold" style="color:#1A1A2E">${r.name}</div>
            <small class="text-muted">${r.type ?? ''} · Kapasitas ${r.capacity ?? 2} orang</small>
            <div class="my-2" style="color:#C9A84C;font-weight:700;font-size:1rem">
              Rp ${Number(r.price).toLocaleString('id-ID')}
              <small style="color:#888;font-weight:400">/malam</small>
            </div>
            <div class="text-muted small mb-3">${nights} malam = Rp ${total}</div>
            <a href="<?php echo e(route('customer.new-booking')); ?>?room_id=${r.id}&check_in=${checkIn}&check_out=${checkOut}&guests=${guests}"
               class="btn btn-gold btn-sm w-100">
               Pilih Kamar
            </a>
          </div>
        </div>`;
    }).join('');
}

/* Auto-update check-out min date */
document.getElementById('dashCheckIn').addEventListener('change', function(){
    const next = new Date(this.value);
    next.setDate(next.getDate() + 1);
    document.getElementById('dashCheckOut').min = next.toISOString().split('T')[0];
    if (document.getElementById('dashCheckOut').value <= this.value) {
        document.getElementById('dashCheckOut').value = next.toISOString().split('T')[0];
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/customer/dashboard.blade.php ENDPATH**/ ?>