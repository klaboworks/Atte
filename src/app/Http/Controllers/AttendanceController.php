<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;

class AttendanceController extends Controller
{
    public function workStart()
    {
        $user = Auth::user();
        $oldTimeStamp = Attendance::where('users_id', $user->id)->latest()->first();

        $stamped = $oldTimeStamp->date;
        $today = Carbon::now()->toDateString();

        if ($stamped == $today) {
            return redirect('/')->with('error', '出勤済みです');
        } else {
            Attendance::create(
                [
                    'users_id' => $user->id,
                    'date' => Carbon::now()->toDateString(),
                    'start_work' => Carbon::now()->format('H:i:s'),
                ]
            );
            return redirect('/')->with('my_status', '出勤打刻が完了しました');
        }
    }
}
