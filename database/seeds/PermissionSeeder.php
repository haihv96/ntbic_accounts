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
                Permission::create([
                    'source' => 'ntbic_database', 'name' => "$action $ntbicDatabaseEntry"
                ]);
            }
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            foreach ($actions as $action) {
                Permission::create([
                    'source' => 'ntbic_database', 'name' => "$action $ntbicHomeEntry"
                ]);
            }
        }
    }
}
