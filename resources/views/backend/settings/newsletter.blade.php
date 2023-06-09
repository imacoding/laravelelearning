@extends('backend.layouts.app')
@section('title', __('labels.backend.general_settings.newsletter.title').' | '.app_name())

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
    <form method="POST" action="{{ route('admin.general-settings') }}" id="general-settings-form" class="form-horizontal" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-5">
                        <h3 class="page-title d-inline">@lang('labels.backend.general_settings.newsletter.title')</h3>
                    </div>
                </div>
            </div>

            <div class="card-body" id="newsletter">
                <h5>@lang('labels.backend.general_settings.mail_configuration_note',['link'=>'<a target="_blank" href="'.route('admin.general-settings',['tab'=>'email']).'">'])</h5>
                <div class="form-group row">
                    <label for="short_description" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.mail_provider')</label>
                    <div class="col-md-10">
                        <p class="d-inline" style="line-height: 35px">
                            <label>
                                <input type="radio" name="mail_provider" value="mailchimp" class="switch-input status" checked>
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <span class="ml-2">@lang('labels.backend.general_settings.newsletter.mailchimp')</span>
                        </p>

                        <p class="d-inline ml-4" style="line-height: 35px">
                            <label>
                                <input type="radio" name="mail_provider" value="sendgrid" class="switch-input status">
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <span class="ml-2">@lang('labels.backend.general_settings.newsletter.sendgrid')</span>
                        </p>
                        <p class="font-italic">{!! __('labels.backend.general_settings.newsletter.mail_provider_note') !!}</p>
                    </div>
                </div>
                <div class="mail-provider-wrapper mailchimp">
                    <div class="form-group row">
                        <label for="api_key" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.api_key')</label>
                        <div class="col-md-10">
                            <input type="text" name="newsletter__apiKey" id="api_key" class="form-control" value="{{ config('newsletter.apiKey') }}" placeholder="Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17">
                            <span class="help-text font-italic mb-0">{!! __('labels.backend.general_settings.newsletter.api_key_note') !!}</span>
                            <span class="float-right font-italic font-weight-bold">
                                <a target="_blank" href="https://mailchimp.com/help/about-api-keys/">{!! __('labels.backend.general_settings.newsletter.api_key_question') !!}</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newsletter.subscribers.id" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.list_id')</label>
                        <div class="col-md-10">
                            <input type="text" name="newsletter__lists__subscribers__id" id="list_id" class="form-control" value="{{ config('newsletter.lists.subscribers.id') }}" placeholder="Ex. d81dasdw17">
                            <span class="help-text font-italic mb-0">{!! __('labels.backend.general_settings.newsletter.list_id_note') !!}</span>
                            <span class="float-right font-italic font-weight-bold">
                                <a target="_blank" href="https://mailchimp.com/help/find-your-list-id/">{!! __('labels.backend.general_settings.newsletter.list_id_question') !!}</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.double_opt_in')</label>
                        <div class="col-md-10">
                            <p class="d-inline" style="line-height: 35px">
                                <label>
                                    <input type="checkbox" name="mailchimp_double_opt_in" class="switch-input status" value="0">
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                            </p>
                            <p class="font-italic">{!! __('labels.backend.general_settings.newsletter.double_opt_in_note') !!}</p>
                        </div>
                    </div>
                </div>
                <div class="mail-provider-wrapper sendgrid d-none">
                    <div class="form-group row">
                        <label for="api_key" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.api_key')</label>
                        <div class="col-md-8">
                            <input type="text" name="sendgrid_api_key" id="sendgrid_api_key" class="form-control" value="{{ config('sendgrid_api_key') }}" placeholder="Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17">
                            <p class="help-text sendgrid-error mb-0 text-danger"></p>
                            <span class="help-text font-italic mb-0">{!! __('labels.backend.general_settings.newsletter.api_key_note_sendgrid') !!}</span>
                            <span class="float-right font-italic font-weight-bold">
                                <a target="_blank" href="https://app.sendgrid.com/settings/api_keys">{!! __('labels.backend.general_settings.newsletter.api_key_question') !!}</a>
                            </span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="getLists" class="btn btn-primary">@lang('labels.backend.general_settings.newsletter.get_lists')</button>
                        </div>
                    </div>
                    <div class="form-group sendgrid-list-wrapper d-none row">
                        <label for="" class="col-md-2 form-control-label">@lang('labels.backend.general_settings.newsletter.sendgrid_lists')</label>
                        <div class="col-md-5">
                            <label>
                                <input type="radio" name="list_selection" value="1" class="switch-input status sendgrid-radio" checked>
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <span class="ml-2">@lang('labels.backend.general_settings.newsletter.select_list')</span>
                            <span class="float-right">
                                <a class="font-italic font-weight-bold" target="_blank" href="https://sendgrid.com/marketing_campaigns/ui/contacts">@lang('labels.backend.general_settings.newsletter.manage_lists')</a>
                            </span>

                            <select name="sendgrid_list" id="sendgrid_list" class="form-control sendgrid-element">
                                <option value="">@lang('labels.backend.general_settings.newsletter.select_list')</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>
                                <input type="radio" name="list_selection" value="2" class="switch-input status sendgrid-radio">
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <span class="ml-2">@lang('labels.backend.general_settings.newsletter.create_new')</span>

                            <input type="text" name="list_name" id="list_name" class="form-control sendgrid-element d-none" placeholder="Ex. LMS List">
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
          
                <button type="submit" id="submit" class="btn btn-primary">{{ __('buttons.general.crud.update') }}</button>
           
        </div><!--col-->
    </div><!--row-->
