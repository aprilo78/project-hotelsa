@extends('layouts.dashboard')

@section('title', 'Cari Kamar')
@section('page-title', 'Cari Kamar')

@section('sidebar')
    <a href="{{ route('customer.dashboard') }}" class="nav-link">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="{{ route('customer.bookings') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i> My Bookings
    </a>
    <a href="{{ route('customer.new-booking') }}" class="nav-link active">
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

<style>
.search-header{
    background:#1A1A2E;
    color:#fff;
    padding:18px 22px;
    border-radius:14px;
    margin-bottom:24px;
}

.search-header small{ color:#C9A84C; }

.refine-box{
    background:#fffaf5;
    border:1px solid #EDE8DC;
    border-radius:14px;
    padding:18px;
    margin-bottom:24px;
}

.room-card{
    background:#fff;
    border-radius:14px;
    border:1px solid #EDE8DC;
    overflow:hidden;
    transition:.2s;
}
.room-card:hover{
    box-shadow:0 10px 25px rgba(0,0,0,0.09);
    transform:translateY(-2px);
}

.room-img{
    width:100%;
    height:170px;
    object-fit:cover;
}

.room-img-placeholder{
    width:100%;
    height:170px;
    background:linear-gradient(135deg,#f5efe6,#ede3d3);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#C9A84C;
    font-size:2.5rem;
}

.price{
    color:#C9A84C;
    font-weight:700;
    font-size:1.1rem;
}

.btn-gold{
    background:#C9A84C;
    color:#1A1A2E;
    border-radius:8px;
    padding:7px 18px;
    font-weight:600;
    border:none;
    font-size:.85rem;
    white-space:nowrap;
}
.btn-gold:hover{ background:#b8962e; }

.feature-tag{
    display:inline-block;
    background:#f5efe6;
    color:#8B6B4A;
    border-radius:6px;
    padding:2px 8px;
    font-size:.72rem;
    font-weight:600;
    margin-right:4px;
    margin-top:4px;
}

.form-control-sm{
    border:1px solid #e0d6c8;
    border-radius:8px;
    background:#fff;
    padding:6px 10px;
    font-size:.85rem;
}
</style>

{{-- SEARCH HEADER --}}
<div class="search-header">
    <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
        <div>
            <strong style="font-size:1rem">Hasil Pencarian Kamar</strong>
            @if(request('check_in') && request('check_out'))
            <div class="mt-1">
                <small>
                    <i class="bi bi-calendar2-check me-1"></i>
                    {{ \Carbon\Carbon::parse(request('check_in'))->format('d M Y') }}
                    →
                    {{ \Carbon\Carbon::parse(request('check_out'))->format('d M Y') }}
                    @php
                        $searchNights = \Carbon\Carbon::parse(request('check_in'))->diffInDays(\Carbon\Carbon::parse(request('check_out')));
                    @endphp
                    ({{ $searchNights }} malam)
                </small>
                @if(request('guests'))
                <small class="ms-3">
                    <i class="bi bi-people me-1"></i>{{ request('guests') }} tamu
                </small>
                @endif
            </div>
            @endif
        </div>

        {{-- QUICK REFINE --}}
        <form action="{{ route('customer.search-rooms') }}" method="GET"
              class="d-flex gap-2 flex-wrap align-items-end">
            <div>
                <div style="font-size:.7rem;color:#aaa;margin-bottom:2px">Check-in</div>
                <input type="date" name="check_in" class="form-control-sm"
                       value="{{ request('check_in') }}"
                       style="background:#fff;color:#1A1A2E;border:none;border-radius:8px">
            </div>
            <div>
                <div style="font-size:.7rem;color:#aaa;margin-bottom:2px">Check-out</div>
                <input type="date" name="check_out" class="form-control-sm"
                       value="{{ request('check_out') }}"
                       style="background:#fff;color:#1A1A2E;border:none;border-radius:8px">
            </div>
            <div>
                <div style="font-size:.7rem;color:#aaa;margin-bottom:2px">Tamu</div>
                <input type="number" name="guests" class="form-control-sm"
                       value="{{ request('guests', 1) }}" min="1" max="10"
                       style="background:#fff;color:#1A1A2E;border:none;border-radius:8px;width:70px">
            </div>
            <button class="btn-gold" style="padding:7px 16px">
                <i class="bi bi-arrow-clockwise me-1"></i>Perbarui
            </button>
        </form>
    </div>
</div>

@php
    $rooms = $rooms ?? collect();
@endphp

@if($rooms->isEmpty())

    <div class="text-center py-5"
         style="background:#fffaf5;border-radius:14px;border:1px solid #ede8dc">
        <i class="bi bi-door-closed fs-2 text-muted d-block mb-3 opacity-50"></i>
        <h6 style="color:#1A1A2E;font-weight:700">Tidak ada kamar tersedia</h6>
        <p class="text-muted" style="font-size:.85rem">
            Tidak ada kamar yang tersedia pada tanggal yang dipilih.<br>
            Coba ubah tanggal atau kurangi jumlah tamu.
        </p>
        <a href="{{ route('customer.dashboard') }}"
           class="btn mt-2"
           style="background:#C9A84C;color:#1A1A2E;border-radius:8px;font-weight:600;padding:8px 20px">
            Cari Tanggal Lain
        </a>
    </div>

@else

    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted" style="font-size:.85rem">
            <strong style="color:#1A1A2E">{{ $rooms->count() }}</strong> kamar ditemukan
        </span>
    </div>

    <div class="d-flex flex-column gap-3">

        @foreach($rooms as $room)

        @php
            $nights = max(1, \Carbon\Carbon::parse(request('check_in'))->diffInDays(\Carbon\Carbon::parse(request('check_out'))));
            $totalRoom = $room->price * $nights;
        @endphp

        <div class="room-card">
            <div class="row g-0 align-items-stretch">

                {{-- IMAGE --}}
                <div class="col-md-3">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}"
                             class="room-img h-100"
                             style="border-radius:14px 0 0 14px"
                             alt="{{ $room->name ?? 'Room' }}">
                    @else
                        <div class="room-img-placeholder" style="border-radius:14px 0 0 14px">
                            <i class="bi bi-building"></i>
                        </div>
                    @endif
                </div>

                {{-- INFO --}}
                <div class="col-md-6 p-3 d-flex flex-column justify-content-between">
                    <div>
                        <h6 style="font-weight:700;color:#1A1A2E;margin-bottom:4px">
                            Kamar {{ $room->room_number }}
                            <span style="font-weight:400;color:#888;font-size:.85rem">
                                · {{ $room->roomType->name ?? '' }}
                            </span>
                        </h6>

                        <p class="text-muted mb-2" style="font-size:.82rem">
                            <i class="bi bi-people me-1"></i>Kapasitas {{ $room->capacity ?? 2 }} orang
                            @if($room->floor ?? false)
                                <span class="mx-1">·</span>
                                <i class="bi bi-layers me-1"></i>Lantai {{ $room->floor }}
                            @endif
                        </p>

                        {{-- FEATURES --}}
                        <div class="mb-2">
                            <span class="feature-tag"><i class="bi bi-wifi"></i> WiFi</span>
                            <span class="feature-tag"><i class="bi bi-snow"></i> AC</span>
                            <span class="feature-tag"><i class="bi bi-tv"></i> TV</span>
                            @if($room->has_breakfast ?? false)
                            <span class="feature-tag"><i class="bi bi-cup-hot"></i> Sarapan</span>
                            @endif
                        </div>

                        @if($room->description ?? false)
                        <p class="text-muted" style="font-size:.8rem;margin:0">
                            {{ Str::limit($room->description, 100) }}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- PRICE + CTA --}}
                <div class="col-md-3 p-3 d-flex flex-column justify-content-between align-items-end"
                     style="border-left:1px solid #f0eae0">

                    <div class="text-end">
                        <div class="price">
                            Rp {{ number_format($room->price, 0, ',', '.') }}
                        </div>
                        <small class="text-muted d-block">/malam</small>

                        @if($nights > 1)
                        <div class="mt-2" style="font-size:.78rem;color:#888">
                            {{ $nights }} malam =
                        </div>
                        <div style="font-weight:700;color:#1A1A2E;font-size:.95rem">
                            Rp {{ number_format($totalRoom, 0, ',', '.') }}
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('customer.new-booking') }}?room_id={{ $room->id }}&check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&guests={{ request('guests', 1) }}"
                       class="btn-gold mt-3 d-inline-block text-center"
                       style="text-decoration:none;width:100%">
                        Pilih Kamar
                    </a>

                </div>

            </div>
        </div>

        @endforeach

    </div>

@endif

@endsection