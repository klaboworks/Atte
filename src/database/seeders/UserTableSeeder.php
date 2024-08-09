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
            'name' => 'ken',
            'email' => 'taro3ppi.0122@gmail.com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'kenta',
            'email' => 'taro4ppi.0122@gmail.com',
            'password' => bcrypt('a'),
        ];
        DB::table('users')->insert($param);
    }
}
