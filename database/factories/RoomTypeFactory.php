<?php

namespace Database\Factories;

use App\Enums\RoomCategory;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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

        $roomType = Arr::random(RoomCategory::cases());

        switch ($roomType->value) {
            case RoomCategory::STANDARD->value:
                $images = $standardImages;
                break;
            case RoomCategory::DELUXE->value:
                $images = $deluxeImages;
                break;
            case RoomCategory::SUITE->value:
                $images = $suiteImages;
                break;
            default:
                $images = [];
        }

        return [
            'name' => $roomType->name,
            'description' => "A {$roomType->name} room with modern facilities.",
            'capacity' => rand(1, 4),
            'image_urls' => json_encode($images),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
