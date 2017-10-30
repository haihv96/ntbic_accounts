<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatiePermission\SpatiePermissionInterface;

class SpatiePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $spatiePermissionRepository;


    public function __construct(SpatiePermissionInterface $spatiePermissionRepository)
    {
        $this->spatiePermissionRepository = $spatiePermissionRepository;
    }

    public function run()
    {
        $this->spatiePermissionRepository->insert([
            ['guard_name' => 'database_ntbic', 'name' => 'edit scientific_experts'],
            ['guard_name' => 'database_ntbic', 'name' => 'edit scientific_enterprises'],
        ]);
    }
}
