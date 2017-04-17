<div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', trans('orderlog.order_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('order_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    {!! Form::label('comment', trans('orderlog.comment'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('comment', null, ['class' => 'form-control']) !!}
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attachment_type') ? 'has-error' : ''}}">
    {!! Form::label('attachment_type', trans('orderlog.attachment_type'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('attachment_type', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('attachment_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">
    {!! Form::label('attachment', trans('orderlog.attachment'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('attachment', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
    {!! Form::label('from', trans('orderlog.from'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('from', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
    {!! Form::label('to', trans('orderlog.to'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('to', null, ['class' => 'form-control']) !!}
        {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
