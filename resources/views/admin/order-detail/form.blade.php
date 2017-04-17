<div class="form-group {{ $errors->has('line') ? 'has-error' : ''}}">
    {!! Form::label('line', trans('orderdetail.line'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('line', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('line', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', trans('orderdetail.order_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('order_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    {!! Form::label('product_id', trans('orderdetail.product_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('product_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_code') ? 'has-error' : ''}}">
    {!! Form::label('product_code', trans('orderdetail.product_code'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    {!! Form::label('product_name', trans('orderdetail.product_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    {!! Form::label('quantity', trans('orderdetail.quantity'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('approved_quantity') ? 'has-error' : ''}}">
    {!! Form::label('approved_quantity', trans('orderdetail.approved_quantity'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('approved_quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('approved_quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('open_quantity') ? 'has-error' : ''}}">
    {!! Form::label('open_quantity', trans('orderdetail.open_quantity'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('open_quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('open_quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', trans('orderdetail.price'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tax_prct') ? 'has-error' : ''}}">
    {!! Form::label('tax_prct', trans('orderdetail.tax_prct'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('tax_prct', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tax_prct', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    {!! Form::label('tax', trans('orderdetail.tax'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('tax', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price_tax') ? 'has-error' : ''}}">
    {!! Form::label('price_tax', trans('orderdetail.price_tax'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price_tax', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('price_tax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', trans('orderdetail.status'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('status', null, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
