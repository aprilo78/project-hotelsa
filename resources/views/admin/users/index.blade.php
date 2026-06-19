@extends('layouts.dashboard')

@section('title', 'Users')
@section('page-title', 'Data Users')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Data Users</h5>
    </div>

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

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->name ?? '-' }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td>{{ $user->role ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data users</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</div>
@endsection