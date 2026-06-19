@extends('layouts.dashboard')

@section('title', 'Invoices')

{{-- ── SIDEBAR (SUDAH DIPERBAIKI TAG YANG COPLOK) ── --}}
@section('sidebar')
    <a href="{{ route('kasir.hotel.dashboard') }}"
       class="nav-link {{ request()->routeIs('kasir.hotel.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('kasir.hotel.payments.index') }}"
       class="nav-link {{ request()->routeIs('kasir.hotel.payments.*') ? 'active' : '' }}">
        <i class="bi bi-cash-stack"></i> Input Pembayaran
    </a> {{-- 💡 FIX: Tag penutup </a> tadi hilang di sini, sekarang sudah aman --}}

    <a href="{{ route('kasir.hotel.invoices.index') }}"
       class="nav-link active">
        <i class="bi bi-receipt"></i> Invoice
    </a>

    <a href="{{ route('kasir.hotel.transactions.history') }}"
       class="nav-link {{ request()->routeIs('kasir.hotel.transactions.*') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Riwayat Transaksi
    </a>
@endsection

{{-- ── KONTEN UTAMA TABLE LUX MINIMALIS ── --}}
@section('content')
@php
    // 💡 SIMULASI DATA INVOICE (SINKRON DENGAN DATA TRANSAKSI SEBELUMNYA)
    $invoicesSimulation = [
        (object)[
            'id' => 3001, // No Invoice
            'booking_id' => 101,
            'amount' => 1200000,
            'payment_status' => 'paid',
            'created_at' => '10 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Nila Aprilia'],
                'check_in_date' => '10 Jun 2026',
                'check_out_date' => '12 Jun 2026',
                'booking_status' => 'checked_out'
            ]
        ],
        (object)[
            'id' => 3002,
            'booking_id' => 102,
            'amount' => 1800000,
            'payment_status' => 'paid',
            'created_at' => '11 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Siti Rahma'],
                'check_in_date' => '11 Jun 2026',
                'check_out_date' => '14 Jun 2026',
                'booking_status' => 'checked_out'
            ]
        ],
        (object)[
            'id' => 3003,
            'booking_id' => 105,
            'amount' => 900000,
            'payment_status' => 'paid',
            'created_at' => '15 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Dimas Saputra'],
                'check_in_date' => '15 Jun 2026',
                'check_out_date' => '17 Jun 2026',
                'booking_status' => 'checked_out'
            ]
        ],
        (object)[
            'id' => 3004,
            'booking_id' => 106,
            'amount' => 2400000,
            'payment_status' => 'pending',
            'created_at' => '19 Jun 2026',
            'booking' => (object)[
                'guest' => (object)['name' => 'Ahmad Fauzi'],
                'check_in_date' => '19 Jun 2026',
                'check_out_date' => '22 Jun 2026',
                'booking_status' => 'checked_in'
            ]
        ]
    ];

    $activePayments = (isset($payments) && $payments->count() > 0) ? $payments : $invoicesSimulation;
@endphp

