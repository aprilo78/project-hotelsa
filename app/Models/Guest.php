<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'identity_number',
        'address',
        'photo_url'
    ];

    /**
     * RELASI KE BOOKING
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * OPTIONAL (aktifkan kalau ada guest_id di restaurant_orders)
     */
    public function restaurantOrders()
    {
        return $this->hasMany(RestaurantOrder::class, 'guest_id');
    }
}