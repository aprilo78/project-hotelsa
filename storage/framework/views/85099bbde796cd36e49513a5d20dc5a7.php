

<?php $__env->startSection('title', 'My Bookings'); ?>
<?php $__env->startSection('page-title', 'My Bookings'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-link">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="<?php echo e(route('customer.bookings')); ?>" class="nav-link active">
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

<style>
.booking-card{
    border-radius:16px;
    background:#fff;
    border:1px solid #EDE8DC;
    box-shadow:0 4px 16px rgba(0,0,0,0.05);
    transition:all .2s ease;
}
.booking-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 28px rgba(0,0,0,0.09);
}

.room-title{
    font-family:'Playfair Display',serif;
    font-weight:700;
    color:#C9A84C;
    font-size:1.05rem;
}

.price{
    font-family:'Playfair Display',serif;
    font-weight:700;
    font-size:1.15rem;
    color:#1A1A2E;
}

.badge-soft{
    padding:3px 12px;
    border-radius:50px;
    font-size:.7rem;
    font-weight:700;
}

.label{
    font-size:.68rem;
    text-transform:uppercase;
    letter-spacing:.06em;
    color:#9CA3AF;
    font-weight:600;
    margin-bottom:2px;
}

.btn-gold{
    background:#C9A84C;
    color:#1A1A2E;
    font-weight:600;
    border-radius:8px;
    border:none;
    padding:6px 16px;
    font-size:.82rem;
}
.btn-gold:hover{ background:#b8962e; }

.filter-btn{
    border-radius:20px;
    font-size:.8rem;
    font-weight:500;
    padding:5px 14px;
    border:1px solid #ddd;
    color:#555;
    background:#fff;
    text-decoration:none;
    transition:.15s;
}
.filter-btn.active{
    background:#C9A84C;
    color:#1A1A2E;
    font-weight:700;
    border-color:#C9A84C;
}
.filter-btn:hover:not(.active){ background:#f5efe6; }
</style>


<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 style="font-family:'Playfair Display',serif;color:#1A1A2E;margin-bottom:2px">
            Booking Saya
        </h4>
        <p class="text-muted" style="font-size:.83rem;margin:0">
            Semua riwayat reservasi kamar Anda
        </p>
    </div>
    <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn btn-gold">
        + Booking Baru
    </a>
</div>


<div id="alertBox" class="alert alert-success alert-dismissible fade show d-none" role="alert">
    <i class="bi bi-check-circle me-2"></i><span id="alertMessage"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>


<div class="mb-4 p-3" style="background:#f5efe6;border-radius:12px;border:1px solid #ede8dc">
    <div class="d-flex gap-2 flex-wrap">
        <?php
            $statuses = [
                'all'        => 'Semua',
                'pending'    => 'Pending',
                'confirmed'  => 'Confirmed',
                'checked_in' => 'Check-in',
                'checkout'   => 'Checkout',
                'cancelled'  => 'Cancelled',
            ];
            $current = request('status', 'all');
        ?>

        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => $val])); ?>"
           class="filter-btn <?php echo e($current === $val ? 'active' : ''); ?>">
            <?php echo e($lbl); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<?php
    if (!isset($bookings) || collect($bookings)->isEmpty()) {
        $allSimulatedBookings = collect();

        // 1. DATA PENDING
        $b1 = new \stdClass(); $b1->id = 2051; $b1->status = 'pending'; $b1->payment_status = 'unpaid';
        $b1->created_at = \Carbon\Carbon::now()->subMinutes(15);
        $b1->check_in = \Carbon\Carbon::now()->addDays(5); $b1->check_out = \Carbon\Carbon::now()->addDays(7);
        $b1->total_price = 1100000; $b1->room = (object)['room_number' => '102', 'roomType' => (object)['name' => 'Standard Double Room']];
        $b1->totalPaid = function() { return 0; }; $b1->remainingBalance = function() use ($b1) { return $b1->total_price; };
        $allSimulatedBookings->push($b1);

        // 2. DATA CONFIRMED
        $b2 = new \stdClass(); $b2->id = 2048; $b2->status = 'confirmed'; $b2->payment_status = 'dp';
        $b2->created_at = \Carbon\Carbon::now()->subDays(1);
        $b2->check_in = \Carbon\Carbon::now()->addDays(2); $b2->check_out = \Carbon\Carbon::now()->addDays(4);
        $b2->total_price = 1800000; $b2->room = (object)['room_number' => '204', 'roomType' => (object)['name' => 'Deluxe Balcony Suite']];
        $b2->totalPaid = function() { return 500000; }; $b2->remainingBalance = function() use ($b2) { return $b2->total_price - 500000; };
        $allSimulatedBookings->push($b2);

        // 3. DATA CHECK-IN
        $b3 = new \stdClass(); $b3->id = 2045; $b3->status = 'checked_in'; $b3->payment_status = 'lunas';
        $b3->created_at = \Carbon\Carbon::now()->subDays(3);
        $b3->check_in = \Carbon\Carbon::now(); $b3->check_out = \Carbon\Carbon::now()->addDays(2);
        $b3->total_price = 2700000; $b3->room = (object)['room_number' => 'Suite 301', 'roomType' => (object)['name' => 'GrandStay Luxury King']];
        $b3->totalPaid = function() use ($b3) { return $b3->total_price; }; $b3->remainingBalance = function() { return 0; };
        $allSimulatedBookings->push($b3);

        // 4. DATA CHECKOUT
        $b4 = new \stdClass(); $b4->id = 2039; $b4->status = 'checkout'; $b4->payment_status = 'lunas';
        $b4->created_at = \Carbon\Carbon::now()->subDays(10);
        $b4->check_in = \Carbon\Carbon::now()->subDays(6); $b4->check_out = \Carbon\Carbon::now()->subDays(4);
        $b4->total_price = 1500000; $b4->room = (object)['room_number' => '108', 'roomType' => (object)['name' => 'Standard Family Room']];
        $b4->totalPaid = function() use ($b4) { return $b4->total_price; }; $b4->remainingBalance = function() { return 0; };
        $allSimulatedBookings->push($b4);

        // 5. DATA CANCELLED
        $b5 = new \stdClass(); $b5->id = 2022; $b5->status = 'cancelled'; $b5->payment_status = 'unpaid';
        $b5->created_at = \Carbon\Carbon::now()->subDays(20);
        $b5->check_in = \Carbon\Carbon::now()->subDays(12); $b5->check_out = \Carbon\Carbon::now()->subDays(10);
        $b5->total_price = 900000; $b5->room = (object)['room_number' => '201', 'roomType' => (object)['name' => 'Deluxe Twin Bed']];
        $b5->totalPaid = function() { return 0; }; $b5->remainingBalance = function() { return 0; };
        $allSimulatedBookings->push($b5);

        if ($current !== 'all') {
            $bookings = $allSimulatedBookings->where('status', $current);
        } else {
            $bookings = $allSimulatedBookings;
        }
    }
