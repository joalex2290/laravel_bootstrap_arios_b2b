@extends('layouts.app')

@section('title')
{{ trans('orderlog.crud_name') }} - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
<!-- MultiSelect CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/admin') }}">Inicio</a></li>
  <li><a href="#">{{ trans('orderlog.crud_name') }}</a></li>
</ol>
<h4>{{ trans('orderlog.crud_name') }}      
  <div class="btn-group pull-right">
    <button class="btn btn-success" title="Crear" onclick="create()">
      <i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Crear</span>
    </button>
  </div>
</h4>
<br>
<div class="table-responsive">
    <table id="orderlog-datatable" class="table table-borderless table-hover">
        <thead>
            <tr class="active text-center">
                <th>ID</th><th>{{ trans('orderlog.order_id') }}</th><th>{{ trans('orderlog.comment') }}</th><th>{{ trans('orderlog.attachment_type') }}</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orderlog as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->order_id }}</td><td>{{ $item->comment }}</td><td>{{ $item->attachment_type }}</td>
                <td>
                    <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->id}})"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>
                    <button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$item->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Create Modal -->
<div id="create-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Crear</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- View Modal -->
<div id="view-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
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
<!-- Edit Modal -->
<div id="edit-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> Editar</h4>
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
<!-- MultiSelect JS -->
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<!-- Scripst -->
<script type="text/javascript">
  $(function() {
    $("#orderlog-datatable").DataTable({
      columnDefs: [
      { orderable: false, targets: -1 }
      ]
    });
  });
</script>
<script type="text/javascript">
  function create() {
    $.ajax({
      url: "{{ url('/admin/order-log/create') }}",
      method: "GET",
      success: function(data) {
        $('#create-modal').find('.modal-body').html("");
        $('#create-modal').find('.modal-body').html(data.html);
        $('#create-modal').modal('toggle');
        $('select[multiple="1"]').multiselect({
          buttonWidth: '100%'
        });
      }
    });

  };
  function view(id) {
    $.ajax({
      url: "{{ url('/admin/order-log/') }}/"+id,
      method: "GET",
      success: function(data) {
        $('#view-modal').find('.modal-body').html("");
        $('#view-modal').find('.modal-body').html(data.html);
        $('#view-modal').modal('toggle');
        $('select[multiple="1"]').multiselect({
          buttonWidth: '100%'
        });
      }
    });
  };
  function edit(id) {
    $.ajax({
      url: "{{ url('/admin/order-log/') }}/"+id+"/edit",
      method: "GET",
      success: function(data) {
        $('#edit-modal').find('.modal-body').html("");
        $('#edit-modal').find('.modal-body').html(data.html);
        $('#edit-modal').modal('toggle');
        $('select[multiple="1"]').multiselect({
          buttonWidth: '100%'
        });
      }
    });
  };
</script>
@endsection