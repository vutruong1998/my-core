<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MyCore\Core\Database\Seeds\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
    }
}
