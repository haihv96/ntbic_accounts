<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class AssignPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Role::findRole('ntbic_home', 'admin')->givePermissionTo('ntbic_home', 'read tin_tuc');
        Role::findRole('ntbic_home', 'admin')->givePermissionTo('ntbic_home', 'store tin_tuc');
        Role::findRole('ntbic_home', 'admin')->givePermissionTo('ntbic_home', 'update tin_tuc');
        Role::findRole('ntbic_home', 'admin')->givePermissionTo('ntbic_home', 'destroy tin_tuc');

        Role::findRole('ntbic_database', 'admin')->givePermissionTo('ntbic_database', 'read chuyen_gia');
        Role::findRole('ntbic_database', 'admin')->givePermissionTo('ntbic_database', 'store chuyen_gia');
        Role::findRole('ntbic_database', 'admin')->givePermissionTo('ntbic_database', 'update chuyen_gia');
        Role::findRole('ntbic_database', 'admin')->givePermissionTo('ntbic_database', 'destroy chuyen_gia');
    }
}
