<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', trans('catalog.code'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('catalog.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    {!! Form::label('organization_id', trans('catalog.organization_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('organization_id', $organizations, isset($catalog_organization) ? $catalog_organization : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('valid_from') ? 'has-error' : ''}}">
    {!! Form::label('valid_from', trans('catalog.valid_from'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('valid_from', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('valid_from', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('valid_to') ? 'has-error' : ''}}">
    {!! Form::label('valid_to', trans('catalog.valid_to'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('valid_to', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('valid_to', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    {!! Form::label('value', trans('catalog.value'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
