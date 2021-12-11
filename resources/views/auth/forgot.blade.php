@extends('layout.site', ['title' => __('site.forgot')])

@section('content')
    <h1>@lang('site.forgot')</h1>
    <form method="post" action="{{ route('forgot-mail') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="@lang('site.address_email')"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">@lang('site.restore')</button>
        </div>
    </form>
@endsection
