@extends('backend.layouts.app')
@section('title', __('labels.backend.general_settings.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
    <style>
        .color-list li {
            float: left;
            width: 8%;
        }

        @media screen  and (max-width: 768px) {
            .color-list li {
                width: 20%;
                padding-bottom: 20px;
            }

            .color-list li:first-child {
                padding-bottom: 0px;
            }
        }

        .options {
            line-height: 35px;
        }

        .color-list li a {
            font-size: 20px;
        }

        .color-list li a.active {
            border: 4px solid grey;
        }

        .color-default {
            font-size: 18px !important;
            background: #101010;
            border-radius: 100%;
        }

        .form-control-label {
            line-height: 35px;
        }

        .switch.switch-3d {
            margin-bottom: 0px;
            vertical-align: middle;

        }

        .color-default i {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .preview {
            background-color: #dcd8d8;
            background-image: url(https://www.transparenttextures.com/patterns/carbon-fibre-v2.png);
        }

        #logos img {
            height: auto;
            width: 100%;
        }
    </style>
@endpush
@section('content')
   <form method="POST" action="{{ route('admin.general-settings') }}" id="general-settings-form" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('POST')
    <div class="card">
        <div class="card-body">
           <div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link active" href="#general">
                    {{ __('labels.backend.general_settings.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#logos">
                    {{ __('labels.backend.general_settings.logos.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#layout">
                    {{ __('labels.backend.general_settings.layout.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#email">
                    {{ __('labels.backend.general_settings.email.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#payment_settings">
                    {{ __('labels.backend.general_settings.payment_settings.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#language_settings">
                    {{ __('labels.backend.general_settings.language_settings.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" class="nav-link" href="#user_registration_settings">
                    {{ __('labels.backend.general_settings.user_registration_settings.title') }}
                </a>
            </li>
        </ul>
        <h4 class="card-title mb-0">
            {{--{{ __('labels.backend.general_settings.management') }}--}}
        </h4>
    </div><!--col-->
</div><!--row-->


            <div class="tab-content">
                <!---General Tab--->
                <div id="general" class="tab-pane container active">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                           <div class="form-group row">
    <label for="app_name" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.app_name') }}</label>

    <div class="col-md-10">
        <input type="text" name="app_name" class="form-control" placeholder="{{ __('labels.backend.general_settings.app_name') }}" maxlength="191" value="{{ config('app.name') }}" autofocus>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="app_url" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.app_url') }}</label>

    <div class="col-md-10">
        <input type="text" name="app_url" class="form-control" placeholder="{{ __('labels.backend.general_settings.app_url') }}" maxlength="191" value="{{ config('app.url') }}">
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="font_color" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.font_color') }}</label>

    <div class="col-md-10">
        <ul class="d-inline-block list-inline w-100 mb-0 color-list list-style-none">
            <li>
                <a data-color="default" class="color-default" href="#!"><i class="fas fa-circle"></i></a>
                <p class="mb-0" style="font-size: 10px">(Default)</p>
            </li>
            <li>
                <a data-color="color-2" class="color-2" onclick="setActiveStyleSheet('color-2'); return true;" href="#!"><i class="fas fa-circle"></i></a>
            </li>
            <!-- Add the remaining color options -->
        </ul>
        <input type="hidden" name="font_color" id="font_color" value="default">
        <span class="help-text font-italic">{{ __('labels.backend.general_settings.font_color_note') }}</span>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="counter" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.counter') }}</label>

    <div class="col-md-10">
        <select class="form-control" id="counter" name="counter">
            <option value="1" selected>{{ __('labels.backend.general_settings.static') }}</option>
            <option value="2">{{ __('labels.backend.general_settings.database') }}</option>
        </select>
        <span class="help-text font-italic">{!! __('labels.backend.general_settings.counter_note') !!}</span>
        <div class="counter-container" id="counter-container">
            <input class="form-control my-2" type="text" id="total_students" required name="total_students" placeholder="{{ __('labels.backend.general_settings.total_students') }}">
            <input type="text" required id="total_courses" class="form-control mb-2" name="total_courses" placeholder="{{ __('labels.backend.general_settings.total_courses') }}">
            <input type="text" required class="form-control mb-2" id="total_teachers" name="total_teachers" placeholder="{{ __('labels.backend.general_settings.total_teachers') }}">
        </div>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="google_analytics_id" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.google_analytics_id') }}</label>

    <div class="col-md-10">
        <input type="text" name="google_analytics_id" class="form-control" placeholder="Ex. UA-34XXXXX23-3" maxlength="191" value="{{ config('google_analytics_id') }}" autofocus>
        <span class="float-right">
            <a target="_blank" class="font-weight-bold font-italic" href="https://support.google.com/analytics/answer/1042508">{{ __('labels.backend.general_settings.google_analytics_id_note') }}</a>
        </span>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="captcha_status" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.settings.general_settings.captcha_status') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="access__captcha__registration" id="captcha_status" class="switch-input" value="1" {{ config('access.captcha.registration') ? 'checked' : '' }}>
                <span class="switch-label"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <span class="float-right">
            <a target="_blank" class="font-weight-bold font-italic" href="https://support.google.com/analytics/answer/1042508">{{ __('labels.backend.general_settings.captcha_note') }}</a>
        </span>
        <small><i>{{ __('labels.backend.general_settings.captcha') }}</i></small>
        <div id="captcha-credentials" class="{{ config('access.captcha.registration') ? '' : 'd-none' }}">
            <br>
            <div class="form-group row">
                <label for="captcha_site_key" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.settings.general_settings.captcha_site_key') }}</label>
                <div class="col-md-10">
                    <input type="text" name="no-captcha.sitekey" class="form-control" placeholder="{{ __('validation.attributes.backend.settings.general_settings.captcha_site_key') }}" value="{{ config('no-captcha.sitekey') }}">
                </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
                <label for="captcha_site_secret" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.settings.general_settings.captcha_site_secret') }}</label>
                <div class="col-md-10">
                    <input type="text" name="no-captcha.secret" class="form-control" placeholder="{{ __('validation.attributes.backend.settings.general_settings.captcha_site_secret') }}" value="{{ config('no-captcha.secret') }}">
                </div><!--col-->
            </div><!--form-group-->
        </div>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="retest" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.settings.general_settings.retest_status') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="retest" id="retest" class="switch-input" value="1" {{ config('retest') ? 'checked' : '' }}>
                <span class="switch-label"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <small><i>{{ __('labels.backend.general_settings.retest_note') }}</i></small>
    </div><!--col-->
</div><!--form-group-->



<div class="col-12 text-left">
    <a href="{{route('admin.troubleshoot')}}" class="btn btn-lg btn-warning">{{__('labels.backend.general_settings.troubleshoot')}}</a>
</div>

                    </div>
                </div>

                <!---Logos Tab--->
             <!-- Logos Tab -->
<div id="logos" class="tab-pane container fade">
    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="row form-group">
                <label for="logo_b_image" class="col-md-2 form-control-label">{{ __('labels.backend.logo.logo_b') }}</label>

                <div class="col-md-10">
                    {!! Form::file('logo_b_image', ['class' => 'form-control d-inline-block', 'placeholder' => '', 'id' => 'logo_b_image', 'accept' => 'image/jpeg,image/gif,image/png', 'data-preview' => '#logo_b_image_preview']) !!}
                    <p class="help-text mb-0 font-italic">{{ __('labels.backend.logo.logo_b_note') }}</p>
                </div>
                <div class="col-md-8 offset-md-2">
                    <div id="logo_b_image_preview" class="d-inline-block p-3 preview">
                        <img height="50px" src="{{ asset('storage/logos/' . config('logo_b_image')) }}">
                    </div>
                </div>
            </div>

            <!-- Repeat the code block for other logos -->
            
        </div>
    </div>
</div>



 <div id="email" class="tab-pane container fade">
    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                <label for="mail_from_name" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_from_name')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__from__name" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_from_name')" maxlength="191" value="{{ config('mail.from.name') }}" autofocus>
                    <span class="help-text font-italic">@lang('labels.backend.general_settings.email.mail_from_name_note')</span>
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_from_address" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_from_address')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__from__address" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_from_address')" maxlength="191" value="{{ config('mail.from.address') }}" autofocus>
                    <span class="help-text font-italic">@lang('labels.backend.general_settings.email.mail_from_address_note')</span>
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_driver" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_driver')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__driver" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_driver')" maxlength="191" value="{{ config('mail.driver') }}">
                    <span class="help-text font-italic">{!! __('labels.backend.general_settings.email.mail_driver_note') !!}</span>
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_host" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_host')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__host" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_driver')" maxlength="191" placeholder="Ex. smtp.gmail.com" value="{{ config('mail.host') }}">
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_port" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_port')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__port" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_port')" maxlength="191" placeholder="Ex. 465" value="{{ config('mail.port') }}">
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_username" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_username')</label>

                <div class="col-md-10">
                    <input type="text" name="mail__username" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_username')" maxlength="191" placeholder="Ex. myemail@email.com" value="{{ config('mail.username') }}">
                    <span class="help-text font-italic">{!! __('labels.backend.general_settings.email.mail_username_note') !!}</span>
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_password" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_password')</label>

                <div class="col-md-10">
                    <input type="password" name="mail__password" class="form-control" placeholder="@lang('labels.backend.general_settings.email.mail_password')" maxlength="191" placeholder="@lang('labels.backend.general_settings.email.mail_password')" value="{{ config('mail.password') }}">
                    <span class="help-text font-italic">{!! __('labels.backend.general_settings.email.mail_password_note') !!}</span>
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                <label for="mail_encryption" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.email.mail_encryption')</label>

                <div class="col-md-10">
                    <select name="mail__encryption" class="form-control">
                        <option value="tls" {{ config('mail.encryption') === 'tls' ? 'selected' : '' }}>tls</option>
                        <option value="ssl" {{ config('mail.encryption') === 'ssl' ? 'selected' : '' }}>ssl</option>
                    </select>
                    <span class="help-text font-italic">{!! __('labels.backend.general_settings.email.mail_encryption_note') !!}</span>
                </div><!--col-->
            </div><!--form-group-->

            <hr>

            <p class="help-text mb-0">{!! __('labels.backend.general_settings.email.note') !!}</p>
        </div>
    </div>
</div>



               <!-- Payment Configuration Tab -->
<div id="payment_settings" class="tab-pane container fade">
    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                <label for="app__currency" class="col-md-3 form-control-label">{{ __('labels.backend.general_settings.payment_settings.select_currency') }}</label>
                <div class="col-md-9">
                    <select class="form-control" id="app__currency" name="app__currency">
                        @foreach(config('currencies') as $currency)
                            <option value="{{ $currency['short_code'] }}" @if(config('app.currency') == $currency['short_code']) selected @endif>
                                {{ $currency['symbol'] }} - {{ $currency['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="services__stripe__active" class="col-md-3 form-control-label">{{ __('labels.backend.general_settings.payment_settings.stripe') }}</label>
                <div class="col-md-9">
                    <div class="checkbox">
                        <input type="checkbox" name="services__stripe__active" class="switch-input" value="1" @if(config('services.stripe.active')) checked @endif>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                        <a class="float-right font-weight-bold font-italic" href="https://stripe.com/docs/keys" target="_blank">{{ __('labels.backend.general_settings.payment_settings.how_to_stripe') }}</a>
                    </div>
                    <small><i>{{ __('labels.backend.general_settings.payment_settings.stripe_note') }}</i></small>
                    <div class="switch-content @if(config('services.stripe.active') == 0 || config('services.stripe.active') == false) d-none @endif">
                        <br>
                        <div class="form-group row">
                            <label for="services__stripe__key" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.payment_settings.key') }}</label>
                            <div class="col-md-8 col-xs-12">
                                <input type="text" name="services__stripe__key" class="form-control" value="{{ config('services.stripe.key') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="services__stripe__secret" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.payment_settings.secret') }}</label>
                            <div class="col-md-8 col-xs-12">
                                <input type="text" name="services__stripe__secret" class="form-control" value="{{ config('services.stripe.secret') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="paypal__active" class="col-md-3 form-control-label">{{ __('labels.backend.general_settings.payment_settings.paypal') }}</label>
                <div class="col-md-9">
                    <div class="checkbox">
                        <input type="checkbox" name="paypal__active" class="switch-input" value="1" @if(config('paypal.active')) checked @endif>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                        <a href="https://developer.paypal.com/developer/applications/" target="_blank" class="float-right font-italic font-weight-bold">{{ __('labels.backend.general_settings.payment_settings.how_to_paypal') }}</a>
                    </div>
                    <small><i>{{ __('labels.backend.general_settings.payment_settings.paypal_note') }}</i></small>
                    <div class="switch-content @if(config('paypal.active') == 0 || config('paypal.active') == false) d-none @endif">
                        <br>
                        <div class="form-group row">
                            <label for="paypal_settings_mode" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.payment_settings.mode') }}</label>
                            <div class="col-md-8 col-xs-12">
                                <select class="form-control" id="paypal_settings_mode" name="paypal__settings__mode">
                                    <option value="sandbox" selected>{{ __('labels.backend.general_settings.payment_settings.sandbox') }}</option>
                                    <option value="live">{{ __('labels.backend.general_settings.payment_settings.live') }}</option>
                                </select>
                                <span class="help-text font-italic">{!!  __('labels.backend.general_settings.payment_settings.mode_note') !!}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paypal__client_id" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.payment_settings.client_id') }}</label>
                            <div class="col-md-8 col-xs-12">
                                <input type="text" name="paypal__client_id" class="form-control" value="{{ config('paypal.client_id') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paypal__secret" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.payment_settings.client_secret') }}</label>
                            <div class="col-md-8 col-xs-12">
                                <input type="text" name="paypal__secret" class="form-control" value="{{ config('paypal.secret') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="payment_offline_active" class="col-md-3 form-control-label">{{ __('labels.backend.general_settings.payment_settings.offline_mode') }}</label>
                <div class="col-md-9">
                    <div class="checkbox">
                        <input type="checkbox" name="payment_offline_active" class="switch-input" value="1" @if(config('payment_offline_active')) checked @endif>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </div>
                    <small><i>{{ __('labels.backend.general_settings.payment_settings.offline_mode_note') }}</i></small>
                </div>
            </div>
        </div>
    </div>
</div>

                <!--Language Tab--->
               <!-- Language Tab -->
<div id="language_settings" class="tab-pane container fade">
    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                <label for="default_language" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.language_settings.default_language') }}</label>
                <div class="col-md-10">
                    <select class="form-control" id="app_locale" name="app__locale">
                        @foreach($app_locales as $lang)
                            <option data-display-type="{{$lang->display_type}}" @if($lang->is_default == 1) selected @endif value="{{$lang->short_name}}">
                                @if(trans('menus.language-picker.langs.'.$lang))
                                    {{ trans('menus.language-picker.langs.'.$lang->short_name) }}
                                @else
                                    {{ $lang }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="display_type" class="col-md-2 form-control-label">{{ __('labels.backend.general_settings.language_settings.display_type') }}</label>
                <div class="col-md-10">
                    <select class="form-control" id="app_display_type" name="app__display_type">
                        <option @if(config('app.display_type') == 'ltr') selected @endif value="ltr">{{ __('labels.backend.general_settings.language_settings.left_to_right') }}</option>
                        <option @if(config('app.display_type') == 'rtl') selected @endif value="rtl">{{ __('labels.backend.general_settings.language_settings.right_to_left') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


              <div id="user_registration_settings" class="tab-pane container fade">
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <h4>{{ __('labels.backend.general_settings.user_registration_settings.desc') }}</h4>
        </div>
        <input type="hidden" id="registration_fields" name="registration_fields">

        <div class="col-lg-9 input-boxes col-12">
            <div class="form-group">
                <input type="text" readonly placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.first_name') }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <input type="text" readonly placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.last_name') }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <input type="text" readonly placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.email') }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <input type="text" readonly placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.password') }}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 border-left col-12">
            <div class="form-group input-list">
                <div class="checkbox">
                    <label><input type="checkbox" checked disabled value=""> First Name</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" checked disabled value=""> Last Name</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" checked disabled value=""> Email</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" checked disabled value=""> Password</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="phone" data-type="number"
                                  value=""> Phone</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="dob" data-type="date"
                                  value=""> Date of Birth</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="gender" data-type="radio"
                                  value=""> Gender</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="address"
                                  data-type="textarea" value=""> Address</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="city" data-type="text"
                                  value=""> City</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="pincode" data-type="text"
                                  value=""> Pincode</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="state" data-type="text"
                                  value=""> State</label>
                </div>
                <div class="checkbox">
                    <label><input class="option" type="checkbox" data-name="country" data-type="text"
                                  value=""> Country</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-footer clearfix">
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.general-settings') }}" class="btn btn-secondary">{{ __('buttons.general.cancel') }}</a>
        </div><!--col-->
        <div class="col text-right">
            <button type="submit" class="btn btn-primary" id="submit">{{ __('buttons.general.crud.update') }}</button>
        </div><!--col-->
    </div><!--row-->
</div><!--card-footer-->

            </div><!--card-->
        </div>
    </div>
   </form>
@endsection


@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            //========= Initialisation for Iconpicker ===========//
            $('#icon').iconpicker({
                cols: 10,
                icon: 'fab fa-facebook-f',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-success',
                unselectedClass: ''
            });


            //========== Preset theme layout ==============//
            @if(config('theme_layout') != "")
            $('#theme_layout').find('option').removeAttr('selected')
            $('#theme_layout').find('option[value="{{config('theme_layout')}}"]').attr('selected', 'selected');
            @endif


            //============ Preset font color ===============//
            @if(config('font_color') != "")
            $('.color-list').find('li a').removeClass('active');
            $('.color-list').find('li a[data-color="{{config('font_color')}}"]').addClass('active');
            $('#font_color').val("{{config('font_color')}}");
            @endif


            //========= Preset Layout type =================//
            @if(config('layout_type') != "")
            $('#layout_type').find('option').removeAttr('selected')
            $('#layout_type').find('option[value="{{config('layout_type')}}"]').attr('selected', 'selected');
            @endif


            //=========== Preset Counter data =============//
            @if(config('counter') != "")
            @if((int)config('counter') == 1)
            $('.counter-container').removeClass('d-none')
            $('#total_students').val("{{config('total_students')}}");
            $('#total_teachers').val("{{config('total_teachers')}}");
            $('#total_courses').val("{{config('total_courses')}}");
            @else
            $('#counter-container').empty();
            @endif

            @if(config('counter') != "")
            $('.counter-container').removeClass('d-none');
            @endif

            $('#counter').find('option').removeAttr('selected')
            $('#counter').find('option[value="{{config('counter')}}"]').attr('selected', 'selected');
            @endif


            //======== Preset PaymentMode for Paypal =======>
            @if(config('paypal.settings.mode') != "")
            $('#paypal_settings_mode').find('option').removeAttr('selected')
            $('#paypal_settings_mode').find('option[value="{{config('paypal.settings.mode')}}"]').attr('selected', 'selected');
            @endif


            //============= Font Color selection =================//
            $(document).on('click', '.color-list li', function () {
                $(this).siblings('li').find('a').removeClass('active')
                $(this).find('a').addClass('active');
                $('#font_color').val($(this).find('a').data('color'));
            });


            //============== Captcha status =============//
            $(document).on('click', '#captcha_status', function (e) {
//              e.preventDefault();
                if ($('#captcha-credentials').hasClass('d-none')) {
                    $('#captcha_status').attr('checked', 'checked');
                    $('#captcha-credentials').find('input').attr('required', true);
                    $('#captcha-credentials').removeClass('d-none');
                } else {
                    $('#captcha-credentials').addClass('d-none');
                    $('#captcha-credentials').find('input').attr('required', false);
                }
            });

            //============== One Signal status =============//
            $(document).on('click', '#onesignal_status', function (e) {
//              e.preventDefault();
                if ($('#onesignal-configuration').hasClass('d-none')) {
                    console.log('here')
                    $('#onesignal_status').attr('checked', 'checked');
                    $('#onesignal-configuration').removeClass('d-none').find('textarea').attr('required', true);
                } else {
                    $('#onesignal-configuration').addClass('d-none').find('textarea').attr('required', false);
                }
            });


            //===== Counter value on change ==========//
            $(document).on('change', '#counter', function () {
                if ($(this).val() == 1) {
                    $('.counter-container').empty().removeClass('d-none');
                    var html = "<input class='form-control my-2' type='text' id='total_students' name='total_students' placeholder='" + "{{__('labels.backend.general_settings.total_students')}}" + "'><input type='text' id='total_courses' class='form-control mb-2' name='total_courses' placeholder='" + "{{__('labels.backend.general_settings.total_courses')}}" + "'><input type='text' class='form-control mb-2' id='total_teachers' name='total_teachers' placeholder='" + "{{__('labels.backend.general_settings.total_teachers')}}" + "'>";

                    $('.counter-container').append(html);
                } else {
                    $('.counter-container').addClass('d-none');
                }
            });


            //========== Preview image function on upload =============//
            var previewImage = function (input, block) {
                var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                var extension = input.files[0].name.split('.').pop().toLowerCase();
                var isSuccess = fileTypes.indexOf(extension) > -1;

                if (isSuccess) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $(block).find('img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Please input valid file!');
                }

            };
            $(document).on('change', 'input[type="file"]', function () {
                previewImage(this, $(this).data('preview'));
            });


            //========== Registration fields status =========//
            @if(config('registration_fields') != NULL)
            var fields = "{{config('registration_fields')}}";

            fields = JSON.parse(fields.replace(/&quot;/g, '"'));

            $(fields).each(function (key,element) {
                appendElement(element.type,element.name);
                $('.input-list').find('[data-name="'+element.name+'"]').attr('checked',true)

            });

            @endif


            //======= Saving settings for All tabs =================//
            $(document).on('submit', '#general-settings-form', function (e) {
//                e.preventDefault();

                //======Saving Layout sections details=====//
                var sections = $('#sections').find('input[type="checkbox"]');
                var title, name, status;
                var sections_data = {};
                $(sections).each(function () {
                    if ($(this).is(':checked')) {
                        status = 1
                    } else {
                        status = 0
                    }
                    name = $(this).attr('id');
                    title = $(this).parent('label').siblings('.title').html();
                    sections_data[name] = {title: title, status: status}
                });
                $('#section_data').val(JSON.stringify(sections_data));

                //=========Saving Registration fields ===============//
                var inputName, inputType;
                var fieldsData = [];
                var registrationFields = $('.input-list').find('.option:checked');
                $(registrationFields).each(function (key, value) {
                    inputName = $(value).attr('data-name');
                    inputType = $(value).attr('data-type');
                    fieldsData.push({name: inputName, type: inputType});
                });
                $('#registration_fields').val(JSON.stringify(fieldsData));

            });


            //==========Hiding sections on Theme layout option changed ==========//
            $(document).on('change', '#theme_layout', function () {
                var theme_layout = "{{config('theme_layout')}}";
                if ($(this).val() != theme_layout) {
                    $('#sections').addClass('d-none');
                    $('#sections_note').removeClass('d-none')
                } else {
                    $('#sections').removeClass('d-none');
                    $('#sections_note').addClass('d-none')
                }
            });

                    @if(request()->has('tab'))
            var tab = "{{request('tab')}}";
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
            @endif

        });

        $(document).on('click', '.switch-input', function (e) {
//              e.preventDefault();
            var content = $(this).parents('.checkbox').siblings('.switch-content');
            if (content.hasClass('d-none')) {
                $(this).attr('checked', 'checked');
                content.find('input').attr('required', true);
                content.removeClass('d-none');
            } else {
                content.addClass('d-none');
                content.find('input').attr('required', false);
            }
        })


        //On Default language change update Display type RTL/LTR
        $(document).on('change', '#app_locale', function () {
            var display_type = $(this).find(":selected").data('display-type');
            $('#app_display_type').val(display_type)
        });


        //On click add input list
        $(document).on('click', '.input-list input[type="checkbox"]', function () {

            var html;
            var type = $(this).data('type');
            var name = $(this).data('name');
            var textInputs = ['text', 'date', 'number'];
            if ($(this).is(':checked')) {
                appendElement(type, name)
            } else {
                if ((textInputs.includes(type)) || (type == 'textarea')) {
                    $('.input-boxes').find('[data-name="' + name + '"]').parents('.form-group').remove();
                } else if (type == 'radio') {
                    $('.input-boxes').find('.radiogroup').remove();
                }
            }
        });

        function appendElement(type, name) {
            var values = "{{json_encode(Lang::get('labels.backend.general_settings.user_registration_settings.fields'))}}";
            values = JSON.parse(values.replace(/&quot;/g, '"'));
            var textInputs = ['text', 'date', 'number'];
            var html;
            if (textInputs.includes(type)) {
                html = "<div class='form-group'>" +
                    "<input type='" + type + "' readonly data-name='" + name + "' placeholder='" + values[name] + "' class='form-control'>" +
                    "</div>";
            } else if (type == 'radio') {
                html = "<div class='form-group radiogroup'>" +
                    "<label class='radio-inline mr-3'><input type='radio' data-name='optradio'> Male</label>" +
                    "<label class='radio-inline mr-3'><input type='radio' data-name='optradio'> Female</label>" +
                    "<label class='radio-inline mr-3'><input type='radio' data-name='optradio'> Other</label>" +
                    "</div>";
            } else if (type == 'textarea') {
                html = "<div class='form-group'>" +
                    "<textarea  readonly data-name='" + name + "' placeholder='" + values[name] + "' class='form-control'></textarea>" +
                    "</div>";
            }
            $('.input-boxes').append(html)
        }


    </script>
@endpush


