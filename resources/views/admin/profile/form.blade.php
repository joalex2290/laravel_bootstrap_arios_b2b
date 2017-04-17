<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', trans('profile.user_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('user_id', $users, isset($profile_user) ? $profile_user : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    {!! Form::label('organization_id', trans('profile.organization_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('organization_id', $organizations, isset($profile_organization) ? $profile_organization : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('personal_id') ? 'has-error' : ''}}">
    {!! Form::label('personal_id', trans('profile.personal_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('personal_id', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('personal_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', trans('profile.phone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('phone', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cellphone') ? 'has-error' : ''}}">
    {!! Form::label('cellphone', trans('profile.cellphone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('cellphone', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('cellphone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('personal_email') ? 'has-error' : ''}}">
    {!! Form::label('personal_email', trans('profile.personal_email'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('personal_email', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('personal_email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('born_date') ? 'has-error' : ''}}">
    {!! Form::label('born_date', trans('profile.born_date'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('born_date', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('born_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('profile.address'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', trans('profile.city_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('city_id', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('img_url') ? 'has-error' : ''}}">
    {!! Form::label('img_url', trans('profile.img_url'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('img_url', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('img_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
