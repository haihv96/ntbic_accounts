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
        Role::findRole('ntbic_home', 'admin')->givePermissionsTo('ntbic_home',
            ['read tin_tuc', 'store tin_tuc', 'update tin_tuc', 'destroy tin_tuc']);

        Role::findRole('ntbic_database', 'admin')->givePermissionsTo('ntbic_database',
            ['read chuyen_gia', 'store chuyen_gia', 'update chuyen_gia', 'destroy chuyen_gia']);
    }
}
