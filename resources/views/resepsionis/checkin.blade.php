@extends('layouts.dashboard')

@section('title', 'Check In')
@section('page-title', 'Check In')

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
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h3>Halaman Check-In</h3>
            <p>Fitur check-in resepsionis siap digunakan.</p>
        </div>
    </div>
</div>
@endsection