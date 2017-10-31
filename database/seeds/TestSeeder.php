<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table("roles")->insert([
	    	['name' => 'admin', 'source' => 'ntbic_home'],
	    	['name' => 'moderator','source' => 'ntbic_home'],
	    	['name' => 'admin',	'source' => 'ntbic_database'],
	    	['name' => 'moderator','source' => 'ntbic_database']
    	]);

    	DB::table("permissions")->insert([
    		['name' => 'read chuyen_gia','source' => 'ntbic_database'],
	    	['name' => 'store chuyen_gia','source' => 'ntbic_database'],
	    	['name' => 'update chuyen_gia','source' => 'ntbic_database'],
	    	['name' => 'destroy chuyen_gia','source' => 'ntbic_database'],
	    	['name' => 'read tin_tuc','source' => 'ntbic_home'],
	    	['name' => 'store tin_tuc','source' => 'ntbic_home'],
	    	['name' => 'update tin_tuc','source' => 'ntbic_home'],
	    	['name' => 'destroy tin_tuc','source' => 'ntbic_home']
    	]);

    	DB::table("role_has_permissions")->insert([
    		['role_id' => 1,'permission_id' => 5],
	    	['role_id' => 1,'permission_id' => 6],
	    	['role_id' => 1,'permission_id' => 7],
	    	['role_id' => 1,'permission_id' => 8],
	    	['role_id' => 3,'permission_id' => 1],
	    	['role_id' => 3,'permission_id' => 2],
	    	['role_id' => 3,'permission_id' => 3],
	    	['role_id' => 3,'permission_id' => 4]
    	]);  

    	DB::table("user_has_roles")->insert([
    		['role_id' => 1,'user_id' => 1],
	    	['role_id' => 2,'user_id' => 1],
	    	['role_id' => 3,'user_id' => 2],
	    	['role_id' => 4,'user_id' => 2]
    	]);

    	DB::table("user_has_permissions")->insert([
    		['permission_id' => 5,'user_id' => 1],
	    	['permission_id' => 6,'user_id' => 1],
	    	['permission_id' => 1,'user_id' => 2],
	    	['permission_id' => 2,'user_id' => 2]
    	]);   
    }
}
