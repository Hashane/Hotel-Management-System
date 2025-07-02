<?php

namespace Database\Factories;

use App\Enums\RoomCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RoomCategoryFactory extends Factory
{
    public function definition(): array
    {
        $roomCategory = Arr::random(RoomCategory::cases());

        return [
            'name' => $roomCategory->name,
        ];
    }
}
