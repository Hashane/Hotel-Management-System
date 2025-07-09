<?php

namespace Database\Seeders;

use App\Models\RatePlan;
use App\Models\RoomRate;
use App\Models\RoomType;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HotelPricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rate Plans
        $bar = RatePlan::create(['name' => 'Best Available Rate', 'code' => 'BAR']);
        $nonref = RatePlan::create([
            'name' => 'Non-Refundable',
            'code' => 'NONREF',
            'parent_id' => $bar->id,
            'adjustment_type' => 'percent',
            'adjustment_value' => 10,
        ]);

        // Seasons
        $peak = Season::create([
            'name' => 'Peak Season',
            'start_date' => '2025-12-20',
            'end_date' => '2026-01-05',
        ]);

        $off = Season::create([
            'name' => 'Off Season',
            'start_date' => '2025-05-01',
            'end_date' => '2025-06-15',
        ]);

        // Sample Daily Rates (BAR only)
        $start = Carbon::create(2025, 7, 1);
        $end = Carbon::create(2025, 7, 10);

        $allRoomTypes = RoomType::all();

        foreach ($allRoomTypes as $roomType) {
            foreach ($start->copy()->daysUntil($end) as $date) {
                RoomRate::create([
                    'room_type_id' => $roomType->id,
                    'rate_plan_id' => $bar->id,
                    'date' => $date,
                    'price' => 120 + rand(0, 20),
                ]);

            }
        }

    }
}
