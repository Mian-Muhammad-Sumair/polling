<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return string[]
     */
    public function run()
    {
        $this->call(AdminPermissionSeeder::class);
        $this->call(AdminRoleSeeder::class);
    }
}
