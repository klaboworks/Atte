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

        if (!$oldTimeStamp) {
            Attendance::create(
                [
                    'users_id' => $user->id,
                    'date' => Carbon::now(),
                    'start_work' => Carbon::now(),
                ]
            );
            return redirect('/')->with('my_status', '出勤打刻が完了しました');
        }

        $stamped = new Carbon($oldTimeStamp->date);
        $today = Carbon::now();
        if ($stamped->eq($today)) {
            return redirect('/')->with('error', '出勤済みです');
        }
        Attendance::create([
            'users_id' => $user->id,
            'date' => Carbon::now(),
            'start_work' => Carbon::now(),
        ]);
        return redirect('/')->with('my_status', '出勤打刻が完了しました');
    }

    public function workEnd()
    {
        $user = Auth::user();
        $oldTimeStamp = Attendance::where('users_id', $user->id)->latest()->first();

        if ($oldTimeStamp) {
            $stamped = $oldTimeStamp->date;
            $today = Carbon::now()->toDateString();
            if ($stamped == $today && !empty($oldTimeStamp->start_work) && !empty($oldTimeStamp->end_work)) {
                return redirect('/')->with('my_status', '退勤済みです');
            } elseif ((!empty($oldTimeStamp->start_work)) && (!empty($oldTimeStamp->end_work))) {
                return redirect('/')->with('my_status', '出勤されていません');
            } else {
                $rest = Rest::where('attendances_id', $oldTimeStamp->id)->latest()->first();
                if ($rest && empty($rest->end_rest)) {
                    $rest->update(['end_rest' => Carbon::now()->format('H:i:s')]);
                    $oldTimeStamp->update(
                        ['end_work' => Carbon::now()->format('H:i:s')]
                    );
                    return redirect('/')->with('my_status', 'お疲れ様でした！');
                } else {
                    $oldTimeStamp->update(
                        ['end_work' => Carbon::now()->format('H:i:s')]
                    );
                    return redirect('/')->with('my_status', 'お疲れ様でした！');
                }
            }
        } else {
            return redirect('/')->with('error', '出勤されていません');
        }
    }
}
