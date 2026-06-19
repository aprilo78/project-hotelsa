<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    protected $fillable = [
        'guest_id', 'booking_id', 'total_price', 'status', 'billed_to_room',
    ];

    protected $casts = ['billed_to_room' => 'boolean'];

    public function guest()   { return $this->belongsTo(User::class, 'guest_id'); }
    public function booking() { return $this->belongsTo(Booking::class); }
    public function details() { return $this->hasMany(RestaurantOrderDetail::class); }
    public function payment() { return $this->hasOne(RestaurantPayment::class); }

    public function recalculateTotal(): void
    {
        $this->total_price = $this->details()->sum(\DB::raw('quantity * price'));
        $this->save();
    }
}