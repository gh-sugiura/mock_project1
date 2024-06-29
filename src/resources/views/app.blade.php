<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOCK1</title>
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>


<body>
    <header class="header">
        <span class="header_text">Atte</span>
        @yield('link')
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="footer">
        <span class="footer_text">Atte,inc.</span>
    </footer>
</body>


</html>