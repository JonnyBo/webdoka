@extends('layout.site', ['title' => 'Админ панель'])

@section('content')
    <h1>{{ $guide['name'] }}</h1>
    <div class="row">
        @if(!empty($items))
            <table class="table table-bordered">

                <tr>

                    <th>№</th>

                    <th>Наименование</th>

                </tr>
                @foreach($items as $key => $item)

                <tr>

                    <td>{{ ++$key }}</td>

                    <td>
                        <form action="{{ route('guide.update') }}" method="POST" class="btn">
                            @csrf
                            <input type="hidden" name="table" value="{{ $guide['table'] }}">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input style="width: 500px;" type="text" name="name" value="{{ $item->name }}">
                            <button type="submit" class="btn btn-primary btn-sm mr-sm-1">Update</button>
                        </form>
                        <form action="{{ route('guide.destroy',$item->id) }}" method="POST" class="btn">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="table" value="{{ $guide['table'] }}">
                            <button type="submit" class="btn btn-danger btn-sm mr-sm-1">Delete</button>
                        </form>

                    </td>

                </tr>

                @endforeach

            </table>

        @endif

    </div>

    <div class="row">
        <form method="post" action="{{ route('guide.create') }}">
            <input type="hidden" name="table" value="{{ $guide['table'] }}">
            @csrf
            <h2>Добавить значение</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Значение"
                               required maxlength="255">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info text-white">Добавить</button>
            </div>
        </form>
    </div>

@endsection
