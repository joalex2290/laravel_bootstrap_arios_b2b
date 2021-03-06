@extends('layouts.app')

@section('title')
Agregar Usuarios a oficina - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="">Inicio</a></li>
  <li><a href="#">Usuarios a oficina</a></li>
</ol>
<h4>Agregar usuarios a oficina
  <div class="btn-group pull-right">
    <a href="{{ url('customer/offices/') }}" class="btn btn-danger" title="Regresar">
      <i class="glyphicon glyphicon-remove"></i>
    </a>
  </div>
</h4>
<br>
@if($offices->count() == 0)
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-exclamation-sign"></i> Aún no hay oficinas creadas, <a href="{{url('/customer/offices')}}">agregue oficinas a su organización</a>
</div>
@elseif($users->count() == 1)
<div class="alert alert-warning">
  <i class="glyphicon glyphicon-exclamation-sign"></i> Aún no hay empleados creados, <a href="{{url('/customer/users')}}">agregue empleados a su organización</a>
</div>
@else
{!! Form::open(['method' => 'POST', 'url' => ['/customer/add-users-to-office'], 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('office_id') ? ' has-error' : ''}}">
  {!! Form::label('office_id', 'Oficina: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="office_id" onchange="getusers()">
      @foreach($offices as $office)
      <option value="{{ $office->id }}">{{ $office->name }}</option>
      @endforeach()
    </select>
    {!! $errors->first('office_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('user_id') ? ' has-error' : ''}}">
  {!! Form::label('user_id', 'Usuario: ', ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-6">
    <select class="form-control" name="user_id">
      @foreach($users as $profile)
      @unless(Auth::user()->id == $profile->user->id )
      <option value="{{ $profile->user->id }}">{{ $profile->user->name }}</option>
      @endunless
      @endforeach()
    </select>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-offset-3 col-md-3">
    {!! Form::submit('Agregar', ['class' => 'btn btn-success']) !!}
  </div>
</div>
{!! Form::close() !!}
<div class="users">
</div>
@endif

@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  function getusers() {
    var office_id = $('select[name="office_id"]').val();
    $('.users').html('<img class="loader" src="{{asset("img/loading.gif")}}">');
    $.ajax({
      url: "{{ route('customer.office-users') }}",
      method: "GET",
      data: {office_id : office_id}, 
      success: function(data) {
        $('.users').html('');
        $('.users').html(data.html);
      }
    });
  }
  $(document).ready(getusers());
</script>
@endsection