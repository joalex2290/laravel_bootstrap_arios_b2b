<div class="form-group {{ $errors->has('doc_num') ? 'has-error' : ''}}">
    {!! Form::label('doc_num', trans('order.doc_num'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('doc_num', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('doc_num', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', trans('order.user_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('user_id', $users, isset($order_user) ? $order_user : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_name') ? 'has-error' : ''}}">
    {!! Form::label('user_name', trans('order.user_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('user_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('office_id') ? 'has-error' : ''}}">
    {!! Form::label('office_id', trans('order.office_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('office_id', $offices, isset($order_office) ? $order_office : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('office_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('office_name') ? 'has-error' : ''}}">
    {!! Form::label('office_name', trans('order.office_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('office_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('office_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    {!! Form::label('organization_id', trans('order.organization_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('organization_id', $organizations, isset($order_organization) ? $order_organization : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organization_name') ? 'has-error' : ''}}">
    {!! Form::label('organization_name', trans('order.organization_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('organization_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('organization_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('catalog_id') ? 'has-error' : ''}}">
    {!! Form::label('catalog_id', trans('order.catalog_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('catalog_id', $catalogs, isset($order_catalog) ?  $order_catalog : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('catalog_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('catalog_name') ? 'has-error' : ''}}">
    {!! Form::label('catalog_name', trans('order.catalog_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('catalog_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('catalog_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', trans('order.status'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('status', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subtotal') ? 'has-error' : ''}}">
    {!! Form::label('subtotal', trans('order.subtotal'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('subtotal', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('subtotal', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    {!! Form::label('tax', trans('order.tax'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('tax', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    {!! Form::label('total', trans('order.total'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('total', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('total_delivered') ? 'has-error' : ''}}">
    {!! Form::label('total_delivered', trans('order.total_delivered'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('total_delivered', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('total_delivered', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    {!! Form::label('reference', trans('order.reference'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('reference', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    {!! Form::label('comment', trans('order.comment'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('order.address'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', trans('order.city_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('city_id', $cities, isset($order_city) ? $order_city : [], ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city_name') ? 'has-error' : ''}}">
    {!! Form::label('city_name', trans('order.city_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('city_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('city_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('department_name') ? 'has-error' : ''}}">
    {!! Form::label('department_name', trans('order.department_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('department_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('department_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('country_name') ? 'has-error' : ''}}">
    {!! Form::label('country_name', trans('order.country_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('country_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('country_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : ''}}">
    {!! Form::label('contact_name', trans('order.contact_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('contact_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_phone') ? 'has-error' : ''}}">
    {!! Form::label('contact_phone', trans('order.contact_phone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('contact_phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_cellphone') ? 'has-error' : ''}}">
    {!! Form::label('contact_cellphone', trans('order.contact_cellphone'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('contact_cellphone', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('contact_cellphone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('contact_email') ? 'has-error' : ''}}">
    {!! Form::label('contact_email', trans('order.contact_email'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('contact_email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('contact_email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">
    {!! Form::label('seller_id', trans('order.seller_id'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('seller_id', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('seller_name') ? 'has-error' : ''}}">
    {!! Form::label('seller_name', trans('order.seller_name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('seller_name', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('seller_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('reviewed_at') ? 'has-error' : ''}}">
    {!! Form::label('reviewed_at', trans('order.reviewed_at'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('reviewed_at', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('reviewed_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('received_at') ? 'has-error' : ''}}">
    {!! Form::label('received_at', trans('order.received_at'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('received_at', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('received_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('dispatched_at') ? 'has-error' : ''}}">
    {!! Form::label('dispatched_at', trans('order.dispatched_at'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('dispatched_at', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('dispatched_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('delivered_at') ? 'has-error' : ''}}">
    {!! Form::label('delivered_at', trans('order.delivered_at'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('delivered_at', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
        {!! $errors->first('delivered_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>
