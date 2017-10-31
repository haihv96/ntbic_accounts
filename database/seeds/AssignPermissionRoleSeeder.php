<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatieRole\SpatieRoleInterface;
use App\Repositories\SpatiePermission\SpatiePermissionInterface;
use Spatie\Permission\Models\Role;

class AssignPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $spatieRoleRepository;
    protected $spatiePermissionRepository;

    public function __construct(
        SpatieRoleInterface $spatieRoleRepository,
        SpatiePermissionInterface $spatiePermissionRepository
    )
    {
        $this->spatieRoleRepository = $spatieRoleRepository;
        $this->spatiePermissionRepository = $spatiePermissionRepository;
    }

    public function run()
    {
        Role::findByName('ntbic_database admin')
            ->givePermissionTo([
                'ntbic_database read chuyen_gia',
                'ntbic_database store chuyen_gia',
                'ntbic_database update chuyen_gia',
                'ntbic_database destroy chuyen_gia'
            ]);

        Role::findByName('ntbic_database moderator')
            ->givePermissionTo([
                'ntbic_database read chuyen_gia',
                'ntbic_database store chuyen_gia',
            ]);
    }
}
