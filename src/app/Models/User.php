<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance', 'users_id');
    }


    public function canStartWork()
    {
        $oldTimeStamp = $this->attendances()->latest()->first();

        // 紐づくAttendanceがないときはtrue
        if (!$oldTimeStamp) {
            // oldTimeStampがないときはtrueを返して関数を終了する
            return true;
        }

        // oldTimeStampがないときは59行目で終了しているのでここから先は必ずoldTimeStampが存在する
        $latestAttendanceDate = new Carbon($oldTimeStamp->date);
        $today = Carbon::now()->startOfDay();
        
        $alreadyStartedWork = $latestAttendanceDate->eq($today);
        return !$alreadyStartedWork;
    }
}
