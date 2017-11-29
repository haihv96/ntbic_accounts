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
            'phat_minh', 'don_vi_uom_tao', 'permission',
            'role', 'user_roles', 'user_permissions'
        ];

        $ntbicHomeEntries = [
            'tin_tuc', 'su_kien',
            'doi_tac', 'cong_nghe',
            'cau_hoi_thuong_gap', 'tuyen_dung',
            'chuyen_gia', 'to_chuc', 'anh_sidebar',
            'permission', 'role', 'user_roles', 'user_permissions'
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
                    'source' => 'ntbic_home', 'name' => "$action $ntbicHomeEntry"
                ]);
            }
        }
    }
}
