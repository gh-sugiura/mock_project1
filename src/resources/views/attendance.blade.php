@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/attendance.css')}}">
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
        <form action="attendance_date" class="heading_message_form" type="submit" method="get">
            @csrf
            <button class="heading_message_back_buttom" type="submit" name="button" value="back"> < </button>
            <input class="heading_message_date" type="text" name="search_day" value="{{$search_day}}" readonly></input>
            <button class="heading_message_forward_buttom" type="submit" name="button" value="forward"> > </button>
        </form>
    </div>

    <table class="table_attendacce">
        <tr class="table_header">
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>

        @foreach ($attendances as $attendance)
            <tr class="table_content">
                <td>{{$attendance["name"]}}</td>
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