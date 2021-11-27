@extends('layout.site', ['title' => 'Сотрудник'])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">Сотрудник {{ $worker->name }}</h2>
    </section>

    <?php //print_r($worker->worker); ?>

    <div class="container">

        {{ Form::open(array('url' => route('user.update', $worker->id), 'method' => 'PUT', 'class'=>'col-md-12',  'enctype' => "multipart/form-data")) }}
            @method('put')
            @csrf

        <h2 class="head">Личные данные</h2>
        <section class="personal">
            <div class="personal__container">
                <label class="personal__label label" for="fam">Имя, Фамилия</label>
                <input class="personal__input personal__input--first input" type="text" id="fam" name="name"
                       placeholder="Введите имя" value="{{ $worker->name }}" required>
                <label class="personal__label label" for="mail">Адрес почты</label>
                <input class="personal__input personal__input--first input" type="email" id="mail" name="email"
                       placeholder="Введите почту" value="{{ $worker->email }}" required>

                <div class="personal__unit">
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="gender">Выберите пол</label>
                        <select class="personal__input personal__input--second input" name="sex" id="gender" required>
                            <option>выберите пол</option>
                            <option value="М" {{ ($worker->worker->sex == 'М') ? 'selected' : '' }}>М</option>
                            <option value="Ж" {{ ($worker->worker->sex == 'Ж') ? 'selected' : '' }}>Ж</option>
                        </select>
                        <!--input class="personal__input personal__input--second input" type="text" id="gender" name="sex"
                               placeholder="Выберите пол" required-->
                    </div>
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="date">Дата рождения</label>
                        <input class="personal__input personal__input--second input" type="date" id="date" name="birthday"
                               placeholder="дд.мм.гг" value="{{ $worker->worker->birthday }}" >
                    </div>
                </div>
            </div>
            <div class="personal__block">
                <p class="personal__photo">Фотография</p>
                <input type="file" name="photo" class="personal_photo personal__btn" @if($worker->worker->photo) style="background-image: url({{ url('storage/'.$worker->worker->photo) }})" @endif>
            </div>
        </section>

        <h2 class="head">Пароль</h2>
        <section class="password">
            <div class="password__unit">
                <div class="password__part">
                    <label class="password__label label" for="password">Пароль</label>
                    <input class="password__input input" type="password" id="password" name="password" placeholder="Придумайте пароль">
                </div>
                <div class="password__part">
                    <label class="password__label label" for="password2">Пароль</label>
                    <input class="password__input input" type="password" id="password2" name="password_confirmation" placeholder="Повторите пароль">
                </div>
            </div>
        </section>

        <h2 class="head">Контактные данные</h2>
        <section class="contact">
            <div class="contact__unit">
                <div class="contact__part">
                    <label class="contact__label label" for="district">Район</label>
                    <input class="contact__input input" type="text" id="district" name="region" value="{{ $worker->worker->region }}" placeholder="Введите название района">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="whatsapp">Ватсап</label>
                    <input class="contact__input input" type="text" id="watsapp" name="watsapp" value="{{ $worker->worker->watsapp }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telephone">Телефон</label>
                    <input class="contact__input input" type="text" id="telephone" name="phone" value="{{ $worker->worker->phone }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="viber">Вайбер</label>
                    <input class="contact__input input" type="text" id="viber" name="vyber" value="{{ $worker->worker->vyber }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telegram">Телеграм</label>
                    <input class="contact__input input" type="text" id="telegram" name="telegram" value="{{ $worker->worker->telegram }}" placeholder="@">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="skype">Скайп</label>
                    <input class="contact__input input" type="text" id="skype" name="skype" value="{{ $worker->worker->skype }}" placeholder="Никнейм">
                </div>
            </div>
        </section>

        <h2 class="head">Профильные данные</h2>
        <section class="skill">
            <div class="skill__unit">
                <div class="skill__part">
                    <label class="skill__label label" for="summary">Резюме на hh.ru</label>
                    <input class="skill__input input" type="text" id="summary" name="resume" value="{{ $worker->worker->resume }}" placeholder="Ссылка на резюме">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="education">Образование</label>
                    <input class="skill__input input" type="text" id="education" name="education" value="{{ $worker->worker->education }}" placeholder="Введите образование">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="experience">Опыт работы</label>
                    <input class="skill__input input" type="text" id="experience" name="experience" value="{{ $worker->worker->experience }}" placeholder="Сколько лет опыта">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="skills">Выберите навыки</label>
                    @foreach($skills as $skill)
                        <div><input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ (in_array($skill->id, explode(',', $worker->worker->skills))) ? 'checked' : '' }}><span class="pl-1">{{ $skill->name }}</span></div>
                @endforeach
                    <!--select class="skill__input input" name="skills[]" id="skills" multiple>
                        <option>выберите навыки</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select-->
                    <!--input class="skill__input input" type="text" id="experience" name="name" placeholder=""
                           required-->
                </div>
            </div>
        </section>

        <h2 class="head">Служебные данные</h2>
        <section class="skill">
            <div class="skill__unit">
                <div class="skill__part">
                    <label class="skill__label label" for="status_id">Статус</label>
                    <select class="skill__input input" name="status_id" id="status_id">
                        <option>выберите статус</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ ($worker->worker->status->id == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="role_id">Роль</label>
                    <select class="skill__input input" name="role_id" id="role_id">
                        <option>выберите роль</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ ($worker->role->id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        <section class="registration">
            <button type="submit" class="registration__btn button">Сохранить</button>
        </section>

    </div>

@endsection

