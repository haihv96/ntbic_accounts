<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatieRole\SpatieRoleInterface;
use App\Repositories\User\UserInterface;
use App\User;

class AssignRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $userRepository;
    protected $spatieRoleRepository;

    public function __construct(UserInterface $userRepository, SpatieRoleInterface $spatieRoleRepository)
    {
        $this->userRepository = $userRepository;
        $this->spatieRoleRepository = $spatieRoleRepository;
    }

    public function run()
    {
        User::find(1)->assignRole('ntbic_database admin');
        User::find(2)->assignRole('ntbic_database moderator');

        User::find(1)->assignRole('ntbic_home admin');
        User::find(2)->assignRole('ntbic_home moderator');
    }
}
