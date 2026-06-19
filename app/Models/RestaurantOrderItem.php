<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantOrderItem extends Model
{
    protected $table = 'restaurant_order_items';

    protected $fillable = [
        'restaurant_order_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
        'notes'
    ];

    public function menu()
    {
        return $this->belongsTo(RestaurantMenu::class, 'menu_id');
    }

    public function order()
    {
        return $this->belongsTo(RestaurantOrder::class, 'restaurant_order_id');
    }
}