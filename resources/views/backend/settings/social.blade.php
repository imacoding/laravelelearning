@extends('backend.layouts.app')
@section('title', __('labels.backend.social_settings.management').' | '.app_name())

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.social_settings.management') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr/>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="services.facebook.active">{{ __('validation.attributes.backend.settings.social_settings.facebook.label') }}</label>
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label class="switch switch-sm switch-3d switch-primary">
                                <input type="checkbox" name="services__facebook__active" value="1" class="switch-input" {{ config('services.facebook.active') ? 'checked' : '' }}>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <a class="float-right font-weight-bold font-italic" target="_blank" href="https://developers.facebook.com/apps/">{{ __('labels.backend.social_settings.fb_api_note')}}</a>
                        </div>
                        <small><i>{{ __('labels.backend.social_settings.fb_note') }}</i></small>
                        <div class="switch-content @if(!config('services.facebook.active')) d-none @endif">
                            <br>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="services.facebook.client_id">{{ __('validation.attributes.backend.settings.social_settings.facebook.client_id') }}</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" name="services__facebook__client_id" class="form-control" value="{{ config('services.facebook.client_id') }}">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="services.facebook.client_secret">{{ __('validation.attributes.backend.settings.social_settings.facebook.client_secret') }}</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" name="services__facebook__client_secret" class="form-control" value="{{ config('services.facebook.client_secret') }}">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="services.facebook.redirect">{{ __('validation.attributes.backend.settings.social_settings.facebook.redirect') }}</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" name="services__facebook__redirect" class="form-control" disabled value="{{ config('services.facebook.redirect') }}">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div>
                    </div><!--col-->
                </div><!--form-group-->

                <!-- Repeat the above code block for other social services (Google, Twitter, LinkedIn) -->

            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer clearfix">
        <div class="row">
            <div class="col">
               
                <a href="route('admin.social-settings')">cancel</a>
            </div><!--col-->

            <div class="col text-right">
               
                <button type="submit" >update </button>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection



@push('after-scripts')
    <script>
        $(document).ready(function () {
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
        });
    </script>
@endpush
