<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);

        $this->call([
            FacilitySeeder::class,
            RoomTypeSeeder::class,
            RoomTypeFacilitySeeder::class,
            RoomSeeder::class,
            RateTypeSeeder::class,
            RoomTypeRateTypeSeeder::class,
            SettingsSeeder::class,
            ServiceTypeSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            SuperAdminSeeder::class,
        ]);
    }
}
