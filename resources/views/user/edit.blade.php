@extends('layout.site', ['title' => 'Сотрудник'])

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>Сотрудник {{ $user->name }}</h1>
        </div>
        <div class="col-md-3">
            <a class="btn btn-secondary float-right" href="{{ route('user.index') }}"> Сотрудники</a>
        </div>
    </div>
    {{ Form::open(array('url' => route('user.update', $user->id), 'method' => 'PUT', 'class'=>'col-md-12')) }}
        @method('put')
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ $user->name }}">
        </div>
        <!--div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ $user->email }}">
        </div-->
        <!--div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="Новый пароль"
                   maxlength="255" >
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password_confirmation"
                   placeholder="Пароль еще раз" maxlength="255">
        </div-->
        <div class="form-group">
            <select class="form-control" name="right" required>
                <option>выберите права</option>
                @foreach(\App\Models\Worker::getRight() as $right)
                    <option value="{{ $right }}" {{ ( $user->worker->right == $right) ? 'selected' : '' }}>{{ $right }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="status" required>
                <option>выберите статус</option>
                @foreach(\App\Models\Worker::getStatus() as $status)
                    <option value="{{ $status }}" {{ ( $user->worker->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
        @if($user->worker->fields->count())
            @foreach($user->worker->fields as $field)
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
        <input type="hidden" name="worker_id" value="{{ $user->worker->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
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

