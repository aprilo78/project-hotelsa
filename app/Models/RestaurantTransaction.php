<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_order_id', 'kasir_id', 'transaction_number', 'amount',
        'payment_method', 'bank', 'payment_status', 'midtrans_transaction_id'
    ];

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}