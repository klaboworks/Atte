<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
}
