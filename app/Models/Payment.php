<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id','kasir_id','amount','payment_method',
        'bank','payment_status','note','midtrans_token','midtrans_status',
    ];

    public function booking()   { return $this->belongsTo(Booking::class); }
    public function kasir()     { return $this->belongsTo(User::class, 'kasir_id'); }

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