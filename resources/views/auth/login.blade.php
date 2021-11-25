@extends('layout.site', ['title' => 'Вход в личный кабинет'])

@section('content')
    <div class="container">
    <h1>Вход в личный кабинет</h1>
        <section class="personal">
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="personal__container">
                    <label class="personal__label label" for="email">Email</label>
                    <input type="email" class="personal__input personal__input--first input" id="email" name="email" placeholder="Адрес почты"
                           required maxlength="255" value="{{ old('email') ?? '' }}">
                    <label class="personal__label label" for="password">Пароль</label>
                    <input type="password" class="personal__input personal__input--first input" id="password" name="password" placeholder="Ваш пароль"
                           required maxlength="255" value="">
                </div>
                <div class="form-group">
                    <a href="/forgot-password">Забыли пароль?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="registration__btn button">Войти</button>
                </div>
            </form>
        </section>
    </div>
@endsection
