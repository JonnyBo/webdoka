@extends('layout.site', ['title' => 'Кандидаты'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Кандидаты</h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-success float-right" href="{{ route('user.create') }}"> Новый сотрудник</a>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            Статус:
            <select class="form-control statusFilter" name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ ( $filter == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        @if(!empty($workers))
        <table class="table table-bordered">

            <tr>

                <th>№</th>

                <th>Имя, Фамилия</th>

                <th>E-mail</th>

                <th>Дата регистрации</th>

                <th>Права</th>

                <th>Статус</th>

                <th>Action</th>

            </tr>

                @foreach($workers as $key => $worker)

                    <tr>

                        <td>{{ ++$key }}</td>

                        <td>{{ $worker->name }}</td>

                        <td>{{ $worker->email }}</td>

                        <td>{{ \Carbon\Carbon::parse($worker->created_at)->format('d.m.Y')}}</td>

                        <td>{{ $worker->role->name }}</td>

                        <td>{{ $worker->worker->status->name }}</td>

                        <td class="text-nowrap">
                            <a class="btn btn-primary btn-sm mr-sm-1" href="{{ route('user.edit',$worker->id) }}">Edit</a>
                            <form action="{{ route('user.destroy',$worker->id) }}" method="POST" class="btn">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mr-sm-1">Delete</button>
                            </form>
                        </td>
                    </tr>

                @endforeach

        </table>
        @else
            <div class="empty">По данному статусу сотрудники не найдены</div>
        @endif
    </div>
@endsection
