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
            ['name' => 'ntbic_database read chuyen_gia'],
            ['name' => 'ntbic_database store chuyen_gia'],
            ['name' => 'ntbic_database update chuyen_gia'],
            ['name' => 'ntbic_database destroy chuyen_gia'],
        ]);
    }
}
