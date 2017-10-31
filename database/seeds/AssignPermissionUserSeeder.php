<?php

use Illuminate\Database\Seeder;
use App\Repositories\SpatiePermission\SpatiePermissionInterface;
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
    protected $spatiePermissionRepository;

    public function __construct(
        UserInterface $userRepository,
        SpatiePermissionInterface $spatiePermissionRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->spatiePermissionRepository = $spatiePermissionRepository;
    }

    public function run()
    {
        User::find(1)->givePermissionTo('ntbic_database store chuyen_gia');
        User::find(2)->givePermissionTo('ntbic_database destroy chuyen_gia');
    }
}
