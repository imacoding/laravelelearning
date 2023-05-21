{{ Form::model(null, ['method' => 'PATCH', 'route' => ['admin.account.post'], 'class' => 'form-horizontal']) }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ Form::label('old_password', __('validation.attributes.frontend.old_password')) }}

                {{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.old_password'), 'autofocus', 'required']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ Form::label('password', __('validation.attributes.frontend.password')) }}

                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.password'), 'required']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ Form::label('password_confirmation', __('validation.attributes.frontend.password_confirmation')) }}

                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('validation.attributes.frontend.password_confirmation'), 'required']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ Form::submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password'), ['class' => 'btn btn-primary']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ Form::close() }}
