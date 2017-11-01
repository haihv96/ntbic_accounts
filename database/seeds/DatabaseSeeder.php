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
            PermissionSeeder::class,
            RoleSeeder::class,
            AssignPermissionUserSeeder::class,
            AssignPermissionRoleSeeder::class,
            AssignRoleUserSeeder::class
        ]);
    }
}
