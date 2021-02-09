<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MyCore\Core\Database\Seeds\PermissionSeeder;
use MyCore\Core\Database\Seeds\RolePermissionSeeder;
use MyCore\Core\Database\Seeds\RoleUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
