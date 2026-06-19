@extends('layouts.dashboard')

@section('title', 'Laporan')
@section('page-title', 'Laporan Sistem Hotel')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}"
       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('admin.bookings') }}"
       class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
        <i class="bi bi-calendar-check"></i> Bookings
    </a>

    <a href="{{ route('admin.rooms') }}"
       class="nav-link {{ request()->routeIs('admin.rooms') ? 'active' : '' }}">
        <i class="bi bi-door-open"></i> Rooms
    </a>

    <a href="{{ route('admin.guests') }}"
       class="nav-link {{ request()->routeIs('admin.guests') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Guests
    </a>

    <a href="{{ route('admin.users') }}"
       class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Users
    </a>

    <a href="{{ route('admin.laporan') }}"
       class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
        <i class="bi bi-graph-up"></i> Laporan
    </a>
@endsection

@section('content')
@php
    // SINKRONISASI DATA UTAMA DENGAN DASHBOARD KITA SEBELUMNYA
    $totalRevenueSimulation = 154250000;
    $totalBookingsSimulation = 148;

    // Menyesuaikan array agar looping @foreach($paymentStatus as $status => $count) berjalan sempurna
    $paymentStatusSimulation = [
        'Paid' => 65,
        'DP' => 20,
        'Pending' => 10,
        'Unpaid' => 5
    ];
@endphp

<style>
    .report-card-title { font-size: 0.95rem; color: #6c757d; font-weight: 500; }
    .report-badge { padding: 0.25rem 0.6rem; border-radius: 6px; font-weight: bold; }
</style>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0" style="border-left: 4px solid #8b5e3c !important;">
            <div class="card-body">
                <h5 class="report-card-title mb-2">Total Revenue</h5>
                <h2 class="mb-0 fw-bold text-dark">Rp {{ number_format($totalRevenueSimulation, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0" style="border-left: 4px solid #a67c52 !important;">
            <div class="card-body">
                <h5 class="report-card-title mb-2">Total Bookings</h5>
                <h2 class="mb-0 fw-bold text-dark">{{ $totalBookingsSimulation }} <span class="fs-6 text-muted font-normal">Reservations</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-credit-card me-2 text-secondary"></i>Payment Status Distribution</h5>
    </div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @foreach($paymentStatusSimulation as $status => $count)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                    <span class="fw-medium text-secondary">{{ $status }}</span>
                    
                    @if($status == 'Paid')
                        <span class="badge bg-success report-badge">{{ $count }} Tx</span>
                    @elseif($status == 'DP')
                        <span class="badge bg-info text-dark report-badge">{{ $count }} Tx</span>
                    @elseif($status == 'Pending')
                        <span class="badge bg-warning text-dark report-badge">{{ $count }} Tx</span>
                    @else
                        <span class="badge bg-danger report-badge">{{ $count }} Tx</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection