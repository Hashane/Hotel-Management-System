<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        RoomCategory::factory()->count(3)->create();
        $roomTypes = [
            [
                'room_category_id' => 1, // Standard
                'name' => 'Standard Queen',
                'bed_type' => 'Queen',
                'capacity' => 2,
                'size' => 22.0,
                'description' => 'Comfortable room with queen bed and city view.',
                'image_urls' => [
                    'https://images.unsplash.com/photo-1590490359854-dfba19688d70?q=80&w=3174&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?q=80&w=2940&auto=format&fit=crop',
                ],
            ],
            [
                'room_category_id' => 1,
                'name' => 'Standard Twin',
                'bed_type' => 'Twin',
                'capacity' => 2,
                'size' => 21.0,
                'description' => 'Twin bed standard room ideal for two guests.',
                'image_urls' => [
                    'https://images.unsplash.com/photo-1631049307290-bb947b114627?q=80&w=2940&auto=format&fit=crop',
                ],
            ],
            [
                'room_category_id' => 2, // Deluxe
                'name' => 'Deluxe King',
                'bed_type' => 'King',
                'capacity' => 2,
                'size' => 28.5,
                'description' => 'Spacious deluxe room with king bed and modern decor.',
                'image_urls' => [
                    'https://plus.unsplash.com/premium_photo-1661962495669-d72424626bdc?q=80&w=2942&auto=format&fit=crop',
                ],
            ],
            [
                'room_category_id' => 2,
                'name' => 'Deluxe Twin',
                'bed_type' => 'Twin',
                'capacity' => 2,
                'size' => 27.0,
                'description' => 'Deluxe twin bed room with modern facilities.',
                'image_urls' => [
                    'https://images.unsplash.com/photo-1713762523087-41019a875741?q=80&w=2940&auto=format&fit=crop',
                ],
            ],
            [
                'room_category_id' => 3, // Suite
                'name' => 'Junior Suite King',
                'bed_type' => 'King',
                'capacity' => 3,
                'size' => 35.0,
                'description' => 'Elegant junior suite with king bed and seating area.',
                'image_urls' => [
                    'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?q=80&w=2940&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1590490359854-dfba19688d70?q=80&w=3174&auto=format&fit=crop',
                ],
            ],
            [
                'room_category_id' => 3,
                'name' => 'Executive Suite Queen',
                'bed_type' => 'Queen',
                'capacity' => 3,
                'size' => 38.0,
                'description' => 'Luxury executive suite with queen bed and lounge.',
                'image_urls' => [
                    'https://images.unsplash.com/photo-1631049307290-bb947b114627?q=80&w=2940&auto=format&fit=crop',
                ],
            ],
        ];

        foreach ($roomTypes as $type) {
            RoomType::create([
                'room_category_id' => $type['room_category_id'],
                'name' => $type['name'],
                'bed_type' => $type['bed_type'],
                'capacity' => $type['capacity'],
                'size' => $type['size'],
                'description' => $type['description'],
                'image_urls' => json_encode($type['image_urls']),
            ]);
        }
    }
}
