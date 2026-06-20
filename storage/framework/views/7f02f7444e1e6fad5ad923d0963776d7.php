<?php $__env->startSection('title','Create Order'); ?>
<?php $__env->startSection('page-title','Input Pesanan Baru'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('kasir.restoran.pos')); ?>" class="nav-link">
        <i class="bi bi-cart"></i> POS
    </a>
    <a href="<?php echo e(route('kasir.restoran.order.create')); ?>" class="nav-link active">
        <i class="bi bi-plus-circle"></i> Create Order
    </a>
    <a href="<?php echo e(route('kasir.restoran.history')); ?>" class="nav-link">
        <i class="bi bi-clock-history"></i> History
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
    .box{
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:16px;
        background:#fff;
        margin-bottom:16px;
    }

    .title{
        font-weight:600;
        font-size:14px;
        margin-bottom:10px;
    }

    .menu-row{
        display:flex;
        gap:10px;
        align-items:center;
    }

    .qty-input{
        width:120px;
    }

    .hint{
        font-size:12px;
        color:#6b7280;
    }
</style>

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Buat Pesanan Baru</h5>
        </div>

        <div class="card-body">

            <form action="<?php echo e(route('kasir.restoran.order.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="box">
                    <div class="title">Nama Pelanggan</div>
                    <input type="text" name="customer_name" class="form-control" placeholder="Masukkan nama pelanggan atau nomor meja (e.g., Meja 05)" value="<?php echo e(old('customer_name')); ?>" required>
                </div>

                
                <div class="box">
                    <div class="title">Menu Restoran</div>

                    <div class="menu-row">

                        
                        <select class="form-select" id="menuSelect">
                            <option value="">-- Pilih Menu --</option>
                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($menu->id); ?>" data-name="<?php echo e($menu->name); ?>" data-price="<?php echo e($menu->price); ?>">
                                    <?php echo e($menu->name); ?> - Rp <?php echo e(number_format($menu->price,0,',','.')); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        
                        <input type="number" class="form-control qty-input" id="qtyInput" placeholder="Qty" min="1">

                        
                        <button type="button" class="btn btn-primary" onclick="addMenu()">
                            Tambah
                        </button>

                    </div>

                    <div class="hint mt-2">
                        Pilih menu terlebih dahulu lalu masukkan jumlah
                    </div>

                    
                    <div id="menuList" class="mt-3"></div>

                </div>

                
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?php echo e(route('kasir.restoran.dashboard')); ?>" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Pesanan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
function addMenu() {
    let select = document.getElementById('menuSelect');
    let qty = document.getElementById('qtyInput');
    let list = document.getElementById('menuList');

    if (!select.value || qty.value < 1) {
        alert('Pilih menu dan isi qty');
        return;
    }

    let id = select.value;
    let name = select.options[select.selectedIndex].dataset.name;
    let price = select.options[select.selectedIndex].dataset.price;

    let row = `
        <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
            <div>
                <strong>${name}</strong><br>
                <small>Rp ${Number(price).toLocaleString('id-ID')}</small>
            </div>

            <div>
                <input type="hidden" name="items[${id}][menu_id]" value="${id}">
                <input type="number" name="items[${id}][qty]" value="${qty.value}" class="form-control form-control-sm" style="width:80px;">
            </div>
        </div>
    `;

    list.innerHTML += row;

    qty.value = '';
    select.value = '';
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/kasir/restoran/create_order.blade.php ENDPATH**/ ?>