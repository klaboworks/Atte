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
        $oldTimeStamp = Attendance::where('user_id', $user->id)->latest()->first();

        if ($oldTimeStamp) {
            $stamped = new Carbon($oldTimeStamp->date);
            $today = Carbon::now()->startOfDay();
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'date' => Carbon::now(),
                'start_work' => Carbon::now()->format('H:i:s'),
            ]);
            return redirect('/');
        }

        if ($stamped->eq($today)) {
            return redirect('/');
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'date' => Carbon::now(),
                'start_work' => Carbon::now()->format('H:i:s'),
            ]);
            return redirect('/');
        }
    }

    public function workEnd()
    {
        $user = Auth::user();
        $oldTimeStamp = Attendance::where('user_id', $user->id)->latest()->first();

        if ($oldTimeStamp) {
            $stamped = new Carbon($oldTimeStamp->date);
            $today = Carbon::now()->startOfDay();
        } else {
            return redirect('/');
        }

        if ($stamped->eq($today) && $oldTimeStamp->start_work && $oldTimeStamp->end_work) {
            return redirect('/');
        }

        //退勤時休憩を強制終了
        $rest = Rest::where('attendance_id', $oldTimeStamp->id)->latest()->first();
        if ($rest && empty($rest->end_rest)) {
            $rest->update(['end_rest' => Carbon::now()->format('H:i:s')]);
            $oldTimeStamp->update(
                ['end_work' => Carbon::now()->format('H:i:s')]
            );
            return redirect('/');
        } else {
            $oldTimeStamp->update(
                ['end_work' => Carbon::now()->format('H:i:s')]
            );
            return redirect('/');
        }
    }
}
