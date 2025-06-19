<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [];
        // Standard Rooms (room_type_id = 1)
        foreach (range(1, 2) as $floor) {
            foreach (range(1, 5) as $i) {
                $room_no = $floor.str_pad($i, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 1,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Standard $room_no",
                    'status' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Deluxe Rooms (room_type_id = 2)
        foreach (range(2, 4) as $floor) {
            foreach (range(1, 4) as $i) {
                $room_no = $floor.str_pad($i + 5, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 2,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Deluxe $room_no",
                    'status' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Suite Rooms (room_type_id = 3)
        foreach (range(4, 5) as $floor) {
            foreach (range(1, 3) as $i) {
                $room_no = $floor.str_pad($i + 9, 2, '0', STR_PAD_LEFT);
                $rooms[] = [
                    'room_type_id' => 3,
                    'floor' => $floor,
                    'room_no' => $room_no,
                    'name' => "Suite $room_no",
                    'status' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('rooms')->insert($rooms);
    }
}
