@extends('layout.site', ['title' => __('site.new_user')])

@section('content')

    <section class="candidates">
        <h2 class="candidates__heading heading">@lang('site.new_user')</h2>
    </section>

    @php
        $lang = session()->get('locale');
        $prefix = ($lang == 'ru') ? '' : '_' . $lang;
    @endphp

    <form method="post" action="@guest{{ route('create') }}@else{{ route('user.store') }}@endif" enctype="multipart/form-data">
        @csrf

    <div class="container">

        <h2 class="head">@lang('site.new_user')</h2>
        <section class="personal">
            <div class="personal__container">
                <label class="personal__label label" for="fam">@lang('site.name_surname')</label>
                <input class="personal__input personal__input--first input" type="text" id="fam" name="name{{ $prefix }}"
                       placeholder="@lang('site.name_surname')" value="{{ old('name' . $prefix) ?? '' }}" required>
                <label class="personal__label label" for="mail">@lang('site.email')</label>
                <input class="personal__input personal__input--first input" type="email" id="mail" name="email"
                       placeholder="@lang('site.address_email')" value="{{ ($worker->email) ? $worker->email : old('email') ?? '' }}" required>

                <div class="personal__unit">
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="gender">@lang('site.sex')</label>
                        <select class="personal__input personal__input--second input" name="sex{{ $prefix }}" id="gender" required>
                            <option>@lang('site.sex')</option>
                            <option value="@lang('site.sex_M')">@lang('site.sex_M')</option>
                            <option value="@lang('site.sex_F')">@lang('site.sex_F')</option>
                        </select>
                        <!--input class="personal__input personal__input--second input" type="text" id="gender" name="sex"
                               placeholder="???????????????? ??????" required-->
                    </div>
                    <div class="personal__part">
                        <label class="personal__label personal__label--second label" for="date">@lang('site.birthday')</label>
                        <input class="personal__input personal__input--second input" type="date" id="date" name="birthday"
                               placeholder="@lang('site.date_format')" value="{{ old('birthday') ?? '' }}" >
                    </div>
                </div>
            </div>
            <div class="personal__block">
                <p class="personal__photo">@lang('site.photo')</p>
                <input type="file" name="photo" class="personal_photo personal__btn">
                <!--button class="personal__btn">???????????????? ????????</button-->
            </div>
        </section>

        <h2 class="head">@lang('site.password')</h2>
        <section class="password">
            <div class="password__unit">
                <div class="password__part">
                    <label class="password__label label" for="password">@lang('site.password')</label>
                    <input class="password__input input" type="password" id="password" name="password" placeholder="@lang('site.new_password')"
                           required>
                </div>
                <div class="password__part">
                    <label class="password__label label" for="password2">@lang('site.password')</label>
                    <input class="password__input input" type="password" id="password2" name="password_confirmation" placeholder="@lang('site.confirm_password')"
                           required>
                </div>
            </div>
        </section>

        <h2 class="head">@lang('site.contact')</h2>
        <section class="contact">
            <div class="contact__unit">
                <div class="contact__part">
                    <label class="contact__label label" for="district">@lang('site.district')</label>
                    <input class="contact__input input" type="text" id="district" name="region{{ $prefix }}" value="{{ old('region' . $prefix) ?? '' }}" placeholder="@lang('site.you_district')">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="whatsapp">@lang('site.watsapp')</label>
                    <input class="contact__input input" type="text" id="watsapp" name="watsapp" value="{{ old('watsapp') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telephone">@lang('site.phone')</label>
                    <input class="contact__input input" type="text" id="telephone" name="phone" value="{{ old('phone') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="viber">@lang('site.viber')</label>
                    <input class="contact__input input" type="text" id="viber" name="vyber" value="{{ old('vyber') ?? '' }}" placeholder="+7 (___) ___ __ __">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="telegram">@lang('site.telegram')</label>
                    <input class="contact__input input" type="text" id="telegram" name="telegram" value="{{ old('telegram') ?? '' }}" placeholder="@">
                </div>
                <div class="contact__part">
                    <label class="contact__label label" for="skype">@lang('site.skype')</label>
                    <input class="contact__input input" type="text" id="skype" name="skype" value="{{ old('skype') ?? '' }}" placeholder="@lang('site.skype')">
                </div>
            </div>
        </section>

        <h2 class="head">@lang('site.profile_data')</h2>
        <section class="skill">
            <div class="skill__unit">
                <div class="skill__part">
                    <label class="skill__label label" for="summary">@lang('site.hh')</label>
                    <input class="skill__input input" type="text" id="summary" name="resume" value="{{ old('resume') ?? '' }}" placeholder="@lang('site.hh_link')">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="education">@lang('site.education')</label>
                    <input class="skill__input input" type="text" id="education" name="education{{ $prefix }}" value="{{ old('education' . $prefix) ?? '' }}" placeholder="@lang('site.you_education')">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="experience">@lang('site.experience')</label>
                    <!--textarea cols="2" rows="10" class="skill__input input" name="experience{{ $prefix }}" id="experience"></textarea-->
                    <input class="skill__input input" type="text" id="experience" name="experience{{ $prefix }}" value="{{ old('experience' . $prefix) ?? '' }}" placeholder="@lang('site.you_experience')">
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="skills">@lang('site.choose_skills')</label>
                    <select class="skill__input input select2-multiple" name="skills[]"
                            id="skill" multiple>
                        <option>@lang('site.choose_skills')</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->{'name' . $prefix} }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>
        @guest

        @else
        <h2 class="head">@lang('site.service_data')</h2>
        <section class="skill">
            <div class="skill__unit">
                <div class="skill__part">
                    <label class="skill__label label" for="status_id">@lang('site.status')</label>
                    <select class="skill__input input" name="status_id" id="status_id">
                        <option value="0">@lang('site.choose_status')</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->{'name' . $prefix} }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="skill__part">
                    <label class="skill__label label" for="role_id">@lang('site.role')</label>
                    <select class="skill__input input" name="role_id" id="role_id">
                        <option value="0">@lang('site.choose_role')</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->{'name' . $prefix} }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="skill__unit">
                <div class="textarea-div">
                    <label class="skill__label label" for="comment">@lang('site.comment')</label>
                    <textarea cols="2" rows="10" class="skill__input input" name="comment{{ $prefix }}" id="comment"></textarea>
                </div>
            </div>
            <div class="skill__unit">
                <div class="textarea-div">
                    <label class="skill__label label" for="documents">@lang('site.documents')</label>
                    <input type="file" class="skill__input input" name="documents[]" id="documents" multiple/>
                </div>
            </div>
        </section>
        @endif
    </div>

    <section class="registration">
        <button type="submit" class="registration__btn button">@lang('site.register_user')</button>
    </section>

    </form>

@endsection
