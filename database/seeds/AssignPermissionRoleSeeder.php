<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatieRole\SpatieRoleInterface;
use App\Repositories\SpatiePermission\SpatiePermissionInterface;

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
        $this->spatieRoleRepository->findBy('name', 'ntbic_database admin')
            ->givePermissionTo([
                'ntbic_database read chuyen_gia',
                'ntbic_database store chuyen_gia',
                'ntbic_database update chuyen_gia',
                'ntbic_database destroy chuyen_gia'
            ]);

        $this->spatieRoleRepository->findBy('name', 'ntbic_database moderator')
            ->givePermissionTo([
                'ntbic_database read chuyen_gia',
                'ntbic_database store chuyen_gia',
            ]);
    }
}
