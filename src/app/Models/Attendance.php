<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function workTime()
    {
        $startWork = new Carbon($this->start_work);
        $endWork =  new Carbon($this->end_work);
        $workTime = $startWork->diffInSeconds($endWork);
        return $workTime;
    }

    public function restSum()
    {
        $rests = $this->hasMany(Rest::class)->get();
        $restTotal = 0;
        foreach ($rests as $rest) {
            $restTotal += $rest->rests();
        }
        return $restTotal;
    }
}
