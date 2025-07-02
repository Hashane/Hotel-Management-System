<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeRateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypeIds = RoomType::pluck('id')->toArray();
        $rateTypeIds = [1, 2, 3]; // fixed rate_type IDs

        foreach ($roomTypeIds as $roomTypeId) {
            foreach ($rateTypeIds as $rateTypeId) {
                DB::table('room_type_rate_types')->updateOrInsert(
                    [
                        'room_type_id' => $roomTypeId,
                        'rate_type_id' => $rateTypeId,
                    ],
                    [
                        'price' => fake()->randomFloat(2, 50, 300), // fake price between 50 and 300
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
