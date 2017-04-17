<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', trans('product.code'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('product.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', trans('product.type'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['Articulo', 'Servicio'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category_id', trans('product.category'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('category_id', $categories, isset($product_category) ? $product_category : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    {!! Form::label('reference', trans('product.reference'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('reference', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('barcode') ? 'has-error' : ''}}">
    {!! Form::label('barcode', trans('product.barcode'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('barcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
    {!! Form::label('brand', trans('product.brand'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('brand', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    {!! Form::label('tax', trans('product.tax'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('tax', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('package_qty') ? 'has-error' : ''}}">
    {!! Form::label('package_qty', trans('product.package_qty'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('package_qty', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('package_qty', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('unit_meassure') ? 'has-error' : ''}}">
    {!! Form::label('unit_meassure', trans('product.unit_meassure'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('unit_meassure', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('unit_meassure', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    {!! Form::label('comment', trans('product.comment'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(isset($product))
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <img src="{{asset('img/products//'.$product->img_url)}}" width="300" class="img-thumbnail">
    </div>
</div>
@endif
<div class="form-group {{ $errors->has('img_url') ? 'has-error' : ''}}">
    {!! Form::label('img_url', trans('product.img_url'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6"> 
        <div class="input-group image-preview">
            {!! Form::text('', null, ['class' => 'form-control image-preview-filename', 'disabled' => 'disabled', 'placeholder' => 'Opcional']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <div class="btn btn-success image-preview-input">
                    <span class="glyphicon glyphicon-folder-open"></span>
                    <input type="file" accept="image/png, image/jpeg, image/gif" name="img_url"/>
                    {!! $errors->first('img_url', '<p class="help-block">:message</p>') !!}
                </div>
            </span>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
