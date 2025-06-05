<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $standardImages = [
            'https://images.unsplash.com/photo-1560448071-7a03e5a45e6d?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1501117716987-c8e69bf92d02?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1560449754-15a6c3a03b84?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=800&q=80',
        ];

        $deluxeImages = [
            'https://images.unsplash.com/photo-1502672023488-70e25813eb80?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1486308510493-cb6e98aeb3a1?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=800&q=80',
        ];

        $suiteImages = [
            'https://images.unsplash.com/photo-1505692952046-59db4d891f86?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1486308510493-cb6e98aeb3a1?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=800&q=80',
        ];



        $rooms = [];

        // Standard Rooms (room_type_id = 1)
        foreach (range(1, 2) as $floor) {
            foreach (range(1, 5) as $i) {
                $room_no = $floor . str_pad($i, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 1,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Standard $room_no",
                    'status' => rand(0, 1),
                    'image_url' => $standardImages[array_rand($standardImages)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Deluxe Rooms (room_type_id = 2)
        foreach (range(2, 4) as $floor) {
            foreach (range(1, 4) as $i) {
                $room_no = $floor . str_pad($i + 5, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 2,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Deluxe $room_no",
                    'status' => rand(0, 1),
                    'image_url' => $deluxeImages[array_rand($deluxeImages)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Suite Rooms (room_type_id = 3)
        foreach (range(4, 5) as $floor) {
            foreach (range(1, 3) as $i) {
                $room_no = $floor . str_pad($i + 9, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 3,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Suite $room_no",
                    'status' => rand(0, 1),
                    'image_url' => $suiteImages[array_rand($suiteImages)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }


        DB::table('rooms')->insert($rooms);
    }
}