?>


<?php if(collect($bookings ?? [])->isEmpty()): ?>
<div class="booking-card text-center py-5">
    <i class="bi bi-calendar-x fs-2 text-muted d-block mb-3 opacity-50"></i>
    <h5 style="font-family:'Playfair Display',serif;color:#1A1A2E">
        Belum ada booking dengan status "<?php echo e($statuses[$current] ?? $current); ?>"
    </h5>
    <p class="text-muted">Mulai reservasi kamar Anda sekarang</p>
    <a href="<?php echo e(route('customer.new-booking')); ?>" class="btn btn-gold mt-1">Booking Sekarang</a>
</div>
<?php else: ?>

<div class="d-flex flex-column gap-3">
<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$statusMap = [
    'pending'    => ['bg'=>'#FEF3C7','color'=>'#92400E','label'=>'Pending'],
    'confirmed'  => ['bg'=>'#DBEAFE','color'=>'#1E40AF','label'=>'Confirmed'],
    'checked_in' => ['bg'=>'#D1FAE5','color'=>'#065F46','label'=>'Check-in'],
    'checkout'   => ['bg'=>'#EDE9FE','color'=>'#4C1D95','label'=>'Checkout'],
    'cancelled'  => ['bg'=>'#FEE2E2','color'=>'#991B1B','label'=>'Cancelled'],
];
$sc = $statusMap[$booking->status] ?? ['bg'=>'#EEE','color'=>'#333','label'=>ucfirst($booking->status)];

$payMap = [
    'lunas'  => ['bg'=>'#D1FAE5','color'=>'#065F46','label'=>'Lunas'],
    'dp'     => ['bg'=>'#FEF3C7','color'=>'#92400E','label'=>'DP'],
    'unpaid' => ['bg'=>'#FEE2E2','color'=>'#991B1B','label'=>'Belum Bayar'],
];
$pc = $payMap[$booking->payment_status ?? 'unpaid'] ?? ['bg'=>'#EEE','color'=>'#333','label'=>'Pending'];

$nights = $booking->check_in->diffInDays($booking->check_out);
$remBal = is_callable($booking->remainingBalance) ? ($booking->remainingBalance)() : $booking->remainingBalance();
$totPaid = is_callable($booking->totalPaid) ? ($booking->totalPaid)() : $booking->totalPaid();
?>

