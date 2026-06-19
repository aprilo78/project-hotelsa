

<?php $__env->startSection('title', 'Riwayat Transaksi'); ?>


<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.hotel.dashboard')); ?>"
       class="nav-link <?php echo e(request()->routeIs('kasir.hotel.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.hotel.payments.index')); ?>"
       class="nav-link <?php echo e(request()->routeIs('kasir.hotel.payments.*') ? 'active' : ''); ?>">
        <i class="bi bi-cash-stack"></i> Input Pembayaran
    </a>
    <a href="<?php echo e(route('kasir.hotel.invoices.index')); ?>"
       class="nav-link <?php echo e(request()->routeIs('kasir.hotel.invoices.*') ? 'active' : ''); ?>">
        <i class="bi bi-receipt"></i> Invoice
    </a>
    <a href="<?php echo e(route('kasir.hotel.transactions.history')); ?>"
       class="nav-link active">
        <i class="bi bi-clock-history"></i> Riwayat Transaksi
    </a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php
    // 1. MASTER DATA SIMULASI SEPANJANG BULAN JUNI 2026
    $masterPayments = [
        (object)[
            'id' => 3001, 'booking_id' => 101, 'amount' => 1200000, 'created_at' => '2026-06-10', 'display_date' => '10 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Nila Aprilia']], 'kasir' => (object)['name' => 'Putri Ayu']
        ],
        (object)[
            'id' => 3002, 'booking_id' => 102, 'amount' => 1800000, 'created_at' => '2026-06-11', 'display_date' => '11 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Siti Rahma']], 'kasir' => (object)['name' => 'Rian Hidayat']
        ],
        (object)[
            'id' => 3003, 'booking_id' => 105, 'amount' => 900000, 'created_at' => '2026-06-15', 'display_date' => '15 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Dimas Saputra']], 'kasir' => (object)['name' => 'Putri Ayu']
        ],
        // ── Data di rentang tanggal 19 - 22 Juni ──
        (object)[
            'id' => 3004, 'booking_id' => 106, 'amount' => 2400000, 'created_at' => '2026-06-19', 'display_date' => '19 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Ahmad Fauzi']], 'kasir' => (object)['name' => 'Rian Hidayat']
        ],
        (object)[
            'id' => 3005, 'booking_id' => 107, 'amount' => 1500000, 'created_at' => '2026-06-20', 'display_date' => '20 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Budi Santoso']], 'kasir' => (object)['name' => 'Putri Ayu']
        ],
        (object)[
            'id' => 3006, 'booking_id' => 108, 'amount' => 3100000, 'created_at' => '2026-06-22', 'display_date' => '22 Jun 2026',
            'booking' => (object)['guest' => (object)['name' => 'Clara Shinta']], 'kasir' => (object)['name' => 'Rian Hidayat']
        ],
    ];

    // 2. PROSES FILTER DATA SECARA REAL-TIME JIKA INPUT DARI/SAMPAI DIISI
    $fromDate = request('from');
    $toDate = request('to');
    
    $filteredPayments = [];
    $calculatedTotal = 0;

    foreach ($masterPayments as $p) {
        $passFilter = true;
        
        if (!empty($fromDate) && $p->created_at < $fromDate) {
            $passFilter = false;
        }
        if (!empty($toDate) && $p->created_at > $toDate) {
            $passFilter = false;
        }

        if ($passFilter) {
            $filteredPayments[] = $p;
            $calculatedTotal += $p->amount; // Hanya menjumlahkan yang lolos filter!
        }
    }

    // Sambungan jika controller asli mengirim data resmi
    $activePayments = (isset($payments) && $payments->count() > 0) ? $payments : $filteredPayments;
    $finalTotal = (isset($payments) && $payments->count() > 0) ? $total : $calculatedTotal;
?>

