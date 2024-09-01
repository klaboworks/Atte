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
        $today = Carbon::now()->startOfDay();
        $attendances = Attendance::where('date',$today)->get();
        foreach($attendances as $attendance){
            $start_work = new Carbon($attendance->end_work);
            $end_work = new Carbon($attendance->start_work);
            $workTime = $start_work->diffInSeconds($end_work);
            return $workTime;
        }
        // return 0;
    }

    public function restSum()
    {
        return 0;
    }
}
