@extends('layouts.app')

@section('title')
{{ trans('catalog.crud_name') }} - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
<!-- MultiSelect CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/') }}">Inicio</a></li>
  <li><a href="{{ url('/shop') }}">Tienda</a></li>
  <li><a href="#">{{ trans('catalog.crud_name') }}</a></li>
</ol>
<h4>
  {{ trans('catalog.crud_name') }}
</h4>
<br>
<table id="catalog-datatable" class="table table-borderless table-hover">
  <thead>
    <tr class="active text-center">
      <th>ID</th><th>{{ trans('catalog.code') }}</th><th>{{ trans('catalog.name') }}</th><th>Acciones:</th>
    </tr>
  </thead>
  <tbody>
    @foreach($catalogs as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->code }}</td>
      <td><a href="javascript:view({{$item->id}});">{{ $item->name }}</a></td>
      <td>
        <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->id}})"><i class="fa fa-eye" aria-hidden="true"></i> 
          <span class="hidden-xs">Ver</span>
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- View Modal -->
<div id="view-modal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-eye"></i> Ver</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Product Detail Modal -->
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title text-danger" id="myModalLabel5">Informacion del Producto </h4>
      </div>
      <div id="product_modal_body" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" data-original-title="" title=""></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<!-- MultiSelect JS -->
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<!-- Scripst -->
<script type="text/javascript">
  $(function() {
    $("#catalog-datatable").DataTable({
      columnDefs: [
      { orderable: false, targets: [-1,-2] }
      ]
    });
  });
</script>
<script type="text/javascript">
  $('select[multiple="1"]').multiselect({
    buttonWidth: '85%',
    enableFiltering: true,
    includeSelectAllOption: true,
  });
  function view(id) {
    $.ajax({
      url: "{{ url('/customer/catalogs/') }}/"+id,
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