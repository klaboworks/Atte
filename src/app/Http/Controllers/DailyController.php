<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class DailyController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $users = User::all();
        $works = Attendance::where('date', $today)->get();
        return view('attendance', compact('today', 'users', 'works'));
    }
}
