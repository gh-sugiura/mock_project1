@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section("link")
    <div class="header_link_inner">
        <a href="/" class="header_link_home">ホーム</a>
        <a href="/attendance" class="header_link_attendance">日付一覧</a>
        <form class="header_link_logout" action="/logout" method="post">
            @csrf
            <button class="header_link_logout">ログアウト</button>
        </form>
    </div>
@endsection

@section("content")
    <div class="heading_message">
        <p>○○○○さんお疲れ様です！</p>
    </div>
    <div class="layout_button">
        <div class="start_work">
            <button class="start_work_button" type="submit">勤務開始</button>
        </div>
        <div class="finish_work">
            <button class="finish_work_button" type="submit">勤務終了</button>
        </div>
        <div class="start_break">
            <button class="start_break_button" type="submit">休憩開始</button>
        </div>
        <div class="finish_break">
            <button class="finish_break_button" type="submit">休憩終了</button>
        </div>
    </div>
@endsection