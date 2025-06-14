<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clerkRole = Role::firstOrCreate(['name' => 'clerk']);
        $clerkUser = User::firstOrCreate(
            ['email' => 'clerk@fourseasons.com'],
            [
                'name' => 'Clerk Test',
                'password' => Hash::make('password'),
            ]
        );
        if (! $clerkUser->hasRole('clerk')) {
            $clerkUser->assignRole('clerk');
        }

        $agentRole = Role::firstOrCreate(['name' => 'travel agent']);
        $agentUser = User::firstOrCreate(
            ['email' => 'agent@fourseasons.com'],
            [
                'name' => 'Travel Agent Joe',
                'password' => Hash::make('password'),
            ]
        );
        if (! $agentUser->hasRole('travel agent')) {
            $agentUser->assignRole('travel agent');
        }
    }
}
