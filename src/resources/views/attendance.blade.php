@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/attendance.css')}}">
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
        <p>2024-07-01</p>
    </div>
    <table class="table_attendacce">
        <tr class="table_header">
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        <tr class="table_content">
            <td>テスト太郎</td>
            <td>10:00:00</td>
            <td>20:00:00</td>
            <td>00:30:00</td>
            <td>09:30:00</td>
        </tr>
    </table>
@endsection