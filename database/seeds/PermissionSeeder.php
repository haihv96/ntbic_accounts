<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

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
        Permission::insert([
            ['source' => 'ntbic_home', 'name' => 'read tin_tuc'],
            ['source' => 'ntbic_home', 'name' => 'store tin_tuc'],
            ['source' => 'ntbic_home', 'name' => 'update tin_tuc'],
            ['source' => 'ntbic_home', 'name' => 'destroy tin_tuc'],
            ['source' => 'ntbic_database', 'name' => 'read chuyen_gia'],
            ['source' => 'ntbic_database', 'name' => 'update chuyen_gia'],
            ['source' => 'ntbic_database', 'name' => 'store chuyen_gia'],
            ['source' => 'ntbic_database', 'name' => 'destroy chuyen_gia']
        ]);
    }
}
