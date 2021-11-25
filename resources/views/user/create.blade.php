@extends('layout.site', ['title' => 'Новый Сотрудник'])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">Новый сотрудник</h2>
    </section>

    <form method="post" action="@guest{{ route('create') }}@else{{ route('user.store') }}@endif">
        @csrf

    <div class="container">

        <h2 class="head">Личные данные</h2>
        <section class="personal">
            <div class="personal__container">
                <label class="personal__label label" for="fam">Имя, Фамилия</label>
                <input class="personal__input personal__input--first input" type="text" id="fam" name="name"
                       placeholder="Введите имя" value="{{ old('name') ?? '' }}" required>
                <label class="personal__label label" for="mail">Адрес почты</label>
                <input class="personal__input personal__input--first input" type="email" id="mail" name="email"
                       placeholder="Введите почту" value="{{ old('email') ?? '' }}" required>

                <div class="personal__unit">
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="gender">Выберите пол</label>
                        <select class="personal__input personal__input--second input" name="sex" id="gender" required>
                            <option>выберите пол</option>
                            <option value="М">М</option>
                            <option value="Ж">Ж</option>
                        </select>
                        <!--input class="personal__input personal__input--second input" type="text" id="gender" name="sex"
                               placeholder="Выберите пол" required-->
                    </div>
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="date">Дата рождения</label>
                        <input class="personal__input personal__input--second input" type="date" id="date" name="birthday"
                               placeholder="дд.мм.гг" value="{{ old('birthday') ?? '' }}" >
                    </div>
                </div>
            </div>
            <div class="personal__block">
                <p class="personal__photo">Фотография</p>
                <button class="personal__btn">Добавить фото</button>
            </div>
        </section>

        <h2 class="head">Пароль</h2>
        <section class="password">
            <div class="password__unit">
                <div class="password__part">
                    <label class="password__label label" for="password">Пароль</label>
                    <input class="password__input input" type="password" id="password" name="password" placeholder="Придумайте пароль"
                           required>
                </div>
                <div class="password__part">
                    <label class="password__label label" for="password2">Пароль</label>
                    <input class="password__input input" type="password" id="password2" name="password_confirmation" placeholder="Повторите пароль"
                           required>
                </div>
            </div>
        </section>

        <h2 class="head">Контактные данные</h2>
        <section class="contact">
            <div class="contact__unit">
                <div class="contact__part">
                    <label class="contact__label label" for="district">Район</label>
                    <input class="contact__input input" type="text" id="district" name="region" value="{{ old('region') ?? '' }}" placeholder="Введите название района">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="whatsapp">Ватсап</label>
                    <input class="contact__input input" type="text" id="watsapp" name="watsapp" value="{{ old('watsapp') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telephone">Телефон</label>
                    <input class="contact__input input" type="text" id="telephone" name="phone" value="{{ old('phone') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="viber">Вайбер</label>
                    <input class="contact__input input" type="text" id="viber" name="vyber" value="{{ old('vyber') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telegram">Телеграм</label>
                    <input class="contact__input input" type="text" id="telegram" name="telegram" value="{{ old('telegram') ?? '' }}" placeholder="@">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="skype">Скайп</label>
                    <input class="contact__input input" type="text" id="skype" name="skype" value="{{ old('skype') ?? '' }}" placeholder="Никнейм">
                </div>
            </div>
        </section>

        <h2 class="head">Профильные данные</h2>
        <section class="skill">
            <div class="skill__unit">
                <div class="skill__part">
                    <label class="skill__label label" for="summary">Резюме на hh.ru</label>
                    <input class="skill__input input" type="text" id="summary" name="resume" value="{{ old('resume') ?? '' }}" placeholder="Ссылка на резюме">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="education">Образование</label>
                    <input class="skill__input input" type="text" id="education" name="education" value="{{ old('education') ?? '' }}" placeholder="Введите образование">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="experience">Опыт работы</label>
                    <input class="skill__input input" type="text" id="experience" name="experience" value="{{ old('experience') ?? '' }}" placeholder="Сколько лет опыта">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="skills">Выберите навыки</label>
                    <select class="skill__input input" name="skills[]" id="skills" multiple>
                        <option>выберите навыки</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <!--input class="skill__input input" type="text" id="experience" name="name" placeholder=""
                           required-->
                </div>
            </div>
        </section>
    </div>

    <section class="registration">
        <button type="submit" class="registration__btn button">Зарегистрировать сотрудника</button>
    </section>

        <input type="hidden" name="role_id" value="2">

    </form>


    <!--h1>Новый Сотрудник</h1>
    <form method="post" action="@guest{{ route('create') }}@else{{ route('user.store') }}@endif">
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
            <input type="password" class="form-control" name="password" placeholder="Придумайте пароль"
                   required maxlength="255" value="">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="Пароль еще раз" required maxlength="255" value="">
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" name="sex">
                        <option>выберите пол</option>
                        <option value="М">М</option>
                        <option value="Ж">Ж</option>
                    </select>
                </div>
                <div class="col-md-6">
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
        @guest
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
        @else

        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">Регистрация</button>
        </div-->

@endsection
