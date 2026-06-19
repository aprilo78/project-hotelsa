

<?php $__env->startSection('title', 'Riwayat Transaksi'); ?>
<?php $__env->startSection('page-title', 'Riwayat Transaksi'); ?>

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
    <a href="<?php echo e(route('customer.history')); ?>" class="nav-link active">
        <i class="bi bi-clock-history"></i> Transaction History
    </a>
    <a href="<?php echo e(route('customer.profile')); ?>" class="nav-link">
        <i class="bi bi-person"></i> My Profile
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
.card-box{
    background:#fff;
    border-radius:16px;
    border:1px solid #EDE8DC;
    box-shadow:0 6px 20px rgba(0,0,0,0.05);
}

.table-modern th{
    font-size:.72rem;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:#6B7280;
    background:#FAF7F2;
    border:none;
    padding:12px 14px;
}

.table-modern td{
    font-size:.85rem;
    color:#374151;
    padding:12px 14px;
    vertical-align:middle;
    border-bottom:1px solid #F5F1EB;
}

.table-modern tbody tr:last-child td{ border-bottom:none; }

.pay-badge{
    padding:4px 12px;
    border-radius:50px;
    font-size:.7rem;
    font-weight:700;
    display:inline-block;
}

.status-pill{
    padding:4px 12px;
    border-radius:50px;
    font-size:.7rem;
    font-weight:700;
    display:inline-block;
}

.filter-tab{
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
.filter-tab.active{
    background:#C9A84C;
    color:#1A1A2E;
    font-weight:700;
    border-color:#C9A84C;
}
.filter-tab:hover:not(.active){ background:#f5efe6; }
</style>


<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 style="font-family:'Playfair Display',serif;color:#1A1A2E;margin-bottom:2px">
            Riwayat Transaksi
        </h4>
        <p class="text-muted" style="font-size:.83rem;margin:0">
            Semua pembayaran dan aktivitas booking Anda
        </p>
    </div>
</div>


<?php if(session('booking_success')): ?>
<div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
    <i class="bi bi-check-circle-fill fs-5"></i>
    <div>
        <strong>Booking berhasil dilakukan!</strong>
        Pesanan Anda sedang diproses. Silakan lakukan pembayaran sesuai instruksi.
    </div>
</div>
<?php endif; ?>


<?php
    $filterStatus = ['all'=>'Semua','pending'=>'Pending','paid'=>'Lunas','failed'=>'Gagal'];
    $activeFilter = request('payment_status','all');
?>

<div class="mb-4 p-3" style="background:#f5efe6;border-radius:12px;border:1px solid #ede8dc">
    <div class="d-flex gap-2 flex-wrap align-items-center">
        <span class="text-muted" style="font-size:.8rem;font-weight:600">Filter:</span>
        <?php $__currentLoopData = $filterStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(request()->fullUrlWithQuery(['payment_status'=>$val])); ?>"
           class="filter-tab <?php echo e($activeFilter === $val ? 'active' : ''); ?>">
            <?php echo e($lbl); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="card-box">

<?php
    $histories = $histories ?? collect();
?>

<?php if($histories->isEmpty()): ?>

    
    <div class="text-center py-5 px-3">
        <i class="bi bi-receipt fs-2 text-muted d-block mb-3 opacity-50"></i>

        <h6 style="font-weight:700;color:#1A1A2E">
            Belum ada transaksi
        </h6>

        <p class="text-muted" style="font-size:.85rem">
            <?php if($activeFilter !== 'all'): ?>
                Tidak ada transaksi dengan status "<?php echo e($filterStatus[$activeFilter] ?? $activeFilter); ?>"
            <?php else: ?>
                Anda belum melakukan booking atau pembayaran
            <?php endif; ?>
        </p>

        <a href="<?php echo e(route('customer.new-booking')); ?>"
           class="btn mt-2"
           style="background:#C9A84C;color:#1A1A2E;font-weight:600;border-radius:8px;padding:8px 20px">
            Booking Sekarang
        </a>
    </div>

<?php else: ?>

    <div class="table-responsive">
        <table class="table table-modern mb-0">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Booking</th>
                    <th>Kamar</th>
                    <th>Check-in / Out</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="fw-semibold" style="color:#1A1A2E;font-size:.82rem">
                        <?php echo e($item->code ?? '#' . $item->id); ?>

                    </td>

                    <td style="white-space:nowrap">
                        <div><?php echo e($item->created_at ? $item->created_at->format('d M Y') : '-'); ?></div>
                        <small class="text-muted"><?php echo e($item->created_at ? $item->created_at->format('H:i') : ''); ?></small>
                    </td>

                    <td>
                        <a href="<?php echo e(route('customer.booking-detail', $item->booking_id ?? $item->id)); ?>"
                           style="color:#C9A84C;text-decoration:none;font-weight:600">
                            #<?php echo e($item->booking_id ?? $item->id); ?>

                        </a>
                    </td>

                    <td>
                        <?php echo e($item->booking->room->room_number ?? ($item->room->name ?? '-')); ?>

                        <?php if($item->booking->room->roomType->name ?? false): ?>
                        <small class="text-muted d-block">
                            <?php echo e($item->booking->room->roomType->name); ?>

                        </small>
                        <?php endif; ?>
                    </td>

                    <td style="white-space:nowrap;font-size:.8rem">
                        <?php if($item->booking->check_in ?? false): ?>
                        <div><?php echo e($item->booking->check_in->format('d M Y')); ?></div>
                        <div class="text-muted">→ <?php echo e($item->booking->check_out->format('d M Y')); ?></div>
                        <?php else: ?>
                        <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>

                    <td style="color:#C9A84C;font-weight:700;white-space:nowrap">
                        Rp <?php echo e(number_format($item->amount ?? 0, 0, ',', '.')); ?>

                    </td>

                    <td>
                        <span style="font-size:.82rem">
                            <?php echo e(ucfirst($item->payment_method ?? 'Cash')); ?>

                        </span>
                    </td>

                    <td>
                        <?php
                            $ps = $item->payment_status ?? 'pending';
                            $psMap = [
                                'paid'    => ['bg'=>'#D1FAE5','color'=>'#065F46','label'=>'Lunas'],
                                'pending' => ['bg'=>'#FEF3C7','color'=>'#92400E','label'=>'Pending'],
                                'failed'  => ['bg'=>'#FEE2E2','color'=>'#991B1B','label'=>'Gagal'],
                            ];
                            $psc = $psMap[$ps] ?? ['bg'=>'#EEE','color'=>'#333','label'=>ucfirst($ps)];
                        ?>
                        <span class="pay-badge"
                              style="background:<?php echo e($psc['bg']); ?>;color:<?php echo e($psc['color']); ?>">
                            <?php echo e($psc['label']); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <?php if(method_exists($histories, 'links')): ?>
    <div class="px-3 py-3">
        <?php echo e($histories->appends(request()->query())->links()); ?>

    </div>
    <?php endif; ?>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/customer/history.blade.php ENDPATH**/ ?>