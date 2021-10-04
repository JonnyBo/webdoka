@extends('layout.site', ['title' => 'Новый Сотрудник'])

@section('content')
    <h1>Новый Сотрудник</h1>
    <form method="post" action="{{ route('user.store') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="Придумайте пароль"
                   required maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password_confirmation"
                   placeholder="Пароль еще раз" required maxlength="255" value="">
        </div>
        <div class="form-group">
            <select class="form-control" name="right">
                <option>выберите права</option>
                @foreach(\App\Models\Worker::getRight() as $right)
                <option value="{{ $right }}">{{ $right }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="status">
                <option>выберите статус</option>
                @foreach(\App\Models\Worker::getStatus() as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Регистрация</button>
        </div>
    </form>
@endsection
