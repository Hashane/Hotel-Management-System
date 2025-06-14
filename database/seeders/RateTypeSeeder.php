<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('rate_types')->insert([
            [
                'name' => 'per_day',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'weekly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'monthly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
