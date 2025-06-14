<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Room Service', 'base_price' => 1500],
            ['name' => 'Laundry', 'base_price' => 1000],
            ['name' => 'Spa Treatment', 'base_price' => 5000],
            ['name' => 'Airport Pickup', 'base_price' => 3500],
            ['name' => 'Extra Bed', 'base_price' => 2000],
            ['name' => 'Late Checkout', 'base_price' => 2500],
            ['name' => 'Mini Bar Usage', 'base_price' => 1200],
            ['name' => 'Breakfast Buffet', 'base_price' => 1800],
            ['name' => 'City Tour Package', 'base_price' => 7000],
            ['name' => 'Conference Room Rent', 'base_price' => 8500],

            ['name' => 'Massage (30 mins)', 'base_price' => 3000],
            ['name' => 'Massage (1 hour)', 'base_price' => 5500],
            ['name' => 'Gym Access', 'base_price' => 1000],
            ['name' => 'Pool Access', 'base_price' => 800],
            ['name' => 'Shuttle Service', 'base_price' => 2500],
            ['name' => 'Valet Parking', 'base_price' => 700],
            ['name' => 'Doctor on Call', 'base_price' => 5000],
            ['name' => 'Business Center Usage', 'base_price' => 1500],
            ['name' => 'Wi-Fi Upgrade (High Speed)', 'base_price' => 900],
            ['name' => 'Bicycle Rental', 'base_price' => 1200],

            ['name' => 'Dinner Buffet', 'base_price' => 2500],
            ['name' => 'Lunch Buffet', 'base_price' => 2200],
            ['name' => 'Early Check-in', 'base_price' => 2000],
            ['name' => 'Pet Accommodation', 'base_price' => 3000],
            ['name' => 'Childcare Service', 'base_price' => 4000],
            ['name' => 'Birthday Setup in Room', 'base_price' => 3500],
            ['name' => 'Honeymoon Room Setup', 'base_price' => 6000],
            ['name' => 'Anniversary Special Dinner', 'base_price' => 5000],
            ['name' => 'In-Room Candlelight Dinner', 'base_price' => 6500],
            ['name' => 'VIP Lounge Access', 'base_price' => 3000],
        ];

        DB::table('service_types')->insert($services);
    }
}
