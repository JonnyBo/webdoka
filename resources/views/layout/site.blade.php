<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <!-- Логотип и кнопка «Гамбургер» -->
        <a class="navbar-brand" href="/">Главная</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-blog" aria-controls="navbar-blog"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
        <div class="collapse navbar-collapse" id="navbar-blog">
            <!-- Этот блок расположен слева -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <!-- Этот блок расположен посередине -->

            <!-- Этот блок расположен справа -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    <!--li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li-->
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Админ панель</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Выйти</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="row">

        <div class="col-md-2">

            @guest

            @else
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Кандидаты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/invite">Пригласить кандидата</a>
                    </li>
                </ul>
                <h3>Справочники</h3>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/guide/role">Роли</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/guide/status">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/guide/source">Источники</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/guide/skill">Навыки</a>
                    </li>
                </ul>
            @endif
        </div>
        <div class="col-md-10">
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
    </div>
</div>
<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
