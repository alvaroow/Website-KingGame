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
            'price_per_hour' => 10000,
            'description' => 'PS3 dengan koleksi game klasik',
            'status' => 'available',
        ]);
        
        Device::create([
            'name' => 'PlayStation 4',
            'type' => 'console',
            'price_per_hour' => 20000,
            'description' => 'PS4 dengan game-game terbaik',
            'status' => 'available',
        ]);
        
        Device::create([
            'name' => 'PlayStation 5',
            'type' => 'console',
            'price_per_hour' => 35000,
            'description' => 'PS5 next-gen dengan grafis memukau',
            'status' => 'available',
        ]);
    }
}