@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section("link")
    <div class="header_link_inner">
        <a href="/" class="header_link_home">ホーム</a>
        <a href="/attendance" class="header_link_attendance">日付一覧</a>
        <a href="/login" class="header_link_login">ログアウト</a>
    </div>
@endsection

@section("content")
    <div class="login-form__heading">
        <p>○○○○さんお疲れ様です！</p>
    </div>
    <div class="stamp">
        <p>勤務開始</p>
        <p>勤務終了</p>
        <p>休憩開始</p>
        <p>休憩終了</p>
    </div>
@endsection