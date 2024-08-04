@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<section class="login">
    <div class="login__inner">
        <div class="login__title">
            <h2 class="login__title-text">ログイン</h2>
        </div>
        <div class="login__form">
            <form action="/login" method="post" class="login__form-items">
                @csrf
                <div class="form-items__unit">
                    <input class="form-items__input" type="email" name="email" placeholder="メールアドレス" value="{{old('email')}}">
                    <div class="error-message">
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-items__unit">
                    <input class="form-items__input" type="password" name="password" placeholder="パスワード" value="{{old('password')}}">
                    <div class="error-message">
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <button class="login__button">ログイン</button>
            </form>
        </div>
        <div class="login__link-register">
            <small class="link-register__text">アカウントをお持ちでない方はこちら</small>
            <a href="/register" class="link-login__link">会員登録</a>
        </div>
    </div>
</section>
@endsection