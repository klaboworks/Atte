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
                <button {{ Auth::user()->canStartWork() ? '' : 'disabled' }} class="btn__start_work">勤務開始</button>
            </form>
            <form action="work/end" method="post" class="form-unit">
                @method('PATCH')
                @csrf
                <input type="hidden" name="end_work">
                <button {{ Auth::user()->canEndWork() ? '' : 'disabled' }} class=btn__end_work>勤務終了</button>
            </form>
            <form action="rest/start" method="post" class="form-unit">
                @csrf
                <input type="hidden" name="start_rest">
                <button class=btn__start_rest {{ Auth::user()->canStartRest() ? 'disabled' : '' }}>休憩開始</button>
            </form>
            <form action="rest/end" method="post" class="form-unit">
                @method('PATCH')
                @csrf
                <input type="hidden" name="end_rest">
                <button class=btn__end_rest {{ Auth::user()->canEndRest() ? 'disabled' : '' }}>休憩終了</button>
            </form>
        </div>
    </div>
</section>
@endsection