{{ Form::model($logged_in_user, ['route' => ['admin.profile.update'], 'method' => 'PATCH', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label(__('validation.attributes.frontend.avatar'), 'avatar') }}

            <div>
                <input type="radio" name="avatar_type"
                       value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> {{__('validation.attributes.frontend.gravatar')}}
                &nbsp;&nbsp;
                <input type="radio" name="avatar_type"
                       value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> {{__('validation.attributes.frontend.upload')}}

                @foreach($logged_in_user->providers as $provider)
                    @if(strlen($provider->avatar))
                        <input type="radio" name="avatar_type"
                               value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                    @endif
                @endforeach
            </div>
        </div><!--form-group-->

        <div class="form-group hidden" id="avatar_location">
            {{ Form::file('avatar_location', ['class' => 'form-control']) }}
        </div><!--form-group-->

    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label(__('validation.attributes.frontend.first_name'), 'first_name') }}

            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.first_name'), 'maxlength' => 191, 'required', 'autofocus']) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label(__('validation.attributes.frontend.last_name'), 'last_name') }}

            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.last_name'), 'maxlength' => 191, 'required']) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

@if ($logged_in_user->canChangeEmail())
    <div class="row">
        <div class="col">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
            </div>

            <div class="form-group">
                {{ Form::label(__('validation.attributes.frontend.email'), 'email') }}

                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.email'), 'maxlength' => 191, 'required']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
@endif

@if(config('registration_fields') != NULL)
    @php
        $fields = json_decode(config('registration_fields'));
        $inputs = ['text','number','date'];
    @endphp

    @foreach($fields as $item)
        <div class="row">
            <div class="col">
                <div class="form-group">
                    @if(in_array($item->type,$inputs))
                        {{ Form::label(__('labels.backend.general_settings.user_registration_settings.fields.'.$item->name), $item->name) }}

                        {{ Form::input($item->type, $item->name, $logged_in_user[$item->name], ['class' => 'form-control mb-0', 'placeholder' => __('labels.backend.general_settings.user_registration_settings.fields.'.$item->name)]) }}
                    @elseif($item->type == 'gender')
                        <label class="radio-inline mr-3 mb-0">
                            {{ Form::radio($item->name, 'male', $logged_in_user[$item->name] == 'male', ['id' => $item->name.'_male']) }}
                            {{ __('validation.attributes.frontend.male') }}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            {{ Form::radio($item->name, 'female', $logged_in_user[$item->name] == 'female', ['id' => $item->name.'_female']) }}
                            {{ __('validation.attributes.frontend.female') }}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            {{ Form::radio($item->name, 'other', $logged_in_user[$item->name] == 'other', ['id' => $item->name.'_other']) }}
                            {{ __('validation.attributes.frontend.other') }}
                        </label>
                    @elseif($item->type == 'textarea')
                        {{ Form::textarea($item->name, $logged_in_user[$item->name], ['class' => 'form-control mb-0', 'placeholder' => __('labels.backend.general_settings.user_registration_settings.fields.'.$item->name)]) }}
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endif

<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
            {{ Form::submit(__('labels.general.buttons.update'), ['class' => 'btn btn-primary']) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
{{ Form::close() }}

@push('after-scripts')
    <script>
        $(function () {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function () {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
    </script>
@endpush
