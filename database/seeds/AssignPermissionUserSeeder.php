<?php

use Illuminate\Database\Seeder;
use App\User;

class AssignPermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $actions = ['read', 'store', 'update', 'destroy'];

        $ntbicDatabaseEntries = [
            'profiles', 'companies',
            'products', 'projects',
            'patents',
        ];

        $ntbicHomeEntries = [
            'tin_tuc', 'su_kien',
            'doi_tac', 'cong_nghe',
            'cau_hoi_thuong_gap', 'tuyen_dung',
            'chuyen_gia', 'to_chuc', 'anh_sidebar'
        ];

        foreach ($ntbicDatabaseEntries as $ntbicDatabaseEntry) {
            foreach ($actions as $action) {
                User::find(1)->givePermissionsTo('ntbic_database', "$action $ntbicDatabaseEntry");
            }
        }

        foreach ($ntbicDatabaseEntries as $ntbicDatabaseEntry) {
            User::find(2)->givePermissionsTo('ntbic_database', "read $ntbicDatabaseEntry");
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            foreach ($actions as $action) {
                User::find(1)->givePermissionsTo('ntbic_home', "$action $ntbicHomeEntry");
            }
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            User::find(2)->givePermissionsTo('ntbic_home', "read $ntbicHomeEntry");
        }
    }
}
