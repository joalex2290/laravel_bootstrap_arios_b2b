@extends('layouts.app')

@section('title')
Agregar permisos a roles - ARB2B
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
  <li><a href="#">Permisos a rol</a></li>
</ol>
<h4>
  Agregar permisos a roles
</h4>
<br>
{!! Form::open(['method' => 'POST', 'url' => ['/admin/add-role-permissions'], 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
  {!! Form::label('name', 'Role: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="role" onchange="getPermissions()">
      @foreach($roles as $role)
      <option value="{{ $role->id }}">{{ $role->name }}</option>
      @endforeach()
    </select>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
  {!! Form::label('label', 'Permisos: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="permissions col-md-6">
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
  function getPermissions() {
    var role_id = $('select[name="role"]').val();
    $('.permissions').html('<img class="loader" src="/img/loading.gif">');
    $.ajax({
      url: "{{ url('/admin/role-permissions/') }}",
      method: "GET",
      data: {role_id : role_id}, 
      success: function(data) {
        $('.permissions').html('');
        $('.permissions').html(data.html);
      }
    });
  }
  $(document).ready(getPermissions());
</script>
@endsection