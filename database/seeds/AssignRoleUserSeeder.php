<?php

use Illuminate\Database\Seeder;
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

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        User::find(1)->assignRoles('ntbic_database', 'admin');
        User::find(2)->assignRoles('ntbic_database', 'moderator');

        User::find(1)->assignRoles('ntbic_home', 'admin');
        User::find(2)->assignRoles('ntbic_home', 'moderator');
    }
}
