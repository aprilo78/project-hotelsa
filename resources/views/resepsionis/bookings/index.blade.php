@extends('layouts.dashboard')

@section('title', 'Manage Bookings')
@section('page-title', 'Booking Management')

@section('sidebar')
    <a href="{{ route('resepsionis.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('resepsionis.bookings.index') }}" class="nav-link active">
        <i class="bi bi-calendar-check"></i> Daftar Booking
    </a>
    <a href="{{ route('resepsionis.bookings.create') }}" class="nav-link">
        <i class="bi bi-plus-circle"></i> Booking Baru
    </a>
    <a href="{{ route('resepsionis.rooms') }}" class="nav-link">
        <i class="bi bi-door-open"></i> Rooms
    </a>
@endsection

@section('content')
@php
    // SIMULASI DATA DAFTAR BOOKING GRANDSTAY
    $bookingsSimulation = [
        (object)[
            'id' => 101,
            'check_in_date' => '2026-06-19',
            'check_out_date' => '2026-06-21',
            'total_price' => 1200000,
            'booking_status' => 'checked_in',
            'payment_status' => 'paid',
            'guest' => (object)['name' => 'Nila Aprilia'],
            'room' => (object)['room_number' => '102']
        ],
        (object)[
            'id' => 102,
            'check_in_date' => '2026-06-19',
            'check_out_date' => '2026-06-22',
            'total_price' => 1800000,
            'booking_status' => 'confirmed',
            'payment_status' => 'partial',
            'guest' => (object)['name' => 'Siti Rahma'],
            'room' => (object)['room_number' => '104']
        ],
        (object)[
            'id' => 103,
            'check_in_date' => '2026-06-19',
            'check_out_date' => '2026-06-20',
            'total_price' => 650000,
            'booking_status' => 'confirmed',
            'payment_status' => 'paid',
            'guest' => (object)['name' => 'Citra Dewi'],
            'room' => (object)['room_number' => '202']
        ],
        (object)[
            'id' => 104,
            'check_in_date' => '2026-06-17',
            'check_out_date' => '2026-06-19',
            'total_price' => 1350000,
            'booking_status' => 'checked_in',
            'payment_status' => 'partial',
            'guest' => (object)['name' => 'Budi Santoso'],
            'room' => (object)['room_number' => '301']
        ],
        (object)[
            'id' => 105,
            'check_in_date' => '2026-06-16',
            'check_out_date' => '2026-06-19',
            'total_price' => 900000,
            'booking_status' => 'checked_out',
            'payment_status' => 'paid',
            'guest' => (object)['name' => 'Dimas Saputra'],
            'room' => (object)['room_number' => '205']
        ],
        (object)[
            'id' => 106,
            'check_in_date' => '2026-06-20',
            'check_out_date' => '2026-06-22',
            'total_price' => 2400000,
            'booking_status' => 'pending',
            'payment_status' => 'unpaid',
            'guest' => (object)['name' => 'Ahmad Fauzi'],
            'room' => (object)['room_number' => '105']
        ]
    ];

    $activeBookings = (isset($bookings) && $bookings->count() > 0) ? $bookings : $bookingsSimulation;
@endphp

