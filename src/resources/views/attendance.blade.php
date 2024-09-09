@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<section class="daily">
    <div class="daily__inner">
        <div class="daily__date-elements">
            <div class="date-elements__yesterday">
                <button class="btn__yesterday">&lt;</button>
            </div>
            <div class="date-elements__today">
                {{$today}}
            </div>
            <div class="date-elements__tommorow">
                <button class="btn__tommorow">&gt;</button>
            </div>
        </div>
        <table class="attendances__table">
            <thead class="table-head">
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody class="table-data">
                @foreach($users as $user)
                @php
                $attendance = $user->todayAttendance();
                @endphp
                <tr>
                    <th class="user-name">{{$user->name}}</th>
                    <td>
                        {{$attendance->start_work ?? ''}}
                    </td>
                    <td>
                        {{$attendance->end_work ?? ''}}
                    </td>
                    <td>
                        {{ $attendance ?  $attendance->restSum() : '' }}
                    </td>
                    <td>
                        {{ $attendance ?  $attendance->workTime() : '' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection