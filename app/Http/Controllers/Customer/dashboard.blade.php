@extends('layouts.dashboard')

@section('title', 'Customer Dashboard')
@section('page-title', 'My Dashboard')

@section('sidebar')
    <a href="{{ route('customer.dashboard') }}" class="nav-link active">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="{{ route('customer.bookings') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i> My Bookings
    </a>
    <a href="{{ route('customer.new-booking') }}" class="nav-link">
        <i class="bi bi-plus-circle"></i> New Booking
    </a>
    <a href="{{ route('customer.history') }}" class="nav-link">
        <i class="bi bi-clock-history"></i> Transaction History
    </a>
    <a href="{{ route('customer.profile') }}" class="nav-link">
        <i class="bi bi-person"></i> My Profile
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Bookings</h6>
                        <h3>{{ isset($totalBookings) ? $totalBookings : 0 }}</h3>
                    </div>
                    <i class="bi bi-calendar-check fs-1 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Upcoming Stays</h6>
                       <h3>{{ $upcomingBookings ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-calendar-heart fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Spent</h6>
                        <h3>Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-wallet2 fs-1 text-warning opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6>My Recent Bookings</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr><th>Booking ID</th><th>Room</th><th>Check In</th><th>Check Out</th><th>Status</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @forelse(($recentBookings ?? []) as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td>
                                <td>{{ date('d/m/Y', strtotime($booking->check_in)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($booking->check_out)) }}</td>

                                <td>
                                <span class="status-badge status-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                </td>
                                    <a href="{{ route('customer.booking-detail', $booking->id) }}" class="btn btn-sm btn-info">View</a>
                                    @if($booking->booking_status === 'pending')
                                        <button class="btn btn-sm btn-danger" onclick="cancelBooking({{ $booking->id }})">Cancel</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center">No bookings found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6>Quick Booking</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.search-rooms') }}" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Check In</label>
                        <input type="date" name="check_in" class="form-control" required min="{{ date('Y-m-d') }}"