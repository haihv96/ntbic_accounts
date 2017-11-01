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
        User::find(1)->givePermissionTo('ntbic_home', 'store tin_tuc');
        User::find(1)->givePermissionTo('ntbic_home', 'destroy tin_tuc');

        User::find(2)->givePermissionTo('ntbic_database', 'store chuyen_gia');
        User::find(2)->givePermissionTo('ntbic_database', 'destroy chuyen_gia');
    }
}
