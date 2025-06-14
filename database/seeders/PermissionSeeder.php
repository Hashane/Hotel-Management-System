<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view users', 'create users', 'update users', 'delete users',
            'view reservations', 'create reservations', 'update reservations', 'delete reservations',
            'view customer', 'create customer', 'update customer', 'delete customer',
            'view rooms', 'create rooms', 'update rooms', 'delete rooms',
            'assign roles', 'check in guests', 'check out guests',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
    }
}
