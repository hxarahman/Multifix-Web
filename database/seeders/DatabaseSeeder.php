<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            RoleUserTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
        ]);
    }
}