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
        <p class="heading_message_text">{{Auth::user()->name}}さんお疲れ様です！</p>
    </div>
    @if(session("message"))
        <div class="start_work_alert">
            <p class="start_work_alert_text">{{session("message")}}</p>
        </div>
    @endif

    <div class="layout_button">
        @if (empty($stamp_attendance) || isset($stamp_attendance->finish_work))
            <form class="start_work" action="/start_work" method="post">
                @csrf
                <button class="start_work_button" type="submit">勤務開始</button>
            </form>
            <div class="dummy_finish_work">
                <p class="dummy_finish_work_button">勤務終了</p>
            </div>
            <div class="dummy_start_rest">
                <p class="dummy_start_rest_button">休憩開始</p>
            </div>
            <div class="dummy_finish_rest">
                <p class="dummy_finish_rest_button">休憩終了</p>
            </div>


        @elseif (isset($stamp_attendance->start_work) && is_null(optional($stamp_rest)->start_rest) 
                || isset($stamp_rest->finish_rest))
            <div class="dummy_start_work">
                <p class="dummy_start_work_button">勤務開始</p>
            </div>
            <form class="finish_work" action="/finish_work" method="post">
                @csrf
                <button class="finish_work_button" type="submit">勤務終了</button>
            </form>
            <form class="start_rest" action="/start_rest" method="post">
                @csrf
                <button class="start_rest_button" type="submit">休憩開始</button>
            </form>
            <div class="dummy_finish_rest">
                <p class="dummy_finish_rest_button">休憩終了</p>
            </div>
        
        
        @elseif (isset($stamp_rest->start_rest))
            <div class="dummy_start_work">
                <p class="dummy_start_work_button">勤務開始</p>
            </div>
            <div class="dummy_finish_work">
                <p class="dummy_finish_work_button">勤務終了</p>
            </div>
            <div class="dummy_start_rest">
                <p class="dummy_start_rest_button">休憩開始</p>
            </div>
            <form class="finish_rest" action="/finish_rest" method="post">
                @csrf
                <button class="finish_rest_button" type="submit">休憩終了</button>
            </form>
        @endif
    </div>
@endsection