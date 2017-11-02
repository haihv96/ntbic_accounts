<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::insert([
            ['name' => 'hai', 'email' => 'hai.hp.96@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'hai1', 'email' => 'hai.hp.961@gmail.com', 'password' => bcrypt('123456')]
        ]);
    }
}
