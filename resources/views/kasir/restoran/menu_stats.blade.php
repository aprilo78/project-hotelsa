@extends('layouts.dashboard')

@section('title', 'Statistik Menu Terlaris')

{{-- SIDEBAR --}}
@section('sidebar')
    <a href="{{ route('kasir.restoran.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('kasir.restoran.pos') }}" class="nav-link">
        <i class="bi bi-cart"></i> POS
    </a>
    <a href="{{ route('kasir.restoran.order.create') }}" class="nav-link">
        <i class="bi bi-plus-circle"></i> Create Order
    </a>
    <a href="{{ route('kasir.restoran.history') }}" class="nav-link">
        <i class="bi bi-clock-history"></i> History
    </a>
@endsection

@section('content')
<div class="container-fluid py-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Statistik Menu Terlaris</h4>
        <span class="badge bg-success px-3 py-2 rounded-pill">Data Realtime</span>
    </div>

    {{-- TABLE STATS --}}
    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Nama Menu Kuliner</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-center">Total Terjual (Qty)</th>
                            <th class="py-3 text-end pe-4">Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $index => $menu)
                        <tr>
                            <td class="ps-4 text-muted fw-bold">
                                {{ $menus->firstItem() + $index }}
                            </td>
                            <td>
                                <span class="fw-semibold text-dark d-block">{{ $menu->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill text-capitalize px-2.5">
                                    {{ $menu->category ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill px-3 py-1.5 fw-bold">
                                    {{ number_format($menu->total_qty ?? 0) }} Porsi
                                </span>
                            </td>
                            <td class="text-end fw-semibold text-secondary pe-4">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-egg-fried fs-2 d-block mb-2" style="opacity:0.5;"></i>
                                Belum ada riwayat penjualan menu saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($menus, 'links'))
        <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
        @endif
    </div>

</div>
@endsection