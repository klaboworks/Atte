@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<section class="register">
    <div class="register__inner">
        <div class="register__title">
            <h2 class="register__title-text">会員登録</h2>
        </div>
        <div class="register__form">
            <form action="/register" method="post" class="register__form-items">
                @csrf
                <div class="form-items__unit">
                    <input class="form-items__input" type="text" name="name" placeholder="名前" value="{{old('name')}}">
                    <div class="error-message">
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                </div>
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
                <div class="form-items__unit">
                    <input class="form-items__input" class="form-items__input" type="password" name="password_confirmation" placeholder="確認用パスワード">
                    <div class="error-message">
                        @error('password_confirmation')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <button class="register__button">会員登録</button>
            </form>
        </div>
        <div class="register__link-login">
            <small class="link-login__text">アカウントをお持ちの方はこちら</small>
            <a href="/login" class="link-login__link">ログイン</a>
        </div>
    </div>
</section>
@endsection