

<?php $__env->startSection('title', 'Data Payments'); ?>


<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.hotel.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.hotel.payments.index')); ?>" class="nav-link active">
        <i class="bi bi-cash-stack"></i> Input Pembayaran
    </a>
    <a href="<?php echo e(route('kasir.hotel.invoices.index')); ?>" class="nav-link">
        <i class="bi bi-receipt"></i> Invoice
    </a>
    <a href="<?php echo e(route('kasir.hotel.transactions.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> Riwayat Transaksi
    </a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php
    // 💡 SIMULASI HISTORI TRANSAKSI YANG LOGIS DAN REALISTIS
    $paymentsSimulation = [
        (object)[
            'id' => 3001, // No. Kuitansi / Transaksi Kasir
            'booking_id' => 101, // ID Dokumen Pemesanan Kamar
            'amount' => 1200000,
            'payment_status' => 'paid',
            'payment_method' => 'transfer',
            'bank' => 'BCA',
            'created_at' => '10 Jun 2026', 
            'booking' => (object)[
                'guest' => (object)['name' => 'Nila Aprilia'],
                'check_in_date' => '10 Jun 2026',  
                'check_out_date' => '12 Jun 2026', 
                'booking_status' => 'checked_out'  
            ]
        ],
        (object)[
            'id' => 3002,
            'booking_id' => 102,
            'amount' => 1800000,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'bank' => null,
            'created_at' => '11 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Siti Rahma'],
                'check_in_date' => '11 Jun 2026',
                'check_out_date' => '14 Jun 2026',
                'booking_status' => 'checked_out'
            ]
        ],
        (object)[
            'id' => 3003,
            'booking_id' => 105,
            'amount' => 900000,
            'payment_status' => 'paid',
            'payment_method' => 'transfer',
            'bank' => 'Mandiri',
            'created_at' => '15 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Dimas Saputra'],
                'check_in_date' => '15 Jun 2026',
                'check_out_date' => '17 Jun 2026',
                'booking_status' => 'checked_out'
            ]
        ],
        (object)[
            'id' => 3004,
            'booking_id' => 106,
            'amount' => 2400000,
            'payment_status' => 'pending',
            'payment_method' => 'e_wallet',
            'bank' => 'QRIS',
            'created_at' => '19 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Ahmad Fauzi'],
                'check_in_date' => '19 Jun 2026',
                'check_out_date' => '22 Jun 2026',
                'booking_status' => 'checked_in'
            ]
        ]
    ];

    $activePayments = (isset($payments) && $payments->count() > 0) ? $payments : $paymentsSimulation;
?>

<style>
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

    .table thead {
        background: #fdfbf9;
        color: #8b5e3c;
        border-bottom: 2px solid #f3e8dc;
        font-size: 13px;
    }

    .table tbody tr td {
        font-size: 13.5px;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background: #fdfbf9;
    }

    .badge-booking-status {
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .book-checked_out { background-color: #f1f3f5; color: #495057; border: 1px solid #dee2e6; }
    .book-checked_in { background-color: #fff5f5; color: #bc5a5a; border: 1px solid #fcdede; }

    .badge-status {
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid transparent;
        text-transform: uppercase;
    }
    .status-paid { background-color: #f0f7f4; color: #4a7c59; border-color: #d8eae1; }
    .status-pending { background-color: #fefaf0; color: #b58533; border-color: #f7e9cc; }
</style>

<div class="container-fluid px-0">

    <div class="card lux-card">
        <div class="card-header bg-transparent border-0 pt-4 px-4">
            <h4 class="lux-title mb-0"><i class="bi bi-clock-history me-2"></i>Data Riwayat Pembayaran Tamu</h4>
        </div>
        
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 110px;">ID Booking</th>
                            <th style="width: 110px;">No. Kuitansi</th>
                            <th>Nama Tamu</th>
                            <th>Periode Menginap</th>
                            <th>Status Booking</th>
                            <th>Jumlah Bayar</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Transaksi</th>
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

                            
                            <td class="font-monospace text-secondary" style="font-size: 12.5px;">
                                <?php echo e($p->booking->check_in_date ?? '-'); ?> <i class="bi bi-arrow-right mx-1"></i> <?php echo e($p->booking->check_out_date ?? '-'); ?>

                            </td>

                            
                            <td>
                                <?php if(isset($p->booking->booking_status)): ?>
                                    <span class="badge-booking-status book-<?php echo e($p->booking->booking_status); ?>">
                                        <?php echo e(str_replace('_', ' ', $p->booking->booking_status)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            
                            
                            <td><span class="fw-bold text-dark">Rp <?php echo e(number_format($p->amount, 0, ',', '.')); ?></span></td>
                            
                            
                            <td>
                                <span class="text-uppercase small font-monospace bg-light px-2 py-1 border rounded" style="font-size: 11px;">
                                    <?php echo e($p->payment_method); ?> 
                                    <?php if(!empty($p->bank)): ?>
                                        (<?php echo e($p->bank); ?>)
                                    <?php endif; ?>
                                </span>
                            </td>

                            
                            <td>
                                <?php if(strtolower($p->payment_status) == 'paid'): ?>
                                    <span class="badge-status status-paid">
                                        <i class="bi bi-check-circle-fill" style="font-size: 6px;"></i> PAID
                                    </span>
                                <?php else: ?>
                                    <span class="badge-status status-pending">
                                        <i class="bi bi-hourglass-split" style="font-size: 6px;"></i> PENDING
                                    </span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="text-secondary font-monospace">
                                <?php echo e(is_string($p->created_at) ? $p->created_at : $p->created_at->format('d M Y')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Tidak ada data riwayat pembayaran resmi.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(isset($payments) && method_exists($payments, 'links')): ?>
            <div class="mt-3">
                <?php echo e($payments->links()); ?>

            </div>
            <?php endif; ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/payments.blade.php ENDPATH**/ ?>