<style>
    /* 🎨 LUX COFFEE GRANDSTAY THEME STYLE */
    .lux-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.04);
        background: #fff;
    }

    .lux-title {
        color: #8b5e3c;
        font-weight: 600;
    }

    .btn-lux {
        background-color: #8b5e3c;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-lux:hover {
        background-color: #6f4a2f;
        color: #fff;
    }

    .alert-lux-revenue {
        background-color: #fdfbf9;
        border: 1px solid #f3e8dc;
        border-left: 5px solid #8b5e3c;
        color: #5c3e27;
        border-radius: 12px;
    }

    .table th {
        background: #fdfbf9 !important;
        color: #8b5e3c;
        border-bottom: 2px solid #f3e8dc !important;
        font-size: 13px;
    }

    .table td {
        font-size: 13.5px;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background: #fdfbf9;
    }
</style>

<div class="container-fluid px-0">

    <h4 class="lux-title mb-4"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi Keuangan</h4>

    
    <div class="card lux-card mb-4">
        <div class="card-body p-4">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary">Dari Tanggal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" name="from" class="form-control bg-light border-start-0 ps-0" value="<?php echo e(request('from')); ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary">Sampai Tanggal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" name="to" class="form-control bg-light border-start-0 ps-0" value="<?php echo e(request('to')); ?>">
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="w-100 d-flex gap-2">
                            <button type="submit" class="btn btn-lux w-100">
                                <i class="bi bi-search me-1"></i> Jalankan Filter
                            </button>
                            <?php if(request('from') || request('to')): ?>
                                <a href="<?php echo e(route('kasir.hotel.transactions.history')); ?>" class="btn btn-light border px-3" title="Reset Filter">
                                    <i class="bi bi-arrow-counterclockwise text-secondary"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="alert alert-lux-revenue p-3 mb-4 d-flex align-items-center justify-content-between shadow-sm">
        <div>
            <i class="bi bi-wallet2 me-2 font-size-lg"></i> 
            <span>Total Pemasukan Kasir <strong><?php echo e(request('from') ? '(Periode Terpilih)' : '(Seluruh Periode)'); ?></strong> :</span>
        </div>
        <h3 class="mb-0 fw-bold font-monospace" style="color: #8b5e3c;">
            Rp <?php echo e(number_format($finalTotal, 0, ',', '.')); ?>

        </h3>
    </div>

    
    <div class="card lux-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 130px;">ID Booking</th>
                            <th style="width: 140px;">No. Kuitansi</th>
                            <th>Nama Customer (Guest)</th>
                            <th>Nama Petugas Kasir</th>
                            <th>Jumlah Transaksi</th>
                            <th>Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $activePayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace" style="font-size: 11.5px; border-radius: 6px;">
                                    BK-<?php echo e($p->booking_id); ?>

                                </span>
                            </td>

                            
                            <td><span class="text-muted font-monospace fw-medium">#PAY-<?php echo e($p->id); ?></span></td>
                            
                            
                            <td><strong><?php echo e($p->booking->guest->name ?? '-'); ?></strong></td>
                            
                            
                            <td>
                                <span class="text-secondary"><i class="bi bi-person-badge me-1"></i><?php echo e($p->kasir->name ?? '-'); ?></span>
                            </td>
                            
                            
                            <td>
                                <span class="fw-bold text-success">
                                    Rp <?php echo e(number_format($p->amount, 0, ',', '.')); ?>

                                </span>
                            </td>

                            
                            <td class="text-secondary font-monospace">
                                <?php echo e(is_string($p->created_at) ? $p->display_date : $p->created_at->format('d M Y')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-clipboard-x d-block display-6 mb-2 text-light"></i>
                                Tidak ditemukan riwayat transaksi pada rentang tanggal tersebut.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(isset($payments) && method_exists($payments, 'links')): ?>
            <div class="p-3">
                <?php echo e($payments->links()); ?>

            </div>
            <?php endif; ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/kasir/hotel/history.blade.php ENDPATH**/ ?>