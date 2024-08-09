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

        $oldTimestamp = Attendance::where('users_id', $user->id)->latest()->first();
        if ($oldTimestamp) {
            $oldTimestampPunchIn = new Carbon($oldTimestamp->start_work);
            $oldTimestampDay = $oldTimestampPunchIn->startOfDay();
        } else {
            $timestamp = Attendance::create([
                'users_id' => $user->id,
                'date' => Carbon::now()->format('Y-m-d'),
                'start_work' => Carbon::now()->format('H:i')
            ]);
        }
        return redirect()->back()->with('my_status', '出勤打刻が完了しました');
    }
}
