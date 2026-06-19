<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            [
                'name' => 'Administrator',
                'email' => 'admin@vantella.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'CEO Vantella',
                'email' => 'ceo@vantella.com',
                'password' => Hash::make('ceo12345'),
                'role' => 'ceo',
            ],
            [
                'name' => 'Resepsionis',
                'email' => 'resepsionis@vantella.com',
                'password' => Hash::make('resep123'),
                'role' => 'resepsionis',
            ],
            [
                'name' => 'Kasir Hotel',
                'email' => 'kasirhotel@vantella.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir_hotel',
            ],
            [
                'name' => 'Kasir Restoran',
                'email' => 'kasirrestoran@vantella.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir_restoran',
            ],
        $customer =
            [
                'name' => 'Customer',
                'email' => 'anita@gmail.com',
                'password' => Hash::make('anita123'),
                'role' => 'customer'
            ],
        ];

        foreach ($staff as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}