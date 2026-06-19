<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{LandingController, CEOController};
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Resepsionis\ResepsionisController;
use App\Http\Controllers\Kasir\{KasirHotelController, KasirRestoranController};
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\customer\BookingController;
use App\Http\Controllers\CustomerController;

// =====================================================
// PUBLIC — LANDING PAGE
// =====================================================
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/cari-kamar', [LandingController::class, 'searchRooms'])->name('landing.search');

// =====================================================
// AUTH
// =====================================================
require __DIR__.'/auth.php';

// =====================================================
// LOGOUT CONFIRM — semua role bisa akses (hanya perlu auth)
// =====================================================
Route::middleware('auth')->get('/logout', fn() => view('auth.logout'))->name('logout.confirm');

// =====================================================
// DASHBOARD REDIRECT BY ROLE
// =====================================================
Route::middleware('auth')->get('/dashboard', function () {

    return match(auth()->user()->role) {
        'admin'          => redirect()->route('admin.dashboard'),
        'owner'          => redirect()->route('owner.dashboard'),
        'ceo'            => redirect()->route('ceo.dashboard'),
        'resepsionis'    => redirect()->route('resepsionis.dashboard'),
        'kasir_hotel'    => redirect()->route('kasir.hotel.dashboard'),
        'kasir_restoran' => redirect()->route('kasir.restoran.dashboard'),
        default          => redirect()->route('customer.dashboard'),
    };

})->name('dashboard');


// =====================================================
// ADMIN
// =====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard',         [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users',             [AdminController::class, 'users'])->name('users');
    Route::get('/users/create',      [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users',            [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}',      [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}',   [AdminController::class, 'deleteUser'])->name('users.delete');

    // Rooms
    Route::get('/rooms',             [AdminController::class, 'rooms'])->name('rooms');
    Route::post('/rooms',            [AdminController::class, 'storeRoom'])->name('rooms.store');
    Route::delete('/rooms/{room}',   [AdminController::class, 'deleteRoom'])->name('rooms.delete');

    // Bookings, Guests, Restaurant
    Route::get('/bookings',          [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/guests',            [AdminController::class, 'guests'])->name('guests');
    Route::get('/restaurant-menus',  [AdminController::class, 'restaurantMenus'])->name('restaurant-menus');

    // Laporan
    Route::get('/laporan',           [AdminController::class, 'laporan'])->name('laporan');
});


// =====================================================
// OWNER
// =====================================================
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard', [
            'totalRevenue'  => \App\Models\Payment::where('payment_status', 'paid')->sum('amount'),
            'totalBookings' => \App\Models\Booking::count(),
            'totalRooms'    => \App\Models\Room::count(),
        ]);
    })->name('dashboard');

});


// =====================================================
// CEO
// =====================================================
Route::middleware(['auth', 'role:ceo'])->prefix('ceo')->name('ceo.')->group(function () {

    Route::get('/dashboard',          [CEOController::class, 'dashboard'])->name('dashboard');

    // Reports
    Route::get('/reports/financial',  [CEOController::class, 'financialReport'])->name('reports.financial');
    Route::get('/reports/bookings',   [CEOController::class, 'bookingsReport'])->name('reports.bookings');
    Route::get('/reports/restaurant', [CEOController::class, 'restaurantReport'])->name('reports.restaurant');
    Route::get('/reports/export',     [CEOController::class, 'exportLaporan'])->name('reports.export');
    Route::get('/export',             [CEOController::class, 'exportLaporan'])->name('export');

});


