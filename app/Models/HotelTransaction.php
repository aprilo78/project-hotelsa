<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'user_id', 'transaction_number', 'amount',
        'payment_type', 'payment_method', 'bank', 'payment_status',
        'midtrans_transaction_id', 'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}