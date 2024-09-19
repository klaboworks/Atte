@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<section class="daily">
    <div class="daily__inner">
        <div class="daily__date-elements">
            <div class="date-elements__yesterday">
                <form action="/attendance/?date={{$date->format('Y-m-d')}}" method="post">
                    @csrf
                    <button class="btn__yesterday">&lt;</button>
                    <input type="hidden" name="day" value="0">
                </form>
            </div>
            <div class="date-elements__today">
                {{$date->format('Y-m-d')}}
            </div>
            <div class="date-elements__tommorow">
                <form action="/attendance/?date={{$date->format('Y-m-d')}}" method="post">
                    @csrf
                    <button class="btn__tommorow">&gt;</button>
                    <input type="hidden" name="day" value="1">
                </form>
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
                $attendance = $user->specifiedDateAttendance($date);
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