<style>
    /* 🎨 THEME COKLAT LUX MINIMALIS */
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
        white-space: nowrap; /* Mencegah teks melorot atau bungkus ke bawah */
    }

    .btn-lux {
        background: #a67c52;
        color: #fff;
        border: none;
        border-radius: 8px;
    }

    .btn-lux:hover {
        background: #8b5e3c;
        color: #fff;
    }

    /* 🏷️ BADGE STATUS PASTEL (SAMA KAYA ROOMS - AMAN KESAMPING) */
    .badge-status {
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid transparent;
    }

    .status-confirmed { background-color: #f0f7f4; color: #4a7c59; border-color: #d8eae1; }
    .status-checked-in { background-color: #fff5f5; color: #bc5a5a; border-color: #fcdede; }
    .status-checked-out { background-color: #f5f5f7; color: #7a7a82; border-color: #e4e4e9; }
    .status-pending { background-color: #fefaf0; color: #b58533; border-color: #f7e9cc; }
    .status-cancelled { background-color: #faf2f2; color: #a37272; border-color: #eddada; }

    /* 🎛️ BUTTON ACTIONS SUPER MINIMALIS (Hanya Ikon, Ukuran Pas) */
    .btn-action-icon {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.15s ease;
    }

    /* Efek Elegant Tipis Saat Hover */
    .btn-action-icon:hover {
        background: #fff;
        color: #8b5e3c;
        border-color: #a67c52;
    }

    /* Efek Khusus Hapus / Sampah */
    .btn-action-danger:hover {
        background: #fff5f5;
        color: #e53e3e;
        border-color: #feb2b2;
    }
</style>

<div class="card lux-card">
<div class="card-header d-flex justify-content-between align-items-center bg-transparent border-0 pt-4 px-4">
    <h4 class="lux-title mb-0">Booking List</h4>
    <a href="{{ route('resepsionis.bookings.create') }}" class="btn btn-lux btn-sm">
        <i class="bi bi-plus-circle me-1"></i> New Booking
    </a>
</div>

<div class="card-body px-4 pb-4">
<div class="table-responsive">
<table class="table align-middle" id="bookingsTable">

<thead>
<tr>
    <th style="width: 70px;">ID</th>
    <th>Guest</th>
    <th>Room</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Total</th>
    <th>Status</th>
    <th>Payment</th>
    <th class="text-end pe-3" style="width: 130px;">Actions</th>
</tr>
</thead>

<tbody>
@foreach($activeBookings as $booking)
<tr>

<td><span class="text-muted fw-medium">#{{ $booking->id }}</span></td>

<td><strong>{{ $booking->guest->name ?? $booking->user->name ?? '-' }}</strong></td>

<td><span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px;">Room {{ $booking->room->room_number }}</span></td>

<td><span class="text-secondary font-monospace" style="font-size: 12.5px;">{{ $booking->check_in_date }}</span></td>
<td><span class="text-secondary font-monospace" style="font-size: 12.5px;">{{ $booking->check_out_date }}</span></td>

<td><span class="fw-bold text-dark">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span></td>

{{-- STATUS MENGIKUTI GAYA MINIMALIS ROOMS --}}
<td>
    @if($booking->booking_status == 'checked_in')
        <span class="badge-status status-checked-in">
            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Checked In
        </span>
    @elseif($booking->booking_status == 'confirmed')
        <span class="badge-status status-confirmed">
            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Confirmed
        </span>
    @elseif($booking->booking_status == 'checked_out')
        <span class="badge-status status-checked-out">
            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Checked Out
        </span>
    @elseif($booking->booking_status == 'cancelled')
        <span class="badge-status status-cancelled">
            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Cancelled
        </span>
    @else
        <span class="badge-status status-pending">
            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Pending
        </span>
    @endif
</td>

<td>
    @if($booking->payment_status == 'paid')
        <span class="text-success small fw-medium"><i class="bi bi-check-circle-fill"></i> Paid</span>
    @elseif($booking->payment_status == 'partial')
        <span class="text-warning small fw-medium"><i class="bi bi-exclamation-circle-fill"></i> Partial</span>
    @else
        <span class="text-danger small fw-medium"><i class="bi bi-x-circle-fill"></i> Unpaid</span>
    @endif
</td>

{{-- BAGIAN ACTIONS HANYA IKON (MATA, KELUAR/ALUR, TEMPAT SAMPAH) --}}
<td class="text-end pe-2">
<div class="d-inline-flex gap-1">

    {{-- IKON MATA (DETAIL MODAL) --}}
    <button class="btn-action-icon"
        data-bs-toggle="modal"
        data-bs-target="#viewModal{{ $booking->id }}" title="View Detail">
        <i class="bi bi-eye"></i>
    </button>

    {{-- IKON ALUR MASUK / KELUAR / CONFIRM --}}
    @if($booking->booking_status == 'pending')
    <button class="btn-action-icon" onclick="confirmBooking({{ $booking->id }})" title="Confirm Booking">
        <i class="bi bi-check2"></i>
    </button>
    @endif

    @if($booking->booking_status == 'confirmed')
    <button class="btn-action-icon" onclick="checkIn({{ $booking->id }})" title="Check In">
        <i class="bi bi-box-arrow-in-right"></i>
    </button>
    @endif

    @if($booking->booking_status == 'checked_in')
    <button class="btn-action-icon" onclick="checkOut({{ $booking->id }})" title="Check Out">
        <i class="bi bi-box-arrow-right"></i>
    </button>
    @endif

    {{-- IKON TEMPAT SAMPAH (CANCEL BOOKING) --}}
    @if(!in_array($booking->booking_status, ['checked_out','cancelled']))
    <button class="btn-action-icon btn-action-danger" onclick="cancelBooking({{ $booking->id }})" title="Cancel Booking">
        <i class="bi bi-trash"></i>
    </button>
    @endif

</div>
</td>

</tr>
@endforeach
</tbody>

</table>
</div>

@if(isset($bookings) && method_exists($bookings, 'links'))
    <div class="mt-3">
        {{ $bookings->links() }}
    </div>
@endif

</div>
</div>

{{-- MODAL DETAIL --}}
@foreach($activeBookings as $booking)
<div class="modal fade" id="viewModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content" style="border-radius:12px;">
<div class="modal-header border-0 pt-4 px-4">
    <h5 class="lux-title mb-0">Detail Booking #{{ $booking->id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body px-4 pb-4">
    <div class="p-3 bg-light rounded-3">
        <p class="mb-1 text-muted fs-7">Nama Tamu</p>
        <h6 class="fw-bold mb-3">{{ $booking->guest->name ?? $booking->user->name ?? '-' }}</h6>
        
        <div class="row">
            <div class="col-6">
                <p class="mb-1 text-muted fs-7">Nomor Kamar</p>
                <h6 class="fw-bold">Kamar {{ $booking->room->room_number }}</h6>
            </div>
            <div class="col-6">
                <p class="mb-1 text-muted fs-7">Total Bayar</p>
                <h6 class="fw-bold text-success">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h6>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
function postAction(url, msg){
    if(!confirm(msg)) return;

    fetch(url, {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        }
    }).then(()=>location.reload());
}

function confirmBooking(id){
    postAction('/resepsionis/bookings/'+id+'/confirm','Confirm booking?');
}

function checkIn(id){
    postAction('/resepsionis/bookings/'+id+'/check-in','Check-in?');
}

function checkOut(id){
    window.location.href='/resepsionis/checkout/'+id;
}

function cancelBooking(id){
    postAction('/resepsionis/bookings/'+id+'/cancel','Cancel?');
}
</script>
@endpush