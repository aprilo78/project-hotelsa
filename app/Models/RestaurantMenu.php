<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RestaurantMenu extends Model
{
    protected $fillable = ['name','description','price','foto_url','is_available'];
    protected $casts    = ['is_available' => 'boolean'];

    public function orderDetails()
    {
        return $this->hasMany(RestaurantOrderDetail::class);
    }

    public function totalOrdered(): int
    {
        return $this->orderDetails()->sum('quantity');
    }
}

// ---

// namespace App\Models;
// RestaurantOrder — save to separate file app/Models/RestaurantOrder.php

// namespace App\Models;
// RestaurantOrderDetail — save to separate file app/Models/RestaurantOrderDetail.php

// namespace App\Models;
// RestaurantPayment — save to separate file app/Models/RestaurantPayment.php