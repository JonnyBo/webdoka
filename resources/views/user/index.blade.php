@extends('layout.site', ['title' => __('site.admin_panel')])

@section('content')
    <h1>@lang('site.admin_panel')</h1>
    <p>{{ __('site.admin_panel_weelcom', ['name' => auth()->user()->name]) }}</p>
    <p>@lang('site.admin_panel_text')</p>
@endsection
