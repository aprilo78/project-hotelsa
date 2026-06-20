<?php $__env->startSection('title','Struk Pembayaran'); ?>
<?php $__env->startSection('content'); ?>
<div class="struk-container">
    <div class="struk-card" id="struk-print">
        <div class="struk-header">
            <h2>DRG Hotel</h2>
            <p>Restoran & Kuliner</p>
            <hr>
        </div>

        <div class="struk-meta">
            <p><strong>No. Order:</strong> #<?php echo e(str_pad($order->id,6,'0',STR_PAD_LEFT)); ?></p>
            <p><strong>Tamu:</strong> <?php echo e($order->guest?->name ?? 'Walk-in Guest'); ?></p>
            <?php if($order->booking): ?>
            <p><strong>Kamar:</strong> <?php echo e($order->booking->room->room_number); ?></p>
            <?php endif; ?>
            <p><strong>Tanggal:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
            <p><strong>Kasir:</strong> <?php echo e($order->payment?->kasir?->name ?? '-'); ?></p>
        </div>

        <hr>

        <table class="struk-items">
            <thead>
                <tr>
                    <th>Item</th><th>Qty</th><th>Harga</th><th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($detail->menu->name); ?></td>
                    <td><?php echo e($detail->quantity); ?></td>
                    <td>Rp <?php echo e(number_format($detail->price,0,',','.')); ?></td>
                    <td>Rp <?php echo e(number_format($detail->subtotal(),0,',','.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <hr>

        <div class="struk-total">
            <div class="struk-row">
                <span>Total</span>
                <strong>Rp <?php echo e(number_format($order->total_price,0,',','.')); ?></strong>
            </div>
            <?php if($order->payment): ?>
            <div class="struk-row">
                <span>Metode</span>
                <span><?php echo e(strtoupper($order->payment->payment_method)); ?><?php echo e($order->payment->bank ? ' - '.$order->payment->bank : ''); ?></span>
            </div>
            <div class="struk-row">
                <span>Status</span>
                <span class="badge badge-success">LUNAS</span>
            </div>
            <?php endif; ?>
        </div>

        <div class="struk-footer">
            <p>Terima kasih telah menikmati hidangan kami!</p>
            <p>DRG Hotel — Selalu Melayani dengan Sepenuh Hati</p>
        </div>
    </div>

    <div class="struk-actions no-print">
        <button onclick="window.print()" class="btn btn-gold">🖨️ Cetak Struk</button>
        <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="btn btn-outline">← Kembali</a>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
@media print {
    .no-print { display: none !important; }
    .struk-card { max-width: 300px; margin: 0 auto; font-size: 12px; }
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/kasir/restoran/struk.blade.php ENDPATH**/ ?>