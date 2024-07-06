@extends('app')


@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection


@section('content')
    <div class="login-form__content">
        <div class="login-form__heading">
            <p>ログイン</p>
        </div>
        
        <form class="form_login" action="/" method="post">
            @csrf
            <div class="login_email">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"/>
            </div>
            <div class="login_password1">
                <input type="password" name="password" placeholder="パスワード" />
            </div>
            <div class="login_button">
                <button class="login_button_text" type="submit">ログイン</button>
            </div>
            <div class="login_text">
                <p class="text">アカウントをお持ちの方はこちらから</p>
            </div>
            <div class="login_register">
                <a href="/register" class="login_register_link">会員登録</a>
            </div>            
        </form>
    </div>    
@endsection