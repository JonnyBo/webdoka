@extends('layout.site', ['title' => 'Приглашение на регистрацию'])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">Пригласить пользователя</h2>
    </section>

    <section class="addition">
        <form method="post" action="{{ route('invite-mail') }}">
            @csrf
            <label class="addition__label label" for="name">Добавить участника</label>
            <input class="addition__input input" type="email" id="email" name="email"
                   placeholder="Введите email" value="{{ old('email') ?? '' }}" required />
            <button type="submit"  class="addition__btn button">Добавить</button>
        </form>
    </section>

@endsection
