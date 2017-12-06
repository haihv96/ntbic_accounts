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
        $ntbicDatabaseRoles = [
            'admin', 'moderator'
        ];

        $ntbicHomeRoles = [
            'admin', 'moderator'
        ];

        $ntbicAccountsRoles = [
            'admin', 'moderator'
        ];

        foreach ($ntbicDatabaseRoles as $ntbicDatabaseRole) {
            Role::create([
                'source' => 'ntbic_database', 'name' => $ntbicDatabaseRole
            ]);
        }

        foreach ($ntbicHomeRoles as $ntbicHomeRole) {
            Role::create([
                'source' => 'ntbic_home', 'name' => $ntbicHomeRole
            ]);
        }

        foreach ($ntbicAccountsRoles as $ntbicAccountsRole) {
            Role::create([
                'source' => 'ntbic_accounts', 'name' => $ntbicAccountsRole
            ]);
        }
    }
}
