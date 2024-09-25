@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
@endsection

@section('content')
<section class="user-attendance">
    <div class="user-attendance__inner">
        <div class="user-attendance__heading">
            <a href="/users">Back</a>
            <p>{{$user->name}}</p>
            <p>{{$user->id}}</p>
            <p>{{$user->email}}</p>
        </div>
        @foreach($user->attendances()->get() as $attendance)
        {{$attendance->start_work}}
        @endforeach

    </div>
    </div>
</section>
@endsection