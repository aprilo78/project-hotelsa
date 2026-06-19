<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_id', 'room_id', 'check_in', 'check_out',
        'total_price', 'booking_type', 'extra_bed', 'extra_bed_price',
        'status', 'payment_status', 'dp_amount', 'notes',
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
        'extra_bed' => 'boolean',
    ];

    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

   public function payments()
{
    return $this->hasMany(\App\Models\Payment::class);
}

    public function restaurantOrders()
    {
        return $this->hasMany(RestaurantOrder::class);
    }

    public function nights(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    public function totalPaid(): float
    {
        return $this->payments()->where('payment_status', 'paid')->sum('amount');
    }

    public function remainingBalance(): float
    {
        return $this->total_price - $this->totalPaid();
    }

    public function restaurantTotal(): float
    {
        return $this->restaurantOrders()->sum('total_price');
    }

    public function grandTotal(): float
    {
        return $this->total_price + $this->restaurantTotal();
    }
}