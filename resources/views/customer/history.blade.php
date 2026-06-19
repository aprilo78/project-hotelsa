@extends('layouts.dashboard')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

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
    <a href="{{ route('customer.history') }}" class="nav-link active">
        <i class="bi bi-clock-history"></i> Transaction History
    </a>
    <a href="{{ route('customer.profile') }}" class="nav-link">
        <i class="bi bi-person"></i> My Profile
    </a>
@endsection

@section('content')

<style>
.card-box{
    background:#fff;
    border-radius:16px;
    border:1px solid #EDE8DC;
    box-shadow:0 6px 20px rgba(0,0,0,0.05);
}

.table-modern th{
    font-size:.72rem;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:#6B7280;
    background:#FAF7F2;
    border:none;
    padding:12px 14px;
}

.table-modern td{
    font-size:.85rem;
    color:#374151;
    padding:12px 14px;
    vertical-align:middle;
    border-bottom:1px solid #F5F1EB;
}

.table-modern tbody tr:last-child td{ border-bottom:none; }

.pay-badge{
    padding:4px 12px;
    border-radius:50px;
    font-size:.7rem;
    font-weight:700;
    display:inline-block;
}

.status-pill{
    padding:4px 12px;
    border-radius:50px;
    font-size:.7rem;
    font-weight:700;
    display:inline-block;
}

.filter-tab{
    border-radius:20px;
    font-size:.8rem;
    font-weight:500;
    padding:5px 14px;
    border:1px solid #ddd;
    color:#555;
    background:#fff;
    text-decoration:none;
    transition:.15s;
}
.filter-tab.active{
    background:#C9A84C;
    color:#1A1A2E;
    font-weight:700;
    border-color:#C9A84C;
}
.filter-tab:hover:not(.active){ background:#f5efe6; }
</style>

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 style="font-family:'Playfair Display',serif;color:#1A1A2E;margin-bottom:2px">
            Riwayat Transaksi
        </h4>
        <p class="text-muted" style="font-size:.83rem;margin:0">
            Semua pembayaran dan aktivitas booking Anda
        </p>
    </div>
</div>

{{-- SUCCESS FLASH (after booking) --}}
@if(session('booking_success'))
<div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
    <i class="bi bi-check-circle-fill fs-5"></i>
    <div>
        <strong>Booking berhasil dilakukan!</strong>
        Pesanan Anda sedang diproses. Silakan lakukan pembayaran sesuai instruksi.
    </div>
</div>
@endif

{{-- FILTER --}}
@php
    $filterStatus = ['all'=>'Semua','pending'=>'Pending','paid'=>'Lunas','failed'=>'Gagal'];
    $activeFilter = request('payment_status','all');
@endphp

<div class="mb-4 p-3" style="background:#f5efe6;border-radius:12px;border:1px solid #ede8dc">
    <div class="d-flex gap-2 flex-wrap align-items-center">
        <span class="text-muted" style="font-size:.8rem;font-weight:600">Filter:</span>
        @foreach($filterStatus as $val => $lbl)
        <a href="{{ request()->fullUrlWithQuery(['payment_status'=>$val]) }}"
           class="filter-tab {{ $activeFilter === $val ? 'active' : '' }}">
            {{ $lbl }}
        </a>
        @endforeach
    </div>
</div>

<div class="card-box">

@php
    $histories = $histories ?? collect();
@endphp

@if($histories->isEmpty())

    {{-- EMPTY STATE --}}
    <div class="text-center py-5 px-3">
        <i class="bi bi-receipt fs-2 text-muted d-block mb-3 opacity-50"></i>

        <h6 style="font-weight:700;color:#1A1A2E">
            Belum ada transaksi
        </h6>

        <p class="text-muted" style="font-size:.85rem">
            @if($activeFilter !== 'all')
                Tidak ada transaksi dengan status "{{ $filterStatus[$activeFilter] ?? $activeFilter }}"
            @else
                Anda belum melakukan booking atau pembayaran
            @endif
        </p>

        <a href="{{ route('customer.new-booking') }}"
           class="btn mt-2"
           style="background:#C9A84C;color:#1A1A2E;font-weight:600;border-radius:8px;padding:8px 20px">
            Booking Sekarang
        </a>
    </div>

@else

    <div class="table-responsive">
        <table class="table table-modern mb-0">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Booking</th>
                    <th>Kamar</th>
                    <th>Check-in / Out</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $item)
                <tr>
                    <td class="fw-semibold" style="color:#1A1A2E;font-size:.82rem">
                        {{ $item->code ?? '#' . $item->id }}
                    </td>

                    <td style="white-space:nowrap">
                        <div>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</div>
                        <small class="text-muted">{{ $item->created_at ? $item->created_at->format('H:i') : '' }}</small>
                    </td>

                    <td>
                        <a href="{{ route('customer.booking-detail', $item->booking_id ?? $item->id) }}"
                           style="color:#C9A84C;text-decoration:none;font-weight:600">
                            #{{ $item->booking_id ?? $item->id }}
                        </a>
                    </td>

                    <td>
                        {{ $item->booking->room->room_number ?? ($item->room->name ?? '-') }}
                        @if($item->booking->room->roomType->name ?? false)
                        <small class="text-muted d-block">
                            {{ $item->booking->room->roomType->name }}
                        </small>
                        @endif
                    </td>

                    <td style="white-space:nowrap;font-size:.8rem">
                        @if($item->booking->check_in ?? false)
                        <div>{{ $item->booking->check_in->format('d M Y') }}</div>
                        <div class="text-muted">→ {{ $item->booking->check_out->format('d M Y') }}</div>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td style="color:#C9A84C;font-weight:700;white-space:nowrap">
                        Rp {{ number_format($item->amount ?? 0, 0, ',', '.') }}
                    </td>

                    <td>
                        <span style="font-size:.82rem">
                            {{ ucfirst($item->payment_method ?? 'Cash') }}
                        </span>
                    </td>

                    <td>
                        @php
                            $ps = $item->payment_status ?? 'pending';
                            $psMap = [
                                'paid'    => ['bg'=>'#D1FAE5','color'=>'#065F46','label'=>'Lunas'],
                                'pending' => ['bg'=>'#FEF3C7','color'=>'#92400E','label'=>'Pending'],
                                'failed'  => ['bg'=>'#FEE2E2','color'=>'#991B1B','label'=>'Gagal'],
                            ];
                            $psc = $psMap[$ps] ?? ['bg'=>'#EEE','color'=>'#333','label'=>ucfirst($ps)];
                        @endphp
                        <span class="pay-badge"
                              style="background:{{ $psc['bg'] }};color:{{ $psc['color'] }}">
                            {{ $psc['label'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if(method_exists($histories, 'links'))
    <div class="px-3 py-3">
        {{ $histories->appends(request()->query())->links() }}
    </div>
    @endif

@endif

</div>

@endsection