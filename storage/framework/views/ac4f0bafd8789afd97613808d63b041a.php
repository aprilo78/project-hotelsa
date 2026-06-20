<?php $__env->startSection('title', 'Input Pembayaran Hotel'); ?>
<?php $__env->startSection('page-title', 'Form Input Pembayaran'); ?>

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
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6>Cari Booking</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Booking ID atau Nama Tamu</label>
                    <div class="input-group">
                        <input type="text" id="searchBooking" class="form-control" placeholder="Masukkan Booking ID atau Nama">
                        <button class="btn btn-primary" onclick="searchBooking()">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </div>

                <div id="bookingResult" style="display: none;">
                    <hr>
                    <h6>Detail Booking</h6>
                    <table class="table table-bordered">
                        <tr><th>Booking ID</th><td id="bookingId"></td></tr>
                        <tr><th>Nama Tamu</th><td id="guestName"></td></tr>
                        <tr><th>Kamar</th><td id="roomNumber"></td></tr>
                        <tr><th>Check In</th><td id="checkIn"></td></tr>
                        <tr><th>Check Out</th><td id="checkOut"></td></tr>
                        <tr><th>Total Harga Kamar</th><td id="roomTotal"></td></tr>
                        <tr><th>Tagihan Restoran</th><td id="restoBill"></td></tr>
                        <tr class="table-active"><th>Grand Total</th><td id="grandTotal"></td></tr>
                        <tr><th>DP Dibayar</th><td id="dpPaid"></td></tr>
                        <tr><th>Sisa Pembayaran</th><td id="remaining"></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6>Form Pembayaran</h6>
            </div>
            <div class="card-body">
                <form id="paymentForm" method="POST" action="<?php echo e(route('kasir.hotel.payments.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="booking_id" id="selectedBookingId">
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah yang Dibayar *</label>
                        <input type="number" name="amount" id="paymentAmount" class="form-control" required step="1000">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran *</label>
                        <select name="payment_method" id="paymentMethod" class="form-select" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="cash">Cash / Tunai</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>

                    <div class="mb-3" id="bankSection" style="display: none;">
                        <label class="form-label">Bank *</label>
                        <select name="bank" class="form-select">
                            <option value="">-- Pilih Bank --</option>
                            <option value="BNI">BNI</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="BRI">BRI</option>
                            <option value="other">Lainnya</option>
                        </select>
                        <small class="text-muted">Wajib diisi jika metode transfer</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>

                    <hr>

                    <div class="alert alert-info">
                        <strong>Informasi:</strong>
                        <ul class="mb-0">
                            <li>Pembayaran DP minimal 30% dari total</li>
                            <li>Sisa pembayaran dapat dilunasi saat checkout</li>
                            <li>Setelah pembayaran sukses, sistem akan generate invoice</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-success w-100" id="submitBtn" disabled>
                        <i class="bi bi-check-circle"></i> Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let currentBooking = null;

function searchBooking() {
    let keyword = $('#searchBooking').val();
    if(!keyword) {
        alert('Masukkan Booking ID atau Nama Tamu');
        return;
    }

    $.get('<?php echo e(route("kasir.hotel.payments.search")); ?>', {q: keyword})
        .done(function(response) {
            if(response.success && response.data) {
                currentBooking = response.data;
                displayBooking(response.data);
                $('#submitBtn').prop('disabled', false);
            } else {
                alert('Booking tidak ditemukan');
                $('#bookingResult').hide();
                $('#submitBtn').prop('disabled', true);
            }
        })
        .fail(function() {
            alert('Terjadi kesalahan');
        });
}

function displayBooking(booking) {
    let grandTotal = booking.total_price + (booking.resto_bill || 0);
    let remaining = grandTotal - (booking.down_payment || 0);
    
    $('#bookingId').text('#' + booking.id);
    $('#guestName').text(booking.guest_name || booking.user_name);
    $('#roomNumber').text(booking.room_number);
    $('#checkIn').text(booking.check_in_date);
    $('#checkOut').text(booking.check_out_date);
    $('#roomTotal').text('Rp ' + formatNumber(booking.total_price));
    $('#restoBill').text('Rp ' + formatNumber(booking.resto_bill || 0));
    $('#grandTotal').text('Rp ' + formatNumber(grandTotal));
    $('#dpPaid').text('Rp ' + formatNumber(booking.down_payment || 0));
    $('#remaining').text('Rp ' + formatNumber(remaining));
    
    $('#selectedBookingId').val(booking.id);
    $('#paymentAmount').attr('max', remaining);
    $('#paymentAmount').attr('placeholder', 'Maksimal Rp ' + formatNumber(remaining));
    
    $('#bookingResult').show();
}

$('#paymentMethod').on('change', function() {
    $('#bankSection').toggle($(this).val() === 'transfer');
});

$('#paymentAmount').on('input', function() {
    let max = parseFloat($(this).attr('max'));
    let val = parseFloat($(this).val());
    if(val > max) {
        $(this).val(max);
        alert('Jumlah pembayaran melebihi sisa tagihan!');
    }
});

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/kasir/hotel/payments/create.blade.php ENDPATH**/ ?>