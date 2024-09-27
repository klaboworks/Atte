@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
@endsection

@section('content')
<section class="user-attendance">
    <div class="user-attendance__inner">
        <div class="user-attendance__heading">
            <p class="heading__title">{{$user->name}}さんの勤務状況</p>
            <div class="heading__date-elements">
                <div class="date-elements__yesterday">
                    <form action="{{ route('users.attendance' , $user->id ) }}">
                        <button class="btn__yesterday">&lt;</button>
                        <input type="hidden" name="month" value="{{$month->copy()->subMonth()->format('Y-m')}}">
                    </form>
                </div>
                <div class="date-elements__today">
                    {{$month->format('Y年m月')}}
                </div>
                <div class="date-elements__tommorow">
                    <form action=" {{ route('users.attendance' , $user->id ) }}">
                        <button class="btn__tommorow">&gt;</button>
                        <input type="hidden" name="month" value="{{$month->copy()->addMonth()->format('Y-m')}}">
                    </form>
                </div>
            </div>
        </div>

        <table class="attendance-sheet">
            <thead class="table-head">
                <tr>
                    <th>日付</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody class="table-data">
                @foreach($dates as $date)
                @php
                $attendance = $user->specifiedDateAttendance($date);
                @endphp
                <tr>
                    <th>{{$date->isoformat('D(dd)')}} </th>
                    <td>{{$attendance->start_work ?? ''}}</td>
                    <td>{{$attendance->end_work ?? ''}}</td>
                    <td>{{ $attendance ?  $attendance->restSum() : '' }}</td>
                    <td>{{ $attendance ?  $attendance->workTime() : '' }}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <th>合計 </th>
                    <td> {{$user->monthlyRests($month)}} </td>
                    <td> {{$user->monthlyAttendance($month)}}</td>
                </tr>
            </tbody>
        </table>


    </div>
</section>
@endsection