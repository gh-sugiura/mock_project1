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
        <input type="date" class="heading_message_date" name="date" value="<?php echo date('Y-m-d'); ?>">    
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
                <td>{{$attendance->getName()}}</td>
                <td>{{$attendance["start_work"]}}</td>
                <td>{{$attendance["finish_work"]}}</td>
                <td>00:30:00</td>
                <td>{{$attendance->workTime()}}</td>
            </tr>
        @endforeach
    </table>
    <div class="pagenation">
        {{$attendances->links()}}
    </div>
@endsection