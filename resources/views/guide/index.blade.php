@extends('layout.site', ['title' => 'Админ панель'])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">Настройки</h2>
    </section>

    <section class="tabs">
        <ul class="tabs__list">
            @foreach($guids as $key => $guid)
            <li class="tabs__item"><button class="tabs__btn @if($key == 0) tabs__btn--active @endif" data-tabs-path="<?=$guid['table']?>"><?=$guid['name']?></button></li>
            @endforeach
            <!--li class="tabs__item"><button class="tabs__btn" data-tabs-path="status">Статусы</button></li>
            <li class="tabs__item"><button class="tabs__btn" data-tabs-path="source">Источники</button></li>
            <li class="tabs__item"><button class="tabs__btn" data-tabs-path="skill">Навыки</button></li-->
        </ul>
        @foreach($guids as $key => $guid)
        <div class="tabs__content @if($key == 0) tabs__content--active @endif" data-tabs-target="<?=$guid['table']?>">
            <div class="content">
                <form method="post" action="{{ route('guide.create') }}">
                    <input type="hidden" name="table" value="{{ $guid['table'] }}">
                    @csrf
                    <label class="content__label label" for="name">Добавить</label>
                    <input class="content__input input" type="text" id="name" name="name" placeholder="Введите название" required />
                    <button class="content__btn button">Добавить</button>
                </form>

                <section class="selection">
                    <div class="selection__container">
                        @if(!empty($guid['items']))
                        <table class="selection__table">
                            <tbody>
                            <tr class="selection__block">
                                <td>
                                    <!--input class="radio__input" type="radio" name="target" id="number"-->
                                    <label class="radio__label" for="number">№</label>
                                </td>
                                <td class="selection__text">Наименование</td>
                                <td class="selection__none"></td>
                                <td class="selection__none"></td>
                            </tr>
                            @foreach($guid['items'] as $k => $item)
                            <tr class="selection__item">
                                <td>
                                    <!--input class="radio__input" type="radio" name="target_{{ $guid['table'] }}[{{ $item->id }}]" id="one_{{ $guid['table'] }}_{{ $item->id }}"-->
                                    <label class="radio__label" for="one_{{ $guid['table'] }}_{{ $item->id }}">{{ ++$k }}</label>
                                </td>
                                <!--td class="selection__text">{{ $item->name }}</td-->
                                <td class="selection__text">
                                    <form action="{{ route('guide.update') }}" method="POST" class="btn" id="edit-{{ $guid['table'] }}_{{ $item->id }}">
                                        @csrf
                                        <input type="hidden" name="table" value="{{ $guid['table'] }}">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input class="content__input input" style="width: 500px" type="text" name="name" value="{{ $item->name }}">

                                    </form>
                                </td>
                                <td class="selection__text"><button type="button" class="selection__pencil selection__button" data-form="edit-{{ $guid['table'] }}_{{ $item->id }}"></button></td>
                                <td class="selection__text">
                                    <!--form action="{{ route('guide.destroy',$item->id) }}" method="POST" class="btn"-->
                                    {!! Form::open(['url'=>route('guide.destroy',$item->id),'method'=>'POST','class'=>'btn',
            'role'=>'form','onsubmit' => 'return confirm("Вы действительно хотите удалить это значение?")'])!!}
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="table" value="{{ $guid['table'] }}">
                                        <button type="submit" class="selection__delete selection__button"></button>
                                    {!! Form::close() !!}
                                    <!--/form-->
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </section>
            </div>
        </div>
        @endforeach
    </section>



@endsection
