<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Rest;

class RestController extends Controller
{
    public function restStart()
    {
        $user = Auth::user();
        $attends = Attendance::where('user_id', $user->id)->latest()->first();

        if ($attends) {
            $today = Carbon::now()->startOfDay();
            $latestWorkDate = new Carbon($attends->date);
            $latestRest = Rest::where('attendance_id', $attends->id)->latest()->first();

            if ($latestRest && !$latestRest->end_rest) {
                return redirect('/');
            }

            if ($latestWorkDate->eq($today) && !$attends->end_work) {
                Rest::create([
                    'attendance_id' => $attends->id,
                    'start_rest' => Carbon::now()->format('H:i:s')
                ]);
                return redirect('/');
            }
        }
        return redirect('/');
    }

    public function restEnd()
    {
        $user = Auth::user();
        $attends = Attendance::where('user_id', $user->id)->latest()->first();

        if ($attends) {
            $latestRest = Rest::where('attendance_id', $attends->id)->latest()->first();

            if ($latestRest && !$latestRest->end_rest) {
                $latestRest->update(['end_rest' => Carbon::now()]);
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
