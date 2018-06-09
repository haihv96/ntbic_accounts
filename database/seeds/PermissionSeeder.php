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
        $actions = [
            ['name' => 'read', 'vi_description' => 'đọc'],
            ['name' => 'store', 'vi_description' => 'tạo mới'],
            ['name' => 'update', 'vi_description' => 'chỉnh sửa'],
            ['name' => 'destroy', 'vi_description' => 'xóa']
        ];

        $ntbicDatabaseEntries = [
            ['entry' => 'profiles', 'vi_description' => ''],
            ['entry' => 'companies', 'vi_description' => ''],
            ['entry' => 'projects', 'vi_description' => ''],
            ['entry' => 'products', 'vi_description' => ''],
            ['entry' => 'patents', 'vi_description' => ''],
            ['entry' => 'permission', 'vi_description' => ''],
            ['entry' => 'role_permissions', 'vi_description' => ''],
            ['entry' => 'user_roles', 'vi_description' => ''],
            ['entry' => 'user_permissions', 'vi_description' => ''],
        ];

        $ntbicHomeEntries = [
            ['entry' => 'anh_sidebar', 'vi_description' => ''],
            ['entry' => 'to_chuc', 'vi_description' => ''],
            ['entry' => 'chuyen_gia', 'vi_description' => ''],
            ['entry' => 'tuyen_dung', 'vi_description' => ''],
            ['entry' => 'cau_hoi_thuong_gap', 'vi_description' => ''],
            ['entry' => 'cong_nghe', 'vi_description' => ''],
            ['entry' => 'doi_tac', 'vi_description' => ''],
            ['entry' => 'su_kien', 'vi_description' => ''],
            ['entry' => 'tin_tuc', 'vi_description' => ''],
            ['entry' => 'permission', 'vi_description' => ''],
            ['entry' => 'role_permissions', 'vi_description' => ''],
            ['entry' => 'user_roles', 'vi_description' => ''],
            ['entry' => 'user_permissions', 'vi_description' => ''],
        ];

        $ntbicAccountsEntries = [
            ['entry' => 'users', 'vi_description' => ''],
            ['entry' => 'permission', 'vi_description' => ''],
            ['entry' => 'role_permissions', 'vi_description' => ''],
            ['entry' => 'user_roles', 'vi_description' => ''],
            ['entry' => 'user_permissions', 'vi_description' => ''],
        ];

        foreach ($ntbicDatabaseEntries as $ntbicDatabaseEntry) {
            foreach ($actions as $action) {
                Permission::create([
                    'source' => 'ntbic_database',
                    'name' => $action['name'] . ' ' . $ntbicDatabaseEntry['entry'],
                    'vi_description' => $action['vi_description']
                        . ' ' . $ntbicDatabaseEntry['vi_description']
                ]);
            }
        }

        foreach ($ntbicHomeEntries as $ntbicHomeEntry) {
            foreach ($actions as $action) {
                Permission::create([
                    'source' => 'ntbic_home',
                    'name' => $action['name'] . ' ' . $ntbicHomeEntry['entry'],
                    'vi_description' => $action['vi_description'] . ' ' . $ntbicHomeEntry['vi_description']
                ]);
            }
        }

        foreach ($ntbicAccountsEntries as $ntbicAccountsEntry) {
            foreach ($actions as $action) {
                Permission::create([
                    'source' => 'ntbic_accounts',
                    'name' => $action['name'] . ' ' . $ntbicAccountsEntry['entry'],
                    'vi_description' => $action['vi_description'] . ' ' . $ntbicAccountsEntry['vi_description']
                ]);
            }
        }

    }
}
