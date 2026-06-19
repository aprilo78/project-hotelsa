

<?php $__env->startSection('title', 'Resepsionis - Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard Resepsionis'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('resepsionis.dashboard')); ?>" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.index')); ?>" class="nav-link">
        <i class="bi bi-calendar-check"></i> Daftar Booking
    </a>
    <a href="<?php echo e(route('resepsionis.bookings.create')); ?>" class="nav-link">
        <i class="bi bi-plus-circle"></i> Booking Baru
    </a>
    <a href="<?php echo e(route('resepsionis.rooms')); ?>" class="nav-link">
        <i class="bi bi-door-open"></i> Rooms
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    // SINKRONISASI DATA OPERASIONAL HOTEL GRANDSTAY
    // Total Kamar: 50. Terisi: 38. Sisa Tersedia: 12.
    $countAvailable = 12;
    $countOccupied = 38;
    
    // Simulasi Tamu Check-in Hari Ini (Nila, Siti, Citra)
    $todayCheckInsSimulation = [
        (object)[
            'id' => 101,
            'remaining_payment' => 0,
            'user' => (object)['name' => 'Nila Aprilia'],
            'room' => (object)['room_number' => '102']
        ],
        (object)[
            'id' => 102,
            'remaining_payment' => 350000,
            'user' => (object)['name' => 'Siti Rahma'],
            'room' => (object)['room_number' => '104']
        ],
        (object)[
            'id' => 103,
            'remaining_payment' => 0,
            'user' => (object)['name' => 'Citra Dewi'],
            'room' => (object)['room_number' => '202']
        ]
    ];

    // Simulasi Tamu Check-out Hari Ini (Budi Santoso, Dimas Saputra)
    $todayCheckOutsSimulation = [
        (object)[
            'id' => 104,
            'remaining_payment' => 150000,
            'user' => (object)['name' => 'Budi Santoso'],
            'room' => (object)['room_number' => '301']
        ],
        (object)[
            'id' => 105,
            'remaining_payment' => 0,
            'user' => (object)['name' => 'Dimas Saputra'],
            'room' => (object)['room_number' => '205']
        ]
    ];

    // Simulasi Pesanan Room Service Aktif (Menu Terlaris: Risol Mayo Premium)
    $roomServiceOrdersSimulation = [
        (object)[
            'id' => 1,
            'room_number' => '102',
            'total_amount' => 75000,
            'created_at' => Carbon\Carbon::now()->subMinutes(15),
            'items' => [
                (object)['quantity' => 3, 'menu' => (object)['name' => 'Risol Mayo Premium']]
            ]
        ],
        (object)[
            'id' => 2,
            'room_number' => '202',
            'total_amount' => 45000,
            'created_at' => Carbon\Carbon::now()->subMinutes(45),
            'items' => [
                (object)['quantity' => 1, 'menu' => (object)['name' => 'Nasi Goreng Grand']]
            ]
        ]
    ];
?>

<style>
    /* 🎨 THEME COKLAT ELEGANT */
    .lux-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: 0.3s;
        background: #fff;
    }

    .lux-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .lux-title {
        color: #8b5e3c;
        font-weight: 600;
    }

    .lux-subtitle {
        color: #6c757d;
        font-size: 14px;
    }

    .lux-bg {
        background: #f8f5f1;
        border-radius: 12px;
    }

    .card-success {
        background: #a67c52 !important;
        color: white;
    }

    .card-warning {
        background: #c8a97e !important;
        color: white;
    }

    .card-info {
        background: #d2b48c !important;
        color: white;
    }

    .card-danger {
        background: #8b5e3c !important;
        color: white;
    }

    .btn-lux {
        background: #a67c52;
        color: #fff;
        border: none;
    }

    .btn-lux:hover {
        background: #8b5e3c;
        color: #fff;
    }

    .table thead {
        background: #f3e8dc;
    }

    .badge {
        border-radius: 8px;
        padding: 6px 10px;
    }

    /* Mini Calendar Mockup Style */
    .mini-calendar-box {
        background: #fcfbf9;
        border: 1px solid #f3e8dc;
        border-radius: 12px;
        padding: 15px;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        text-align: center;
        font-weight: 500;
    }
    .calendar-day {
        padding: 10px;
        border-radius: 8px;
        background: #fff;
        border: 1px solid #f1eae1;
        font-size: 0.9rem;
    }
    .calendar-day.booked {
        background: #f8d7da !important;
        color: #842029 !important;
        border-color: #f5c2c7;
        font-weight: bold;
    }
</style>

