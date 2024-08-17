<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'user1',
            'email' => '1@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user2',
            'email' => '2@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user3',
            'email' => '3@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);
    }
}
