<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Helper role checks ──────────────────────────────
    public function isAdmin(): bool           { return $this->role === 'admin'; }
    public function isCeo(): bool             { return $this->role === 'ceo'; }
    public function isResepsionis(): bool     { return $this->role === 'resepsionis'; }
    public function isKasirHotel(): bool      { return $this->role === 'kasir_hotel'; }
    public function isKasirRestoran(): bool   { return $this->role === 'kasir_restoran'; }
    public function isCustomer(): bool        { return $this->role === 'customer'; }

    // ── Redirect path setelah login ─────────────────────
    public function dashboardRoute(): string
    {
        return match($this->role) {
            'admin'           => 'admin.dashboard',
            'ceo'             => 'ceo.dashboard',
            'resepsionis'     => 'resepsionis.dashboard',
            'kasir_hotel'     => 'kasir.hotel.dashboard',
            'kasir_restoran'  => 'kasir.restoran.dashboard',
            default           => 'customer.dashboard',
        };
    }
}