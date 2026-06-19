<?php

namespace App\Http\Controllers;

use App\Models\RestaurantOrder;
use App\Models\RestaurantMenu;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantOrderController extends Controller
{
    // For Cashier Restoran
    public function pos()
    {
        $menus = RestaurantMenu::where('is_available', true)->get();
        $rooms = Room::with('roomType')->where('status', 'occupied')->get();
        $bookings = Booking::where('booking_status', 'checked_in')
            ->with(['guest', 'room'])
            ->get();
        
        $cart = session()->get('restaurant_cart', []);
        
        return view('kasir.restoran.pos', compact('menus', 'rooms', 'bookings', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $menu = RestaurantMenu::findOrFail($request->menu_id);
        $cart = session()->get('restaurant_cart', []);
        
        if(isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity']++;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => 1,
                'subtotal' => $menu->price
            ];
        }
        
        $cart[$menu->id]['subtotal'] = $cart[$menu->id]['price'] * $cart[$menu->id]['quantity'];
        
        session()->put('restaurant_cart', $cart);
        
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function removeFromCart($menuId)
    {
        $cart = session()->get('restaurant_cart', []);
        
        if(isset($cart[$menuId])) {
            unset($cart[$menuId]);
            session()->put('restaurant_cart', $cart);
        }
        
        return response()->json(['success' => true]);
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('restaurant_cart', []);
        
        foreach($request->quantities as $menuId => $quantity) {
            if($quantity <= 0) {
                unset($cart[$menuId]);
            } else {
                $cart[$menuId]['quantity'] = $quantity;
                $cart[$menuId]['subtotal'] = $cart[$menuId]['price'] * $quantity;
            }
        }
        
        session()->put('restaurant_cart', $cart);
        
        return response()->json(['success' => true]);
    }

    public function processOrder(Request $request)
    {
        $cart = session()->get('restaurant_cart', []);
        
        if(empty($cart)) {
            return back()->with('error', 'Cart is empty!');
        }
        
        $validated = $request->validate([
            'payment_type' => 'required|in:cash,transfer,billed_to_room',
            'customer_type' => 'required|in:guest,room_guest,walk_in',
            'bank' => 'required_if:payment_type,transfer|nullable|string',
        ]);
        
        DB::beginTransaction();
        
        try {
            $totalPrice = array_sum(array_column($cart, 'subtotal'));
            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(RestaurantOrder::count() + 1, 4, '0', STR_PAD_LEFT);
            
            $orderData = [
                'order_number' => $orderNumber,
                'total_price' => $totalPrice,
                'kasir_id' => Auth::id(),
                'payment_method' => $validated['payment_type'] === 'billed_to_room' ? null : $validated['payment_type'],
                'bank' => $validated['payment_type'] === 'transfer' ? $validated['bank'] : null,
                'is_billed_to_room' => $validated['payment_type'] === 'billed_to_room',
                'payment_status' => $validated['payment_type'] === 'billed_to_room' ? 'billed_to_room' : 'pending',
                'order_status' => 'ordered',
                'is_guest_order' => $validated['customer_type'] === 'walk_in'
            ];
            
            // Handle customer type
            if($validated['customer_type'] === 'guest' && $request->guest_id) {
                $orderData['guest_id'] = $request->guest_id;
            } elseif($validated['customer_type'] === 'room_guest' && $request->room_id) {
                $orderData['room_id'] = $request->room_id;
                $booking = Booking::where('room_id', $request->room_id)
                    ->where('booking_status', 'checked_in')
                    ->first();
                if($booking) {
                    $orderData['booking_id'] = $booking->id;
                    $orderData['guest_id'] = $booking->guest_id;
                }
            }
            
            $order = RestaurantOrder::create($orderData);
            
            // Create order details
            foreach($cart as $menuId => $item) {
                $order->orderDetails()->create([
                    'restaurant_menu_id' => $menuId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal']
                ]);
            }
            
            // If not billed to room, process payment
            if($validated['payment_type'] !== 'billed_to_room') {
                // Process payment (will integrate with Midtrans later)
                $transactionNumber = 'TRX-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
                
                $order->transaction()->create([
                    'kasir_id' => Auth::id(),
                    'transaction_number' => $transactionNumber,
                    'amount' => $totalPrice,
                    'payment_method' => $validated['payment_type'],
                    'bank' => $validated['payment_type'] === 'transfer' ? $validated['bank'] : null,
                    'payment_status' => 'success'
                ]);
                
                $order->update([
                    'payment_status' => 'paid',
                    'order_status' => 'preparing'
                ]);
            }
            
            // Clear cart
            session()->forget('restaurant_cart');
            
            DB::commit();
            
            // Print receipt
            return redirect()->route('kasir.restoran.receipt', $order->id)
                ->with('success', 'Order processed successfully!');
            
        } catch(\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }

    public function receipt($id)
    {
        $order = RestaurantOrder::with(['orderDetails.menu', 'transaction', 'guest', 'room'])
            ->findOrFail($id);
        
        return view('kasir.restoran.receipt', compact('order'));
    }

    public function printReceipt($id)
    {
        $order = RestaurantOrder::with(['orderDetails.menu', 'transaction', 'guest', 'room'])
            ->findOrFail($id);
        
        return view('kasir.restoran.print', compact('order'));
    }
}