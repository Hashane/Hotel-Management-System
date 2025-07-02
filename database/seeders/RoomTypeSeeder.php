<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('room_types')->insert([
            [
                'name' => 'Standard Room',
                'description' => 'A basic room with essential amenities.',
                'capacity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Spacious room with a city view and king-size bed.',
                'capacity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suite',
                'description' => 'Luxury suite with separate living area and amenities.',
                'capacity' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