<style>
    /* 🎨 THEME COKLAT LUX GRANDSTAY */
    .lux-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.04);
        background: #fff;
    }

    .lux-title {
        color: #8b5e3c;
        font-weight: 600;
    }

    .table thead {
        background: #fdfbf9;
        color: #8b5e3c;
        border-bottom: 2px solid #f3e8dc;
        font-size: 13px;
    }

    .table tbody tr td {
        font-size: 13.5px;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background: #fdfbf9;
    }

    /* 🏷️ STATUS BOOKING PASTEL */
    .badge-booking-status {
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .book-checked_out { background-color: #f1f3f5; color: #495057; border: 1px solid #dee2e6; }
    .book-checked_in { background-color: #fff5f5; color: #bc5a5a; border: 1px solid #fcdede; }

    /* 🏷️ STATUS INVOICE PASTEL */
    .badge-status {
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid transparent;
        text-transform: uppercase;
    }
    .status-paid { background-color: #f0f7f4; color: #4a7c59; border-color: #d8eae1; }
    .status-pending { background-color: #fefaf0; color: #b58533; border-color: #f7e9cc; }

    /* 🔘 BUTTON DETAIL MINIMALIS */
    .btn-lux-detail {
        background-color: #fdfbf9;
        color: #8b5e3c;
        border: 1px solid #f3e8dc;
        border-radius: 8px;
        font-weight: 500;
        font-size: 12.5px;
        transition: all 0.2s ease;
    }
    .btn-lux-detail:hover {
        background-color: #8b5e3c;
        color: #fff;
        border-color: #8b5e3c;
    }
</style>

<div class="container-fluid px-0">

    <div class="card lux-card">
        <div class="card-header bg-transparent border-0 pt-4 px-4">
            <h4 class="lux-title mb-0"><i class="bi bi-receipt me-2"></i>Data Invoice Tagihan</h4>
        </div>
        
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 120px;">ID Booking</th>
                            <th style="width: 120px;">No. Invoice</th>
                            <th>Nama Tamu</th>
                            <th>Periode Menginap</th>
                            <th>Status Booking</th>
                            <th>Total Tagihan</th>
                            <th>Status Invoice</th>
                            <th>Tanggal Cetak</th>
                            <th style="width: 100px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activePayments as $p)
                        <tr>
                            {{-- 1. ID Booking --}}
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace" style="font-size: 11.5px; border-radius: 6px;">
                                    BK-{{ $p->booking_id }}
                                </span>
                            </td>

                            {{-- 2. No. Invoice --}}
                            <td><span class="text-muted font-monospace fw-medium">#INV-{{ $p->id }}</span></td>
                            
                            {{-- 3. Nama Tamu --}}
                            <td><strong>{{ $p->booking->guest->name ?? '-' }}</strong></td>

                            {{-- 4. Periode Menginap --}}
                            <td class="font-monospace text-secondary" style="font-size: 12.5px;">
                                {{ $p->booking->check_in_date ?? '-' }} <i class="bi bi-arrow-right mx-1"></i> {{ $p->booking->check_out_date ?? '-' }}
                            </td>

                            {{-- 5. Status Keberadaan Tamu --}}
                            <td>
                                @if(isset($p->booking->booking_status))
                                    <span class="badge-booking-status book-{{ $p->booking->booking_status }}">
                                        {{ str_replace('_', ' ', $p->booking->booking_status) }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted">-</span>
                                @endif
                            </td>
                            
                            {{-- 6. Total Tagihan --}}
                            <td><span class="fw-bold text-dark">Rp {{ number_format($p->amount, 0, ',', '.') }}</span></td>

                            {{-- 7. Status Pembayaran Invoice --}}
                            <td>
                                @if(strtolower($p->payment_status) == 'paid')
                                    <span class="badge-status status-paid">
                                        <i class="bi bi-check-circle-fill" style="font-size: 6px;"></i> PAID
                                    </span>
                                @else
                                    <span class="badge-status status-pending">
                                        <i class="bi bi-hourglass-split" style="font-size: 6px;"></i> PENDING
                                    </span>
                                @endif
                            </td>

                            {{-- 8. Tanggal Cetak Invoice --}}
                            <td class="text-secondary font-monospace">
                                {{ is_string($p->created_at) ? $p->created_at : $p->created_at->format('d M Y') }}
                            </td>

                            {{-- 9. Tombol Aksi Detail --}}
                            <td class="text-center">
                                <a href="{{ route('kasir.hotel.invoices.show', $p->id) }}"
                                   class="btn btn-sm btn-lux-detail px-3">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Tidak ada data invoice resmi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($payments) && method_exists($payments, 'links'))
            <div class="mt-3">
                {{ $payments->links() }}
            </div>
            @endif

        </div>
    </div>

</div>
@endsection