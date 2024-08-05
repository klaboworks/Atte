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
            <form action="startwork" method="post" class="form-unit">
                <input type="hidden" name="start_work" value="">
                <button class=btn__start_work>勤務開始</button>
            </form>
            <form action="endwork" method="post" class="form-unit">
                <input type="hidden" name="end_work" value="">
                <button class=btn__end_work>勤務終了</button>
            </form>
            <form action="startrest" method="post" class="form-unit">
                <input type="hidden" name="start_rest" value="">
                <button class=btn__start_rest>休憩開始</button>
            </form>
            <form action="endrest" method="post" class="form-unit">
                <input type="hidden" name="end_rest" value="">
                <button class=btn__end_rest>休憩終了</button>
            </form>
        </div>
    </div>
</section>
@endsection