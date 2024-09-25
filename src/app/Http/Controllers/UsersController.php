<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function showUserAttendance(Request $request)
    {
        $user = User::find($request->id);
        return view('user.user_attendance', compact('user'));
    }
}
