<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'users_id' => '1',
            'date' => Carbon::create(2024, 8, 4, 10, 0)->format('Y:m:d'),
            'start_work' => Carbon::create(2024, 8, 4, 10, 0)->format('H:i:s'),
            'end_work' => Carbon::create(2024, 8, 4, 19, 0)->format('H:i:s'),
            'created_at' => Carbon::create(2024, 8, 4, 10, 0),
            'updated_at' => Carbon::create(2024, 8, 4, 19, 0),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'users_id' => '2',
            'date' => Carbon::create(2024, 8, 4, 10, 0)->format('Y:m:d'),
            'start_work' => Carbon::create(2024, 8, 4, 10, 0)->format('H:i:s'),
            'end_work' => Carbon::create(2024, 8, 4, 20, 0)->format('H:i:s'),
            'created_at' => Carbon::create(2024, 8, 4, 10, 0),
            'updated_at' => Carbon::create(2024, 8, 4, 20, 0),
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'users_id' => '1',
            'date' => Carbon::create(2024, 8, 5, 10, 0)->format('Y:m:d'),
            'start_work' => Carbon::create(2024, 8, 5, 10, 0)->format('H:i:s'),
            'end_work' => Carbon::create(2024, 8, 5, 19, 30)->format('H:i:s'),
            'created_at' => Carbon::create(2024, 8, 5, 10, 0),
            'updated_at' => Carbon::create(2024, 8, 5, 19, 30),
        ];
        DB::table('attendances')->insert($param);

        // $param = [
        //     'users_id' => '1',
        //     'date' => Carbon::now()->format('Y:m:d'),
        //     'start_work' => Carbon::now()->format('H:i:s'),
        //     'end_work' => Carbon::now()->endOfDay()->format('H:i:s'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()->endOfDAy(),
        // ];
        // DB::table('attendances')->insert($param);
    }
}
