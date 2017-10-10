<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'hai',
            'email' => 'hai.hp.96@gmail.com',
            'password' => bcrypt('123456')
        ]);

        DB::table('users')->insert([
            'name' => 'hai1',
            'email' => 'hai.hp.961@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
