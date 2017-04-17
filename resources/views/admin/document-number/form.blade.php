<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    {!! Form::label('organization_id', trans('documentnumber.organization_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('organization_id', $organizations, isset($doc_organization)? $doc_organization: [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('current_number') ? 'has-error' : ''}}">
    {!! Form::label('current_number', trans('documentnumber.current_number'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('current_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('current_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('next_number') ? 'has-error' : ''}}">
    {!! Form::label('next_number', trans('documentnumber.next_number'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('next_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('next_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
