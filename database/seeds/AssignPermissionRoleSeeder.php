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
        $actions = ['read', 'store', 'update', 'destroy'];

        $ntbicDatabaseEntries = [
            'chuyen_gia', 'doanh_nghiep',
            'san_pham', 'de_tai_du_an_cac_cap',
            'phat_minh', 'don_vi_uom_tao', 'role_permissions', 'permission',
            'user_roles', 'user_permissions'
        ];

        $ntbicHomeEntries = [
            'tin_tuc', 'su_kien',
            'doi_tac', 'cong_nghe',
            'cau_hoi_thuong_gap', 'tuyen_dung',
            'chuyen_gia', 'to_chuc', 'anh_sidebar', 'permission',
            'role_permissions', 'user_roles', 'user_permissions'
        ];

        $ntbicAccountsEntries = [
            'users', 'permission', 'role_permissions', 'user_roles', 'user_permissions'
        ];

        foreach ($ntbicDatabaseEntries as $ntbicDatabaseEntry) {
            foreach ($actions as $action) {
                Role::findRole('ntbic_database', 'admin')
                    ->givePermissionsTo('ntbic_database', "$action $ntbicDatabaseEntry");
            }
        }

        foreach ($ntbicDatabaseEntries as $ntbicDatabaseEntry) {
            Role::findRole('ntbic_database', 'moderator')
                ->givePermissionsTo('ntbic_database', "read $ntbicDatabaseEntry");
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            foreach ($actions as $action) {
                Role::findRole('ntbic_home', 'admin')
                    ->givePermissionsTo('ntbic_home', "$action $ntbicHomeEntry");
            }
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            Role::findRole('ntbic_home', 'moderator')
                ->givePermissionsTo('ntbic_home', "read $ntbicHomeEntry");
        }

        foreach ($ntbicAccountsEntries as $ntbicAccountsEntry) {
            foreach ($actions as $action) {
                Role::findRole('ntbic_accounts', 'admin')
                    ->givePermissionsTo('ntbic_accounts', "$action $ntbicAccountsEntry");
            }
        }

        foreach ($ntbicAccountsEntries as $ntbicAccountsEntry) {
            Role::findRole('ntbic_accounts', 'moderator')
                ->givePermissionsTo('ntbic_accounts', "read $ntbicAccountsEntry");
        }
    }
}
