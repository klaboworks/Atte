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
        $users = User::Paginate(5);
        $date = new Carbon($request->date);
        return view('attendance', compact('users', 'date'));
    }
}
