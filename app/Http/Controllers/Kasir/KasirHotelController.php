<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirHotelController extends Controller
{
    public function dashboard()
    {
        $todayTransactions  = Payment::where('payment_status','paid')->whereDate('created_at', today())->sum('amount');
        $pendingPayments = Booking::whereNotIn('booking_status', ['cancelled','checkout'])
    ->whereDoesntHave('payments', function($q) {
        $q->where('payment_status','paid');
    })
    ->count();
        $monthlyTotal       = Payment::where('payment_status','paid')->whereMonth('created_at', now()->month)->sum('amount');
        $recentTransactions = Payment::with(['booking.guest'])->latest()->take(10)->get();

        return view('kasir.hotel.dashboard', compact('todayTransactions','pendingPayments','monthlyTotal','recentTransactions'));
    }

    public function processPayment(Booking $booking)
    {
        $booking->load(['room.roomType','guest','payments','restaurantOrders']);
        return view('kasir.hotel.payments', compact('booking'));
    }

    public function paymentsIndex()
{
    $payments = \App\Models\Payment::with(['booking.guest'])
        ->latest()
        ->paginate(10);

    return view('payments', compact('payments'));
}
    public function storePayment(Request $request, Booking $booking)
    {
        $request->validate([
            'amount'          => 'required|numeric|min:1',
            'payment_method'  => 'required|in:cash,transfer',
            'bank'            => 'required_if:payment_method,transfer|nullable|string|max:100',
        ]);

        $bank = $request->payment_method === 'cash' ? null : $request->bank;

        $payment = Payment::create([
            'booking_id'      => $booking->id,
            'kasir_id'        => Auth::id(),
            'amount'          => $request->amount,
            'payment_method'  => $request->payment_method,
            'bank'            => $bank,
            'payment_status'  => 'paid',
            'note'            => $request->note,
        ]);

        // Update booking payment_status
        $totalPaid = $booking->totalPaid();
        if ($totalPaid >= $booking->grandTotal()) {
            $booking->update(['payment_status' => 'lunas']);
        } elseif ($totalPaid > 0) {
            $booking->update(['payment_status' => 'dp', 'dp_amount' => $totalPaid]);
        }

        return redirect()->route('kasir.hotel.invoice', $payment)
            ->with('success', 'Pembayaran berhasil diproses.');
    }

    public function invoicesIndex()
{
    $payments = \App\Models\Payment::with(['booking.guest'])
        ->latest()
        ->paginate(10);

    return view('kasir.hotel.invoices', compact('payments'));
}

    public function history(Request $request)
    {
        $q = Payment::with(['booking.guest','kasir'])->where('payment_status','paid');
        if ($request->from) $q->whereDate('created_at', '>=', $request->from);
        if ($request->to)   $q->whereDate('created_at', '<=', $request->to);
        $payments = $q->latest()->paginate(20);
        $total    = $q->sum('amount');
        return view('kasir.hotel.history', compact('payments', 'total'));
    }
}