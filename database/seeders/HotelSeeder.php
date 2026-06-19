<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RoomPackage;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HotelSeeder extends Seeder
{
    public function run()
    {
        // Users per Role
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'CEO Hotel',
            'email' => 'ceo@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'ceo'
        ]);

        User::create([
            'name' => 'Resepsionis 1',
            'email' => 'resepsionis@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'resepsionis'
        ]);

        // Kasir Hotel
        User::create([
            'name' => 'Kasir Hotel',
            'email' => 'kasir.hotel@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
            'kasir_type' => 'hotel'
        ]);

        // Kasir Restoran
        User::create([
            'name' => 'Kasir Restoran',
            'email' => 'kasir.restoran@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
            'kasir_type' => 'restoran'
        ]);
        // Customer
        User::create([
            'name' => 'Customer Test',
            'email' => 'anita@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);

        // Room Types
        $deluxe = RoomType::create([
            'name' => 'Deluxe Room',
            'description' => 'Kamar deluxe dengan view bagus',
            'base_price' => 750000,
            'capacity' => 2,
            'facilities' => ['AC', 'TV', 'WiFi', 'Kamar Mandi']
        ]);

        $suite = RoomType::create([
            'name' => 'Junior Suite',
            'description' => 'Kamar suite mewah',
            'base_price' => 1250000,
            'capacity' => 3,
            'facilities' => ['AC', 'TV', 'WiFi', 'Mini Bar', 'Bathtub']
        ]);

        // Rooms
        for ($i = 101; $i <= 110; $i++) {
            Room::create([
                'room_type_id' => $deluxe->id,
                'room_number' => $i,
                'status' => 'available'
            ]);
        }

        for ($i = 201; $i <= 205; $i++) {
            Room::create([
                'room_type_id' => $suite->id,
                'room_number' => $i,
                'status' => 'available'
            ]);
        }

        // Room Packages
        RoomPackage::create([
            'name' => 'Kamar Saja',
            'room_type_id' => $deluxe->id,
            'price' => 750000,
            'includes' => 'Kamar + WiFi + AC'
        ]);

        RoomPackage::create([
            'name' => 'Kamar + Breakfast',
            'room_type_id' => $deluxe->id,
            'price' => 850000,
            'includes' => 'Kamar + Sarapan Pagi + WiFi'
        ]);

        RoomPackage::create([
            'name' => 'Full Package',
            'room_type_id' => $suite->id,
            'price' => 1500000,
            'includes' => 'Kamar Suite + Breakfast + Dinner + Spa'
        ]);

        // Menu Restoran
        $menus = [
            ['name' => 'Nasi Goreng Special', 'price' => 45000, 'category' => 'Makanan'],
            ['name' => 'Ayam Bakar', 'price' => 65000, 'category' => 'Makanan'],
            ['name' => 'Mie Ayam', 'price' => 38000, 'category' => 'Makanan'],
            ['name' => 'Es Teh Manis', 'price' => 12000, 'category' => 'Minuman'],
            ['name' => 'Juice Alpukat', 'price' => 25000, 'category' => 'Minuman'],
            ['name' => 'Brownies', 'price' => 28000, 'category' => 'Dessert'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}