

<?php $__env->startSection('title', 'Restaurant POS'); ?>
<?php $__env->startSection('page-title', 'Point of Sale - Restaurant'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.restoran.pos')); ?>" class="nav-link active">
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
    /* LUXURY THEME INTEGRATION (Matches Dashboard) */
    body {
        background-color: #fcfbfa;
    }
    
    .pos-card-menu {
        border: 1px solid #f2ede7;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(166, 124, 82, 0.04);
        transition: all 0.25s ease;
        cursor: pointer;
    }
    
    .pos-card-menu:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(166, 124, 82, 0.15);
        border: 1px solid #a67c52;
    }
    
    /* Elegant Category Tabs */
    .category-nav .nav-link {
        color: #615243;
        font-weight: 600;
        border: 1px solid #e2d9cf;
        padding: 10px 22px;
        border-radius: 30px;
        margin-right: 8px;
        background-color: #fff;
        transition: all 0.2s ease;
    }
    
    .category-nav .nav-link.active {
        background-color: #a67c52 !important;
        border-color: #a67c52 !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(166, 124, 82, 0.25);
    }
    
    /* Cart Panel Premium */
    .cart-panel {
        border: 1px solid #f2ede7;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(166, 124, 82, 0.06);
        background: #fff;
        position: sticky;
        top: 20px;
    }
    
    .cart-header-luxury {
        background: #2c2520;
        color: #fff;
        border-radius: 20px 20px 0 0;
    }
    
    .cart-container {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }
    
    .cart-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .cart-container::-webkit-scrollbar-thumb {
        background-color: #e2d9cf;
        border-radius: 10px;
    }
    
    .cart-item {
        background: #fdfcfb;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 10px;
        border: 1px solid #f2ede7;
    }
    
    /* Luxury Buttons */
    .btn-gold {
        background: #a67c52;
        color: #fff;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-gold:hover {
        background: #8b5e3c;
        color: #fff;
    }
    
    .btn-outline-gold {
        border: 1px solid #c8a97e;
        color: #a67c52;
        background: #fff;
    }
    
    .btn-outline-gold:hover {
        background: #fdfaf7;
        color: #8b5e3c;
    }
    
    .qty-btn {
        width: 28px;
        height: 28px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #f4efe9;
        border: none;
        color: #4a3f35;
    }
    
    .qty-input-modern {
        width: 40px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 700;
        color: #2c2520;
    }
    
    .badge-category {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(253, 252, 251, 0.9);
        backdrop-filter: blur(4px);
        color: #a67c52;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        border: 1px solid #f2ede7;
    }
    
    .text-gold-price {
        color: #a67c52;
    }
</style>

