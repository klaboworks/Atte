@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<section class="attendance">
    <div class="attendance__inner">
        <div class="attendance__title--greeting">
            <p class="greeting__text">さんお疲れ様です！</p>
        </div>
        <div class="attendance__functions">
            <input type="hidden" name="start_work" value="">
            <button class=btn__start_work>勤務開始</button>
            <input type="hidden" name="end_work" value="">
            <button class=btn__end_work>勤務終了</button>
            <input type="hidden" name="start_rest" value="">
            <button class=btn__start_rest>休憩開始</button>
            <input type="hidden" name="end_rest" value="">
            <button class=btn__end_rest>休憩終了</button>
        </div>
    </div>
</section>
@endsection