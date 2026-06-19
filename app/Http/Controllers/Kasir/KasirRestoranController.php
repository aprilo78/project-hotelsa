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
        // 💡 FIXED: Disamakan dengan status database ('ordered') & diload relasinya
        $pendingOrders = RestaurantOrder::with(['details.menu'])
            ->where('status', 'ordered')
            ->latest()
            ->paginate(15);

        // 💡 FIXED: Memastikan pencarian pendapatan hari ini tepat menggunakan method date bawaan Laravel/PHP
        $todayRevenue = RestaurantPayment::where('payment_status', 'paid')
            ->whereDate('created_at', today())
            ->sum('amount');

        // 🔥 FIXED CRITICAL BUG: withCount tidak bisa dipaksa SUM dengan cara biasa karena akan merusak penamaan atribut Laravel.
        // Kita gunakan selectRaw subquery yang bersih agar total_qty terbaca sempurna sebagai angka di View Blade.
        $topMenus = RestaurantMenu::select('restaurant_menus.*')
            ->selectSub(function ($query) {
                $query->from('restaurant_order_details')
                    ->whereColumn('restaurant_order_details.restaurant_menu_id', 'restaurant_menus.id')
                    ->selectRaw('COALESCE(SUM(quantity), 0)');
            }, 'total_qty')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('kasir.restoran.dashboard', compact('pendingOrders', 'todayRevenue', 'topMenus'));
    }

    /**
     * Tampilkan Form Create Order (Tambah Pesanan Restoran)
     */
    public function createOrder()
    {
        $menus = RestaurantMenu::where('is_available', true)->get();
        return view('kasir.restoran.create_order', compact('menus'));
    }

    /**
     * Simpan Pesanan Baru Restoran
     */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255', 
            'items'          => 'required|array|min:1',
            'items.*.menu_id'=> 'required|exists:restaurant_menus,id',
            'items.*.qty'    => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
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
        $order->load(['details.menu', 'payment', 'payment.kasir']);
        return view('kasir.restoran.struk', compact('order'));
    }

    /**
     * Riwayat Transaksi Pendapatan Restoran
     */
    public function history(Request $request)
    {
        $q = RestaurantPayment::with(['order', 'kasir'])->where('payment_status', 'paid');
        
        if ($request->from) $q->whereDate('created_at', '>=', $request->from);
        if ($request->to)   $q->whereDate('created_at', '<=', $request->to);
        
        $total = $q->sum('amount');
        
        $payments = $q->latest()->paginate(20);
        
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
        // 💡 FIXED: Penerapan optimasi subquery sum yang sama agar halaman statistik menu ikut tampil normal.
        $menus = RestaurantMenu::select('restaurant_menus.*')
            ->selectSub(function ($query) {
                $query->from('restaurant_order_details')
                    ->whereColumn('restaurant_order_details.restaurant_menu_id', 'restaurant_menus.id')
                    ->selectRaw('COALESCE(SUM(quantity), 0)');
            }, 'total_qty')
            ->orderByDesc('total_qty')
            ->paginate(20);
        
        return view('kasir.restoran.menu_stats', compact('menus'));
    }

    /**
     * Point Of Sale (POS) Halaman Utama Kasir Makanan
     */
    public function pos()
    {
        $categories = RestaurantMenu::select('category')->distinct()->pluck('category');
        $menus = RestaurantMenu::where('is_available', true)->get();
        
        return view('kasir.restoran.pos', compact('menus', 'categories'));
    }

    /**
     * Daftar Seluruh Pesanan Restoran
     */
    public function ordersIndex()
    {
        $orders = RestaurantOrder::latest()->paginate(10);
        return view('kasir.restoran.orders', compact('orders'));
    }

    /**
     * Index Halaman Sub-Folder Restoran / Orders / Index
     */
    public function indexOrders()
    {
        $orders = RestaurantOrder::orderBy('created_at', 'desc')->get();
        return view('kasir.restoran.orders.index', compact('orders'));
    }
}