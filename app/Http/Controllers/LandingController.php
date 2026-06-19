<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $roomTypes    = RoomType::with('rooms')->get();
        $menus        = RestaurantMenu::where('is_available', true)->take(6)->get();
        return view('landing.index', compact('roomTypes', 'menus'));
    }

    public function searchRooms(Request $request)
    {
        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
        ]);

        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;

        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->get()
            ->filter(fn($room) => $room->isAvailable($checkIn, $checkOut));

        return view('landing.search_results', compact('rooms', 'checkIn', 'checkOut'));
    }
}