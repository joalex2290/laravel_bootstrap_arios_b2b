<div class="form-group {{ $errors->has('tax_id') ? 'has-error' : ''}}">
    {!! Form::label('tax_id', trans('organization.tax_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('tax_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tax_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('organization.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('comercial_name') ? 'has-error' : ''}}">
    {!! Form::label('comercial_name', trans('organization.comercial_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('comercial_name', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('comercial_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', trans('organization.description'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', trans('organization.phone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('phone', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('organization.address'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', trans('organization.city_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('city_id', $cities, isset($organization_city) ? $organization_city : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    {!! Form::label('website', trans('organization.website'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('facebook') ? 'has-error' : ''}}">
    {!! Form::label('facebook', trans('organization.facebook'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('avatar_url') ? 'has-error' : ''}}">
    {!! Form::label('avatar_url', trans('organization.avatar_url'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('avatar_url', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('avatar_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    {!! Form::label('active', trans('organization.active'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('active', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
