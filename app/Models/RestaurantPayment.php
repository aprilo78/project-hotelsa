<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantPayment extends Model
{
    protected $fillable = [
        'restaurant_order_id','kasir_id','amount',
        'payment_method','bank','payment_status','note',
    ];

    public function order()  { return $this->belongsTo(RestaurantOrder::class, 'restaurant_order_id'); }
    public function kasir()  { return $this->belongsTo(User::class, 'kasir_id'); }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if ($model->payment_method === 'cash') {
                $model->bank = null;
            }
        });
    }
}