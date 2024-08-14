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

        if ($oldTimeStamp) {
            $stamped = $oldTimeStamp->date;
            $today = Carbon::now()->toDateString();
            if (($stamped == $today)) {
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

    public function workEnd()
    {
        $user = Auth::user();
        $oldTimeStamp = Attendance::where('users_id', $user->id)->latest()->first();

        if ($oldTimeStamp) {
            $stamped = $oldTimeStamp->date;
            $today = Carbon::now()->toDateString();
            if (($stamped == $today) && (!empty($oldTimeStamp->start_work)) && (!empty($oldTimeStamp->end_work))) {
                return redirect('/')->with('my_status', '退勤済みです');
            } elseif ((!empty($oldTimeStamp->start_work)) && (!empty($oldTimeStamp->end_work))) {
                return redirect('/')->with('my_status', '出勤されていません');
            } else {
                $oldTimeStamp->update(
                    ['end_work' => Carbon::now()->format('H:i:s')]
                );
                return redirect('/')->with('my_status', 'お疲れ様でした！');
            }
        } else {
            return redirect('/')->with('error', '出勤されていません');
        }
    }
}
