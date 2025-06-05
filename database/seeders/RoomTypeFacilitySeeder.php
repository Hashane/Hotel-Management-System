<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Map of room type names to their facilities
        $assignments = [
            'Standard Room' => [
                'Free Wi-Fi',
                'Air Conditioning',
                'Flat-screen TV',
                'Daily Housekeeping',
                'Non-smoking Rooms',
            ],
            'Deluxe Room' => [
                'Free Wi-Fi',
                'Air Conditioning',
                'Flat-screen TV',
                'Mini Bar',
                'Room Service',
                'Coffee Maker',
                'Balcony',
                'Hair Dryer',
            ],
            'Suite' => [
                'Free Wi-Fi',
                'Air Conditioning',
                'Flat-screen TV',
                'Mini Bar',
                'Room Service',
                'Coffee Maker',
                'Hair Dryer',
                'In-room Safe',
                'Spa',
                'Sauna',
                'Terrace',
                'Wake-up Service',
            ],
        ];

        foreach ($assignments as $roomTypeName => $facilityNames) {
            $roomType = DB::table('room_types')->where('name', $roomTypeName)->first();
            if (!$roomType) continue;

            foreach ($facilityNames as $facilityName) {
                $facility = DB::table('facilities')->where('name', $facilityName)->first();
                if (!$facility) continue;

                // Avoid duplicates
                DB::table('room_type_facilities')->updateOrInsert([
                    'room_type_id' => $roomType->id,
                    'facility_id' => $facility->id,
                ]);
            }
        }
    }
}
