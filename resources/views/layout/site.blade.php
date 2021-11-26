<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? env('APP_NAME') }}</title>

    <link rel="preload" href="/fonts/ubunturegular.woff2" as="font">
    <link rel="preload" href="/fonts/ubunturegular.woff" as="font">
    <link rel="preload" href="/fonts/ubuntumedium.woff2" as="font">
    <link rel="preload" href="/fonts/ubuntumedium.woff" as="font">
    <link rel="preload" href="/fonts/ubuntubold.woff2" as="font">
    <link rel="preload" href="/fonts/ubuntubold.woff" as="font">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="page-body">

    <header class="page-header">
        <a class="page-header__logo">
            <picture>
                <img class="page-header__logo-image" src="/img/logo@1x.png" srcset="./img/logo@2x.png 2x" width="175" height="44"
                     alt="Логотип">
            </picture>
        </a>

        <nav class="main-nav">
            <ul class="main-nav__list site-list">
                @auth
                <li class="site-list__item">
                    <a href="/user" class="site-list__link {{ request()->is('user') ? 'site-list__link--active' : '' }}">
                        <svg class="site-list__svg" width="22" height="22">
                            <use xlink:href="/img/sprite.svg#users">
                            </use>
                        </svg>
                        Кандидаты
                    </a>
                </li>
                <li class="site-list__item">
                    <a href="/invite" class="site-list__link {{ request()->is('invite') ? 'site-list__link--active' : '' }}">
                        <svg class="site-list__svg" width="22" height="22">
                            <use xlink:href="/img/sprite.svg#add">
                            </use>
                        </svg>
                        Пригласить кандидата
                    </a>
                </li>
                <li class="site-list__item">
                    <a href="/guide" class="site-list__link {{ request()->is('guide') ? 'site-list__link--active' : '' }}">
                        <svg class="site-list__svg" width="22" height="22">
                            <use xlink:href="/img/sprite.svg#settings">
                            </use>
                        </svg>
                        Настройки
                    </a>
                </li>
                @endif
                @guest
                    <li class="site-list__item">
                        <a href="{{ route('login') }}" class="site-list__link site-list__link--output">
                            <svg class="site-list__svg" width="22" height="22">
                                <use xlink:href="/img/sprite.svg#output">
                                </use>
                            </svg>
                            Войти
                        </a>
                    </li>
                    <!--li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li-->
                <!--li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li-->
                @else
                    <li class="site-list__item">
                        <a href="{{ route('logout') }}" class="site-list__link site-list__link--output">
                            <svg class="site-list__svg" width="22" height="22">
                                <use xlink:href="/img/sprite.svg#output">
                                </use>
                            </svg>
                            Выйти
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </header>

    <main class="page-main">


            <div class="messages">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible mt-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>

    </main>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
