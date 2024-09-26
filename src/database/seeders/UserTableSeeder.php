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

        $param = [
            'name' => 'user4',
            'email' => '4@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user5',
            'email' => '5@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user6',
            'email' => '6@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user7',
            'email' => '7@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'user8',
            'email' => '8@com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);
    }
}
