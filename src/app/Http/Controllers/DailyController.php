<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class DailyController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $date = new Carbon($request->date);
        return view('attendance', compact('users', 'date'));
    }

    public function viewOtherDays(Request $request)
    {
        $users = User::all();
        $date = new Carbon($request->date);
        $require = $request->day;
        if ($require == 0) {
            $date->subDay(1);
        } else {
            $date->addDay(1);
        }

        return view('attendance', compact('users', 'date'));
    }
}
