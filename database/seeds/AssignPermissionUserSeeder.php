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
            'chuyen_gia', 'doanh_nghiep',
            'san_pham', 'de_tai_du_an_cac_cap',
            'phat_minh', 'don_vi_uom_tao'
        ];

        $ntbicHomeEntries = [
            'tin_tuc'
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
