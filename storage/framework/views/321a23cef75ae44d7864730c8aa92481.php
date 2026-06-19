

<?php $__env->startSection('title', 'Restaurant Menus'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .menu-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: 0.3s;
        overflow: hidden;
        background: #fff;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .menu-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .title-brown {
        color: #8b5e3c;
    }

    .btn-brown {
        background: #a67c52;
        color: #fff;
        border: none;
    }

    .btn-brown:hover {
        background: #8b5e3c;
        color: #fff;
    }

    .btn-light-brown {
        background: #c8a97e;
        color: #fff;
        border: none;
    }

    .btn-light-brown:hover {
        background: #b8956b;
        color: #fff;
    }
</style>

<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 title-brown">Restaurant Menus</h3>

        <button class="btn btn-brown">
            + Add Menu
        </button>
    </div>

    
    <div class="row">

        <?php for($i = 1; $i <= 12; $i++): ?>
        <div class="col-md-3 mb-4">

            <div class="card menu-card h-100">

                
                <img src="<?php echo e(asset('images/menu'.$i.'.jpg')); ?>"
                     alt="Menu <?php echo e($i); ?>"
                     class="menu-img">

                <div class="card-body">

                    <h6 class="mb-1 title-brown">Menu <?php echo e($i); ?></h6>

                    <small class="text-muted">
                        Delicious food description
                    </small>

                    <div class="mt-2">
                        <strong class="title-brown">
                            Rp <?php echo e(number_format(rand(15000, 75000), 0, ',', '.')); ?>

                        </strong>
                    </div>

                    
                    <a href="<?php echo e(route('restaurant.order', ['id' => $i])); ?>"
                       class="btn btn-sm btn-light-brown mt-3 w-100">
                        Add Order
                    </a>

                </div>
            </div>

        </div>
        <?php endfor; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/admin/restaurant-menus.blade.php ENDPATH**/ ?>