

<?php $__env->startSection('title', 'CEO Executive Dashboard'); ?>
<?php $__env->startSection('page-title', 'Executive Management Analytics'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(route('ceo.dashboard')); ?>" class="nav-link active">
        <i class="bi bi-graph-up"></i> Analytics
    </a>
    <a href="<?php echo e(route('ceo.reports.financial')); ?>" class="nav-link">
        <i class="bi bi-calculator"></i> Financial Reports
    </a>
    <a href="<?php echo e(route('ceo.reports.bookings')); ?>" class="nav-link">
        <i class="bi bi-calendar"></i> Booking Reports
    </a>
    <a href="<?php echo e(route('ceo.reports.restaurant')); ?>" class="nav-link">
        <i class="bi bi-egg-fried"></i> Restaurant Analytics
    </a>
    <a href="<?php echo e(route('ceo.reports.export')); ?>" class="nav-link">
        <i class="bi bi-download"></i> Export Data
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* LUXURY PREMIUM CORE THEME */
    body {
        background-color: #fcfbfa;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .style-heading {
        font-size: 24px;
        font-weight: 700;
        color: #2c2520;
        border-left: 4px solid #a67c52;
        padding-left: 12px;
    }

    /* PREMIUM STAT CARDS WITH GRADIENT LUXE */
    .card-stats-luxury {
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #2c2520 0%, #4a3e35 100%);
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(44, 37, 32, 0.08);
        transition: transform 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .card-stats-luxury:hover {
        transform: translateY(-3px);
    }

    .card-stats-luxury .card-icon-bg {
        position: absolute;
        right: 15px;
        bottom: 10px;
        font-size: 3.5rem;
        color: rgba(212, 183, 149, 0.12);
        line-height: 1;
    }

    .stat-label {
        color: #d4b795;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 700;
        color: #fcf9f5;
    }

    /* ANALYTICS CHARTS CARDS */
    .chart-card-luxury {
        background: #ffffff;
        border: 1px solid #f2ede7;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(166, 124, 82, 0.03);
    }

    .chart-card-luxury .card-header {
        background: #fcf9f5 !important;
        border-bottom: 1px solid #f2ede7 !important;
        padding: 14px 20px;
    }

    .chart-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #2c2520;
        margin-bottom: 0;
    }

    /* KPI TABLE RE-DESIGN */
    .kpi-table-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f2ede7;
        box-shadow: 0 4px 15px rgba(166, 124, 82, 0.03);
        overflow: hidden;
    }

    .kpi-table th {
        background: #fcf9f5;
        color: #615243;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #f2ede7;
        padding: 14px 20px;
    }

    .kpi-table td {
        padding: 14px 20px;
        font-size: 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f8f5f0;
    }

    .badge-luxury-success {
        background-color: #e8f5e9;
        color: #1b5e20;
        border: 1px solid #a5d6a7;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
    }

    .badge-luxury-warning {
        background-color: #fff3e0;
        color: #e65100;
        border: 1px solid #ffcc80;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
    }

    .form-select-luxury {
        border: 1px solid #e2d9cf;
        border-radius: 8px;
        color: #4a3f35;
        font-weight: 600;
        background-color: #fff;
    }
</style>

