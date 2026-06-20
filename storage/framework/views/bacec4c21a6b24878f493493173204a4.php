<?php $__env->startSection('title', 'Create Booking'); ?>
<?php $__env->startSection('page-title', 'Create New Booking'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('resepsionis.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.index')); ?>" class="nav-link">
        <i class="bi bi-calendar-check"></i> Daftar Booking
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.create')); ?>" class="nav-link active">
        <i class="bi bi-plus-circle"></i> Booking Baru
    </a>
    <a href="<?php echo e(route('resepsionis.rooms')); ?>" class="nav-link">
        <i class="bi bi-door-open"></i> Rooms
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* ── Layout ─────────────────────────────────────────────── */
    .booking-wrapper { max-width: 900px; }

    .step-bar {
        display: flex; align-items: center;
        gap: 0; margin-bottom: 1.75rem;
    }
    .step-item {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; font-weight: 500; color: #9ca3af;
    }
    .step-item.active { color: #8b5e3c; }
    .step-item.done  { color: #16a34a; }
    .step-num {
        width: 24px; height: 24px; border-radius: 50%;
        border: 1.5px solid currentColor;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 600; flex-shrink: 0;
    }
    .step-item.active .step-num { background: #fdfbf9; }
    .step-item.done  .step-num { background: #f0fdf4; }
    .step-line { flex: 1; height: 1px; background: #e5e7eb; margin: 0 10px; min-width: 28px; }

    /* ── Section Cards ──────────────────────────────────────── */
    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
    }
    .section-header {
        display: flex; align-items: flex-start; gap: 12px;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .section-icon {
        width: 36px; height: 36px; border-radius: 8px;
        background: #f3e8dc; color: #8b5e3c;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; font-size: 16px;
    }
    .section-title { font-size: 15px; font-weight: 600; color: #111827; margin-bottom: 2px; }
    .section-subtitle { font-size: 12.5px; color: #6b7280; }

    /* ── Form Fields ────────────────────────────────────────── */
    .field-label {
        font-size: 11.5px; font-weight: 600; color: #6b7280;
        text-transform: uppercase; letter-spacing: .05em;
        margin-bottom: 5px; display: block;
    }
    .field-label .req { color: #ef4444; }
    .form-control, .form-select {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        font-size: 14px !important;
        color: #111827 !important;
        background: #f9fafb !important;
        padding: 8px 12px !important;
        transition: border-color .15s, box-shadow .15s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #a67c52 !important;
        background: #fff !important;
        box-shadow: 0 0 0 3px rgba(166,124,82,.15) !important;
        outline: none !important;
    }
    textarea.form-control { resize: vertical; min-height: 76px; }

    /* ── Radio Pills ────────────────────────────────────────── */
    .radio-pill-group { display: flex; gap: 8px; }
    .radio-pill {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
        padding: 8px 16px; border-radius: 8px; cursor: pointer;
        border: 1px solid #d1d5db; font-size: 13.5px; font-weight: 500;
        color: #6b7280; background: #f9fafb; transition: all .15s;
        user-select: none;
    }
    .radio-pill input[type="radio"] { display: none; }
    .radio-pill:has(input:checked) {
        border-color: #a67c52; background: #fdfbf9; color: #8b5e3c;
    }
    .radio-pill .pill-dot {
        width: 9px; height: 9px; border-radius: 50%;
        border: 1.5px solid currentColor; flex-shrink: 0;
    }
    .radio-pill:has(input:checked) .pill-dot { background: currentColor; }

    /* ── Package Cards ──────────────────────────────────────── */
    .pkg-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 1rem; }
    .pkg-card {
        display: flex; flex-direction: column; align-items: flex-start; gap: 4px;
        padding: 12px 14px; border-radius: 10px; cursor: pointer;
        border: 1px solid #e5e7eb; background: #f9fafb; transition: all .15s;
        user-select: none;
    }
    .pkg-card input[type="radio"] { display: none; }
    .pkg-card:has(input:checked) {
        border-color: #a67c52; background: #fdfbf9;
    }
    .pkg-card-title { font-size: 13.5px; font-weight: 600; color: #111827; }
    .pkg-card-sub   { font-size: 11.5px; color: #6b7280; }
    .pkg-card:has(input:checked) .pkg-card-title { color: #8b5e3c; }
    .pkg-card:has(input:checked) .pkg-card-sub   { color: #a67c52; }

    /* ── Extra Bed Toggle ───────────────────────────────────── */
    .extra-bed-card {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px; border-radius: 10px; cursor: pointer;
        border: 1px solid #e5e7eb; background: #f9fafb; transition: all .15s;
    }
    .extra-bed-card:has(input:checked) {
        border-color: #a67c52; background: #fdfbf9;
    }
    .extra-bed-card input[type="checkbox"] { display: none; }
    .check-box {
        width: 18px; height: 18px; border-radius: 5px; flex-shrink: 0;
        border: 1.5px solid #d1d5db; background: #fff;
        display: flex; align-items: center; justify-content: center;
        transition: all .15s;
    }
    .extra-bed-card:has(input:checked) { border-color: #a67c52; background: #fdfbf9; }
    .extra-bed-card:has(input:checked) .check-box {
        background: #a67c52; border-color: #a67c52;
    }
    .check-box i { color: #fff; font-size: 10px; display: none; }
    .extra-bed-card:has(input:checked) .check-box i { display: block; }
    .extra-bed-info { flex: 1; }
    .extra-bed-title { font-size: 13.5px; font-weight: 600; color: #111827; }
    .extra-bed-sub   { font-size: 12px; color: #6b7280; }
    .extra-bed-badge {
        font-size: 11.5px; font-weight: 600;
        background: #fef3c7; color: #92400e;
        padding: 3px 10px; border-radius: 20px;
    }

    /* ── Nights Badge ───────────────────────────────────────── */
    .nights-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 12.5px; font-weight: 600;
        background: #f0fdf4; color: #15803d;
        padding: 4px 12px; border-radius: 20px;
        border: 1px solid #bbf7d0;
    }

    /* ── Promo Row ──────────────────────────────────────────── */
    .promo-row { display: flex; gap: 8px; }
    .promo-row .form-control { flex: 1; }
    .btn-apply {
        padding: 8px 18px; font-size: 13.5px; font-weight: 500;
        background: #fff; color: #374151;
        border: 1px solid #d1d5db; border-radius: 8px;
        cursor: pointer; white-space: nowrap; transition: all .15s;
    }
    .btn-apply:hover { background: #f3f4f6; }

    /* ── Price Summary ──────────────────────────────────────── */
    .price-summary {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .price-row { display: flex; justify-content: space-between; align-items: center; padding: 5px 0; font-size: 13.5px; }
    .price-label { color: #6b7280; }
    .price-value { color: #111827; font-variant-numeric: tabular-nums; font-weight: 500; }
    .price-divider { border: none; border-top: 1px solid #e5e7eb; margin: 10px 0; }
    .price-total .price-label { font-size: 15px; font-weight: 600; color: #111827; }
    .price-total .price-value { font-size: 20px; font-weight: 700; color: #8b5e3c; }

    /* ── Action Bar ─────────────────────────────────────────── */
    .action-bar {
        display: flex; align-items: center; justify-content: flex-end;
        gap: 10px; padding-top: .5rem;
    }
    .btn-cancel {
        padding: 9px 22px; font-size: 14px; font-weight: 500;
        background: #fff; color: #374151;
        border: 1px solid #d1d5db; border-radius: 8px;
        cursor: pointer; transition: all .15s; text-decoration: none;
    }
    .btn-cancel:hover { background: #f9fafb; color: #374151; }
    .btn-submit {
        padding: 9px 28px; font-size: 14px; font-weight: 600;
        background: #a67c52; color: #fff;
        border: none; border-radius: 8px; cursor: pointer; transition: opacity .15s;
    }
    .btn-submit:hover { opacity: .88; color: #fff; }

    /* ── Payment Method Styles ──────────────────────────────── */
    .pay-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 10px; }
    .pay-card {
        display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;
        padding: 12px; border-radius: 8px; cursor: pointer;
        border: 1px solid #d1d5db; background: #f9fafb; transition: all .15s; text-align: center;
    }
    .pay-card input[type="radio"] { display: none; }
    .pay-card:has(input:checked) { border-color: #a67c52; background: #fdfbf9; color: #8b5e3c; }
    .pay-card i { font-size: 18px; }
    .pay-instruction-box {
        background: #fdfbf9; border: 1px dashed #e2d4c5; border-radius: 8px; padding: 15px; margin-top: 12px;
    }
</style>

<div class="booking-wrapper">

    
    <div class="step-bar">
        <div class="step-item done">
            <div class="step-num"><i class="bi bi-check"></i></div>
            <span class="d-none d-sm-inline">Tamu</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item active">
            <div class="step-num">2</div>
            <span class="d-none d-sm-inline">Detail Booking</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item">
            <div class="step-num">3</div>
            <span class="d-none d-sm-inline">Konfirmasi</span>
        </div>
    </div>

    <form method="POST" action="<?php echo e(route('resepsionis.bookings.store')); ?>" id="bookingForm">
        <?php echo csrf_field(); ?>

        
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon"><i class="bi bi-person-fill"></i></div>
                <div>
                    <div class="section-title">Informasi Tamu</div>
                    <div class="section-subtitle">Pilih tamu yang sudah terdaftar atau daftarkan tamu baru</div>
                </div>
            </div>

            <div class="mb-3">
                <label class="field-label">Tipe Tamu</label>
                <div class="radio-pill-group">
                    <label class="radio-pill">
                        <input type="radio" name="guest_type" id="existingGuest" value="existing" checked>
                        <span class="pill-dot"></span> Tamu Terdaftar
                    </label>
                    <label class="radio-pill">
                        <input type="radio" name="guest_type" id="newGuest" value="new">
                        <span class="pill-dot"></span> Tamu Baru
                    </label>
                </div>
            </div>

            
            <div id="existingGuestSection">
                <div class="mb-0">
                    <label class="field-label">Pilih Tamu</label>
                    <select name="guest_id" class="form-select">
                        <option value="">-- Pilih Tamu --</option>
                        <option value="1">Nila Aprilia - 08123456789</option>
                        <option value="2">Siti Rahma - 08198765432</option>
                        <option value="3">Citra Dewi - 08561234567</option>
                        <option value="4">Budi Santoso - 08781234567</option>
                        <option value="5">Dimas Saputra - 08211234567</option>
                    </select>
                </div>
            </div>

            
            <div id="newGuestSection" style="display:none;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="field-label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="guest_name" class="form-control" placeholder="cth: John Doe">
                    </div>
                    <div class="col-md-6">
                        <label class="field-label">Email <span class="req">*</span></label>
                        <input type="email" name="guest_email" class="form-control" placeholder="email@contoh.com">
                    </div>
                    <div class="col-md-6">
                        <label class="field-label">No. Telepon <span class="req">*</span></label>
                        <input type="text" name="guest_phone" class="form-control" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="col-md-6">
                        <label class="field-label">No. Identitas (NIK/Paspor) <span class="req">*</span></label>
                        <input type="text" name="guest_identity_number" class="form-control" placeholder="Nomor identitas">
                    </div>
                    <div class="col-12">
                        <label class="field-label">Alamat</label>
                        <textarea name="guest_address" class="form-control" rows="2" placeholder="Alamat lengkap tamu..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon"><i class="bi bi-calendar-range-fill"></i></div>
                <div>
                    <div class="section-title">Detail Booking</div>
                    <div class="section-subtitle">Tanggal menginap, pilihan kamar, dan paket layanan</div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="field-label">Check In <span class="req">*</span></label>
                    <input type="date" name="check_in_date" class="form-control" id="checkIn" required>
                </div>
                <div class="col-md-6">
                    <label class="field-label">Check Out <span class="req">*</span></label>
                    <input type="date" name="check_out_date" class="form-control" id="checkOut" required>
                </div>
            </div>

            <div id="nightsBadgeWrap" class="mb-3" style="display:none;">
                <span class="nights-badge">
                    <i class="bi bi-moon-fill"></i>
                    <span id="nightsText">0 malam</span>
                </span>
            </div>

            
            <div class="mb-3">
                <label class="field-label">Pilih Kamar <span class="req">*</span></label>
                <select name="room_id" class="form-select" id="roomSelect" required>
                    <option value="">-- Pilih Kamar --</option>
                    <optgroup label="Standard Room">
                        <option value="1" data-price="450000">Kamar 101 (Standard)</option>
                        <option value="2" data-price="450000">Kamar 102 (Standard)</option>
                        <option value="3" data-price="450000">Kamar 103 (Standard)</option>
                    </optgroup>
                    <optgroup label="Deluxe Room">
                        <option value="4" data-price="650000">Kamar 201 (Deluxe)</option>
                        <option value="5" data-price="650000">Kamar 202 (Deluxe)</option>
                        <option value="6" data-price="650000">Kamar 203 (Deluxe)</option>
                    </optgroup>
                    <optgroup label="Suite Room">
                        <option value="7" data-price="1200000">Kamar 301 (Suite)</option>
                        <option value="8" data-price="1200000">Kamar 302 (Suite)</option>
                    </optgroup>
                </select>
            </div>

            <div class="mb-3">
                <label class="field-label">Paket Menginap</label>
                <div class="pkg-grid">
                    <label class="pkg-card">
                        <input type="radio" name="booking_type" value="room_only" checked>
                        <div class="pkg-card-title"><i class="bi bi-door-closed me-1"></i>Room Only</div>
                        <div class="pkg-card-sub">Tanpa paket tambahan</div>
                    </label>
                    <label class="pkg-card">
                        <input type="radio" name="booking_type" value="include_breakfast">
                        <div class="pkg-card-title"><i class="bi bi-cup-hot me-1"></i>Breakfast</div>
                        <div class="pkg-card-sub">+Rp 50.000/malam</div>
                    </label>
                    <label class="pkg-card">
                        <input type="radio" name="booking_type" value="full_package">
                        <div class="pkg-card-title"><i class="bi bi-stars me-1"></i>Full Package</div>
                        <div class="pkg-card-sub">+Rp 150.000/malam</div>
                    </label>
                </div>
            </div>

            <label class="extra-bed-card">
                <input type="checkbox" name="has_extra_bed" id="extraBed" value="1">
                <div class="check-box"><i class="bi bi-check"></i></div>
                <div class="extra-bed-info">
                    <div class="extra-bed-title">Extra Bed</div>
                    <div class="extra-bed-sub">Kasur tambahan untuk tamu ekstra</div>
                </div>
                <span class="extra-bed-badge">+Rp 150.000/malam</span>
            </label>
        </div>

        
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon"><i class="bi bi-credit-card-fill"></i></div>
                <div>
                    <div class="section-title">Pembayaran</div>
                    <div class="section-subtitle">Promo code, uang muka, dan metode pembayaran</div>
                </div>
            </div>

            <div class="mb-3">
                <label class="field-label">Kode Promo <small style="text-transform:none;font-weight:400;">(opsional)</small></label>
                <div class="promo-row">
                    <input type="text" name="promo_code" class="form-control" placeholder="Masukkan kode promo...">
                    <button type="button" class="btn-apply">Terapkan</button>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="field-label">Uang Muka (Down Payment)</label>
                    <input type="number" name="down_payment" id="downPayment" class="form-control" placeholder="0" oninput="updateDP()">
                    <div class="mt-1" style="font-size:12px;color:#9ca3af;" id="dpNote">Min. uang muka: 30% dari total harga</div>
                </div>
            </div>

            
            <div class="mb-0">
                <label class="field-label">Metode Pembayaran</label>
                <div class="pay-grid">
                    <label class="pay-card">
                        <input type="radio" name="payment_method" value="qris" onchange="togglePaymentDetails()">
                        <i class="bi bi-qr-code-scan"></i>
                        <span style="font-size:12.5px; font-weight:500;">QRIS</span>
                    </label>
                    <label class="pay-card">
                        <input type="radio" name="payment_method" value="bca" onchange="togglePaymentDetails()">
                        <i class="bi bi-bank"></i>
                        <span style="font-size:12.5px; font-weight:500;">Bank BCA</span>
                    </label>
                    <label class="pay-card">
                        <input type="radio" name="payment_method" value="mandiri" onchange="togglePaymentDetails()">
                        <i class="bi bi-bank2"></i>
                        <span style="font-size:12.5px; font-weight:500;">Mandiri</span>
                    </label>
                    <label class="pay-card">
                        <input type="radio" name="payment_method" value="cash" checked onchange="togglePaymentDetails()">
                        <i class="bi bi-cash-stack"></i>
                        <span style="font-size:12.5px; font-weight:500;">Tunai / Cash</span>
                    </label>
                </div>

                
                <div id="paymentInstructions" class="pay-instruction-box" style="display:none;">
                    <!-- Konten Diisi Dinamis oleh JavaScript -->
                </div>
            </div>
        </div>

        
        <div class="price-summary">
            <div class="price-row">
                <span class="price-label">Harga kamar</span>
                <span class="price-value" id="priceRoom">Rp 0</span>
            </div>
            <div class="price-row">
                <span class="price-label">Paket tambahan</span>
                <span class="price-value" id="pricePackage">Rp 0</span>
            </div>
            <div class="price-row" id="extraBedRow" style="display:none;">
                <span class="price-label">Extra bed</span>
                <span class="price-value" id="priceExtraBed">Rp 0</span>
            </div>
            <hr class="price-divider">
            <div class="price-row price-total">
                <span class="price-label">Total</span>
                <span class="price-value" id="priceTotal">Rp 0</span>
            </div>
            <div class="price-row" id="dpRow" style="display:none;">
                <span class="price-label">Down payment</span>
                <span class="price-value" id="priceDP">Rp 0</span>
            </div>
            <div class="price-row" id="remainRow" style="display:none;">
                <span class="price-label" style="color:#6b7280;">Sisa tagihan</span>
                <span class="price-value" style="color:#ef4444;" id="priceRemain">Rp 0</span>
            </div>
        </div>

        
        <div class="action-bar">
            <a href="<?php echo e(route('resepsionis.bookings.index')); ?>" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle me-1"></i> Simpan Booking
            </button>
        </div>

    </form>
</div>

<script>
    let nights = 0, roomPrice = 0, extraBedPrice = 150000;

    /* ── Guest toggle ── */
    document.querySelectorAll('input[name="guest_type"]').forEach(r => {
        r.addEventListener('change', () => {
            const isNew = r.value === 'new';
            document.getElementById('existingGuestSection').style.display = isNew ? 'none' : '';
            document.getElementById('newGuestSection').style.display = isNew ? '' : 'none';
        });
    });

    /* ── Night calculation ── */
    ['checkIn', 'checkOut'].forEach(id =>
        document.getElementById(id).addEventListener('change', calcNights)
    );

    function calcNights() {
        const ci = document.getElementById('checkIn').value;
        const co = document.getElementById('checkOut').value;
        if (ci && co) {
            nights = Math.max(0, Math.round((new Date(co) - new Date(ci)) / 86400000));
            const wrap = document.getElementById('nightsBadgeWrap');
            wrap.style.display = nights > 0 ? '' : 'none';
            document.getElementById('nightsText').textContent = nights + ' malam';
        }
        recalc();
    }

    /* ── Room price ── */
    document.getElementById('roomSelect').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        roomPrice = opt.dataset.price ? parseInt(opt.dataset.price) : 0;
        recalc();
    });

    /* ── Package add-on ── */
    function pkgAdd() {
        const pkg = document.querySelector('input[name="booking_type"]:checked')?.value;
        return pkg === 'include_breakfast' ? 50000 : pkg === 'full_package' ? 150000 : 0;
    }
    document.querySelectorAll('input[name="booking_type"]').forEach(r =>
        r.addEventListener('change', recalc)
    );

    /* ── Extra bed ── */
    document.getElementById('extraBed').addEventListener('change', function () {
        document.getElementById('extraBedRow').style.display = this.checked ? '' : 'none';
        recalc();
    });

    /* ── DP ── */
    function updateDP() {
        const total = (roomPrice + pkgAdd() + (document.getElementById('extraBed').checked ? extraBedPrice : 0)) * nights;
        const dp = parseInt(document.getElementById('downPayment').value) || 0;
        if (total > 0 && dp > 0) {
            document.getElementById('dpRow').style.display = '';
            document.getElementById('remainRow').style.display = '';
            document.getElementById('priceDP').textContent = fmt(dp);
            document.getElementById('priceRemain').textContent = fmt(Math.max(0, total - dp));
        } else {
            document.getElementById('dpRow').style.display = 'none';
            document.getElementById('remainRow').style.display = 'none';
        }
    }
    document.getElementById('downPayment').addEventListener('input', updateDP);

    /* ── Recalculate ── */
    function recalc() {
        const add = pkgAdd();
        const eb = document.getElementById('extraBed').checked ? extraBedPrice : 0;
        const total = (roomPrice + add + eb) * nights;
        document.getElementById('priceRoom').textContent    = fmt(roomPrice * nights);
        document.getElementById('pricePackage').textContent = fmt(add * nights);
        document.getElementById('priceExtraBed').textContent = fmt(eb * nights);
        document.getElementById('priceTotal').textContent   = fmt(total);
        updateDP();
    }

    function fmt(n) {
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    /* ── Toggle Detail Metode Pembayaran Dinamis ── */
    function togglePaymentDetails() {
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const infoBox = document.getElementById('paymentInstructions');
        
        if (method === 'cash') {
            infoBox.style.display = 'none';
            infoBox.innerHTML = '';
            return;
        }
        
        infoBox.style.display = '';
        if (method === 'qris') {
            infoBox.innerHTML = `
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white p-2 rounded border">
                        <!-- Placeholder Mock QR Code -->
                        <div class="d-flex flex-column align-items-center justify-content-center bg-dark text-white rounded font-monospace p-2 text-center" style="width:100px; height:100px; font-size:10px;">
                            <i class="bi bi-qr-code fs-2 mb-1"></i>
                            <span>GRANDSTAY</span>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#8b5e3c;"><i class="bi bi-phone-vibrate me-1"></i> QRIS Real-time Terbuka</h6>
                        <p class="mb-0 text-muted small">Silakan arahkan scanner aplikasi e-wallet tamu ke barcode simulasi di samping untuk memproses uang muka.</p>
                    </div>
                </div>
            `;
        } else if (method === 'bca') {
            infoBox.innerHTML = `
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-info-circle-fill text-primary mt-0.5"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Transfer Virtual Account BCA</h6>
                        <p class="mb-1 fw-bold text-secondary font-monospace" style="font-size:15px;">88301 0812 3456 789</p>
                        <p class="mb-0 text-muted small">Konfirmasi otomatis akan berjalan setelah dana masuk ke rekening GrandStay Luxury.</p>
                    </div>
                </div>
            `;
        } else if (method === 'mandiri') {
            infoBox.innerHTML = `
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-info-circle-fill text-warning mt-0.5"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Transfer Mandiri Bill Payment</h6>
                        <p class="mb-1 fw-bold text-secondary font-monospace" style="font-size:15px;">12377 9902 1122 334</p>
                        <p class="mb-0 text-muted small">Berikan kode bayar di atas jika tamu ingin menggunakan ATM Mandiri atau Livin'.</p>
                    </div>
                </div>
            `;
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/resepsionis/bookings/create.blade.php ENDPATH**/ ?>