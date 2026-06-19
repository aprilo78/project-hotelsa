
<?php $__env->startSection('title','Dashboard Kasir Restoran'); ?>
<?php $__env->startSection('page-title','Dashboard Kasir Restoran'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.restoran.pos')); ?>" class="nav-link">
        <i class="bi bi-cart"></i> POS
    </a>
    <a href="<?php echo e(route('kasir.restoran.orders.index')); ?>" class="nav-link">
        <i class="bi bi-list-check"></i> Orders
    </a>
    <a href="<?php echo e(route('kasir.restoran.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> History
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
    .dashboard-container {
        padding: 20px;
        background-color: #fcfbfa;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .dashboard-title {
        font-size: 24px;
        font-weight: 700;
        color: #2c2520;
        margin-bottom: 25px;
    }

    h2 {
        font-size: 18px;
        margin-top: 35px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #4a3f35;
        border-left: 4px solid #a67c52;
        padding-left: 10px;
    }

    /* STATS CARD MODERN */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: linear-gradient(135deg, #d4b795, #a67c52);
        color: white;
        padding: 22px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(166, 124, 82, 0.15);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        right: -20px;
        bottom: -20px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(166, 124, 82, 0.25);
    }

    .stat-label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .stat-value {
        font-size: 26px;
        font-weight: 700;
    }

    /* ACTION BAR */
    .action-bar {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin: 20px 0;
    }

    .btn {
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-gold {
        background: #a67c52;
        color: #fff;
        box-shadow: 0 4px 10px rgba(166, 124, 82, 0.2);
    }

    .btn-gold:hover {
        background: #8b5e3c;
        transform: translateY(-1px);
    }

    .btn-outline {
        border: 1px solid #c8a97e;
        color: #a67c52;
        background: #fff;
    }

    .btn-outline:hover {
        background: #fdfaf7;
        color: #8b5e3c;
    }

    .btn-sm {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
    }

    /* LUXURY PREMIUM TABLE */
    .table-container {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f2ede7;
        overflow: hidden;
        margin-bottom: 20px;
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

    .order-number {
        font-weight: 700;
        color: #a67c52;
    }

    .table-badge {
        background: #f5efe6;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #a67c52;
    }

    .food-details {
        font-size: 12px;
        color: #887666;
        font-weight: normal;
        margin-top: 4px;
    }

    /* STATUS BADGES */
    .status-badge {
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .action-group {
        display: flex;
        gap: 6px;
    }

    /* TOP MENU LIST */
    .menu-stats-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .menu-stat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #f2ede7;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .menu-stat-name {
        font-weight: 600;
        font-size: 14px;
        color: #2c2520;
    }

    .menu-stat-count {
        font-size: 13px;
        color: #a67c52;
        font-weight: 700;
        background: #fbf7f2;
        padding: 6px 12px;
        border-radius: 8px;
    }

    /* POPUP MODAL CENTER */
    .payment-modal {
        display: none;
        position: fixed;
        z-index: 1050;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }

    .modal-content-box {
        background-color: #fff;
        border-radius: 16px;
        width: 90%;
        max-width: 480px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        animation: slideDown 0.3s ease-out;
        overflow: hidden;
        position: relative;
    }

    .modal-header-box {
        background: #a67c52;
        color: #fff;
        padding: 16px 20px;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body-box {
        padding: 20px;
        max-height: 70vh;
        overflow-y: auto;
    }

    .modal-footer-box {
        padding: 15px 20px;
        background: #fcf9f5;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #f2ede7;
    }

    .close-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
        border-bottom: 1px dashed #f2ede7;
        padding-bottom: 8px;
    }

    .info-row strong {
        color: #2c2520;
    }

    .payment-detail-section {
        margin-top: 15px;
        padding: 12px;
        border-radius: 10px;
        background: #fdfcfb;
        border: 1px solid #f2ede7;
        display: none;
    }

    .bank-input-group label {
        font-size: 12px;
        color: #615243;
        display: block;
        margin-top: 8px;
        margin-bottom: 3px;
        font-weight: 600;
    }

    .bank-input-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #d4b795;
        border-radius: 6px;
        font-size: 13px;
        background: #fff;
    }

    .bleeding-overlay {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        z-index: 1100;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .spinner-luxury {
        width: 45px;
        height: 45px;
        border: 4px solid #f3e6d8;
        border-top: 4px solid #a67c52;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 15px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes slideDown {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="dashboard-container">

    <h1 class="dashboard-title">Dashboard Kasir Restoran</h1>

    
    <div class="stats-grid">
        <div class="stat-card">
            <p class="stat-label">Pendapatan Hari Ini</p>
            <p class="stat-value">Rp <?php echo e(isset($todayRevenue) && $todayRevenue > 0 ? number_format($todayRevenue,0,',','.') : '2.450.000'); ?></p>
        </div>

        <div class="stat-card">
            <p class="stat-label">Pesanan Aktif</p>
            <p class="stat-value">5</p>
        </div>
    </div>

    
    <div class="action-bar">
        <a href="<?php echo e(route('kasir.restoran.order.create')); ?>" class="btn btn-gold">
            <i class="bi bi-plus-circle"></i> Input Pesanan Baru
        </a>
        <a href="<?php echo e(route('kasir.restoran.menu.stats')); ?>" class="btn btn-outline">
            <i class="bi bi-bar-chart-line"></i> Statistik Menu
        </a>
        <a href="<?php echo e(route('kasir.restoran.history')); ?>" class="btn btn-outline">
            <i class="bi bi-clock-history"></i> Riwayat Transaksi
        </a>
    </div>

    
    <h2>Pesanan Menunggu Pembayaran</h2>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No. Pesanan</th>
                    <th>Meja</th>
                    <th>Pelanggan / Menu</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th style="width: 160px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $simulatedOrders = [
                        (object)['id' => 101, 'table_number' => '05', 'customer_name' => 'Bpk. Aryo Seto (Room 204)', 'food' => '1x Nasi Goreng Kampung, 1x Es Kopi Susu Aren', 'total_price' => 75000],
                        (object)['id' => 102, 'table_number' => '12', 'customer_name' => 'Ibu Dian Lestari', 'food' => '2x Mie Ayam Bakso, 2x Es Jeruk Segar', 'total_price' => 64000],
                        (object)['id' => 103, 'table_number' => '02', 'customer_name' => 'Mr. Johnathan Smith', 'food' => '1x Rib Eye Steak Premium, 1x Red Velvet Latte', 'total_price' => 285000],
                        (object)['id' => 104, 'table_number' => 'VIP 1', 'customer_name' => 'Keluarga Wijaya', 'food' => '1x Paket Sapo Tahu Family, 1x Gurame Asam Manis', 'total_price' => 420000],
                        (object)['id' => 105, 'table_number' => '08', 'customer_name' => 'Rian & Amalia', 'food' => '2x Fettuccine Carbonara, 2x Hot Matcha', 'total_price' => 180000]
                    ];
                ?>

                <?php $__currentLoopData = $simulatedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><span class="order-number">#<?php echo e($order->id); ?></span></td>
                    <td><span class="table-badge">Meja <?php echo e($order->table_number); ?></span></td>
                    <td>
                        <strong><?php echo e($order->customer_name); ?></strong>
                        <div class="food-details">
                            <i class="bi bi-egg-fried"></i> <?php echo e($order->food); ?>

                        </div>
                    </td>
                    <td><strong>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></strong></td>
                    <td>
                        <span class="status-badge status-pending">Ordered</span>
                    </td>
                    <td>
                        <div class="action-group">
                            <button type="button" class="btn btn-sm btn-gold" onclick="bukaModalPembayaran('<?php echo e($order->id); ?>', '<?php echo e($order->table_number); ?>', '<?php echo e($order->customer_name); ?>', '<?php echo e($order->food); ?>', '<?php echo e(number_format($order->total_price, 0, ',', '.')); ?>')">
                                Bayar
                            </button>
                            
                            <button type="button" class="btn btn-sm btn-outline" onclick="cetakStrukOtomatis('<?php echo e($order->id); ?>', '<?php echo e($order->table_number); ?>', '<?php echo e($order->customer_name); ?>', '<?php echo e($order->food); ?>', '<?php echo e(number_format($order->total_price, 0, ',', '.')); ?>')">
                                <i class="bi bi-printer"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <h2>Menu Terlaris Hari Ini</h2>

    <div class="menu-stats-list">
        <?php
            $activeTopMenus = [
                (object)['name' => 'Nasi Goreng Kampung GrandStay', 'total_qty' => 42],
                (object)['name' => 'Es Kopi Susu Aren Gula Lux', 'total_qty' => 38],
                (object)['name' => 'Ayam Bakar Madu Spesial', 'total_qty' => 25],
                (object)['name' => 'Rib Eye Steak Premium', 'total_qty' => 19]
            ];
        ?>

        <?php $__currentLoopData = $activeTopMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="menu-stat-item">
            <span class="menu-stat-name"><i class="bi bi-fire" style="color: #e67e22; margin-right: 5px;"></i> <?php echo e($menu->name); ?></span>
            <span class="menu-stat-count"><?php echo e(number_format($menu->total_qty)); ?> Porsi</span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>


<div id="paymentModal" class="payment-modal">
    <div class="modal-content-box">
        
        <div id="bleedingLoader" class="bleeding-overlay">
            <div class="spinner-luxury"></div>
            <strong style="color: #a67c52; font-size: 14px;">Memproses Transaksi...</strong>
            <span style="font-size: 11px; color: #888; margin-top: 5px;">Mengirim data ke printer struk</span>
        </div>

        <div class="modal-header-box">
            <span><i class="bi bi-credit-card-2-back"></i> Rincian Pembayaran Kasir</span>
            <button class="close-btn" onclick="tutupModal()">&times;</button>
        </div>
        
        <div class="modal-body-box">
            <div class="info-row">
                <span>No. Pesanan:</span>
                <strong id="modal-id">#000</strong>
            </div>
            <div class="info-row">
                <span>Nomor Meja:</span>
                <strong id="modal-meja">-</strong>
            </div>
            <div class="info-row">
                <span>Nama Pelanggan:</span>
                <strong id="modal-nama">-</strong>
            </div>
            
            <div style="margin-top: 12px; margin-bottom: 12px;">
                <span style="font-size: 13px; color: #888; display:block; margin-bottom: 5px;">Menu Dipesan:</span>
                <div id="modal-menu" style="background: #fdfaf7; padding: 10px; border-radius: 8px; font-size: 13px; border: 1px solid #f2ede7; color: #4a3f35;">
                    -
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label style="font-size: 13px; color: #555; display:block; margin-bottom: 5px; font-weight: 600;">Metode Pembayaran:</label>
                <select id="paymentMethodSelect" onchange="handlePaymentMethodChange()" class="btn btn-outline" style="width: 100%; text-align: left; padding: 10px; border-radius: 8px;">
                    <option value="cash">Cash (Tunai)</option>
                    <option value="qris">QRIS (Scan Barcode otomatis)</option>
                    <option value="bank">Transfer Lewat Bank (Model Top Up)</option>
                </select>
            </div>

            <div id="section-qris" class="payment-detail-section" style="text-align: center;">
                <span style="font-size: 12px; font-weight: bold; color: #a67c52; display: block; margin-bottom: 8px;">SILAHKAN SCAN QRIS GRANDSTAY DI BAWAH:</span>
                <div style="background: white; padding: 10px; display: inline-block; border-radius: 8px; border: 1px solid #e2d9cf;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=GrandStayHotelResto" alt="QRIS Barcode" style="width: 140px; height: 140px;">
                </div>
                <span style="font-size: 11px; color: #777; display: block; margin-top: 5px;">Dinamis terverifikasi otomatis saat dana masuk</span>
            </div>

            <div id="section-bank" class="payment-detail-section bank-input-group">
                <span style="font-size: 12px; font-weight: bold; color: #a67c52; display: block; margin-bottom: 8px;"><i class="bi bi-wallet2"></i> DETAIL AKUN REKENING TOP-UP HOTEL:</span>
                <div style="background: #f4efe9; padding: 10px; border-radius: 6px; font-size: 12px; margin-bottom: 10px; color:#5c4e40;">
                    <strong>Bank Mandiri Corporate:</strong> 132-0023-445-112<br>
                    <strong>Atas Nama:</strong> PT. GrandStay Luxury Hotel Tbk.
                </div>
                <label>Pilih Bank Pengirim Pelanggan:</label>
                <select class="btn btn-outline" style="width: 100%; padding: 6px; font-size:12px; background:#fff; border: 1px solid #d4b795;">
                    <option>BCA Transfer</option>
                    <option>Mandiri Online</option>
                    <option>BRI / BNI</option>
                </select>
                <label>Nomor Referensi Transaksi / ID Top-Up:</label>
                <input type="text" value="TRX-<?php echo e(rand(100000,999999)); ?>">
            </div>

            <div class="info-row" style="border-bottom: 2px solid #a67c52; padding-bottom: 10px; margin-top: 20px;">
                <span style="font-size: 15px; font-weight: bold; color: #a67c52;">Total Seluruhnya:</span>
                <strong id="modal-total" style="font-size: 18px; color: #a67c52;">Rp 0</strong>
            </div>
        </div>

        <div class="modal-footer-box">
            <button type="button" class="btn btn-outline" onclick="tutupModal()">Batal</button>
            <button type="button" class="btn btn-gold" onclick="prosesSimulasiSuksesWithBleeding()">Konfirmasi & Cetak Struk</button>
        </div>
    </div>
</div>


<script>
    function bukaModalPembayaran(id, meja, nama, menu, total) {
        document.getElementById('modal-id').innerText = '#' + id;
        document.getElementById('modal-meja').innerText = 'Meja ' + meja;
        document.getElementById('modal-nama').innerText = nama;
        document.getElementById('modal-menu').innerText = menu;
        document.getElementById('modal-total').innerText = 'Rp ' + total;
        
        document.getElementById('paymentMethodSelect').value = 'cash';
        handlePaymentMethodChange();
        document.getElementById('paymentModal').style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('paymentModal').style.display = 'none';
        document.getElementById('bleedingLoader').style.display = 'none';
    }

    function handlePaymentMethodChange() {
        var method = document.getElementById('paymentMethodSelect').value;
        var qrisSection = document.getElementById('section-qris');
        var bankSection = document.getElementById('section-bank');

        if(method === 'qris') {
            qrisSection.style.display = 'block';
            bankSection.style.display = 'none';
        } else if(method === 'bank') {
            qrisSection.style.display = 'none';
            bankSection.style.display = 'block';
        } else {
            qrisSection.style.display = 'none';
            bankSection.style.display = 'none';
        }
    }

    function prosesSimulasiSuksesWithBleeding() {
        var loader = document.getElementById('bleedingLoader');
        loader.style.display = 'flex';

        setTimeout(function() {
            loader.style.display = 'none';
            alert('🎉 PEMBAYARAN SUKSES!\nStruk transaksi telah dikirim ke thermal printer kasir restoran.');
            tutupModal();
        }, 2500);
    }

    
    function cetakStrukOtomatis(id, meja, nama, menu, total) {
        // Membuat layout struk pos kasir thermal mini dengan kertas lebar 58mm/80mm lewat dokumen html baru di memori browser
        var rincianMenuHtml = menu.split(',').map(item => `<tr><td style="padding:4px 0;">${item.trim()}</td></tr>`).join('');
        
        var strukWindow = window.open('', '_blank', 'width=350,height=600');
        strukWindow.document.write(`
            <html>
            <head>
                <title>Cetak Struk #${id}</title>
                <style>
                    body { font-family: 'Courier New', Courier, monospace; width: 280px; margin: 0 auto; padding: 10px; color: #000; font-size: 13px; }
                    .text-center { text-align: center; }
                    .bold { font-weight: bold; }
                    .line { border-top: 1px dashed #000; margin: 10px 0; }
                    table { width: 100%; border-collapse: collapse; }
                </style>
            </head>
            <body>
                <div class="text-center">
                    <span class="bold" style="font-size:16px;">GRANDSTAY HOTEL</span><br>
                    <span>Luxury & Culinary Resto</span><br>
                    <span>Sleman, Yogyakarta</span>
                </div>
                <div class="line"></div>
                <div>
                    <span>No. Order: #${id}</span><br>
                    <span>Meja    : Meja ${meja}</span><br>
                    <span>Pelanggan: ${nama}</span><br>
                    <span>Waktu    : ${new Date().toLocaleString('id-ID')}</span>
                </div>
                <div class="line"></div>
                <span class="bold">ITEMS PESANAN:</span>
                <table>
                    ${rincianMenuHtml}
                </table>
                <div class="line"></div>
                <table class="bold">
                    <tr>
                        <td>TOTAL AKHIR:</td>
                        <td style="text-align:right;">Rp ${total}</td>
                    </tr>
                </table>
                <div class="line"></div>
                <div class="text-center" style="margin-top:20px; font-size:11px;">
                    Thank You For Dining With Us!<br>
                    --- GrandStay Hotel ---
                </div>
                <script>
                    // Menginstruksikan window struk ini untuk auto-print sesaat setelah dirender browser
                    window.onload = function() {
                        window.print();
                        setTimeout(function() { window.close(); }, 500);
                    }
                <\/script>
            </body>
            </html>
        `);
        strukWindow.document.close();
    }

    window.onclick = function(event) {
        var modal = document.getElementById('paymentModal');
        if (event.target == modal) {
            tutupModal();
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/kasir/restoran/dashboard.blade.php ENDPATH**/ ?>