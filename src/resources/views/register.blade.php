@extends('app')


@section('css')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection


@section('content')
    <div class="register-form__content">
        <div class="register-form__heading">
            <p>会員登録</p>
        </div>
        

        <form class="form_register" action="/register" method="post">
            @csrf
            <div class="register_name">
                <input type="text" name="name" placeholder="名前" value="{{ old('name') }}"/>                
            </div>
            @error("name")
                <div class="error_message">
                    {{ $message }} 
                </div>
            @enderror


            <div class="register_email">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"/>
            </div>
            @error("email")
                <div class="error_message">
                    {{ $message }} 
                </div>
            @enderror


            <div class="register_password">
                <input type="password" name="password" placeholder="パスワード" />
            </div>
            @error("password")
                <div class="error_message">
                    {{ $message }} 
                </div>
            @enderror


            <div class="register_password_confirmation">
                <input type="password" name="password_confirmation" placeholder="確認用パスワード" />
            </div>
            @error("password_confirmation")
                <div class="error_message">
                    {{ $message }} 
                </div>
            @enderror


            <div class="register_button">
                <button class="register_button_text" type="submit">会員登録</button>
            </div>
            <div class="register_text">
                <p class="text">アカウントをお持ちの方はこちらから</p>
            </div>
            <div class="register_login">
                <a href="/login" class="register_login_link">ログイン</a>
            </div>            
        </form>
    </div>    
@endsection