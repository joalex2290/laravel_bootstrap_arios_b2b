@extends('layouts.app')

@section('title')
{{ trans('office.crud_name') }} - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/shop') }}">Inicio</a></li>
  <li><a href="#">{{ trans('office.crud_name') }}</a></li>
</ol>
<h4>{{ trans('office.crud_name') }}  
  @if(Auth::user()->hasRole('administrador'))     
  <div class="btn-group pull-right">
    <a href="{{ url('/customer/offices/create') }}" class="btn btn-success" title="Crear">
      <i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Crear</span>
    </a>
    <a href="{{ url('customer/add-catalogs-to-office') }}/" class="btn btn-primary" title="Agregar"><i class="fa fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Catalogos<span></span></a>
    <a href="{{ url('/customer/add-users-to-office') }}/" class="btn btn-info" title="Agregar"><i class="fa fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Empleados<span></span></a>
  </div>
  @endif
</h4>
<br>
<table id="office-datatable" class="table table-borderless table-hover">
  <thead>
    <tr class="active text-center">
      <th>ID</th>
      <th>{{ trans('office.code') }}</th>
      <th>{{ trans('office.name') }}</th>
      <th>{{ trans('office.type') }}</th>
      <th>{{ trans('office.active') }}</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if(Auth::user()->hasRole('administrador')) 
    @foreach($offices as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->code }}</td>
      <td><a href="javascript:view({{$item->id}});">{{ $item->name }}</a></td>
      <td>{{ $office_types[$item->type] }}</td>
      <td class="text-center">
        @if($item->active)
        <i class="fa fa-check-circle fa-lg text-success"></i>
        @else
        <i class="fa fa-ban fa-lg text-danger"></i>
        @endif
      </td>
      <td>
        <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->id}})"><i class="fa fa-eye" aria-hidden="true"></i> <span class="hidden-xs">Ver</span></button>
        <a href="{{url('customer/offices/'.$item->id.'/edit')}}" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Editar<span></span></a>
      </td>
    </tr>
    @endforeach
    @elseif(Auth::user()->hasRole('supervisor'))
    @foreach(Auth::user()->offices()->get() as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->code }}</td>
      <td><a href="javascript:view({{$item->id}});">{{ $item->name }}</a></td>
      <td>{{ $office_types[$item->type] }}</td>
      <td class="text-center">
        @if($item->active)
        <i class="fa fa-check-circle fa-lg text-success"></i>
        @else
        <i class="fa fa-ban fa-lg text-danger"></i>
        @endif
      </td>
      <td>
        <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->id}})"><i class="fa fa-eye" aria-hidden="true"></i> <span class="hidden-xs">Ver</span></button>
        <a href="{{ url('/customer/offices/'.$item->id.'/edit') }}/" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Editar<span></span></a>
      </td>
    </tr>
    @endforeach
    @else
    No esta autorizado para ver este modulo
    @endif

  </tbody>
</table>
<!-- View Modal -->
<div id="view-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-building"></i> Información de la oficina</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<!-- Scripst -->
<script type="text/javascript">
  $(function() {
    $("#office-datatable").DataTable({
      columnDefs: [
      { orderable: false, targets: -1 }
      ]
    });
  });
</script>
<script type="text/javascript">
  function view(id) {
    $.ajax({
      url: "{{ url('/customer/offices/') }}/"+id,
      method: "GET",
      success: function(data) {
        $('#view-modal').find('.modal-body').html("");
        $('#view-modal').find('.modal-body').html(data.html);
        $('#view-modal').modal('toggle');
      }
    });
  };
</script>
@endsection