<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $facilities = [
            'Free Wi-Fi',
            'Air Conditioning',
            'Swimming Pool',
            'Fitness Center',
            'Room Service',
            'Laundry Service',
            '24-Hour Front Desk',
            'Restaurant',
            'Bar/Lounge',
            'Spa',
            'Sauna',
            'Parking',
            'Valet Parking',
            'Business Center',
            'Conference Room',
            'Airport Shuttle',
            'Pet Friendly',
            'Daily Housekeeping',
            'Mini Bar',
            'Coffee Maker',
            'Flat-screen TV',
            'Cable Channels',
            'In-room Safe',
            'Hair Dryer',
            'Iron and Ironing Board',
            'Non-smoking Rooms',
            'Wheelchair Accessible',
            'Elevator',
            'Garden',
            'Terrace',
            'Balcony',
            'Luggage Storage',
            'Wake-up Service',
            'ATM on Site',
            'Bicycle Rental',
            'Car Rental',
            'Tours and Tickets',
            'Fire Extinguishers',
            'Smoke Alarms',
            'CCTV in Common Areas',
        ];

        foreach ($facilities as $name) {
            DB::table('facilities')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
