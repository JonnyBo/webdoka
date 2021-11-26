@extends('layout.site', ['title' => 'Кандидаты'])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">Кандидаты</h2>
        <a class="candidates__link button" href="{{ route('user.create') }}">Новый сотрудник</a>
    </section>

    <section class="tabs">
        <ul class="tabs__list filter__candidate">
            <li class="tabs__item">
                <button class="tabs__btn tabs__btn--active" data-tabs-path="filter">Фильтр</button>
            </li>
            <!--li class="tabs__item">
                <button class="tabs__btn" data-tabs-path="new-filter">Новый фильтр</button>
            </li-->
        </ul>
    </section>



    <div class="tabs__content tabs__content--active" data-tabs-target="filter">
        <div class="content">
            <section class="filter">
                <form id="form-user-filter" action="{{ route('user.index') }}" method="GET">
                    <div class="filter__container">

                        <label class="filter__label filter__label--first label" for="name">Поиск</label>
                        <label class="filter__label filter__label--second label" for="status">Статус</label>
                        <label class="filter__label filter__label--third label" for="skill">Навыки</label>
                        <input class="filter__input filter__input--first input" type="text" id="name" name="name"
                               placeholder="Поиск по имени или email"  value="{{ $filter['name'] ?? '' }}">
                        <select class="filter__input filter__input--second input select2-single" name="status"
                                id="status">
                            <!--option>Выберите статус</option-->
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" @if(isset($filter['status']) && $status->id == $filter['status']) selected @endif>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        <select class="filter__input filter__input--third input select2-multiple" name="skills[]"
                                id="skill" multiple>
                            <option>выберите навыки</option>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" @if(isset($filter['skills']) && !empty($filter['skills']) && in_array($skill->id, $filter['skills'])) selected @endif>{{ $skill->name }}</option>
                            @endforeach
                        </select>
                        <!--input class="filter__input filter__input--second input" type="text" id="status" name="name"
                               placeholder="Работает сейчас" required-->
                        <!--input class="filter__input filter__input--third input" type="text" id="skill" name="name"
                               placeholder="Выберите навык" required-->

                    </div>
                </form>
            </section>

            <section class="selection">
                <div class="selection__container">
                    @if(!empty($workers))
                        <table class="selection__table">
                            <tbody>
                            <tr class="selection__block">

                                <td>
                                    <input class="radio__input" type="radio" name="target" id="number">
                                    <label class="radio__label" for="number">№</label>
                                </td>

                                <td class="selection__text">Имя, Фамилия</td>

                                <td class="selection__text">E-mail</td>

                                <td class="selection__text">Дата регистрации</td>

                                <td class="selection__text">Права</td>

                                <td class="selection__text">Статус</td>

                                <td class="selection__none"></td>

                                <td class="selection__none"></td>

                            </tr>

                            @foreach($workers as $key => $worker)

                                <tr>

                                    <td>
                                        <input class="radio__input" type="radio" name="target[{{ $worker->id }}]"
                                               id="one_{{ $worker->id }}">
                                        <label class="radio__label" for="one_{{ $worker->id }}">{{ ++$key }}</label>
                                    </td>

                                    <td class="selection__text">{{ $worker->name }}</td>

                                    <td class="selection__text">{{ $worker->email }}</td>

                                    <td class="selection__text">{{ \Carbon\Carbon::parse($worker->created_at)->format('d.m.Y')}}</td>

                                    <td class="selection__text">{{ $worker->role }}</td>

                                    <td class="selection__text">{{ $worker->status }}</td>

                                    <td class="selection__text"><a href="{{ route('user.edit',$worker->id) }}">
                                            <button class="selection__pencil selection__button"></button>
                                        </a></td>

                                    <td class="selection__text">
                                        <form action="{{ route('user.destroy',$worker->id) }}" method="POST"
                                              class="btn">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="selection__delete selection__button"></button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty">По данному статусу сотрудники не найдены</div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
