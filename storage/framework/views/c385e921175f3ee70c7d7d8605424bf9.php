

<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.restoran.pos')); ?>" class="nav-link">
        <i class="bi bi-cart"></i> POS
    </a>
    <a href="<?php echo e(route('kasir.restoran.orders.index')); ?>" class="nav-link active">
        <i class="bi bi-list-check"></i> Orders
    </a>
    <a href="<?php echo e(route('kasir.restoran.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> History
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* LUXURY PREMIUM THEME INTEGRATION */
    body {
        background-color: #fcfbfa;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .style-heading {
        font-size: 24px;
        font-weight: 700;
        color: #2c2520;
    }

    h3 {
        border-left: 4px solid #a67c52;
        padding-left: 10px;
    }

    /* PREMIUM FILTER CARD */
    .filter-card {
        background: #ffffff;
        border: 1px solid #f2ede7;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(166, 124, 82, 0.04);
    }

    .form-label-luxury {
        font-size: 12px;
        font-weight: 600;
        color: #615243;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-luxury, .form-select-luxury {
        border: 1px solid #e2d9cf;
        border-radius: 8px;
        padding: 10px;
        font-size: 13px;
        color: #4a3f35;
        background-color: #fff;
    }

    .form-control-luxury:focus, .form-select-luxury:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.15);
        outline: none;
    }

    .btn-gold {
        background: #a67c52;
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .btn-gold:hover {
        background: #8b5e3c;
        color: #fff;
    }

    /* LUXURY DATA TABLE */
    .table-container {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(166, 124, 82, 0.04);
        border: 1px solid #f2ede7;
        overflow: hidden;
        margin-top: 20px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .data-table th {
        background: #fcf9f5;
        color: #615243;
        font-weight: 600;
        padding: 16px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #f2ede7;
    }

    .data-table td {
        padding: 16px;
        font-size: 14px;
        color: #4a4a4a;
        border-bottom: 1px solid #f8f5f0;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: #fdfcfb;
    }

    .order-id-badge {
        font-weight: 700;
        color: #a67c52;
    }

    .table-badge-room {
        background: #f5efe6;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        color: #a67c52;
        border: 1px solid #e2d9cf;
    }

    /* STATUS BADGES PREMIUM */
    .status-badge {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-paid {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }
</style>

<div class="container-fluid py-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0 style-heading">Daftar Orders Restoran</h3>
            <small class="text-muted">Kelola & monitor data pesanan masuk tamu kamar / walk-in secara terpadu</small>
        </div>
    </div>

    <div class="card filter-card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label form-label-luxury"><i class="bi bi-calendar3"></i> Filter Tanggal Order</label>
                <input type="date" id="filterTanggal" class="form-control form-control-luxury" onchange="jalankanFilterPesanan()">
            </div>
            <div class="col-md-4">
                <label class="form-label form-label-luxury"><i class="bi bi-shield-check"></i> Filter Status Bayar</label>
                <select id="filterStatus" class="form-select text-capitalize form-select-luxury" onchange="jalankanFilterPesanan()">
                    <option value="all">-- Semua Status Pembayaran --</option>
                    <option value="paid">Paid (Lunas)</option>
                    <option value="pending">Pending (Menunggu)</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <button type="button" class="btn btn-gold w-100" onclick="resetFilterLokal()">
                    <i class="bi bi-arrow-clockwise"></i> Reset Pencarian
                </button>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="data-table" id="ordersTable">
            <thead>
                <tr>
                    <th style="width: 100px;" class="ps-4">ID Order</th>
                    <th>Nama Tamu / Pelanggan</th>
                    <th>Rincian Menu Hidangan</th>
                    <th>Total Tagihan</th>
                    <th>Status</th>
                    <th>Tanggal & Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Menyusun data tiruan order kasir hotel yang detail & rapi untuk langsung ditampilkan di sistem
                    $simulatedOrders = [
                        ['id' => 101, 'guest_name' => 'Bpk. Aryo Seto', 'room' => 'Room 204', 'items' => '1x Nasi Goreng Kampung, 1x Es Kopi Susu Aren', 'total' => 75000, 'status' => 'pending', 'date' => '2026-06-19', 'time' => '11:15'],
                        ['id' => 102, 'guest_name' => 'Ibu Dian Lestari', 'room' => 'Walk-In', 'items' => '2x Mie Ayam Bakso Urat Lux, 2x Es Jeruk Peras', 'total' => 64000, 'status' => 'paid', 'date' => '2026-06-19', 'time' => '10:30'],
                        ['id' => 103, 'guest_name' => 'Mr. Johnathan Smith', 'room' => 'Room 501', 'items' => '1x Kwetiau Goreng Sapi Premium, 1x Hot Matcha Latte', 'total' => 62000, 'status' => 'paid', 'date' => '2026-06-18', 'time' => '19:45'],
                        ['id' => 104, 'guest_name' => 'Keluarga Wijaya', 'room' => 'VIP Lounge', 'items' => '3x Nasi Goreng Kampung, 3x Hot Matcha Latte', 'total' => 177000, 'status' => 'pending', 'date' => '2026-06-18', 'time' => '13:20'],
                        ['id' => 105, 'guest_name' => 'Rian & Amalia', 'room' => 'Walk-In', 'items' => '2x Mie Goreng Jawa Spesial, 2x Es Kopi Susu Aren', 'total' => 108000, 'status' => 'paid', 'date' => '2026-06-17', 'time' => '20:10']
                    ];
                ?>

                <?php $__currentLoopData = $simulatedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="order-row-item" data-tanggal="<?php echo e($o['date']); ?>" data-status="<?php echo e($o['status']); ?>">
                    <td class="ps-4"><span class="order-id-badge">#<?php echo e($o['id']); ?></span></td>
                    <td>
                        <div class="fw-bold text-dark"><?php echo e($o['guest_name']); ?></div>
                        <span class="table-badge-room"><i class="bi bi-door-open"></i> <?php echo e($o['room']); ?></span>
                    </td>
                    <td>
                        <span class="text-muted" style="font-size:13px;"><i class="bi bi-egg-fried"></i> <?php echo e($o['items']); ?></span>
                    </td>
                    <td>
                        <strong style="color: #2c2520;">Rp <?php echo e(number_format($o['total'], 0, ',', '.')); ?></strong>
                    </td>
                    <td>
                        <?php if($o['status'] == 'paid'): ?>
                            <span class="status-badge status-paid">Paid</span>
                        <?php else: ?>
                            <span class="status-badge status-pending">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="text-dark fw-semibold" style="font-size:13px;"><?php echo e(date('d M Y', strtotime($o['date']))); ?></div>
                        <small class="text-muted" style="font-size:11px;"><i class="bi bi-clock"></i> Pukul <?php echo e($o['time']); ?> WIB</small>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
                <tr id="noDataRow" style="display: none;">
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2" style="color:#e2d9cf;"></i>
                        Tidak ada data order hotel yang sesuai dengan kriteria filter pencarian.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    function jalankanFilterPesanan() {
        let inputTanggal = document.getElementById('filterTanggal').value; // format: YYYY-MM-DD
        let selectStatus = document.getElementById('filterStatus').value;
        
        let rows = document.querySelectorAll('.order-row-item');
        let dataDitemukan = false;

        rows.forEach(row => {
            let rowTanggal = row.getAttribute('data-tanggal');
            let rowStatus = row.getAttribute('data-status');
            
            // Logika pencocokan filter tanggal dan status secara bersamaan
            let cocokTanggal = (inputTanggal === "" || rowTanggal === inputTanggal);
            let cocokStatus = (selectStatus === "all" || rowStatus === selectStatus);

            if (cocokTanggal && cocokStatus) {
                row.style.display = "";
                dataDitemukan = true;
            } else {
                row.style.display = "none";
            }
        });

        // Tampilkan notifikasi kosong jika tidak ada baris tabel yang lolos filter
        document.getElementById('noDataRow').style.display = dataDitemukan ? "none" : "";
    }

    function resetFilterLokal() {
        document.getElementById('filterTanggal').value = "";
        document.getElementById('filterStatus').value = "all";
        
        let rows = document.querySelectorAll('.order-row-item');
        rows.forEach(row => {
            row.style.display = "";
        });
        
        document.getElementById('noDataRow').style.display = "none";
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/kasir/restoran/orders.blade.php ENDPATH**/ ?>