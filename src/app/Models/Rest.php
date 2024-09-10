<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_id', 'start_rest', 'end_rest'];

    public function attendances()
    {
        return $this->belongsTo('App\Models\Attendance');
    }

    public function rests(){
        $startRest = new Carbon($this->start_rest);
        $endRest = new Carbon($this->end_rest);
        $restTimes = $startRest->diffInSeconds($endRest);
        return $restTimes;
    }
}