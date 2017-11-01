<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('roles')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'admin'
        ]);

        DB::table('roles')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'moderator'
        ]);

        DB::table('roles')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'admin'
        ]);

        DB::table('roles')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'moderator'
        ]);
    }
}
