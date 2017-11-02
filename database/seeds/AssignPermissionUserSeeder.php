<?php

use Illuminate\Database\Seeder;
use App\Repositories\User\UserInterface;
use App\User;

class AssignPermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $userRepository;

    public function __construct(
        UserInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        User::find(1)->givePermissionsTo('ntbic_home',
            ['store tin_tuc', 'update tin_tuc', 'destroy tin_tuc']
        );

        User::find(2)->givePermissionsTo('ntbic_database',
            ['store chuyen_gia', 'update chuyen_gia', 'destroy chuyen_gia']);
    }
}
