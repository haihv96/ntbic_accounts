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
            ['name' => 'ntbic_database admin'],
            ['name' => 'ntbic_database moderator'],
            ['name' => 'ntbic_home admin'],
            ['name' => 'ntbic_home moderator'],
        ]);
    }
}
