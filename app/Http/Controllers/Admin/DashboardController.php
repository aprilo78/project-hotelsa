<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\RestaurantOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalUsers = User::whereHas('role', function($q) {
            $q->where('name', 'customer');
        })->count();
        
        $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');
        
        $monthlyRevenue = Payment::where('payment_status', 'paid')
            ->whereMonth('paid_at', Carbon::now()->month)
            ->sum('amount');
            
        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(10)
            ->get();
            
        $roomStatus = [
            'available' => Room::where('status', 'available')->count(),
            'booked' => Room::where('status', 'booked')->count(),
            'occupied' => Room::where('status', 'occupied')->count(),
            'maintenance' => Room::where('status', 'maintenance')->count(),
        ];
        
        return view('admin.dashboard', compact(
            'totalRooms', 'totalBookings', 'totalUsers', 'totalRevenue',
            'monthlyRevenue', 'recentBookings', 'roomStatus'
        ));
    }
}