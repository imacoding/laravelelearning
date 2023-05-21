@extends('backend.layouts.app')
@section('title', __('labels.backend.general_settings.contact.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
    <style>
        .color-list li {
            float: left;
            width: 8%;
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
    </style>
@endpush

@section('content')
<div>
    <form method="POST" action="{{ route('admin.general-settings') }}" id="general-settings-form" class="form-horizontal" enctype="multipart/form-data">
    @csrf



<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-5">
                <h3 class="page-title d-inline">@lang('labels.backend.general_settings.contact.title')</h3>
            </div>
        </div>
    </div>

    <div class="card-body" id="contact">

        <input type="hidden" name="contact_data" id="contact_data">

        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="short_text">@lang('labels.backend.general_settings.contact.short_text')</label>

            <div class="col-md-8">
                <input id="short_text" class="form-control" type="text" placeholder="@lang('labels.backend.general_settings.contact.short_text')" value="{{ config('contact.short_text') }}" name="short_text">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="primary_address">@lang('labels.backend.general_settings.contact.primary_address')</label>

            <div class="col-md-8">
                <input id="primary_address" class="form-control" type="text" placeholder="@lang('labels.backend.general_settings.contact.primary_address')" value="{{ config('contact.primary_address') }}" name="primary_address">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="secondary_address">@lang('labels.backend.general_settings.contact.secondary_address')</label>

            <div class="col-md-8">
                <input id="secondary_address" class="form-control" type="text" placeholder="@lang('labels.backend.general_settings.contact.secondary_address')" value="{{ config('contact.secondary_address') }}" name="secondary_address">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="primary_phone">@lang('labels.backend.general_settings.contact.primary_phone')</label>

            <div class="col-md-8">
                <input id="primary_phone" class="form-control" type="text" placeholder="@lang('labels.backend.general_settings.contact.primary_phone')" value="{{ config('contact.primary_phone') }}" name="primary_phone">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="secondary_phone">@lang('labels.backend.general_settings.contact.secondary_phone')</label>

            <div class="col-md-8">
                <input id="secondary_phone" class="form-control" type="text" placeholder="@lang('labels.backend.general_settings.contact.secondary_phone')" value="{{ config('contact.secondary_phone') }}" name="secondary_phone">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="primary_email">@lang('labels.backend.general_settings.contact.primary_email')</label>

            <div class="col-md-8">
                <input id="primary_email" class="form-control" type="email" placeholder="@lang('labels.backend.general_settings.contact.primary_email')" value="{{ config('contact.primary_email') }}" name="primary_email">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="secondary_email">@lang('labels.backend.general_settings.contact.secondary_email')</label>

            <div class="col-md-8">
                <input id="secondary_email" class="form-control" type="email" placeholder="@lang('labels.backend.general_settings.contact.secondary_email')" value="{{ config('contact.secondary_email') }}" name="secondary_email">
            </div>
            <div class="col-md-2">
                <p style="line-height: 35px">
                    <span class="mr-2">{{__('labels.backend.general_settings.contact.show')}}</span>
                    <label class="switch switch-sm switch-3d switch-primary">
                        <input type="checkbox" class="switch-input" value="1" checked>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </p>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">@lang('buttons.general.save')</button>
            </div>
        </div>
    </div>
</div>

</form>
@endsection


@push('after-scripts')
    <script>
        //=========Preset contact data ==========//
       @if(config('contact_data'))
        var contact_data = "{{config('contact_data')}}";
        contact_data = JSON.parse(contact_data.replace(/&quot;/g, '"'));

        $(contact_data).each(function (key, element) {
            if (element.name == 'location_on_map') {
                $('#' + element.name).html(element.value);

            } else {
                $('#' + element.name).val(element.value)
            }

            if (element.status == 1) {
                $('#' + element.name).parents('.form-group').find('input[type="checkbox"]').attr('checked', true);
            } else {
                $('#' + element.name).parents('.form-group').find('input[type="checkbox"]').attr('checked', false);
            }
        });
        @endif


        $(document).on('submit', '#general-settings-form', function (e) {
            //                e.preventDefault();
            //============Saving Contact Details=====//
            var dataJson = {};
            var inputs = $('#contact').find('input[type="text"],textarea,input[type="email"]');
            var data = [];
            var val, name, status
            $(inputs).each(function (key, value) {
                name = $(value).attr('id')
                if (name == 'location_on_map') {
                    val = $(value).val().replace(/"/g, "'")
                } else {
                    val = $(value).val()
                }
                status = ($(value).parents('.form-group').find('input[type="checkbox"]:checked').val()) ? 1 : 0;
                data.push({name: name, value: val, status: status});
            });
            dataJson = JSON.stringify(data);
            $('#contact_data').val(dataJson);
        });
    </script>
@endpush