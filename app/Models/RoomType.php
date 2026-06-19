<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price_per_night', 'max_occupancy',
        'has_extra_bed', 'extra_bed_price', 'photo_url'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}