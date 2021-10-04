@extends('layout.site', ['title' => 'Админ панель'])

@section('content')
    <h1>Админ панель</h1>
    <p>Добрый день {{ auth()->user()->name }}!</p>
    <p>Это Админ панель сайта.</p>
@endsection
