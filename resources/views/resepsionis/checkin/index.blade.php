@extends('layouts.dashboard')

@section('title','Check-in/out')

@section('content')
<h4>Halaman Check-in & Check-out</h4>

@foreach($bookings as $booking)
    <div>
        {{ $booking->id }} - {{ $booking->booking_status }}
    </div>
@endforeach

@endsection