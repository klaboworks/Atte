@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<section class="attendance">
    <div class="attendance__inner">
        <div class="attendance__title--greeting">
            @auth
            <p class="greeting__text">{{ Auth::user()->name }}さんお疲れ様です！</p>
            @endauth
        </div>

        <div class="attendance__functions">
            <form action="/work/start" method="post" class="form-unit">
                @csrf
                <input type="hidden" name="start_work">
                <button class=btn__start_work>勤務開始</button>
            </form>
            <form action="work/end" method="post" class="form-unit">
                @csrf
                <input type="hidden" name="end_work" value="">
                <button class=btn__end_work>勤務終了</button>
            </form>
            <form action="rest/start" method="post" class="form-unit">
                <input type="hidden" name="start_rest" value="">
                <button class=btn__start_rest>休憩開始</button>
            </form>
            <form action="rest/end" method="post" class="form-unit">
                <input type="hidden" name="end_rest" value="">
                <button class=btn__end_rest>休憩終了</button>
            </form>
        </div>
        @if (session('my_status'))
        {{ session('my_status') }}
        @endif
        @if(session('error'))
        {{ session('error') }}
        @endif
    </div>
</section>
@endsection