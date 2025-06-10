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
            'https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1621891334481-5c14b369d9d7?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/flagged/photo-1556438758-8d49568ce18e?q=80&w=2948&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1631049421450-348ccd7f8949?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ];

        $deluxeImages = [
            'https://images.unsplash.com/photo-1590490359854-dfba19688d70?q=80&w=3174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1631049307290-bb947b114627?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://plus.unsplash.com/premium_photo-1661962495669-d72424626bdc?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1713762523087-41019a875741?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ];

        $suiteImages = [
            'https://plus.unsplash.com/premium_photo-1661875135365-16aab794632f?q=80&w=3053&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://plus.unsplash.com/premium_photo-1675616563084-63d1f129623d?q=80&w=2938&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1667125095636-dce94dcbdd96?q=80&w=2904&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=2914&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',

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
