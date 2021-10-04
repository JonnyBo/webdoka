@extends('layout.site', ['title' => 'Приглашение на регистрацию'])

@section('content')
    <h1>Приглашение на регистрацию</h1>
    <form method="post" action="{{ route('invite-mail') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Отправить</button>
        </div>
    </form>
@endsection
