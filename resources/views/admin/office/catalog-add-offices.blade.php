@extends('layouts.app')

@section('title')
Agregar oficinas al catalogo - ARB2B
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
  <li><a href="#">Oficinas al catalogo</a></li>
</ol>
<h4>Agregar oficinas al catalogo
</h4>
<br>
{!! Form::open(['method' => 'POST', 'url' => ['/admin/add-catalog-offices'], 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('catalog') ? ' has-error' : ''}}">
    {!! Form::label('catalog', 'Catalogo: ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="catalog" onchange="getOffices()">
            @foreach($catalogs as $catalog)
            <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
            @endforeach()
        </select>
        {!! $errors->first('catalog', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
    {!! Form::label('label', 'Oficinas: ', ['class' => 'col-md-3 control-label']) !!}
    <div class="offices col-md-6">
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-3 col-md-4">
        {!! Form::submit('Agregar', ['class' => 'btn btn-success']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('scripts')
<!-- MultiSelect JS -->
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript">
  function getOffices() {
    var catalog_id = $('select[name="catalog"]').val();
    $('.offices').html('<img class="loader" src="/img/loading.gif">');
    $.ajax({
      url: "{{ url('/admin/catalog-offices/') }}",
      method: "GET",
      data: {catalog_id : catalog_id}, 
      success: function(data) {
        $('.offices').html('');
        $('.offices').html(data.html);
      }
    });
  }
  $(document).ready(getOffices());
</script>
@endsection