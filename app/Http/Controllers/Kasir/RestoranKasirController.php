<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderDetail;
use App\Models\RestaurantPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirRestoranController extends Controller
{
    /**
     * Tampilkan Dashboard Kasir Restoran
     */
    public function dashboard()
    {
        // 💡 FIXED: Dibuat murni restoran, hanya memanggil detail menu restoran saja
        $pendingOrders = RestaurantOrder::with(['details.menu'])
            ->where('status','ordered')
            ->latest()
            ->paginate(15);

        $todayRevenue = RestaurantPayment::where('payment_status','paid')
            ->whereDate('created_at', today())
            ->sum('amount');

        $topMenus = RestaurantMenu::withCount(['orderDetails as total_qty' => fn($q) => $q->select(DB::raw('SUM(quantity)'))])
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('kasir.restoran.dashboard', compact('pendingOrders','todayRevenue','topMenus'));
    }

    /**
     * Tampilkan Form Create Order (Tambah Pesanan Restoran)
     */
    public function createOrder()
    {
        // 💡 FIXED: Menghapus data Booking/Kamar Hotel. Input pesanan hanya butuh menu restoran.
        $menus = RestaurantMenu::where('is_available', true)->get();
        return view('kasir.restoran.create_order', compact('menus'));
    }

    /**
     * Simpan Pesanan Baru Restoran
     */
    public function storeOrder(Request $request)
    {
        // 💡 FIXED: Hapus validasi guest_id, booking_id, dan billed_to_room dari hotel
        $request->validate([
            'customer_name'  => 'required|string|max:255', // Diganti nama pelanggan umum/restoran
            'items'          => 'required|array|min:1',
            'items.*.menu_id'=> 'required|exists:restaurant_menus,id',
            'items.*.qty'    => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // 💡 FIXED: Simpan murni data pesanan makanan tanpa embel-embel hotel
            $order = RestaurantOrder::create([
                'customer_name'  => $request->customer_name,
                'status'         => 'ordered',
                'total_price'    => 0,
            ]);

            $total = 0;
            foreach ($request->items as $item) {
                $menu = RestaurantMenu::find($item['menu_id']);
                RestaurantOrderDetail::create([
                    'restaurant_order_id'  => $order->id,
                    'restaurant_menu_id'   => $menu->id,
                    'quantity'             => $item['qty'],
                    'price'                => $menu->price,
                ]);
                $total += $menu->price * $item['qty'];
            }

            $order->update(['total_price' => $total]);
        });

        return redirect()->route('kasir.restoran.dashboard')
            ->with('success', 'Pesanan makanan berhasil dibuat.');
    }

    /**
     * Proses Halaman Pembayaran Makanan
     */
    public function processPayment(RestaurantOrder $order)
    {
        // 💡 FIXED: Hapus pemanggilan relasi guest dan booking kamar
        $order->load(['details.menu']);
        return view('kasir.restoran.payment', compact('order'));
    }

    /**
     * Simpan Transaksi Pembayaran Kasir Restoran
     */
    public function storePayment(Request $request, RestaurantOrder $order)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'bank'           => 'required_if:payment_method,transfer|nullable|string|max:100',
        ]);

        $bank = $request->payment_method === 'cash' ? null : $request->bank;

        RestaurantPayment::create([
            'restaurant_order_id' => $order->id,
            'kasir_id'            => Auth::id(),
            'amount'              => $order->total_price,
            'payment_method'      => $request->payment_method,
            'bank'                => $bank,
            'payment_status'      => 'paid',
        ]);

        $order->update(['status' => 'paid']);

        return redirect()->route('kasir.restoran.struk', $order)
            ->with('success', 'Pembayaran makanan berhasil.');
    }

    /**
     * Tampilkan Struk Cetak Kasir Restoran
     */
    public function struk(RestaurantOrder $order)
    {
        // 💡 FIXED: Hapus relasi kamar/hotel (guest, booking)
        $order->load(['details.menu', 'payment', 'payment.kasir']);
        return view('kasir.restoran.struk', compact('order'));
    }

    /**
     * Riwayat Transaksi Pendapatan Restoran
     */
    public function history(Request $request)
    {
        // 💡 FIXED: Bersihkan dari pencarian guest hotel
        $q = RestaurantPayment::with(['order', 'kasir'])->where('payment_status', 'paid');
        
        if ($request->from) $q->whereDate('created_at', '>=', $request->from);
        if ($request->to)   $q->whereDate('created_at', '<=', $request->to);
        
        $payments = $q->latest()->paginate(20);
        $total    = $q->sum('amount');
        
        return view('kasir.restoran.history', [
            'payments' => $payments,
            'total' => $total
        ]);
    }

    /**
     * Statistik Menu Terlaris Restoran
     */
    public function menuStats()
    {
        $menus = RestaurantMenu::withCount([
            'orderDetails as total_qty' => fn($q) => $q->select(DB::raw('SUM(quantity)')),
        ])->orderByDesc('total_qty')->paginate(20);
        
        return view('kasir.restoran.menu_stats', compact('menus'));
    }

    /**
     * Point Of Sale (POS) Halaman Utama Kasir Makanan
     */
    public function pos()
    {
        $menus = RestaurantMenu::where('is_available', true)->get();
        return view('kasir.restoran.pos', compact('menus'));
    }

    /**
     * Daftar Seluruh Pesanan Restoran
     */
    public function ordersIndex()
    {
        // 💡 FIXED: Murni memanggil orderan makanan saja tanpa menyenggol booking kamar
        $orders = RestaurantOrder::latest()->paginate(10);
        return view('kasir.restoran.orders', compact('orders'));
    }

    /**
     * Index Halaman Sub-Folder Restoran / Orders / Index
     */
    public function indexOrders()
    {
        // 💡 FIXED: Ganti Model 'Order' (milik hotel) dengan 'RestaurantOrder' asli milik restoran
        $orders = RestaurantOrder::orderBy('created_at', 'desc')->get();
        return view('kasir.restoran.orders.index', compact('orders'));
    }
}