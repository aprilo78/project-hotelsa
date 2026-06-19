<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;

class ResepsionisController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
 public function dashboard()
{
    $todayCheckIns = Booking::whereDate('check_in_date', today())
        ->where('status', 'confirmed')
        ->with('room.roomType','user')
        ->get();

    $todayCheckOuts = Booking::whereDate('check_out_date', today())
        ->where('status', 'checked_in')
        ->with('room.roomType','user')
        ->get();

    $pendingBookings = Booking::where('status', 'pending')
        ->with('room.roomType','user')
        ->latest()
        ->take(10)
        ->get();

    $availableRooms = Room::where('status', 'available')->get();
    $occupiedRooms  = Room::where('status', 'occupied')->get();

    // ✅ FIX PENTING INI
    $roomServiceOrders = collect(); 
    $fullHouseDates = [];

    return view('resepsionis.dashboard', compact(
        'todayCheckIns',
        'todayCheckOuts',
        'pendingBookings',
        'availableRooms',
        'occupiedRooms',
        'roomServiceOrders',
        'fullHouseDates'
    ));
}

    public function rooms()
{
    $rooms = \App\Models\Room::with('roomType')->get();

    return view('resepsionis.rooms.index', compact('rooms'));
}
    // =========================
    // BOOKINGS LIST
    // =========================
    public function bookings()
    {
        $bookings = Booking::with(['room.roomType','user'])
            ->latest()
            ->paginate(15);

        return view('resepsionis.bookings.index', compact('bookings'));
    }

    // =========================
    // CREATE PAGE
    // =========================
   public function createBooking()
{
    $rooms = Room::where('status', 'available')->get();

    // FIX INI (tambahkan guests)
    $guests = User::where('role', 'customer')->get();

    return view('resepsionis.bookings.create', compact('rooms', 'guests'));
}

    // =========================
    // STORE BOOKING
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
        ]);

        Booking::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'status' => 'pending'
        ]);

        return redirect()->route('resepsionis.bookings.index')
            ->with('success', 'Booking berhasil dibuat');
    }

    // =========================
    // CHECK IN
    // =========================
    public function checkIn(Booking $booking)
    {
        $booking->update(['status' => 'checked_in']);
        $booking->room->update(['status' => 'occupied']);

        return back()->with('success', 'Check-in berhasil');
    }

    // =========================
    // CHECK OUT
    // =========================
    public function checkOut(Booking $booking)
    {
        $booking->update(['status' => 'checked_out']);
        $booking->room->update(['status' => 'available']);

        return back()->with('success', 'Check-out berhasil');
    }

    public function checkinPage()
{
    return view('resepsionis.checkin');
}

    public function guestStatus()
{
    $checkIns = Booking::with(['user', 'room'])
        ->where('booking_status', 'checked_in')
        ->latest()
        ->get();

    $checkOuts = Booking::with(['user', 'room'])
        ->where('booking_status', 'checked_out')
        ->latest()
        ->get();

    return view('resepsionis.guest-status', compact('checkIns', 'checkOuts'));
}
}