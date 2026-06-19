@extends('layouts.dashboard')

@section('title', 'New Booking')
@section('page-title', 'New Booking')

{{-- SIDEBAR --}}
@section('sidebar')
    <a href="{{ route('customer.dashboard') }}"
       class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i> Dashboard
    </a>

    <a href="{{ route('customer.bookings') }}"
       class="nav-link {{ request()->routeIs('customer.bookings') ? 'active' : '' }}">
        <i class="bi bi-calendar-check"></i> My Bookings
    </a>

    <a href="{{ route('customer.new-booking') }}"
       class="nav-link {{ request()->routeIs('customer.new-booking') ? 'active' : '' }}">
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

{{-- FLATPICKR CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
.card-box {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #EDE8DC;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

.input-style {
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    padding: 10px 12px;
    width: 100%;
    font-size: 0.9rem;
}

.label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #6B7280;
    margin-bottom: 4px;
}

.btn-gold {
    background: #C9A84C;
    color: #1A1A2E;
    border-radius: 8px;
    padding: 8px 18px;
    font-size: 0.85rem;
    font-weight: 600;
}

.summary-box {
    border-radius: 14px;
    border: 1px solid #EDE8DC;
    background: #FAF7F2;
}
</style>

<div class="row g-4">

    {{-- FORM --}}
    <div class="col-lg-8">
        <div class="card-box p-4">

            <h6 style="font-weight:700;color:#1A1A2E;margin-bottom:16px">
                Form Booking
            </h6>

            <form action="{{ route('customer.bookings.store') }}" method="POST" class="d-flex flex-column gap-3">
            @csrf

                {{-- PILIH KAMAR --}}
@php
    $groupedRooms = collect($rooms ?? [])->groupBy('type');

    if ($groupedRooms->isEmpty()) {
        $groupedRooms = collect([
            'Deluxe' => [
                (object)['id' => 1, 'name' => 'Kamar A', 'price' => 500000],
                (object)['id' => 2, 'name' => 'Kamar B', 'price' => 550000],
            ],
            'Standard' => [
                (object)['id' => 3, 'name' => 'Kamar A', 'price' => 300000],
                (object)['id' => 4, 'name' => 'Kamar B', 'price' => 350000],
            ],
            'Premium' => [
                (object)['id' => 5, 'name' => 'Kamar Suite', 'price' => 900000],
            ]
        ]);
    }
@endphp

<div>
    <div class="label" style="font-weight: 600; margin-bottom: 8px; color: #333;">Pilih Kamar</div>

    <select name="room_id" id="roomSelect" class="input-style" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 14px; background-color: #fff; cursor: pointer;">
        <option value="" disabled selected hidden>-- Silahkan Pilih Kamar --</option>
        
        @foreach($groupedRooms as $type => $group)
            @foreach($group as $room)
                {{-- Data harga tetap disimpan di dalam atribut data-price, tapi teks harganya dihapus dari tampilan pilihan --}}
                <option 
                    value="{{ $room->id }}"
                    data-name="[{{ ucwords($type) }}] {{ $room->name }}"
                    data-price="{{ $room->price }}"
                >
                    [{{ ucwords($type) }}] {{ $room->name }}
                </option>
            @endforeach
        @endforeach
    </select>
</div>

<input type="hidden" name="booking_type" value="room_only">

            {{-- TAMPILKAN HARGA --}}
            <div style="margin-top:10px;">
                <div class="label">Harga</div>
                <input 
                    type="text" 
                    id="priceDisplay" 
                    class="input-style" 
                    readonly 
                    placeholder="Harga akan muncul otomatis"
                >
            </div>

                {{-- TANGGAL --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="label">Check-in</div>
                        <input type="text" id="check_in" name="check_in" class="input-style">
                    </div>
                    <div class="col-md-6">
                        <div class="label">Check-out</div>
                        <input type="text" id="check_out" name="check_out" class="input-style">
                    </div>
                </div>

                {{-- TAMU --}}
                <div>
                    <div class="label">Jumlah Tamu</div>
                    <input type="number" id="guestInput" name="guests" value="1" min="1" class="input-style">
                </div>

                {{-- CATATAN --}}
                <div>
                    <div class="label">Catatan</div>
                    <textarea name="notes" rows="3" class="input-style"></textarea>
                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-between align-items-center mt-2">
                    
                    {{-- BUTTON KEMBALI --}}
                    <a href="{{ route('customer.dashboard') }}" class="btn-gold">
                        Kembali
                    </a>

                    <a href="{{ route('customer.history') }}" class="btn-gold">
                        Booking Sekarang
                    </a>

                </div>

            </form>

        </div>
    </div>

    {{-- SUMMARY --}}
    <div class="col-lg-4">
        <div class="summary-box p-4">

            <h6 style="font-weight:700;color:#1A1A2E;margin-bottom:14px">
                Ringkasan Booking
            </h6>

            <div class="d-flex flex-column gap-2 text-muted" style="font-size:.85rem">

                <div class="d-flex justify-content-between">
                    <span>Kamar</span>
                    <span id="summaryRoom">-</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Check-in</span>
                    <span id="summaryCheckIn">-</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Check-out</span>
                    <span id="summaryCheckOut">-</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Tamu</span>
                    <span id="summaryGuests">1</span>
                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between" style="font-weight:700">
                <span>Total</span>
                <span id="summaryTotal" style="color:#C9A84C">Rp 0</span>
            </div>

        </div>
    </div>

</div>

{{-- INTEGRASI JAVASCRIPT & KALENDER --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua elemen form dan ringkasan
    const roomSelect = document.getElementById('roomSelect');
    const priceDisplay = document.getElementById('priceDisplay');
    const guestInput = document.getElementById('guestInput');
    
    const summaryRoom = document.getElementById('summaryRoom');
    const summaryCheckIn = document.getElementById('summaryCheckIn');
    const summaryCheckOut = document.getElementById('summaryCheckOut');
    const summaryGuests = document.getElementById('summaryGuests');
    const summaryTotal = document.getElementById('summaryTotal');

    let roomPrice = 0;
    let totalNights = 0;

    // Fungsi format rupiah
    function formatRupiah(number) {
        return "Rp " + new Intl.NumberFormat('id-ID').format(number);
    }

    // Fungsi hitung total akhir (Harga per malam x jumlah malam)
    function calculateTotal() {
        if (roomPrice > 0 && totalNights > 0) {
            let totalCost = roomPrice * totalNights;
            summaryTotal.innerText = formatRupiah(totalCost);
        } else {
            summaryTotal.innerText = "Rp 0";
        }
    }

    // Aksi saat memilih kamar
    roomSelect.addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];
        let name = selectedOption.getAttribute('data-name');
        roomPrice = parseInt(selectedOption.getAttribute('data-price')) || 0;

        if (roomPrice) {
            priceDisplay.value = formatRupiah(roomPrice);
            summaryRoom.innerText = name;
        } else {
            priceDisplay.value = "";
            summaryRoom.innerText = "-";
        }
        calculateTotal();
    });

    // Aksi saat merubah jumlah tamu (bisa bertambah/berkurang)
    guestInput.addEventListener('input', function() {
        let val = this.value || 1;
        if(val < 1) { this.value = 1; val = 1; }
        summaryGuests.innerText = val;
    });

    // Konfigurasi kalender dan tanggal pesanan
    const bookedDates = [
        "2026-05-05",
        "2026-05-06",
        "2026-05-10"
    ];

    const fpCheckIn = flatpickr("#check_in", {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: bookedDates,
        onChange: function(selectedDates, dateStr) {
            summaryCheckIn.innerText = dateStr ? dateStr : "-";
            
            // Atur otomatis agar check-out minimal H+1 dari check-in
            if (selectedDates.length > 0) {
                let nextDay = new Date(selectedDates[0]);
                nextDay.setDate(nextDay.getDate() + 1);
                fpCheckOut.set("minDate", nextDay);
            }
            updateDuration();
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            let date = dayElem.dateObj.toISOString().split('T')[0];
            if (bookedDates.includes(date)) {
                dayElem.style.background = "#FCA5A5";
                dayElem.style.color = "#fff";
                dayElem.style.borderRadius = "50%";
            }
        }
    });

    const fpCheckOut = flatpickr("#check_out", {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: bookedDates,
        onChange: function(selectedDates, dateStr) {
            summaryCheckOut.innerText = dateStr ? dateStr : "-";
            updateDuration();
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            let date = dayElem.dateObj.toISOString().split('T')[0];
            if (bookedDates.includes(date)) {
                dayElem.style.background = "#FCA5A5";
                dayElem.style.color = "#fff";
                dayElem.style.borderRadius = "50%";
            }
        }
    });

    // Fungsi otomatis hitung selisih malam menginap
    function updateDuration() {
        if (fpCheckIn.selectedDates.length > 0 && fpCheckOut.selectedDates.length > 0) {
            let checkInDate = fpCheckIn.selectedDates[0];
            let checkOutDate = fpCheckOut.selectedDates[0];
            
            let timeDiff = checkOutDate.getTime() - checkInDate.getTime();
            totalNights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (totalNights < 0) totalNights = 0;
        } else {
            totalNights = 0;
        }
        calculateTotal();
    }
});
</script>

@endsection