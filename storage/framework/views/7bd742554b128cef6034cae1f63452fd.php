<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="<?php echo e(route('admin.bookings')); ?>" class="nav-link">
        <i class="bi bi-calendar-check"></i> Bookings
    </a>
    <a href="<?php echo e(route('admin.rooms')); ?>" class="nav-link">
        <i class="bi bi-door-open"></i> Rooms
    </a>
    <a href="<?php echo e(route('admin.guests')); ?>" class="nav-link">
        <i class="bi bi-people"></i> Guests
    </a>
    <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">
        <i class="bi bi-person-badge"></i> Users
    </a>
    <a href="<?php echo e(route('admin.laporan')); ?>" class="nav-link">
        <i class="bi bi-graph-up"></i> Laporan
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    // MENYUNTIKKAN DATA SIMULASI AGAR TIDAK NOL LAGI
    $totalBookings = 148;
    $monthlyBookings = 42;
    $totalRevenue = 154250000;
    $monthlyRevenue = 48500000;
    $occupancyRate = 76;
    $occupiedRooms = 38;
    $totalRooms = 50;
    $totalOrders = 320;
    $todayOrders = 14;

    $revenueLabels = [
        date('d M', strtotime('-6 days')), 
        date('d M', strtotime('-5 days')), 
        date('d M', strtotime('-4 days')), 
        date('d M', strtotime('-3 days')), 
        date('d M', strtotime('-2 days')), 
        date('d M', strtotime('-1 days')), 
        date('d M',  strtotime('now'))
    ];
    // Data grafik naik turun sengaja dibuat fluktuatif
    $revenueData = [5200000, 8900000, 4200000, 11500000, 6300000, 14200000, 9500000];

    $menuLabels = ['Risol Mayo Premium', 'Nasi Goreng Grand', 'Ice Lychee Tea', 'Kopi Susu Aren', 'Club Sandwich'];
    $menuData = [120, 85, 95, 110, 45];
    $paymentDistribution = [65, 20, 10, 5];

    // Simulasi data tamu terbaru
    $recentBookings = [
        (object)['booking_status' => 'confirmed', 'guest' => (object)['name' => 'Nila Aprilia'], 'room' => (object)['room_number' => '102']],
        (object)['booking_status' => 'pending', 'guest' => (object)['name' => 'Dimas Saputra'], 'room' => (object)['room_number' => '205']],
        (object)['booking_status' => 'confirmed', 'guest' => (object)['name' => 'Siti Rahma'], 'room' => (object)['room_number' => '104']],
        (object)['booking_status' => 'cancelled', 'guest' => (object)['name' => 'Budi Santoso'], 'room' => (object)['room_number' => '301']],
        (object)['booking_status' => 'confirmed', 'guest' => (object)['name' => 'Citra Dewi'], 'room' => (object)['room_number' => '202']]
    ];
?>

    <style>
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 50rem; font-size: 0.85rem; font-weight: 500; }
        .status-confirmed { background-color: #d1e7dd; color: #0f5132; }
        .status-pending { background-color: #fff3cd; color: #664d03; }
        .status-cancelled { background-color: #f8d7da; color: #842029; }
    </style>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-stats text-white" style="background:#a67c52;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">Total Bookings</h6>
                            <h3 class="mb-0"><?php echo e($totalBookings); ?></h3>
                        </div>
                        <i class="bi bi-calendar-check fs-1 opacity-50"></i>
                    </div>
                    <small>This month: <?php echo e($monthlyBookings); ?></small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats text-white" style="background:#8b5e3c;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">Revenue</h6>
                            <h3 class="mb-0">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></h3>
                        </div>
                        <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                    </div>
                    <small>This month: Rp <?php echo e(number_format($monthlyRevenue, 0, ',', '.')); ?></small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats text-white" style="background:#c8a97e;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">Occupancy Rate</h6>
                            <h3 class="mb-0"><?php echo e($occupancyRate); ?>%</h3>
                        </div>
                        <i class="bi bi-building fs-1 opacity-50"></i>
                    </div>
                    <small><?php echo e($occupiedRooms); ?> / <?php echo e($totalRooms); ?> rooms occupied</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats text-white" style="background:#d2b48c;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">Restaurant Orders</h6>
                            <h3 class="mb-0"><?php echo e($totalOrders); ?></h3>
                        </div>
                        <i class="bi bi-cup-straw fs-1 opacity-50"></i>
                    </div>
                    <small>Today: <?php echo e($todayOrders); ?></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Revenue Chart (Last 7 Days)</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Recent Bookings</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?php echo e($booking->guest->name ?? 'Guest'); ?></strong>
                                        <br>
                                        <small>Room <?php echo e($booking->room->room_number); ?></small>
                                    </div>
                                    <span class="status-badge status-<?php echo e($booking->booking_status); ?>">
                                        <?php echo e(ucfirst($booking->booking_status)); ?>

                                    </span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Top Selling Menu</h6>
                    <a href="<?php echo e(route('admin.restaurant-menus')); ?>" class="btn btn-sm btn-outline-primary">Manage</a>
                </div>
                <div class="card-body">
                    <canvas id="topMenuChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Payment Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="paymentChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Revenue Chart dengan Tren Naik Turun yang Jelas
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($revenueLabels); ?>,
            datasets: [{
                label: 'Revenue (Rp)',
                data: <?php echo json_encode($revenueData); ?>,
                borderColor: '#a67c52',
                backgroundColor: 'rgba(166, 124, 82, 0.2)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#8b5e3c',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Top Menu Chart
    const menuCtx = document.getElementById('topMenuChart').getContext('2d');
    new Chart(menuCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($menuLabels); ?>,
            datasets: [{
                label: 'Quantity Sold',
                data: <?php echo json_encode($menuData); ?>,
                backgroundColor: '#c8a97e',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Payment Chart
    const payCtx = document.getElementById('paymentChart').getContext('2d');
    new Chart(payCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'DP', 'Pending', 'Unpaid'],
            datasets: [{
                data: <?php echo json_encode($paymentDistribution); ?>,
                backgroundColor: ['#a67c52', '#c8a97e', '#d8b98a', '#8b5e3c']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>