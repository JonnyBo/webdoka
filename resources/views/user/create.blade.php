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
            <div class="row">
                <div class="col-md-4">
                    <input type="number" class="form-control" name="age" placeholder="Возраст" maxlength="3" value="">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="sex">
                        <option>выберите пол</option>
                        <option value="М">М</option>
                        <option value="Ж">Ж</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="birthday" placeholder="Дата рождения" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <select class="form-control" name="source_id">
                <option>выберите источник</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="region"
                   placeholder="Район" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone"
                   placeholder="Телефон" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="telegram"
                   placeholder="Телеграм" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="watsapp"
                   placeholder="Ватсап" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="vyber"
                   placeholder="Вайбер" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="skype"
                   placeholder="Скайп" maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="resume"
                   placeholder="Резюме на hh.ru" maxlength="255" value="">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="experience" placeholder="Опыт работы"></textarea>
        </div>

        <div class="form-group">
            <select class="form-control" name="skills[]" multiple>
                <option>выберите навыки</option>
                @foreach($skills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="education" placeholder="Образование"></textarea>
        </div>

        <div class="form-group">
            <select class="form-control" name="status_id">
                <option>выберите статус</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select class="form-control" name="role_id">
                <option>выберите роль</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Регистрация</button>
        </div>
    </form>
@endsection
