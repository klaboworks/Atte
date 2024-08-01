<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <h1 class="logo__text">Atte</h1>
            </div>
            <div class="header__menu">
                <nav>
                    <ul class="menu__list">
                        <li class="menu__items"><a href="">ホーム</a></li>
                        <li class="menu__items"><a href="">日付一覧</a></li>
                        <li class="menu__items"><a href="">ログアウト</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="footer">
        <div class="footer__inner">
            <small class="footer__copy">Atte,Inc.</small>
        </div>
    </footer>
</body>

</html>