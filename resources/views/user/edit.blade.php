@extends('layout.site', ['title' => 'Сотрудник'])

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>Сотрудник {{ $worker->name }}</h1>
        </div>
        <div class="col-md-3">
            <a class="btn btn-secondary float-right" href="{{ route('user.index') }}"> Сотрудники</a>
        </div>
    </div>
    {{ Form::open(array('url' => route('user.update', $worker->id), 'method' => 'PUT', 'class'=>'col-md-12')) }}
        @method('put')
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ $worker->name }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ $worker->email }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="Придумайте пароль"
                   maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password_confirmation"
                   placeholder="Пароль еще раз" maxlength="255" value="">
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <input type="number" class="form-control" name="age" placeholder="Возраст" maxlength="3" value="{{ $worker->worker->age }}">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="sex">
                        <option>выберите пол</option>
                        <option value="М" {{ ($worker->worker->sex == 'М') ? 'selected' : '' }}>М</option>
                        <option value="Ж" {{ ($worker->worker->sex == 'Ж') ? 'selected' : '' }}>Ж</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="birthday" placeholder="Дата рождения" value="{{ $worker->worker->birthday }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <select class="form-control" name="source_id">
                <option>выберите источник</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}" {{ (isset($worker->worker->source->id) && $worker->worker->source->id == $source->id) ? 'selected' : '' }}>{{ $source->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="region"
                   placeholder="Район" maxlength="255" value="{{ $worker->worker->region }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone"
                   placeholder="Телефон" maxlength="255" value="{{ $worker->worker->phone }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="telegram"
                   placeholder="Телеграм" maxlength="255" value="{{ $worker->worker->telegram }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="watsapp"
                   placeholder="Ватсап" maxlength="255" value="{{ $worker->worker->watsapp }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="vyber"
                   placeholder="Вайбер" maxlength="255" value="{{ $worker->worker->vyber }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="skype"
                   placeholder="Скайп" maxlength="255" value="{{ $worker->worker->skype }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="resume"
                   placeholder="Резюме на hh.ru" maxlength="255" value="{{ $worker->worker->resume }}">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="experience" placeholder="Опыт работы">{{ $worker->worker->experience }}</textarea>
        </div>

        <div class="form-group">
            @foreach($skills as $skill)
                <div><input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ (in_array($skill->id, explode(',', $worker->worker->skills))) ? 'checked' : '' }}><span class="pl-1">{{ $skill->name }}</span></div>
            @endforeach
        </div>

        <div class="form-group">
            <textarea class="form-control" name="education" placeholder="Образование">{{ $worker->worker->education }}</textarea>
        </div>

        <div class="form-group">
            <select class="form-control" name="status_id">
                <option>выберите статус</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ ($worker->worker->status->id == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select class="form-control" name="role_id">
                <option>выберите роль</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ ($worker->role->id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
        @if($worker->worker->fields->count())
            @foreach($worker->worker->fields as $field)
                <div class="row row-cols-3 field-item">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Поле</label>
                            <input type="text" class="form-control" name="label[{{ $field->id }}]" placeholder="Поле"
                                   required maxlength="255" value="{{ $field->label }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Значение</label>
                            <input type="text" class="form-control" name="value[{{ $field->id }}]" placeholder="Значение"
                                   maxlength="255" value="{{ $field->value }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm mt-my-4 deleteField" data-id="{{ $field->id }}" data-token="{{ csrf_token() }}">Удалить</button>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Обновить</button>
        </div>
    {{ Form::close() }}
    <hr/>
    <form method="post" action="{{ route('field.store') }}">
        <input type="hidden" name="worker_id" value="{{ $worker->worker->id }}">
        <input type="hidden" name="user_id" value="{{ $worker->id }}">
        @csrf
        <h2>Добавить поле</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="label" placeholder="Поле"
                           required maxlength="255">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="value" placeholder="Значение"
                           required maxlength="255">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Добавить</button>
        </div>
    </form>
@endsection

