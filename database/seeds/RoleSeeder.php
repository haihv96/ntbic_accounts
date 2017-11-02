<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Role::insert([
            ['source' => 'ntbic_home', 'name' => 'admin'],
            ['source' => 'ntbic_home', 'name' => 'moderator'],
            ['source' => 'ntbic_database', 'name' => 'admin'],
            ['source' => 'ntbic_database', 'name' => 'moderator']
        ]);
    }
}