<div class="row g-4">
    
    <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0 style-heading" style="color: #2c2520; border-left: 4px solid #a67c52; padding-left: 10px;">Daftar Menu Restoran</h5>
            <span class="badge rounded-pill" style="background: #f4efe9; color: #a67c52; border: 1px solid #e2d9cf;">Pilihan Utama</span>
        </div>

        
        <div class="mb-4">
            <ul class="nav nav-pills category-nav" id="categoryTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-category="all" href="javascript:void(0)"><i class="bi bi-grid-fill me-1"></i> Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-category="Makanan" href="javascript:void(0)">Makanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-category="Minuman" href="javascript:void(0)">Minuman</a>
                </li>
            </ul>
        </div>

        
        <div class="row g-3" id="menuGrid">
            <?php
                // Menyiapkan daftar menu lengkap restoran agar tampil serentak ketika diklik "Semua"
                $simulatedMenus = [
                    ['id' => 1, 'name' => 'Nasi Goreng Kampung GrandStay', 'category' => 'Makanan', 'price' => 35000, 'img' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 2, 'name' => 'Mie Goreng Jawa Spesial', 'category' => 'Makanan', 'price' => 32000, 'img' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 3, 'name' => 'Kwetiau Goreng Sapi Premium', 'category' => 'Makanan', 'price' => 38000, 'img' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 4, 'name' => 'Mie Ayam Bakso Urat Lux', 'category' => 'Makanan', 'price' => 28000, 'img' => 'https://images.unsplash.com/photo-1626804475315-7690623f7734?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 5, 'name' => 'Es Kopi Susu Aren Gula Lux', 'category' => 'Minuman', 'price' => 22000, 'img' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 6, 'name' => 'Es Jeruk Peras Murni Segar', 'category' => 'Minuman', 'price' => 15000, 'img' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&w=300&q=80'],
                    ['id' => 7, 'name' => 'Hot Matcha Latte Velvet', 'category' => 'Minuman', 'price' => 24000, 'img' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=300&q=80']
                ];
            ?>

            <?php $__currentLoopData = $simulatedMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-4 menu-item" data-category="<?php echo e($menu['category']); ?>">
                <div class="card h-100 pos-card-menu" onclick="tambahKeKeranjangLokal(<?php echo e($menu['id']); ?>, '<?php echo e($menu['name']); ?>', <?php echo e($menu['price']); ?>)">
                    <div style="position: relative; overflow: hidden;">
                        <span class="badge-category"><?php echo e($menu['category']); ?></span>
                        <img src="<?php echo e($menu['img']); ?>" class="card-img-top" alt="<?php echo e($menu['name']); ?>" style="height: 120px; object-fit: cover;">
                    </div>
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="card-title fw-bold mb-1 text-truncate" style="color: #2c2520;" title="<?php echo e($menu['name']); ?>"><?php echo e($menu['name']); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold fs-6 text-gold-price">Rp <?php echo e(number_format($menu['price'], 0, ',', '.')); ?></span>
                            <button class="btn btn-sm btn-outline-gold rounded-circle p-1 d-flex align-items-center justify-content-center" style="width:28px; height:28px;"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="col-lg-5">
        <div class="card cart-panel">
            <div class="card-header cart-header-luxury d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-bag-check-fill me-2" style="color: #d4b795;"></i> Keranjang Pesanan</h6>
                <span id="cartCountBadge" class="badge text-dark fw-bold" style="background: #d4b795;">0 Items</span>
            </div>
            
            <div class="card-body p-3">
                <div class="cart-container" id="cartItemsContainer">
                    
                    <div id="emptyCartMessage" class="text-center text-muted py-5">
                        <i class="bi bi-cart-x" style="font-size: 3.5rem; color: #e2d9cf;"></i>
                        <p class="mt-2 mb-0 fw-semibold" style="color: #615243;">Keranjang Masih Kosong</p>
                        <small class="text-muted">Klik item menu di sebelah kiri untuk menambahkan</small>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top p-3" style="border-radius: 0 0 20px 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-semibold" style="color: #615243;">Total Pembayaran:</span>
                    <strong id="cartTotalDisplay" style="color: #a67c52; font-size: 1.4rem;" class="fw-bold">Rp 0</strong>
                </div>
                <button type="button" id="btnKonfirmasi" class="btn btn-gold w-100 py-2.5 fw-bold rounded-3" onclick="bukaModalPembayaranFinal()" disabled>
                    <i class="bi bi-credit-card-2-back-fill me-2"></i> Konfirmasi & Bayar
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: #2c2520; color: #fff; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title fw-bold" style="font-size: 16px;"><i class="bi bi-shield-check" style="color: #d4b795;"></i> Detail Transaksi Final</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background: #fcfbfa;">
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color: #4a3f35;">Tipe Pelanggan</label>
                    <select class="form-select" id="customerType" style="border-color: #d4b795;">
                        <option value="walk_in">Walk-in Customer</option>
                        <option value="room_guest">Tamu Kamar Hotel (GrandStay)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color: #4a3f35;">Metode Pembayaran</label>
                    <select class="form-select" id="paymentMethodSelect" onchange="toggleMetodePembayaranLokal()" style="border-color: #d4b795;">
                        <option value="cash">Cash / Tunai</option>
                        <option value="qris">QRIS (Scan Barcode Otomatis)</option>
                        <option value="bank">Transfer Lewat Bank (Model Top Up)</option>
                    </select>
                </div>

                
                <div id="modal-qris-section" style="display:none; text-align: center; background: #fff; padding: 15px; border-radius: 10px; border: 1px dashed #a67c52; margin-bottom: 15px;">
                    <span style="font-size: 12px; font-weight: bold; color: #a67c52; display: block; margin-bottom: 8px;">SILAHKAN SCAN QRIS DI BAWAH:</span>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=GrandStayPOSPayment" style="width: 130px; height: 130px; border: 1px solid #e2d9cf; padding: 5px; border-radius: 6px;">
                </div>

                
                <div id="modal-bank-section" style="display:none; background: #fff; padding: 15px; border-radius: 10px; border: 1px solid #f2ede7; margin-bottom: 15px;">
                    <div style="background: #f4efe9; padding: 10px; border-radius: 6px; font-size: 12px; color:#5c4e40; margin-bottom: 10px;">
                        <strong>Mandiri Corporate:</strong> 132-0023-445-112<br>
                        <strong>A/N:</strong> PT. GrandStay Luxury Hotel
                    </div>
                    <label class="form-label style-sub" style="font-size: 12px; font-weight: 600;">ID / No Referensi Bank Pengirim:</label>
                    <input type="text" class="form-control form-control-sm" value="TRX-POS<?php echo e(rand(100,999)); ?>" style="border-color: #d4b795;">
                </div>

                <div class="p-3 d-flex justify-content-between align-items-center rounded-3" style="background: #f4efe9; border: 1px solid #e2d9cf;">
                    <span class="fw-semibold text-dark">Total Tagihan Kasir:</span>
                    <strong id="modalTotalDisplay" class="fs-5" style="color: #a67c52;">Rp 0</strong>
                </div>
            </div>
            <div class="modal-footer" style="background: #fcf9f5;">
                <button type="button" class="btn btn-outline-gold fw-semibold" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-gold fw-bold" onclick="prosesSimulasiSuksesPOS()">Proses & Cetak Struk</button>
            </div>
        </div>
    </div>
</div>


<script>
let keranjangLokal = {};

// Filter Kategori Realtime
document.querySelectorAll('#categoryTab .nav-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('#categoryTab .nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        
        let category = this.getAttribute('data-category');
        document.querySelectorAll('.menu-item').forEach(item => {
            if(category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Tambah Item ke Keranjang Realtime
function tambahKeKeranjangLokal(id, name, price) {
    if (keranjangLokal[id]) {
        keranjangLokal[id].quantity += 1;
    } else {
        keranjangLokal[id] = { name: name, price: price, quantity: 1 };
    }
    renderKeranjang();
}

// Mengubah Kuantitas Item
function ubahQtyLokal(id, delta) {
    if (keranjangLokal[id]) {
        keranjangLokal[id].quantity += delta;
        if (keranjangLokal[id].quantity <= 0) {
            delete keranjangLokal[id];
        }
        renderKeranjang();
    }
}

// Hapus Item
function hapusItemLokal(id) {
    delete keranjangLokal[id];
    renderKeranjang();
}

// Render Ulang Tampilan Komponen Keranjang & Hitung Total Harga
function renderKeranjang() {
    let container = document.getElementById('cartItemsContainer');
    let keys = Object.keys(keranjangLokal);
    
    if(keys.length === 0) {
        container.innerHTML = `
            <div id="emptyCartMessage" class="text-center text-muted py-5">
                <i class="bi bi-cart-x" style="font-size: 3.5rem; color: #e2d9cf;"></i>
                <p class="mt-2 mb-0 fw-semibold" style="color: #615243;">Keranjang Masih Kosong</p>
                <small class="text-muted">Klik item menu di sebelah kiri untuk menambahkan</small>
            </div>`;
        document.getElementById('cartTotalDisplay').innerText = "Rp 0";
        document.getElementById('cartCountBadge').innerText = "0 Items";
        document.getElementById('btnKonfirmasi').disabled = true;
        return;
    }
    
    let html = '';
    let total = 0;
    let totalItems = 0;
    
    keys.forEach(id => {
        let item = keranjangLokal[id];
        let subtotal = item.price * item.quantity;
        total += subtotal;
        totalItems += item.quantity;
        
        html += `
        <div class="cart-item">
            <div class="row align-items-center g-2">
                <div class="col-5">
                    <span class="fw-bold text-dark d-block text-truncate" style="font-size:13px;">${item.name}</span>
                    <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center justify-content-center bg-white rounded-pill p-1 border" style="border-color:#e2d9cf!important;">
                        <button class="qty-btn" onclick="ubahQtyLokal(${id}, -1)"><i class="bi bi-minus"></i></button>
                        <span class="qty-input-modern">${item.quantity}</span>
                        <button class="qty-btn" onclick="ubahQtyLokal(${id}, 1)"><i class="bi bi-plus"></i></button>
                    </div>
                </div>
                <div class="col-3 text-end d-flex align-items-center justify-content-end gap-2">
                    <span class="fw-bold text-dark" style="font-size:13px;">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    <button class="btn btn-sm text-danger p-0 border-0" onclick="hapusItemLokal(${id})">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </div>
        </div>`;
    });
    
    container.innerHTML = html;
    document.getElementById('cartTotalDisplay').innerText = "Rp " + total.toLocaleString('id-ID');
    document.getElementById('cartCountBadge').innerText = totalItems + " Items";
    document.getElementById('btnKonfirmasi').disabled = false;
}

// Buka Modal Pembayaran & Oper Nominal Total Angka
function bukaModalPembayaranFinal() {
    let totalStr = document.getElementById('cartTotalDisplay').innerText;
    document.getElementById('modalTotalDisplay').innerText = totalStr;
    
    // Reset area dinamis modal
    document.getElementById('paymentMethodSelect').value = 'cash';
    toggleMetodePembayaranLokal();
    
    let myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    myModal.show();
}

// Handler Dropdown Metode Pembayaran Modal POS
function toggleMetodePembayaranLokal() {
    let val = document.getElementById('paymentMethodSelect').value;
    document.getElementById('modal-qris-section').style.display = (val === 'qris') ? 'block' : 'none';
    document.getElementById('modal-bank-section').style.display = (val === 'bank') ? 'block' : 'none';
}

// Aksi Cetak Struk POS Otomatis Layout Kertas Struk Kasir Thermal
function prosesSimulasiSuksesPOS() {
    let totalStr = document.getElementById('cartTotalDisplay').innerText;
    let menuRowsHtml = '';
    
    Object.keys(keranjangLokal).forEach(id => {
        let item = keranjangLokal[id];
        menuRowsHtml += `
        <tr>
            <td style="padding:4px 0;">${item.quantity}x ${item.name}</td>
            <td style="text-align:right; padding:4px 0;">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</td>
        </tr>`;
    });

    let modalEl = document.getElementById('paymentModal');
    let modalInstance = bootstrap.Modal.getInstance(modalEl);
    if(modalInstance) modalInstance.hide();

    // Membuka jendela pop-up print cetak struk kasir thermal mini otomatis
    let strukWindow = window.open('', '_blank', 'width=350,height=600');
    strukWindow.document.write(`
        <html>
        <head>
            <title>Cetak Struk POS Kasir</title>
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
                <span>Culinary & Resto POS</span><br>
                <span>Sleman, Yogyakarta</span>
            </div>
            <div class="line"></div>
            <div>
                <span>Kasir  : POS-System</span><br>
                <span>Metode : ${document.getElementById('paymentMethodSelect').value.toUpperCase()}</span><br>
                <span>Waktu  : ${new Date().toLocaleString('id-ID')}</span>
            </div>
            <div class="line"></div>
            <table class="bold">
                ${menuRowsHtml}
            </table>
            <div class="line"></div>
            <table class="bold">
                <tr>
                    <td>TOTAL LUNAS:</td>
                    <td style="text-align:right;">${totalStr}</td>
                </tr>
            </table>
            <div class="line"></div>
            <div class="text-center" style="margin-top:20px; font-size:11px;">
                Terima Kasih Atas Kunjungan Anda!<br>
                --- GrandStay Hotel ---
            </div>
            <script>
                window.onload = function() {
                    window.print();
                    setTimeout(function() { window.close(); }, 500);
                }
            <\/script>
        </body>
        </html>
    `);
    strukWindow.document.close();
    
    // Kosongkan keranjang kembali setelah transaksi selesai
    keranjangLokal = {};
    renderKeranjang();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/kasir/restoran/pos.blade.php ENDPATH**/ ?>