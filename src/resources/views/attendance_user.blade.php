@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/attendance_user.css')}}">
@endsection


@section("link")
    <div class="header_link_inner">
        <a href="/" class="header_link_home">ホーム</a>
        <a href="/attendance_date" class="header_link_attendance">日付別勤怠</a>
        <a href="/attendance_user" class="header_link_attendance_user">ユーザー別勤怠</a>
        <a href="/register_user" class="header_link_register_user">ユーザー一覧</a>
        <form class="header_link_logout" action="/logout" method="post">
            @csrf
            <button class="header_link_logout">ログアウト</button>
        </form>
    </div>
@endsection

@section("content")
    <div class="heading_message">
        <form action="attendance_user" class="heading_message_form" type="submit" method="get">
            @csrf
            <input class="heading_message_name" type="search" name="search_name" placeholder="検索する名前を入力" spellcheck="false"></input>
            <button class="heading_message_buttom" type="submit" name="button" value="search">検索</button>
            <button class="heading_message_buttom" type="submit" name="button" value="all">全表示</button>
        </form>
    </div>

    <table class="table_attendacce">
        <tr class="table_header">
            <th>名前</th>
            <th>勤務日</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>

        @foreach ($attendances as $attendance)
            <tr class="table_content">
                <td>{{$attendance["name"]}}</td>
                <td>{{$attendance["work_date"]}}</td>
                <td>{{$attendance["start_work"]}}</td>
                <td>{{$attendance["finish_work"]}}</td>
                <td>{{$attendance["time_rest"]}}</td>
                <td>{{$attendance["time_work"]}}</td>
            </tr>
        @endforeach
    </table>
    <div class="pagenation">
        {{-- {{$attendances->links()}} --}}
        {{$attendances->appends(request()->query())->links()}}
    </div>
@endsection