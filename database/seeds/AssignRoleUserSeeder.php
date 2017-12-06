<?php

use Illuminate\Database\Seeder;
use App\User;

class AssignRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::find(1)->assignRoles('ntbic_database', 'admin');
        User::find(2)->assignRoles('ntbic_database', 'moderator');

        User::find(1)->assignRoles('ntbic_home', 'admin');
        User::find(2)->assignRoles('ntbic_home', 'moderator');

        User::find(1)->assignRoles('ntbic_accounts', 'admin');
        User::find(2)->assignRoles('ntbic_accounts', 'moderator');
    }
}
