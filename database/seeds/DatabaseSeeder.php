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
            SpatiePermissionSeeder::class,
            SpatieRoleSeeder::class
        ]);

        $this->call([
            AssignPermissionUserSeeder::class,
            AssignPermissionRoleSeeder::class,
            AssignRoleUserSeeder::class
        ]);
    }
}
