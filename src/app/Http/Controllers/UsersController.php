<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('user.index', compact('users'));
    }

    public function showUserAttendance(Request $request)
    {
        $user = User::find($request->id);
        $month = new Carbon($request->month);
        $period = CarbonPeriod::create($month->copy()->startOfMonth(), $month->copy()->endOfMonth());

        foreach ($period as $months) {
            $dates[] = $months;
        }

        return view('user.user_attendance', compact('user', 'month', 'dates'));
    }
}
