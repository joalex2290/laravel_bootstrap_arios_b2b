@extends('layouts.app')

@section('title')
Agregar usuarios a oficina - ARB2B
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
  <li><a href="#">Usuarios a oficina</a></li>
</ol>
<h4>Agregar usuarios a oficina
</h4>
<br>
{!! Form::open(['method' => 'POST', 'url' => ['/admin/add-office-users'], 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('office') ? ' has-error' : ''}}">
  {!! Form::label('office', 'Oficina: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="office" onchange="getUsers()">
      @foreach($offices as $office)
      <option value="{{ $office->id }}">{{ $office->name }}</option>
      @endforeach()
    </select>
    {!! $errors->first('office', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
  {!! Form::label('label', 'Usuarios: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="users col-md-6">
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
  function getUsers() {
    var office_id = $('select[name="office"]').val();
    $('.users').html('<img class="loader" src="/img/loading.gif">');
    $.ajax({
      url: "{{ url('/admin/office-users/') }}",
      method: "GET",
      data: {office_id : office_id}, 
      success: function(data) {
        $('.users').html('');
        $('.users').html(data.html);
      }
    });
  }
  $(document).ready(getUsers());
</script>
@endsection