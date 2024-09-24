<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'index']);
    Route::get('/attendance',[DailyController::class,'index']);
    
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/attendance/{id}', [UsersController::class, 'showUserAttendance'])->name('users.attendance');
});

Route::post('/work/start', [AttendanceController::class, 'workStart']);
Route::patch('/work/end', [AttendanceController::class, 'workEnd']);

Route::post('/rest/start',[RestController::class,'restStart']);
Route::patch('/rest/end',[RestController::class,'restEnd']);