<div class="container-fluid">

    
    <div class="mb-4">
        <h2 class="lux-title">Dashboard Resepsionis</h2>
        <p class="lux-subtitle">Kelola check-in, check-out, dan status kamar</p>
    </div>

    
    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card lux-card card-success p-3 text-white">
                <h6>Tersedia</h6>
                <h2><?php echo e($countAvailable); ?></h2>
                <small>Kamar</small>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card lux-card card-warning p-3">
                <h6>Terisi</h6>
                <h2><?php echo e($countOccupied); ?></h2>
                <small>Kamar</small>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card lux-card card-info p-3">
                <h6>Check-in Hari Ini</h6>
                <h2><?php echo e(count($todayCheckInsSimulation)); ?></h2>
                <small>Tamu</small>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card lux-card card-danger p-3">
                <h6>Check-out Hari Ini</h6>
                <h2><?php echo e(count($todayCheckOutsSimulation)); ?></h2>
                <small>Tamu</small>
            </div>
        </div>

    </div>

    
    <div class="row mb-4">

        <div class="col-md-8 mb-4">
            <div class="card lux-card p-3">
                <h5 class="lux-title">Kalender Hunian Hotel</h5>
                <p class="lux-subtitle mb-3">
                    <span class="badge bg-danger text-white me-2">Merah</span> Status hunian puncak (Full Booked / High Occupancy)
                </p>

                <!-- Membuat Tampilan Kalender Visual yang Cantik & Sesuai Petunjuk -->
                <div class="mini-calendar-box">
                    <div class="calendar-grid mb-2 text-muted text-uppercase fs-7">
                        <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day text-muted">28</div><div class="calendar-day text-muted">29</div><div class="calendar-day text-muted">30</div>
                        <div class="calendar-day">1</div><div class="calendar-day">2</div><div class="calendar-day booked">3</div><div class="calendar-day booked">4</div>
                        <div class="calendar-day">5</div><div class="calendar-day">6</div><div class="calendar-day">7</div><div class="calendar-day">8</div><div class="calendar-day">9</div><div class="calendar-day booked">10</div><div class="calendar-day booked">11</div>
                        <div class="calendar-day">12</div><div class="calendar-day">13</div><div class="calendar-day">14</div><div class="calendar-day booked">15</div><div class="calendar-day booked">16</div><div class="calendar-day booked">17</div><div class="calendar-day">18</div>
                        <div class="calendar-day booked">19</div><div class="calendar-day">20</div><div class="calendar-day">21</div><div class="calendar-day">22</div><div class="calendar-day">23</div><div class="calendar-day">24</div><div class="calendar-day">25</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card lux-card mb-3 p-3">
                <h5 class="lux-title">Check-in Hari Ini</h5>

                <div style="max-height:300px; overflow-y:auto;">
                    <?php $__empty_1 = true; $__currentLoopData = $todayCheckInsSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-bottom py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo e($booking->user->name); ?></strong><br>
                                <small class="text-muted">Kamar <?php echo e($booking->room->room_number); ?></small>
                            </div>
                            <button class="btn btn-sm btn-lux" onclick="checkIn(<?php echo e($booking->id); ?>)">
                                Check-in
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted">Tidak ada check-in hari ini</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card lux-card p-3">
                <h5 class="lux-title">Check-out Hari Ini</h5>

                <div style="max-height:300px; overflow-y:auto;">
                    <?php $__empty_1 = true; $__currentLoopData = $todayCheckOutsSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-bottom py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo e($booking->user->name); ?></strong><br>
                                <small class="text-muted">Kamar <?php echo e($booking->room->room_number); ?></small><br>
                                <small class="text-success fw-bold">
                                    Sisa: Rp <?php echo e(number_format($booking->remaining_payment, 0, ',', '.')); ?>

                                </small>
                            </div>
                            <a href="#" class="btn btn-sm btn-warning">
                                Check-out
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted">Tidak ada check-out hari ini</p>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>

    
    <div class="card lux-card p-3 mb-4">
        <h5 class="lux-title">Pesanan Room Service</h5>

        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>Kamar</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $roomServiceOrdersSimulation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><span class="badge bg-secondary">Room <?php echo e($order->room_number); ?></span></td>
                        <td>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong><?php echo e($item->menu->name); ?></strong><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e(data_get($order->items, '0.quantity', 1)); ?> Porsi</td>
                        <td><span class="text-dark fw-bold">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span></td>
                        <td><code><?php echo e($order->created_at->format('H:i')); ?> WIB</code></td>
                        <td>
                            <button class="btn btn-sm btn-lux" onclick="tagToBill(<?php echo e($order->id); ?>)">
                                <i class="bi bi-receipt me-1"></i> Tag Bill
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada pesanan</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/resepsionis/dashboard.blade.php ENDPATH**/ ?>