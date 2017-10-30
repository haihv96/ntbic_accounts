<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatieRole\SpatieRoleInterface;

class SpatieRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $spatieRoleRepository;


    public function __construct(SpatieRoleInterface $spatieRoleRepository)
    {
        $this->spatieRoleRepository = $spatieRoleRepository;
    }

    public function run()
    {
        $this->spatieRoleRepository->insert([
            ['guard_name' => 'database_ntbic', 'name' => 'admin'],
            ['guard_name' => 'database_ntbic', 'name' => 'moderator'],
        ]);
    }
}
