<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_work', 'end_work'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function rests()
    {
        return $this->hasMany('App\Models\Rest');
    }

    public function restSeconds()
    {
        $rests = $this->hasMany(Rest::class)->get();
        $restTotal = 0;
        foreach ($rests as $rest) {
            $restTotal += $rest->rests();
        }

        return $restTotal;
    }

    public function restSum()
    {
        $restTotal = $this->restSeconds();
        $hours = sprintf('%02d', floor($restTotal / 3600));
        $minutes = sprintf('%02d', floor(($restTotal % 3600) / 60));
        $seconds = sprintf('%02d', $restTotal % 60);

        $restSum = "$hours:$minutes:$seconds";

        return $restSum;
    }

    public function workSeconds()
    {
        $startWork = new Carbon($this->start_work);
        $endWork =  new Carbon($this->end_work);
        $diffInSeconds = $startWork->diffInSeconds($endWork);
        $workSeconds = $diffInSeconds - $this->restSeconds();

        return $workSeconds;
    }

    public function workTime()
    {
        $workSeconds = $this->workSeconds();
        $hours = sprintf('%02d', floor($workSeconds / 3600));
        $minutes = sprintf('%02d', floor(($workSeconds % 3600) / 60));
        $seconds = sprintf('%02d', $workSeconds % 60);

        $workTime = "$hours:$minutes:$seconds";

        return $workTime;
    }
}
