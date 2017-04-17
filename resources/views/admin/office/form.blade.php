<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', trans('office.code'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('office.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', trans('office.type'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['Oficina', 'Sucursal', 'Departamento', 'Seccion', 'Centro de costo', 'Regional', 'Bodega'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    {!! Form::label('organization_id', trans('office.organization_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('organization_id', $organizations, isset($office_organization) ? $office_organization : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', trans('office.phone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('office.address'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', trans('office.city_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('city_id', $cities, isset($office_city) ? $office_city : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('postal_code') ? 'has-error' : ''}}">
    {!! Form::label('postal_code', trans('office.postal_code'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : ''}}">
    {!! Form::label('contact_name', trans('office.contact_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('contact_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_phone') ? 'has-error' : ''}}">
    {!! Form::label('contact_phone', trans('office.contact_phone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('contact_phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_cellphone') ? 'has-error' : ''}}">
    {!! Form::label('contact_cellphone', trans('office.contact_cellphone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('contact_cellphone', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('contact_cellphone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_email') ? 'has-error' : ''}}">
    {!! Form::label('contact_email', trans('office.contact_email'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('contact_email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('credit_limit') ? 'has-error' : ''}}">
    {!! Form::label('credit_limit', trans('office.credit_limit'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('credit_limit', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('credit_limit', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('avatar_url') ? 'has-error' : ''}}">
    {!! Form::label('avatar_url', trans('office.avatar_url'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('avatar_url', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('avatar_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    {!! Form::label('active', trans('office.active'), ['class' => 'col-md-4 control-label']) !!}
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
