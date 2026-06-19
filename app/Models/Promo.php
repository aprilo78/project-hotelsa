<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'discount_type', 'discount_value', 'valid_from',
        'valid_until', 'min_booking_nights', 'min_transaction_amount',
        'usage_limit', 'used_count', 'is_active'
    ];

    protected function casts(): array
    {
        return [
            'valid_from' => 'date',
            'valid_until' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function usage()
    {
        return $this->hasMany(PromoUsage::class);
    }

    public function isValid()
    {
        $now = now();
        return $this->is_active &&
               $now->between($this->valid_from, $this->valid_until) &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function calculateDiscount($subtotal)
    {
        if ($this->discount_type === 'percentage') {
            return $subtotal * ($this->discount_value / 100);
        }
        return min($this->discount_value, $subtotal);
    }
}