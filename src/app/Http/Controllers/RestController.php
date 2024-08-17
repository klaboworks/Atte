<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Rest;

class RestController extends Controller
{
    public function restStart()
    {
        $user = Auth::user();
        $attends = Attendance::where('users_id', $user->id)->latest()->first();

        if ($attends) {
            $stamped = $attends->date;
            $today = Carbon::now()->toDateString();
            if ($attends->start_work && $attends->end_work) {
                if ($stamped != $today) {
                    return redirect('/')->with('error', '先に出勤してください');
                } else {
                    return redirect('/')->with('error', '本日の勤務は終了しています');
                }
            } elseif ($attends) {
                $rest =  Rest::where('attendances_id', $attends->id)->latest()->first();
                if ($rest) {
                    if (empty($rest->end_rest)) {
                        return redirect('/')->with('error', '既に休憩が開始されています');
                    } elseif ($rest->start_rest && $rest->end_rest) {
                        Rest::create([
                            'attendances_id' => $attends->id,
                            'start_rest' => Carbon::now()->format('H:i:s')
                        ]);
                        return redirect('/')->with('my_status', '休憩を開始しました');
                    }
                } else {
                    Rest::create([
                        'attendances_id' => $attends->id,
                        'start_rest' => Carbon::now()->format('H:i:s')
                    ]);
                    return redirect('/')->with('my_status', '休憩を開始しました');
                }
            }
        } else {
            return redirect('/')->with('error', '先に出勤してください');
        }
    }

    public function restEnd()
    {
        $user = Auth::user();
        $attends = Attendance::where('users_id', $user->id)->latest()->first();

        if ($attends) {
            $stamped = $attends->date;
            $today = Carbon::now()->toDateString();
            if ($attends->start_work && $attends->end_work) {
                if ($stamped != $today) {
                    return redirect('/')->with('error', '先に出勤してください');
                } else {
                    return redirect('/')->with('error', '本日の勤務は終了しています');
                }
            } elseif ($attends) {
                $rest =  Rest::where('attendances_id', $attends->id)->latest()->first();
                if ($rest && empty($rest->end_rest)) {
                    $rest->update([
                        'end_rest' => Carbon::now()->format('H:i:s')
                    ]);
                    return redirect('/')->with('my_status', '休憩を終了しました');
                } else {
                    return redirect('/')->with('error', '休憩が開始されていません');
                }
            }
        } else {
            return redirect('/')->with('error', '先に出勤してください');
        }
    }
}
