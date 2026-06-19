@extends('layouts.dashboard')

@section('title', 'Rooms')

@section('sidebar')
    <a href="{{ route('resepsionis.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('resepsionis.bookings.index') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i> Daftar Booking
    </a>
    <a href="{{ route('resepsionis.bookings.create') }}" class="nav-link">
        <i class="bi bi-plus-circle"></i> Booking Baru
    </a>
    <a href="{{ route('resepsionis.rooms') }}" class="nav-link active">
        <i class="bi bi-door-open"></i> Rooms
    </a>
@endsection

@section('content')
@php
    // SIMULASI DATA KAMAR GRANDSTAY (SINKRON DENGAN DATA TRANSACTIONS)
    $roomsSimulation = [
        (object)[
            'room_number' => '101',
            'status' => 'available',
            'roomType' => (object)['name' => 'Standard Room']
        ],
        (object)[
            'room_number' => '102',
            'status' => 'occupied',
            'roomType' => (object)['name' => 'Standard Room']
        ],
        (object)[
            'room_number' => '103',
            'status' => 'available',
            'roomType' => (object)['name' => 'Standard Room']
        ],
        (object)[
            'room_number' => '104',
            'status' => 'occupied',
            'roomType' => (object)['name' => 'Standard Room']
        ],
        (object)[
            'room_number' => '201',
            'status' => 'dirty',
            'roomType' => (object)['name' => 'Deluxe Room']
        ],
        (object)[
            'room_number' => '202',
            'status' => 'occupied',
            'roomType' => (object)['name' => 'Deluxe Room']
        ],
        (object)[
            'room_number' => '205',
            'status' => 'maintenance',
            'roomType' => (object)['name' => 'Deluxe Room']
        ],
        (object)[
            'room_number' => '301',
            'status' => 'occupied',
            'roomType' => (object)['name' => 'Suite Room']
        ],
        (object)[
            'room_number' => '302',
            'status' => 'available',
            'roomType' => (object)['name' => 'Suite Room']
        ]
    ];

    $activeRooms = (isset($rooms) && count($rooms) > 0) ? $rooms : $roomsSimulation;
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
    }

    /* 🏷️ TAMPILAN BADGE STATUS PASTEL / SOFT */
    .badge-status {
        border-radius: 20px; /* Diubah melingkar penuh agar lebih estetik dan tidak kaku */
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid transparent;
    }

    /* Hijau Sage Lembut */
    .status-available {
        background-color: #f0f7f4;
        color: #4a7c59;
        border-color: #d8eae1;
    }

    /* Terracotta / Merah Muda Muted */
    .status-occupied {
        background-color: #fff5f5;
        color: #bc5a5a;
        border-color: #fcdede;
    }

    /* Kuning Gandum Hangat */
    .status-dirty {
        background-color: #fefaf0;
        color: #b58533;
        border-color: #f7e9cc;
    }

    /* Abu-abu Warm Taupe Kalem */
    .status-maintenance {
        background-color: #f5f5f7;
        color: #7a7a82;
        border-color: #e4e4e9;
    }
</style>

<div class="card lux-card">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h4 class="lux-title mb-0"><i class="bi bi-door-open-fill me-2"></i>Room Status List</h4>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="table-responsive">
            <table class="table align-middle" id="roomsTable">
                <thead>
                    <tr>
                        <th style="width: 80px;">No</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th style="width: 200px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeRooms as $room)
                    <tr>
                        <td><span class="text-muted fw-medium">{{ $loop->iteration }}</span></td>
                        <td>
                            <span class="badge bg-light text-dark border px-3 py-2 fw-bold fs-6" style="border-radius: 8px;">
                                {{ $room->room_number }}
                            </span>
                        </td>
                        <td>
                            <strong class="text-dark">{{ $room->roomType->name ?? '-' }}</strong>
                        </td>
                        <td>
                            @if(strtolower($room->status) == 'available')
                                <span class="badge-status status-available">
                                    <i class="bi bi-circle-fill" style="font-size: 7px;"></i> Available
                                </span>
                            @elseif(strtolower($room->status) == 'occupied')
                                <span class="badge-status status-occupied">
                                    <i class="bi bi-circle-fill" style="font-size: 7px;"></i> Occupied
                                </span>
                            @elseif(strtolower($room->status) == 'dirty')
                                <span class="badge-status status-dirty">
                                    <i class="bi bi-circle-fill" style="font-size: 7px;"></i> Dirty
                                </span>
                            @else
                                <span class="badge-status status-maintenance">
                                    <i class="bi bi-circle-fill" style="font-size: 7px;"></i> Maintenance
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection