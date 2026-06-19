<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoUsage extends Model
{
    use HasFactory;

    protected $table = 'promo_usage';

    protected $fillable = [
        'promo_id', 'booking_id', 'restaurant_order_id', 'discount_amount'
    ];

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }
}