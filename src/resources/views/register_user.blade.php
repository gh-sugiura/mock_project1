@extends("app")


@section("css")
    <link rel="stylesheet" href="{{asset('css/register_user.css')}}">
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
        <form action="/register_user" class="heading_message_form" type="submit" method="get">
            @csrf
            <input class="heading_message_name" type="search" name="search_name" placeholder="検索する名前を入力" spellcheck="false"></input>
            <button class="heading_message_buttom" type="submit" name="button" value="search">検索</button>
            <button class="heading_message_buttom" type="submit" name="button" value="all">全表示</button>
        </form>
    </div>

    <table class="table_attendacce">
        <tr class="table_header">
            <th>名前</th>
            <th>登録日</th>
        </tr>

        @foreach ($users as $user)
            <tr class="table_content">
                <td>{{$user["name"]}}</td>
                <td>{{$user["created_at"]->format("Y-m-d")}}</td>
            </tr>
        @endforeach
    </table>
    <div class="pagenation">
        {{-- {{$users->links()}} --}}
        {{$users->appends(request()->query())->links()}}
    </div>
@endsection