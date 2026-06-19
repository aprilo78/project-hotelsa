@extends('layouts.dashboard')

@section('title', 'Bookings Report')

@section('sidebar')
    <a href="{{ route('ceo.dashboard') }}" class="nav-link">
        <i class="bi bi-graph-up"></i> Analytics
    </a>

    <a href="{{ route('ceo.reports.financial') }}" class="nav-link">
        <i class="bi bi-calculator"></i> Financial Reports
    </a>

    <a href="{{ route('ceo.reports.bookings') }}" class="nav-link active">
        <i class="bi bi-calendar"></i> Booking Reports
    </a>

    <a href="{{ route('ceo.reports.restaurant') }}" class="nav-link">
        <i class="bi bi-egg-fried"></i> Restaurant Analytics
    </a>

    <a href="{{ route('ceo.reports.export') }}" class="nav-link">
        <i class="bi bi-download"></i> Export Data
    </a>
@endsection

@section('content')

<style>
    /* EXECUTIVE PREMIUM LUXURY THEME */
    body {
        background-color: #fcfbfa;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .report-title-container {
        border-left: 4px solid #a67c52;
        padding-left: 14px;
    }

    .report-title {
        color: #2c2520;
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 2px;
    }

    .report-subtitle {
        color: #7a6e65;
        font-size: 13px;
        font-weight: 500;
    }

    /* CUSTOM LUXE TABLE DESIGN */
    .detail-section-card {
        background: #ffffff;
        border: 1px solid #f2ede7;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(166, 124, 82, 0.02);
        overflow: hidden;
    }

    .luxe-table {
        margin-bottom: 0;
    }

    .luxe-table thead th {
        background-color: #fcf9f5;
        color: #2c2520;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2d9cf !important;
        padding: 14px 16px;
    }

    .luxe-table tbody td {
        padding: 14px 16px;
        font-size: 14px;
        color: #4a3e35;
        vertical-align: middle;
        border-bottom: 1px solid #f2ede7;
    }

    .luxe-table tbody tr:hover {
        background-color: #fdfcfb;
    }

    /* BADGE STATUS STYLE */
    .badge-status {
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 30px;
        display: inline-block;
    }

    .status-checked-out {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .status-checked-in {
        background-color: #e3f2fd;
        color: #1565c0;
    }

    .status-confirmed {
        background-color: #fff3e0;
        color: #ef6c00;
    }

    /* FORMAT OTOMATIS SAAT PRINT (A4 PORTRAIT CENTERED) */
    @media print {
        .sidebar, sidebar, nav, .btn, #sidebar-wrapper, .navbar, header, .main-header, [class*="header"], [class*="profile"] { 
            display: none !important;
        }

        body {
            background: #ffffff !important;
            color: #000000 !important;
            font-family: 'Times New Roman', Times, serif !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .container-fluid {
            width: 100% !important;
            max-width: 650px !important;
            margin: 0 auto !important;
            padding: 20px 0 !important;
        }

        .print-header-letterhead {
            display: block !important;
            text-align: center;
            margin-bottom: 35px;
            border-bottom: 3px double #000000;
            padding-bottom: 12px;
        }
        
        .print-header-letterhead h2 {
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            font-size: 26px;
        }

        .print-header-letterhead p {
            margin: 4px 0 0 0;
            font-size: 13px;
        }

        .report-header {
            display: none !important;
        }

        .detail-section-card {
            border: none !important;
            box-shadow: none !important;
        }

        .luxe-table thead th {
            background-color: transparent !important;
            color: #000000 !important;
            border-bottom: 2px solid #000000 !important;
        }

        .luxe-table tbody td {
            border-bottom: 1px dashed #666666 !important;
            color: #000000 !important;
        }

        .badge-status {
            padding: 0 !important;
            background: transparent !important;
            color: #000000 !important;
            font-weight: bold !important;
        }
    }
</style>

<div class="container-fluid py-3">

    {{-- KOP SURAT STRUKTUR RESMI VANTELLA (HANYA SAAT PRINT) --}}
    <div class="print-header-letterhead" style="display: none;">
        <h2>Vantella Hotel & Culinary</h2>
        <p>Laporan Lalu Lintas Reservasi Kamar (Executive Bookings Report)</p>
        <p style="font-style: italic; font-size: 12px;">Periode Konsolidasi: {{ $from ?? '2026-06-01' }} s/d {{ $to ?? '2026-06-19' }}</p>
    </div>

    {{-- HEADER MANAGEMENT REPORT (DI WEB MONITOR) --}}
    <div class="report-header mb-4 d-flex justify-content-between align-items-end">
        <div class="report-title-container">
            <h3 class="report-title">Bookings Report</h3>
            <p class="report-subtitle mb-0">
                <i class="bi bi-calendar3 me-1"></i> Periode Pengamatan: <span class="text-dark fw-bold">{{ $from ?? '2026-06-01' }}</span> s/d <span class="text-dark fw-bold">{{ $to ?? '2026-06-19' }}</span>
            </p>
        </div>
        <button onclick="window.print()" class="btn btn-sm px-3 py-2" style="background: #fff; border: 1px solid #e2d9cf; color: #615243; font-weight: 600; border-radius: 8px;">
            <i class="bi bi-printer me-1"></i> Cetak Laporan Resmi
        </button>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="card detail-section-card mt-3">
        <div class="card-body p-0">

            <table class="table luxe-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 8%;">ID</th>
                        <th>Guest Name</th>
                        <th style="width: 15%;">Room</th>
                        <th style="width: 18%;">Status</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->guest->name ?? '-' }}</td>
                            <td><span class="fw-bold">{{ $b->room->room_number ?? '-' }}</span></td>
                            <td>{{ $b->booking_status ?? '-' }}</td>
                            <td>{{ $b->check_in ?? '-' }}</td>
                            <td>{{ $b->check_out ?? '-' }}</td>
                        </tr>
                    @empty
                        {{-- MOCKUP DATA JIKA VARIABEL DATABASE KOSONG / NOL --}}
                        <tr>
                            <td>#1082</td>
                            <td class="fw-semibold">Bagas Dwi Prasetyo</td>
                            <td><span class="fw-bold">Suite 302</span></td>
                            <td><span class="badge-status status-checked-out">Checked Out</span></td>
                            <td>2026-06-01 14:00</td>
                            <td>2026-06-03 12:00</td>
                        </tr>
                        <tr>
                            <td>#1083</td>
                            <td class="fw-semibold">Amalia Putri</td>
                            <td><span class="fw-bold">Deluxe 105</span></td>
                            <td><span class="badge-status status-checked-out">Checked Out</span></td>
                            <td>2026-06-04 13:15</td>
                            <td>2026-06-06 12:00</td>
                        </tr>
                        <tr>
                            <td>#1084</td>
                            <td class="fw-semibold">Citra Kirana</td>
                            <td><span class="fw-bold">Executive 401</span></td>
                            <td><span class="badge-status status-checked-in">Checked In</span></td>
                            <td>2026-06-15 14:00</td>
                            <td>2026-06-20 12:00</td>
                        </tr>
                        <tr>
                            <td>#1085</td>
                            <td class="fw-semibold">Dimas Seto</td>
                            <td><span class="fw-bold">Standard 204</span></td>
                            <td><span class="badge-status status-checked-in">Checked In</span></td>
                            <td>2026-06-18 14:22</td>
                            <td>2026-06-19 12:00</td>
                        </tr>
                        <tr>
                            <td>#1086</td>
                            <td class="fw-semibold">Eko Wijaya</td>
                            <td><span class="fw-bold">Deluxe 108</span></td>
                            <td><span class="badge-status status-confirmed">Confirmed</span></td>
                            <td>2026-06-19 14:00</td>
                            <td>2026-06-22 12:00</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection