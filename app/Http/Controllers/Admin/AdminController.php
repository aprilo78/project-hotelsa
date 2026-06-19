<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderItem;
use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Guest;
use App\Models\User;

class AdminController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        // BOOKING
        $totalBookings = Booking::count();

        $monthlyBookings = Booking::whereMonth('created_at', now()->month)->count();

        $recentBookings = Booking::with(['guest', 'room'])
            ->latest()
            ->limit(5)
            ->get();

        // ROOMS OCCUPANCY
        $totalRooms = Room::count();

        $occupiedRooms = Booking::where('booking_status', 'confirmed')->count();

        $occupancyRate = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100)
            : 0;

        // REVENUE
        $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');

        $monthlyRevenue = Payment::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        $revenueLabels = [];
        $revenueData = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);

            $revenueLabels[] = $day->format('d/m');

            $revenueData[] = Payment::where('payment_status', 'paid')
                ->whereDate('created_at', $day)
                ->sum('amount');
        }

        // RESTAURANT
        $totalOrders = RestaurantOrder::count();

        $todayOrders = RestaurantOrder::whereDate('created_at', now())->count();

        $topMenus = RestaurantOrderItem::selectRaw('menu_id, SUM(quantity) as total')
            ->whereNotNull('menu_id')
            ->groupBy('menu_id')
            ->with('menu')
            ->get();

        $menuLabels = $topMenus->map(fn($i) => $i->menu->name ?? 'Unknown')->toArray();
        $menuData = $topMenus->map(fn($i) => $i->total)->toArray();

        // PAYMENT
        $paymentDistribution = [
            Payment::where('payment_status', 'paid')->count(),
            Payment::where('payment_status', 'dp')->count(),
            Payment::where('payment_status', 'pending')->count(),
            Payment::where('payment_status', 'unpaid')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalBookings',
            'monthlyBookings',
            'totalRevenue',
            'monthlyRevenue',
            'totalRooms',
            'occupiedRooms',
            'occupancyRate',
            'totalOrders',
            'todayOrders',
            'recentBookings',
            'revenueLabels',
            'revenueData',
            'menuLabels',
            'menuData',
            'paymentDistribution'
        ));
    }

    // =========================
    // BOOKINGS (FIX ERROR KAMU)
    // =========================
    public function bookings()
    {
        $bookings = Booking::with(['guest', 'room'])
            ->latest()
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function rooms()
{
    $rooms = Room::latest()->paginate(10);

    return view('admin.rooms.index', compact('rooms'));
}

    public function guests()
{
    $guests = Guest::latest()->paginate(10);

    return view('admin.guests.index', compact('guests'));
}

    public function users()
{
    $users = User::latest()->paginate(10);

    return view('admin.users.index', compact('users'));
}

    public function restaurantMenus()
{
    return view('admin.restaurant-menus'); 
}

    public function laporan()
{
    // Total pemasukan
    $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');

    // Total booking
    $totalBookings = Booking::count();

    // Data pembayaran per status
    $paymentStatus = [
        'Paid' => Payment::where('payment_status', 'paid')->count(),
        'DP' => Payment::where('payment_status', 'dp')->count(),
        'Pending' => Payment::where('payment_status', 'pending')->count(),
        'Unpaid' => Payment::where('payment_status', 'unpaid')->count(),
    ];

    return view('admin.laporan.index', compact(
        'totalRevenue',
        'totalBookings',
        'paymentStatus'
    ));
}
}