<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Dioptimasi agar pemanggilan Carbon lebih rapi

class BookingController extends Controller
{
    // 1. Menampilkan Semua Riwayat Transaksi / Booking
    public function index()
    {
        $bookings = Booking::with(['room.roomType'])
            ->where('guest_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }

    // 2. Form Final (Tempat Customer Isi Identitas / Notes / Pilih Extra Bed)
    public function create(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date',
            'check_out' => 'required|date',
        ]);

        $room     = Room::with('roomType')->findOrFail($request->room_id);
        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;

        return view('customer.bookings.create', compact('room', 'checkIn', 'checkOut'));
    }

    // 3. Eksekusi "Booking Sekarang" -> Otomatis Simpan ke Transaction History
    public function store(Request $request)
{
    $request->validate([
        'room_id'       => 'required|exists:rooms,id',
        'check_in'      => 'required|date|after_or_equal:today',
        'check_out'     => 'required|date|after:check_in',
        'notes'         => 'nullable|string|max:500',
    ]);

    $room    = Room::with('roomType')->findOrFail($request->room_id);
    $checkIn = $request->check_in;
    $checkOut= $request->check_out;

    if (!$room->isAvailable($checkIn, $checkOut)) {
        return back()->withErrors(['room_id' => 'Kamar tidak tersedia pada tanggal tersebut.']);
    }

    // Hitung total harga
    $nights   = \Carbon\Carbon::parse($checkIn)->diffInDays($checkOut);
    $basePrice= ($room->roomType->price ?? $room->price) * $nights;
    
    // Simpan ke database booking / transaksi
    $booking = Booking::create([
        'guest_id'        => Auth::id(),
        'room_id'         => $room->id,
        'check_in'        => $checkIn,
        'check_out'       => $checkOut,
        'total_price'     => $basePrice,
        'booking_type'    => $request->booking_type ?? 'room_only',
        'status'          => 'pending',
        'payment_status'  => 'pending', // Menyesuaikan dengan badge 'pending' di table history Anda
        'notes'           => $request->notes,
    ]);

    // REDIRECT KE HALAMAN HISTORY DENGAN FLASH SESSION YANG COCOK
    return redirect()->route('customer.history')
        ->with('booking_success', true); 
}

    // 4. Menampilkan Detail Transaksi Spesifik
    public function show(Booking $booking)
    {
        // Pastikan booking ini milik user yang login (Policy)
        $this->authorize('view', $booking);

        $booking->load(['room.roomType', 'payments', 'restaurantOrders.details.menu']);

        return view('customer.bookings.show', compact('booking'));
    }

    // 5. Batalkan Transaksi
    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->withErrors(['status' => 'Booking tidak dapat dibatalkan.']);
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    // 6. Cari Kamar Kosong (Langkah Awal / Halaman New Booking)
    public function searchRooms(Request $request)
    {
        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;
        $guests   = $request->guests ?? 1;

        if (!$checkIn || !$checkOut) {
            return view('customer.new-booking', ['rooms' => [], 'bookedRoomIds' => []]);
        }

        if ($checkOut <= $checkIn) {
            return back()->withErrors('Check-out harus setelah check-in');
        }

        // Ambil ID Kamar yang sudah di-booking pada tanggal tersebut
        $bookedRoomIds = Booking::where(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn);
            })
            ->whereNotIn('status', ['cancelled'])
            ->pluck('room_id')
            ->toArray();

        // Tampilkan semua kamar (Di view nanti tinggal di-filter mana yang masuk $bookedRoomIds)
        $rooms = Room::with('roomType')->orderBy('price', 'asc')->get();

        if ($request->ajax() || $request->get('ajax')) {
            return response()->json([
                'rooms' => $rooms,
                'bookedRoomIds' => $bookedRoomIds
            ]);
        }

        return view('customer.new-booking', compact('rooms', 'bookedRoomIds', 'checkIn', 'checkOut', 'guests'));
    }

    // 7. Review Booking sebelum klik final (Opsional)
    public function review($id)
    {
        $booking = Booking::with('room.roomType')->findOrFail($id);
        return view('customer.booking-review', compact('booking'));
    }
}