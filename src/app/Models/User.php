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
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function specifiedDateAttendance(String $date)
    {
        $specifiedDate = new Carbon($date);
        return $this
            ->hasMany(Attendance::class)
            ->whereDate('date', $specifiedDate)
            ->first();
    }

    public function monthlyAttendance(String $month)
    {
        $specifiedMonth = new Carbon($month);
        $from = $specifiedMonth->copy()->startOfMonth();
        $to = $specifiedMonth->endOfMonth();
        $workTimes =
            $this
            ->hasMany(Attendance::class)
            ->whereBetween('date', [$from, $to])->get();

        $workTotal = 0;
        foreach ($workTimes as $workTime) {
            $workTotal += $workTime->workSeconds();
        }
        $hours = sprintf('%02d', floor($workTotal / 3600));
        $minutes = sprintf('%02d', floor(($workTotal % 3600) / 60));
        $seconds = sprintf('%02d', $workTotal % 60);

        $workTime = "$hours:$minutes:$seconds";

        return $workTime;
    }

    public function rests()
    {
        return $this->hasManyThrough(
            Rest::class,
            Attendance::class,
        );
    }

    public function monthlyRests(String $month)
    {
        $specifiedMonth = new Carbon($month);
        $from = $specifiedMonth->copy()->startOfMonth();
        $to = $specifiedMonth->endOfMonth();
        $rests =
            $this
            ->hasManyThrough(Rest::class,Attendance::class)
            ->whereBetween('date', [$from, $to])
            ->get();

        $restTotal = 0;
        foreach ($rests as $rest) {
            $restTotal += $rest->rests();
        }

        $hours = sprintf('%02d', floor($restTotal / 3600));
        $minutes = sprintf('%02d', floor(($restTotal % 3600) / 60));
        $seconds = sprintf('%02d', $restTotal % 60);

        $restSum = "$hours:$minutes:$seconds";

        return $restSum;
    }

    public function canStartWork()
    {
        $oldTimeStamp = $this->attendances()->latest()->first();
        if (!$oldTimeStamp) {
            return true;
        }
        $today = Carbon::today()->startOfDay();
        $latestAttendanceDate = new Carbon($oldTimeStamp->date);
        return !$latestAttendanceDate->eq($today);
    }

    public function canEndWork()
    {
        $oldTimeStamp = $this->attendances()->latest()->first();
        if ($oldTimeStamp && !($oldTimeStamp->end_work)) {
            return true;
        }
    }

    public function canStartRest()
    {
        $oldTimeStamp = $this->attendances()->latest()->first();
        if (!$oldTimeStamp) {
            return true;
        }
        if ($oldTimeStamp->end_work) {
            return true;
        }
        $recentRest = $this->rests()->latest()->first();
        if ($recentRest && !$recentRest->end_rest) {
            return true;
        }
    }

    public function canEndRest()
    {
        $oldTimeStamp = $this->attendances()->latest()->first();
        if (!$oldTimeStamp) {
            return true;
        }
        $recentRest = $this->rests()->latest()->first();
        if ($recentRest && $recentRest->end_rest) {
            return true;
        }
        return !$recentRest;
    }
}
