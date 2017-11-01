<?php

use Illuminate\Database\Seeder;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $permissionRepository;

    public function run()
    {
        DB::table('permissions')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'read tin_tuc'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'store tin_tuc'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'update tin_tuc'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_home',
        	'name' => 'destroy tin_tuc'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'read chuyen_gia'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'update chuyen_gia'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'store chuyen_gia'
        ]);

        DB::table('permissions')->insert([
        	'source' => 'ntbic_database',
        	'name' => 'destroy chuyen_gia'
        ]);
    }
}
