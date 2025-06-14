<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'room_service_fee'],
            [
                'value' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('settings')->updateOrInsert(
            ['key' => 'accommodation_tax'],
            [
                'value' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('settings')->updateOrInsert(
            ['key' => 'default_checkout_time'],
            [
                'value' => '11:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
