<?php

use Illuminate\Database\Seeder;
use App\Repositories\User\UserInterface;

class UserSeeder extends Seeder
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
        $this->userRepository->insert([
            'name' => 'hai',
            'email' => 'hai.hp.96@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $this->userRepository->insert([
            'name' => 'hai1',
            'email' => 'hai.hp.961@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
