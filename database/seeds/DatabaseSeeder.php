<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TestSeeder::class
            // SpatiePermissionSeeder::class,
            // SpatieRoleSeeder::class,
            // AssignPermissionUserSeeder::class,
            // AssignPermissionRoleSeeder::class,
            // AssignRoleUserSeeder::class
        ]);
    }
}
