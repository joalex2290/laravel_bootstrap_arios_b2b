@extends('layouts.app')

@section('title')
Agregar productos a catalogo - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
<!-- MultiSelect CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="">Inicio</a></li>
  <li><a href="#">Productos a catalogo</a></li>
</ol>
<h4>Agregar productos a catalogo</h4>
<br>
{!! Form::open(['method' => 'POST', 'url' => ['/admin/add-catalog-products'], 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('catalog') ? ' has-error' : ''}}">
  {!! Form::label('catalog', 'Catalogo: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="catalog" onchange="getProducts()">
      @foreach($catalogs as $catalog)
      <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
      @endforeach()
    </select>
    {!! $errors->first('catalog', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('product') ? ' has-error' : ''}}">
  {!! Form::label('product', 'Producto: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="product" onchange="getProducts()">
      @foreach($products as $product)
      <option value="{{ $product->id }}">{{ $product->name }}</option>
      @endforeach()
    </select>
    {!! $errors->first('product', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('code', 'Codigo en el catalogo', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('name', 'Nombre en el catalogo', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
  {!! Form::label('price', 'Precio', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-offset-3 col-md-3">
    {!! Form::submit('Agregar', ['class' => 'btn btn-success']) !!}
  </div>
</div>
{!! Form::close() !!}
<div class="products">
</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  function getProducts() {
    var catalog_id = $('select[name="catalog"]').val();
    $('.products').html('<img class="loader" src="/img/loading.gif">');
    $.ajax({
      url: "{{ url('/admin/catalog-products/') }}",
      method: "GET",
      data: {catalog_id : catalog_id}, 
      success: function(data) {
        $('.products').html('');
        $('.products').html(data.html);
      }
    });
  }
  $(document).ready(getProducts());
</script>
@endsection