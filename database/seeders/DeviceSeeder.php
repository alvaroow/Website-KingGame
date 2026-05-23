<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::create([
            'name' => 'PlayStation 3',
            'type' => 'console',
            'price_per_hour' => 5000,
            'stock' => 7,
            'description' => 'PS3 dengan koleksi game klasik',
            'status' => 'available',
        ]);
        
        Device::create([
            'name' => 'PlayStation 4',
            'type' => 'console',
            'price_per_hour' => 10000,
            'stock' => 7,
            'description' => 'PS4 dengan game-game terbaik',
            'status' => 'available',
        ]);
        
        Device::create([
            'name' => 'PlayStation 5',
            'type' => 'console',
            'price_per_hour' => 15000,
            'stock' => 7,
            'description' => 'PS5 next-gen dengan grafis memukau',
            'status' => 'available',
        ]);
    }
}