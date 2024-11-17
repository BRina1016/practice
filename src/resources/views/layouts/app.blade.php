<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    @yield('css')
    <script src="{{ asset('js/menu.js') }}"></script>
</head>

<body>
<div class="app">
    <header class="header">
        <div class="menu_container">
            <div class="menu_icon" id="menuIcon">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="menu_title">Rese</div>
        @yield('link')
        </div>

        <div class="menu" id="menu">
            <ul>
                <li><a href="/">Home</a></li>
                @auth
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/mypage">Mypage</a></li>
                @endauth

                @guest
                    <li><a href="/register">Registration</a></li>
                    <li><a href="/login">Login</a></li>
                @endguest
            </ul>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>
</div>
</body>

</html>
