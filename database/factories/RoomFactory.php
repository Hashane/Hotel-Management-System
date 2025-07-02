<?php

namespace Database\Factories;

use App\Enums\RoomStatus;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room_type_id = RoomType::inRandomOrder()->value('id');
        $floor = rand(1, 3);

        // Unique within the faker session
        $room_no = $this->faker->unique()->numberBetween(1, 20);
        $full_room_no = $floor.$room_no;

        return [
            'room_type_id' => $room_type_id,
            'floor' => $floor,
            'room_no' => $full_room_no,
            'name' => (string) $full_room_no,
            'status' => $this->faker->randomElement(Arr::pluck(RoomStatus::cases(), 'value')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
