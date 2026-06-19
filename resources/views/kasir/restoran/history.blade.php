@extends('layouts.dashboard')

@section('title', 'Riwayat Transaksi Restoran')

{{-- SIDEBAR --}}
@section('sidebar')
    <a href="{{ route('kasir.restoran.dashboard') }}"
       class="nav-link {{ request()->routeIs('kasir.restoran.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('kasir.restoran.pos') }}"
       class="nav-link {{ request()->routeIs('kasir.restoran.pos') ? 'active' : '' }}">
        <i class="bi bi-cart"></i> POS
    </a>

    <a href="{{ route('kasir.restoran.orders.index') }}"
       class="nav-link {{ request()->routeIs('kasir.restoran.orders.*') ? 'active' : '' }}">
        <i class="bi bi-list-check"></i> Orders
    </a>

    <a href="{{ route('kasir.restoran.history') }}"
       class="nav-link {{ request()->routeIs('kasir.restoran.history') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> History
    </a>
@endsection

@section('content')
<style>
    /* LUXURY PREMIUM THEME INTEGRATION */
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

    /* PREMIUM CARD & FILTERS */
    .filter-card {
        background: #ffffff;
        border: 1px solid #f2ede7;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(166, 124, 82, 0.03);
    }

    .form-label-luxury {
        font-size: 12px;
        font-weight: 600;
        color: #615243;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-luxury {
        border: 1px solid #e2d9cf;
        border-radius: 8px;
        padding: 10px;
        font-size: 13px;
        color: #4a3f35;
        background-color: #fff;
    }

    .form-control-luxury:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.12);
        outline: none;
    }

    /* PREMIUM GOLD BUTTONS */
    .btn-gold {
        background: #a67c52;
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .btn-gold:hover {
        background: #8b5e3c;
        color: #fff;
    }

    .btn-outline-gold {
        border: 1px solid #c8a97e;
        color: #a67c52;
        background: #fff;
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        padding: 5px 12px;
        transition: all 0.2s;
    }

    .btn-outline-gold:hover {
        background: #a67c52;
        color: #fff;
    }

    /* OMSET BANNER LUXURY */
    .omset-card {
        background: linear-gradient(135deg, #2c2520 0%, #4a3e35 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(44, 37, 32, 0.15);
        color: #ffffff;
    }

    .omset-title {
        color: #d4b795;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .omset-value {
        color: #fcf9f5;
        font-weight: 700;
        font-size: 28px;
    }

    /* DATA TABLE LUXURY */
    .table-container {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(166, 124, 82, 0.04);
        border: 1px solid #f2ede7;
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #fcf9f5;
        color: #615243;
        font-weight: 600;
        padding: 16px;
        font-size: 13px;
        text-transform: uppercase;
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

    /* BADGE METHOD */
    .method-badge {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .method-cash { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
    .method-qris { background-color: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
    .method-bank { background-color: #f3e5f5; color: #6a1b9a; border: 1px solid #e1bee7; }
</style>

<div class="container-fluid py-2">

    <!-- HEADER (Badge Arsip Resto Berhasil Dihapus) -->
    <div class="mb-4">
        <h4 class="mb-0 style-heading">Riwayat Penjualan Restoran</h4>
        <small class="text-muted">Laporan rekaman jejak seluruh transaksi pembayaran kasir kuliner</small>
    </div>

    {{-- FILTER TANGGAL REALTIME --}}
    <div class="card filter-card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label form-label-luxury"><i class="bi bi-calendar-event me-1"></i> Dari Tanggal</label>
                <input type="date" id="historyFromDate" class="form-control form-control-luxury" onchange="filterRiwayatOmsetRealtime()">
            </div>

            <div class="col-md-4">
                <label class="form-label form-label-luxury"><i class="bi bi-calendar-check me-1"></i> Sampai Tanggal</label>
                <input type="date" id="historyToDate" class="form-control form-control-luxury" onchange="filterRiwayatOmsetRealtime()">
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-gold w-100" onclick="resetFilterHistoryLokal()">
                    <i class="bi bi-arrow-clockwise me-1"></i> Tampilkan Semua Data
                </button>
            </div>
        </div>
    </div>

    {{-- TOTAL INDIKATOR OMSET --}}
    <div class="card omset-card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <span class="omset-title d-block mb-1"><i class="bi bi-calculator-fill me-1"></i> Ringkasan Omset Penjualan (Periode Terpilih)</span>
                <h2 class="omset-value mb-0" id="omsetDisplayTotal">Rp 0</h2>
            </div>
            <div class="p-3 rounded-circle" style="background: rgba(212, 183, 149, 0.15); border: 1px solid rgba(212, 183, 149, 0.3);">
                <i class="bi bi-graph-up-arrow fs-2" style="color: #d4b795;"></i>
            </div>
        </div>
    </div>

    {{-- TABLE RIWAYAT MURNI RESTORAN --}}
    <div class="table-container mb-4">
        <div class="table-responsive">
            <table class="data-table" id="historyTable">
                <thead>
                    <tr>
                        <th class="ps-4">ID Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Metode Pembayaran</th>
                        <th class="text-end">Total Pembayaran</th>
                        <th class="text-center">Tanggal & Jam Transaksi</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $simulatedPayments = [
                            ['id' => 2001, 'customer_name' => 'Bpk. Aryo Seto', 'method' => 'cash', 'amount' => 75000, 'date' => '2026-06-19', 'time' => '11:15'],
                            ['id' => 2002, 'customer_name' => 'Ibu Dian Lestari', 'method' => 'qris', 'amount' => 64000, 'date' => '2026-06-19', 'time' => '10:30'],
                            ['id' => 2003, 'customer_name' => 'Mr. Johnathan Smith', 'method' => 'bank', 'amount' => 125000, 'date' => '2026-06-15', 'time' => '19:45'],
                            ['id' => 2004, 'customer_name' => 'Keluarga Wijaya', 'method' => 'qris', 'amount' => 177000, 'date' => '2026-06-02', 'time' => '13:20'],
                            ['id' => 2005, 'customer_name' => 'Rian & Amalia', 'method' => 'cash', 'amount' => 108000, 'date' => '2026-05-28', 'time' => '20:10'],
                            ['id' => 2006, 'customer_name' => 'Ibu Citra Kirana', 'method' => 'bank', 'amount' => 95000, 'date' => '2026-05-10', 'time' => '08:45']
                        ];
                    @endphp

                    @foreach($simulatedPayments as $p)
                    <tr class="history-row-item" data-tanggal="{{ $p['date'] }}" data-nominal="{{ $p['amount'] }}">
                        <td class="ps-4 fw-bold" style="color: #a67c52;">#{{ $p['id'] }}</td>
                        <td>
                            <span class="fw-bold text-dark">{{ $p['customer_name'] }}</span>
                        </td>
                        <td>
                            @if($p['method'] == 'cash')
                                <span class="method-badge method-cash"><i class="bi bi-cash-stack"></i> Cash</span>
                            @elseif($p['method'] == 'qris')
                                <span class="method-badge method-qris"><i class="bi bi-qr-code-scan"></i> QRIS</span>
                            @else
                                <span class="method-badge method-bank"><i class="bi bi-bank"></i> Bank Transfer</span>
                            @endif
                        </td>
                        <td class="text-end fw-bold" style="color: #2c2520;">
                            Rp {{ number_format($p['amount'], 0, ',', '.') }}
                        </td>
                        <td class="text-center text-muted" style="font-size: 13px;">
                            <div>{{ date('d M Y', strtotime($p['date'])) }}</div>
                            <small style="font-size: 11px;"><i class="bi bi-clock"></i> Pukul {{ $p['time'] }} WIB</small>
                        </td>
                        <td class="text-center pe-4">
                            <button type="button" class="btn btn-sm btn-outline-gold" onclick="simulasiCetakStrukUlang({{ $p['id'] }}, '{{ $p['customer_name'] }}', '{{ $p['method'] }}', {{ $p['amount'] }}, '{{ $p['date'] }} {{ $p['time'] }}')">
                                <i class="bi bi-printer-fill me-1"></i> Struk
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    <tr id="historyNoDataRow" style="display: none;">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2" style="color:#e2d9cf;"></i>
                            Tidak ada rekaman data transaksi penjualan pada rentang tanggal tersebut.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- JAVASCRIPT CONTROL --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        hitungUlangOmset();
    });

    function filterRiwayatOmsetRealtime() {
        let fromDateStr = document.getElementById('historyFromDate').value;
        let toDateStr = document.getElementById('historyToDate').value;

        let fromDate = fromDateStr ? new Date(fromDateStr) : null;
        let toDate = toDateStr ? new Date(toDateStr) : null;

        if (toDate) toDate.setHours(23, 59, 59, 999);

        let rows = document.querySelectorAll('.history-row-item');
        let dataDitemukan = false;

        rows.forEach(row => {
            let rowTanggal = new Date(row.getAttribute('data-tanggal'));

            let cocok = true;
            if (fromDate && rowTanggal < fromDate) cocok = false;
            if (toDate && rowTanggal > toDate) cocok = false;

            if (cocok) {
                row.style.display = "";
                dataDitemukan = true;
            } else {
                row.style.display = "none";
            }
        });

        document.getElementById('historyNoDataRow').style.display = dataDitemukan ? "none" : "";
        hitungUlangOmset();
    }

    function hitungUlangOmset() {
        let rows = document.querySelectorAll('.history-row-item');
        let totalOmset = 0;

        rows.forEach(row => {
            if (row.style.display !== "none") {
                let nominal = parseInt(row.getAttribute('data-nominal')) || 0;
                totalOmset += nominal;
            }
        });

        document.getElementById('omsetDisplayTotal').innerText = "Rp " + totalOmset.toLocaleString('id-ID');
    }

    function resetFilterHistoryLokal() {
        document.getElementById('historyFromDate').value = "";
        document.getElementById('historyToDate').value = "";

        let rows = document.querySelectorAll('.history-row-item');
        rows.forEach(row => {
            row.style.display = "";
        });

        document.getElementById('historyNoDataRow').style.display = "none";
        hitungUlangOmset();
    }

    function simulasiCetakStrukUlang(id, nama, metode, nominal, waktu) {
        let strukWindow = window.open('', '_blank', 'width=350,height=500');
        strukWindow.document.write(`
            <html>
            <head>
                <title>Salinan Struk POS</title>
                <style>
                    body { font-family: 'Courier New', monospace; width: 280px; margin: 0 auto; padding: 10px; font-size: 13px; }
                    .center { text-align: center; }
                    .bold { font-weight: bold; }
                    .line { border-top: 1px dashed #000; margin: 10px 0; }
                </style>
            </head>
            <body>
                <div class="center">
                    <span class="bold" style="font-size:15px;">GRANDSTAY HOTEL</span><br>
                    <span>Salinan Riwayat Transaksi</span>
                </div>
                <div class="line"></div>
                <div>
                    <span>Order ID : #${id}</span><br>
                    <span>Pelanggan: ${nama}</span><br>
                    <span>Metode   : ${metode.toUpperCase()}</span><br>
                    <span>Waktu    : ${waktu}</span>
                </div>
                <div class="line"></div>
                <table style="width:100%; font-weight:bold;">
                    <tr>
                        <td>TOTAL AMBIL:</td>
                        <td style="text-align:right;">Rp ${nominal.toLocaleString('id-ID')}</td>
                    </tr>
                </table>
                <div class="line"></div>
                <div class="center" style="font-size:11px; margin-top:15px;">
                    [ STATUS: LUNAS ]<br>
                    Dokumen ini sah dicetak dari arsip data.
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
    }
</script>
@endsection