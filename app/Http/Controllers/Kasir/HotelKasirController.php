<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class HotelKasirController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function dashboard()
    {
        $pendingPayments = Booking::where('status', 'confirmed')
            ->where('remaining_payment', '>', 0)
            ->with(['user', 'room'])
            ->get();
            
        $todayCheckouts = Booking::where('check_out_date', Carbon::today())
            ->where('status', 'checked_in')
            ->with(['user', 'room'])
            ->get();
            
        $recentTransactions = Payment::with(['booking.user', 'processedBy'])
            ->latest()
            ->take(10)
            ->get();
            
        return view('kasir.hotel.dashboard', compact('pendingPayments', 'todayCheckouts', 'recentTransactions'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer,credit_card,e_wallet,qris,midtrans',
            'bank' => 'required_if:payment_method,transfer',
            'amount' => 'required|numeric|min:1|max:' . $booking->remaining_payment,
        ]);

        $payment = Payment::create([
            'payment_number' => 'PAY-' . time() . '-' . uniqid(),
            'booking_id' => $booking->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'bank' => $request->bank,
            'payment_status' => 'pending',
            'payment_type' => $booking->down_payment > 0 ? 'down_payment' : 'full_payment',
            'processed_by' => auth()->id(),
        ]);

        if ($request->payment_method === 'midtrans') {
            $params = [
                'transaction_details' => [
                    'order_id' => $payment->payment_number,
                    'gross_amount' => $request->amount,
                ],
                'customer_details' => [
                    'first_name' => $booking->user->name,
                    'email' => $booking->user->email,
                ],
            ];
            
            $snapToken = Snap::getSnapToken($params);
            $payment->midtrans_order_id = $payment->payment_number;
            $payment->save();
            
            return response()->json(['snap_token' => $snapToken]);
        }

        // Handle cash/transfer payment
        $payment->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        // Update booking
        $newRemaining = $booking->remaining_payment - $request->amount;
        $booking->update([
            'down_payment' => $booking->down_payment + $request->amount,
            'remaining_payment' => $newRemaining,
            'status' => $newRemaining == 0 ? 'confirmed' : 'pending',
        ]);

        $this->sendNotification($booking->user, 'Pembayaran Diterima', 
            "Pembayaran sebesar Rp " . number_format($request->amount) . " telah diterima untuk booking #" . $booking->booking_number);

        return redirect()->back()->with('success', 'Payment processed successfully');
    }

    public function generateInvoice(Booking $booking)
    {
        $booking->load(['user', 'room', 'payments', 'restaurantOrders']);
        
        $totalRestaurant = $booking->restaurantOrders->sum('total_amount');
        $totalPaid = $booking->payments->where('payment_status', 'paid')->sum('amount');
        
        $invoice = [
            'booking' => $booking,
            'total_restaurant' => $totalRestaurant,
            'total_paid' => $totalPaid,
            'remaining' => $booking->remaining_payment + $totalRestaurant - $totalPaid,
        ];
        
        return view('kasir.hotel.invoice', compact('invoice'));
    }

    private function sendNotification($user, $title, $message)
    {
        // Implement notification logic
    }
}