</div><!--card-footer-->

        </div>
    </form>
@endsection



@push('after-scripts')
    <script>
        $(document).ready(function () {
            @if(config('mail_provider') != "")
            var provider = "{{config('mail_provider')}}";
            $('input[type="radio"][value="' + provider + '"]').attr('checked', true);
            @endif

            @if(config('mail_provider') == "sendgrid")
            $('.mailchimp').addClass('d-none')
            $('.sendgrid').removeClass('d-none')
            if ($('#sendgrid_api_key').val() != "") {
                getSendGridList();
            }

            @endif


            @if(config('mailchimp_double_opt_in') != "")
            var opt_in = ("{{config('mailchimp_double_opt_in') }}" == 1)
            $('#mailchimp_double_opt_in').attr('checked', opt_in).val(1);
            @endif

            $(document).on('change', '#mail_provider', function () {
                if ($(this).is(':checked') == true) {
                    if ($(this).val() == 'mailchimp') {
                        $('.mailchimp').removeClass('d-none')
                        $('.sendgrid').addClass('d-none')
                    } else {
                        $('.mailchimp').addClass('d-none')
                        $('.sendgrid').removeClass('d-none')
                        getSendGridList()
                    }
                }
            })

            $(document).on('click', '#getLists', function () {
                if ($('#sendgrid_api_key').val() == "") {
                    $('.sendgrid-error').text('Please input API key');
                } else {
                    getSendGridList();
                }
            })

            $(document).on('click', '.sendgrid-radio', function () {
                $('.sendgrid-element').addClass('d-none')
                if ($(this).is(':checked')) {
                    if($(this).val() == 2){
                        $(this).parents('.switch').siblings('.sendgrid-element').removeClass('d-none').attr('required',true);
                    }else{
                        $(this).parents('.switch').siblings('.sendgrid-element').removeClass('d-none')
                    }

                }
            })
        });

        function getSendGridList() {
            var apiKey = $('#sendgrid_api_key').val();
            $('.sendgrid-error').empty();
            $.ajax({
                url: '{{route('admin.newsletter.getSendGridLists')}}',
                type: 'POST',
                dataType: 'JSON',
                data: {'apiKey': apiKey, _token: '{{csrf_token()}}'},
                success: function (response) {
                    if(response.status == 'success'){
                        $('#sendgrid_list').empty();
                        $(JSON.parse(response.body).lists).each(function (key, object) {
                            $('#sendgrid_list').append($("<option/>", {
                                value: object.id,
                                text: object.name
                            }));
                        });
                        @if(config('sendgrid_list') != "")
                                var value = "{{config('sendgrid_list')}}";

                        $('#sendgrid_list').find('option[value="'+value+'"]').attr('selected',true)
                        @endif
                        $('.sendgrid-list-wrapper').removeClass('d-none')
                    }else{
                        $('.sendgrid-list-wrapper').addClass('d-none');
                        $('.sendgrid-error').text(response.message);
                    }

                }
            })

        }


    </script>
@endpush