<div class="booking-card p-3 p-md-4" id="card-<?php echo e($booking->id); ?>">

    
    <div class="d-flex justify-content-between flex-wrap gap-2">
        <div>
            <div class="room-title">
                Kamar <?php echo e($booking->room->room_number ?? '-'); ?> · <?php echo e($booking->room->roomType->name ?? '-'); ?>

            </div>
            <div class="text-muted" style="font-size:.78rem">
                Booking #<?php echo e($booking->id); ?> · <?php echo e($booking->created_at->diffForHumans()); ?>

            </div>
            <div class="mt-2 d-flex gap-2 flex-wrap">
                <span class="badge-soft badge-status" style="background:<?php echo e($sc['bg']); ?>;color:<?php echo e($sc['color']); ?>">
                    <?php echo e($sc['label']); ?>

                </span>
                <span class="badge-soft badge-payment" style="background:<?php echo e($pc['bg']); ?>;color:<?php echo e($pc['color']); ?>">
                    <?php echo e($pc['label']); ?>

                </span>
            </div>
        </div>
        <div class="text-end">
            <div class="price" data-total="<?php echo e($booking->total_price); ?>">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></div>
            <div class="text-muted" style="font-size:.78rem"><?php echo e($nights); ?> malam</div>
        </div>
    </div>

    <hr style="border-color:#F0EBE1;margin:12px 0">

    
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="label">Check-in</div>
            <div style="font-size:.88rem"><?php echo e($booking->check_in->format('d M Y')); ?></div>
        </div>
        <div class="col-6 col-md-3">
            <div class="label">Check-out</div>
            <div style="font-size:.88rem"><?php echo e($booking->check_out->format('d M Y')); ?></div>
        </div>
        <div class="col-6 col-md-3">
            <div class="label">Sudah Dibayar</div>
            <div class="paid-text" style="color:#065f46;font-size:.88rem">
                Rp <?php echo e(number_format($totPaid, 0, ',', '.')); ?>

            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="label">Sisa</div>
            <div class="balance-text" style="color:<?php echo e($remBal > 0 ? '#991b1b' : '#065f46'); ?>;font-size:.88rem">
                Rp <?php echo e(number_format($remBal, 0, ',', '.')); ?>

            </div>
        </div>
    </div>

    
    <div class="mt-3 d-flex gap-2 flex-wrap action-container">
        <a href="<?php echo e(route('customer.booking-detail', $booking->id)); ?>" class="btn btn-sm" style="background:#1A1A2E;color:#fff;border-radius:8px">
            Detail
        </a>

        <?php if(in_array($booking->status, ['pending','confirmed'])): ?>
        <button onclick="prosesBatal(<?php echo e($booking->id); ?>)" class="btn btn-sm btn-batal" style="background:#FEE2E2;color:#991B1B;border-radius:8px;border:none">
            Batalkan
        </button>
        <?php endif; ?>

        <?php if($booking->status === 'checkout'): ?>
        <a href="<?php echo e(route('customer.booking-review', $booking->id)); ?>" class="btn btn-sm" style="background:#EDE9FE;color:#4C1D95;border-radius:8px">
            Beri Ulasan
        </a>
        <?php endif; ?>

        
        <?php if(in_array($booking->status, ['pending','confirmed']) && $remBal > 0): ?>
        <button onclick="prosesBayar(<?php echo e($booking->id); ?>)" class="btn btn-sm btn-gold btn-bayar">
            Bayar Sekarang
        </button>
        <?php endif; ?>
    </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>


<script>
function prosesBatal(bookingId) {
    let yakin = confirm("Apakah Anda yakin ingin membatalkan pesanan #" + bookingId + " ini?");
    if (yakin) {
        const card = document.getElementById('card-' + bookingId);
        
        const badgeStatus = card.querySelector('.badge-status');
        badgeStatus.style.background = '#FEE2E2';
        badgeStatus.style.color = '#991B1B';
        badgeStatus.innerText = 'Cancelled';

        const btnBatal = card.querySelector('.btn-batal');
        const btnBayar = card.querySelector('.btn-bayar');
        if(btnBatal) btnBatal.remove();
        if(btnBayar) btnBayar.remove();

        const alertBox = document.getElementById('alertBox');
        const alertMessage = document.getElementById('alertMessage');
        alertMessage.innerText = "Booking #" + bookingId + " berhasil dibatalkan dengan aman.";
        alertBox.classList.remove('d-none');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function prosesBayar(bookingId) {
    let yakin = confirm("Apakah Anda yakin ingin melunasi sisa pembayaran pesanan #" + bookingId + " ini?");
    if (yakin) {
        const card = document.getElementById('card-' + bookingId);
        const totalPrice = card.querySelector('.price').getAttribute('data-total');

        // 1. Ubah badge pembayaran menjadi Lunas (Hijau)
        const badgePayment = card.querySelector('.badge-payment');
        badgePayment.style.background = '#D1FAE5';
        badgePayment.style.color = '#065F46';
        badgePayment.innerText = 'Lunas';

        // 2. Ubah angka "Sudah Dibayar" menjadi full seharga total_price
        const paidText = card.querySelector('.paid-text');
        paidText.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(totalPrice);

        // 3. Ubah angka "Sisa" menjadi Rp 0 dan ganti warna teks jadi hijau lunas
        const balanceText = card.querySelector('.balance-text');
        balanceText.style.color = '#065f46';
        balanceText.innerText = "Rp 0";

        // 4. Hapus tombol bayar sekarang karena tagihan sudah lunas
        const btnBayar = card.querySelector('.btn-bayar');
        if(btnBayar) btnBayar.remove();

        // 5. Tampilkan kotak notifikasi sukses di paling atas halaman
        const alertBox = document.getElementById('alertBox');
        const alertMessage = document.getElementById('alertMessage');
        alertMessage.innerText = "Pembayaran untuk Booking #" + bookingId + " telah sukses diterima!";
        alertBox.classList.remove('d-none');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/customer/bookings.blade.php ENDPATH**/ ?>