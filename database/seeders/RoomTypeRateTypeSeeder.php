<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeRateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Standard Room - price is per day rate for that stay type
            ['room_type_id' => 1, 'rate_type_id' => 1, 'price' => 200.00],  // per day
            ['room_type_id' => 1, 'rate_type_id' => 2, 'price' => 150.00],  // weekly per day
            ['room_type_id' => 1, 'rate_type_id' => 3, 'price' => 100.00],  // monthly per day

            // Deluxe Room
            ['room_type_id' => 2, 'rate_type_id' => 1, 'price' => 300.00],
            ['room_type_id' => 2, 'rate_type_id' => 2, 'price' => 250.00],
            ['room_type_id' => 2, 'rate_type_id' => 3, 'price' => 200.00],

            // Suite Room
            ['room_type_id' => 3, 'rate_type_id' => 1, 'price' => 400.00],
            ['room_type_id' => 3, 'rate_type_id' => 2, 'price' => 350.00],
            ['room_type_id' => 3, 'rate_type_id' => 3, 'price' => 300.00],
        ];

        foreach ($data as $row) {
            DB::table('room_type_rate_types')->updateOrInsert([
                'room_type_id' => $row['room_type_id'],
                'rate_type_id' => $row['rate_type_id'],
            ], [
                'price' => $row['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