<div class="container-fluid py-2">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 style-heading">Laporan Eksekutif Tahun <strong>2026</strong></h4>
            <small class="text-muted">Data Analitik Terkonsolidasi per <?php echo e(now()->format('d M Y')); ?></small>
        </div>
        <form method="GET" action="" class="d-flex gap-2">
            <select name="year" class="form-select form-select-sm form-select-luxury px-3 py-1.5" onchange="this.form.submit()">
                <option value="2026" selected>Tahun 2026</option>
                <option value="2025">Tahun 2025</option>
                <option value="2024">Tahun 2024</option>
            </select>
        </form>
    </div>

    
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-stats-luxury h-100 p-2">
                <div class="card-body">
                    <span class="stat-label d-block mb-1">Total Gabungan Revenue</span>
                    <h3 class="stat-value mb-1">Rp 12.000.000</h3>
                    <small style="color: #69f0ae;"><i class="bi bi-graph-up-arrow"></i> +12.4% vs bulan lalu</small>
                    <div class="card-icon-bg"><i class="bi bi-wallet2"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats-luxury h-100 p-2">
                <div class="card-body">
                    <span class="stat-label d-block mb-1">Hotel Rooms Revenue</span>
                    <h3 class="stat-value mb-1">Rp 15.000.000</h3>
                    <small style="color: #d4b795;"><i class="bi bi-building-check"></i> Performa Kamar Utama</small>
                    <div class="card-icon-bg"><i class="bi bi-door-open"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats-luxury h-100 p-2">
                <div class="card-body">
                    <span class="stat-label d-block mb-1">Culinary & Resto Revenue</span>
                    <h3 class="stat-value mb-1">Rp 18.000.000</h3>
                    <small style="color: #d4b795;"><i class="bi bi-egg-fried"></i> Penjualan Makanan & Minuman</small>
                    <div class="card-icon-bg"><i class="bi bi-receipt-cutoff"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-stats-luxury h-100 p-2">
                <div class="card-body">
                    <span class="stat-label d-block mb-1">Average Order Value</span>
                    <h3 class="stat-value mb-1">Rp 20.000</h3>
                    <small style="color: #69f0ae;"><i class="bi bi-arrow-up-right"></i> Nilai rata-rata per transaksi</small>
                    <div class="card-icon-bg"><i class="bi bi-cart-check"></i></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col-md-8 mb-3">
            <div class="card chart-card-luxury h-100">
                <div class="card-header">
                    <h6 class="chart-card-title"><i class="bi bi-activity text-gold-price me-1"></i> Tren Fluktuasi Pendapatan Harian (Naik Turun Realistis)</h6>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 300px;">
                        <canvas id="revenueTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card chart-card-luxury h-100">
                <div class="card-header">
                    <h6 class="chart-card-title"><i class="bi bi-pie-chart-fill text-gold-price me-1"></i> Komposisi Kontribusi Finansial (Lingkaran)</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="position: relative; width:100%; height:260px;">
                        <canvas id="revenueBreakdownChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card chart-card-luxury h-100">
                <div class="card-header">
                    <h6 class="chart-card-title"><i class="bi bi-bar-chart-line-fill text-gold-price me-1"></i> Traffic Volume Penjualan Top 5 Menu</h6>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 280px;">
                        <canvas id="topMenuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card chart-card-luxury h-100">
                <div class="card-header">
                    <h6 class="chart-card-title"><i class="bi bi-calendar3-range text-gold-price me-1"></i> Traffic Kamar Terbooking Per Bulan</h6>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 280px;">
                        <canvas id="bookingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card kpi-table-container">
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="chart-card-title mb-0"><i class="bi bi-shield-check text-gold-price me-1"></i> Key Performance Indicators (KPI Executive)</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table kpi-table mb-0">
                    <thead>
                        <tr>
                            <th>Metrik Strategis Hotel</th>
                            <th>Nilai Saat Ini (Aktual)</th>
                            <th>Target Perusahaan</th>
                            <th>Status Performa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold text-dark">Occupancy Rate (Tingkat Hunian)</td>
                            <td><strong style="color: #a67c52;">78.5%</strong></td>
                            <td>75.0%</td>
                            <td><span class="badge-luxury-success">✅ Target Tercapai</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Average Daily Rate (ADR)</td>
                            <td><strong>Rp 545.000</strong></td>
                            <td>Rp 500.000</td>
                            <td><span class="badge-luxury-success">✅ Target Tercapai</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Revenue Per Available Room (RevPAR)</td>
                            <td><strong>Rp 427.800</strong></td>
                            <td>Rp 350.000</td>
                            <td><span class="badge-luxury-success">✅ Target Tercapai</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-dark">Restaurant Table Turnover Ratio</td>
                            <td><strong>3.4x / Hari</strong></td>
                            <td>3.0x / Hari</td>
                            <td><span class="badge-luxury-success">✅ Efisien & Optimal</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ── 1. TREND FLUKTUASI HARIAN (Naik Turun sesuai Tanggal 1 s/d 10) ──
    new Chart(document.getElementById('revenueTrendChart'), {
        type: 'line',
        data: {
            labels: ['Tgl 1', 'Tgl 2', 'Tgl 3', 'Tgl 4', 'Tgl 5', 'Tgl 6', 'Tgl 7', 'Tgl 8', 'Tgl 9', 'Tgl 10'],
            datasets: [
                {
                    label: 'Pendapatan Restoran (Rupiah)',
                    // Mengikuti contoh instruksi: tanggal 1 agak menurun, tanggal 2 naik, lalu fluktuatif dinamis
                    data: [1200000, 2500000, 1400000, 2900000, 1800000, 3100000, 1600000, 2200000, 3500000, 2100000],
                    borderColor: '#a67c52',
                    backgroundColor: 'rgba(166, 124, 82, 0.08)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointBackgroundColor: '#2c2520'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        callback: v => 'Rp ' + v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });

    // ── 2. KOMPOSISI KONTRIBUSI FINANSIAL (Bentuk Lingkaran/Doughnut) ──
    new Chart(document.getElementById('revenueBreakdownChart'), {
        type: 'doughnut',
        data: {
            labels: ['Hotel Rooms', 'Culinary / Resto', 'Gabungan / Lainnya'],
            datasets: [{
                data: [15000000, 18000000, 12000000], // Sesuai angka input stat cards
                backgroundColor: ['#2c2520', '#a67c52', '#d4b795'],
                borderWidth: 2,
                borderColor: '#ffffff'
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

    // ── 3. TOP 5 MENU TERLARIS TRAFFIC BAR ──
    new Chart(document.getElementById('topMenuChart'), {
        type: 'bar',
        data: {
            labels: ['Nasi Goreng', 'Mie Goreng Premium', 'Kwetiau Sapi', 'Matcha Latte', 'Es Kopi Aren'],
            datasets: [{
                label: 'Jumlah Terjual (Porsi)',
                data: [450, 380, 310, 240, 190], // Data traffic bernilai padat
                backgroundColor: '#a67c52',
                hoverBackgroundColor: '#2c2520',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y'
        }
    });

    // ── 4. TRAFFIC KAMAR TERBOOKING PER BULAN (Naik Turun Bergelombang) ──
    new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Kamar Terjual',
                data: [150, 240, 180, 310, 220, 450, 490, 320, 280, 410, 390, 550], // Naik turun dinamis
                borderColor: '#2c2520',
                backgroundColor: 'rgba(44, 37, 32, 0.04)',
                tension: 0.35,
                fill: true,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project-hotel-saapp\resources\views/ceo/dashboard.blade.php ENDPATH**/ ?>