// =====================================================
// RESEPSIONIS
// =====================================================
Route::middleware(['auth', 'role:resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {

    Route::get('/dashboard',                     [ResepsionisController::class, 'dashboard'])->name('dashboard');

    // Bookings
    Route::get('/bookings', [ResepsionisController::class, 'bookings'])
    ->name('bookings.index');
    Route::get('/bookings/create',               [ResepsionisController::class, 'createBooking'])->name('bookings.create');
    Route::post('/bookings',                     [ResepsionisController::class, 'storeBooking'])->name('bookings.store');
    Route::post('/bookings/{booking}/confirm',   [ResepsionisController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/check-in',  [ResepsionisController::class, 'checkIn'])->name('bookings.checkin');
    Route::post('/bookings/{booking}/check-out', [ResepsionisController::class, 'checkOut'])->name('bookings.checkout');

    // Invoice & Kamar
    Route::get('/invoice/{booking}',             [ResepsionisController::class, 'invoice'])->name('invoice');
    Route::get('/rooms',                         [ResepsionisController::class, 'rooms'])->name('rooms');
    Route::patch('/rooms/{room}/status',         [ResepsionisController::class, 'updateRoomStatus'])->name('rooms.status');

    // Checkout & Room Service
    Route::get('/checkout/{booking}',            [ResepsionisController::class, 'showCheckout'])->name('checkout');
    Route::post('/tag-to-bill/{order}',          [ResepsionisController::class, 'tagToBill'])->name('tag-to-bill');

    // AJAX calendar
    Route::get('/booking-events',                [ResepsionisController::class, 'bookingEvents'])->name('booking-events');

     Route::get('/guest-status', [ResepsionisController::class, 'guestStatus'])
            ->name('guest-status');
    });


// =====================================================
// KASIR HOTEL
// =====================================================
Route::middleware(['auth'])->prefix('kasir/hotel')->name('kasir.hotel.')->group(function () {

    Route::get('/dashboard',          [KasirHotelController::class, 'dashboard'])->name('dashboard');

    // Payments
    Route::get('/payments',           [KasirHotelController::class, 'paymentsIndex'])->name('payments.index');
    Route::get('/payments/{booking}', [KasirHotelController::class, 'processPayment'])->name('payment');
    Route::post('/payments/{booking}',[KasirHotelController::class, 'storePayment'])->name('payment.store');

    // Invoices
    Route::get('/invoices',           [KasirHotelController::class, 'invoicesIndex'])->name('invoices.index');
    Route::get('/invoices/{payment}', [KasirHotelController::class, 'invoiceShow'])->name('invoices.show');

    // Riwayat
    Route::get('/transactions',       [KasirHotelController::class, 'history'])->name('transactions.history');

});


// =====================================================
// KASIR RESTORAN (SUDAH DI-FIX: MURNI RESTORAN SAJA)
// =====================================================
Route::middleware(['auth'])->prefix('kasir/restoran')->name('kasir.restoran.')->group(function () {

    // Dashboard Restoran murni panggil KasirRestoranController
    Route::get('/dashboard',         [KasirRestoranController::class, 'dashboard'])->name('dashboard');

    // POS
    Route::get('/pos',               [KasirRestoranController::class, 'pos'])->name('pos');

    // Order
    Route::get('/orders',            [KasirRestoranController::class, 'ordersIndex'])->name('orders.index');
    Route::get('/order/create',      [KasirRestoranController::class, 'createOrder'])->name('order.create');
    Route::post('/order',            [KasirRestoranController::class, 'storeOrder'])->name('order.store');

    // Payment & Struk
    Route::get('/payment/{order}',   [KasirRestoranController::class, 'processPayment'])->name('payment');
    Route::post('/payment/{order}',  [KasirRestoranController::class, 'storePayment'])->name('payment.store');
    Route::get('/struk/{order}',     [KasirRestoranController::class, 'struk'])->name('struk');

    // Riwayat & Statistik
    Route::get('/history',           [KasirRestoranController::class, 'history'])->name('history');
    Route::get('/menu-stats',        [KasirRestoranController::class, 'menuStats'])->name('menu.stats');

    Route::get('/restaurant/order/{id}', function ($id) {
        return view('restaurant.order', compact('id'));
    })->name('restaurant.order');

});


// =====================================================
// CUSTOMER
// =====================================================
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard',    fn() => view('customer.dashboard'))->name('dashboard');
    Route::get('/bookings',     fn() => view('customer.bookings'))->name('bookings');
    Route::get('/history',      fn() => view('customer.history'))->name('history');
    Route::get('/profile',      fn() => view('customer.profile'))->name('profile');
    Route::get('/search-rooms', fn() => view('customer.search-rooms'))->name('search-rooms');

    Route::get('/new-booking',  fn() => view('customer.new-booking'))->name('new-booking');
    Route::post('/new-booking', [CustomerBookingController::class, 'store'])->name('new-booking.store');

    // Detail booking (dipanggil dari tabel di customer dashboard)
    Route::get('/bookings/{booking}', [CustomerBookingController::class, 'show'])->name('booking-detail');

    // Posisikan rute review di sini agar terbaca sebagai 'customer.booking-review'
    Route::get('/booking-review/{id}', [CustomerBookingController::class, 'review'])->name('booking-review');

    // Mengamankan rute backup Anda agar namanya tetap konsisten
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('bookings.store');
    Route::get('/rooms/available', [CustomerBookingController::class, 'availableRooms'])->name('rooms.available');
    
    // --- TAMBAHKAN KODE DI BAWAH INI ---
    Route::get('/profile/edit', [CustomerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [CustomerController::class, 'update'])->name('profile.update'); // Ditambahkan agar form edit bisa submit data
    // ----------------------------------

    Route::get('/profile/change-password', [CustomerController::class, 'showChangePassword'])->name('profile.change-password');
});