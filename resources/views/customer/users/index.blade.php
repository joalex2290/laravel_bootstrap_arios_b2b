@extends('layouts.app')

@section('title')
Empleado - ARB2B
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
  <li><a href="#">Empleados</a></li>
</ol>
<h4>Empleados       
  <div class="btn-group pull-right">
    <button class="btn btn-success" title="Crear" onclick="create()">
      <i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Crear</span>
    </button>
  </div>
</h4>
<br>
<div class="table-responsive">
  <table id="users-datatable" class="table table-borderless table-hover">
    <thead>
      <tr class="active text-center">
        <th>ID</th><th>{{trans('user.name')}}</th><th>{{trans('user.email')}}</th><th>{{trans('user.role')}}</th><th>{{trans('user.active')}}</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @if(Auth::user()->hasRole('administrador'))
      @foreach($organization_users as $item)
      @unless(Auth::user()->id == $item->user->id )
      <tr>
        <td>{{ $item->user->id }}</td>
        <td><a href="javascript:view({{$item->user->id}});">{{ $item->user->name }}</a></td>
        <td>{{ $item->user->email }}</td>
        <td>
          {{$item->user->roles[0]->name}}
        </td>
        <td class="text-center">
          @if($item->user->profile->active)
          <i class="fa fa-check-circle fa-lg text-success"></i>
          @else
          <i class="fa fa-ban fa-lg text-danger"></i>
          @endif
        </td>
        <td>
          <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->user->id}})"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>
          <button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$item->user->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
          <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#change_pass_modal" onclick="setUserIdModal({{$item->id}})"><i class="fa fa-lock"></i><span class="hidden-xs"> Cambiar Contraseña</span></button>
        </td>
      </tr>
      @endunless
      @endforeach
      @elseif(Auth::user()->hasRole('supervisor'))
      @foreach($office_users as $offices)
      @foreach($offices->users as $item)
      @unless(Auth::user()->id == $item->id )
      <tr>
        <td>{{ $item->id }}</td>
        <td><a href="javascript:view({{$item->id}});">{{ $item->name }}</a></td>
        <td>{{ $item->email }}</td>
        <td>
          {{$item->roles[0]->name}}
        </td>
        <td>
          <button class="btn btn-primary btn-xs" title="Ver" onclick="view({{$item->id}})"><i class="fa fa-eye" aria-hidden="true"></i><span class="hidden-xs"> Ver</span></button>
          <button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$item->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="hidden-xs"> Editar</span></button>
          <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#change_pass_modal" onclick="setUserIdModal({{$item->id}})"><i class="fa fa-lock"></i><span class="hidden-xs"> Cambiar Contraseña</span>
          </button>
        </td>
      </tr>
      @endunless
      @endforeach
      @endforeach
      @else
      No esta autorizado para ver este modulo
      @endif
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
<!-- Change Pass Modal -->
<div class="modal fade" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-lock"></i> Cambiar contraseña</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('customer.users.change-pass')}}" method="POST">
          {{CSRF_field()}}
          <input type="hidden" name="cpassword_user_id" value="">
          <div class="form-group">
            <label>Contraseña</label>
            <input class="form-control " type="password" name="cpassword1" oninput="checkChangePass(this)" pattern = "(?=.*\d)(?=.*[a-z]).{6,}" title = "Debe contener al menos un numero, al menos una letra y mas de 6 caracteres" required>
          </div>
          <div class="form-group">
            <label>Confirmar contraseña</label>
            <input class="form-control " type="password" name="cpassword2" oninput="checkChangePass(this)" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-warning"> Cambiar</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
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
    $("#users-datatable").DataTable({
      columnDefs: [
      { orderable: false, targets: -1 }
      ]
    });
  });
</script>
<script type="text/javascript">
  function create() {
    $.ajax({
      url: "{{ url('customer/users/create') }}",
      method: "GET",
      success: function(data) {
        $('#create-modal').find('.modal-body').html("");
        $('#create-modal').find('.modal-body').html(data.html);
        $('#create-modal').modal('toggle');
        $('select[multiple="1"]').multiselect({
          buttonWidth: '100%',
          enableFiltering: true,
          includeSelectAllOption: true,
        });
      }
    });

  };
  function view(id) {
    $.ajax({
      url: "{{ url('customer/users/') }}/"+id,
      method: "GET",
      success: function(data) {
        $('#view-modal').find('.modal-body').html("");
        $('#view-modal').find('.modal-body').html(data.html);
        $('#view-modal').modal('toggle');
      }
    });
  };
  function edit(id) {
    $.ajax({
      url: "{{ url('customer/users/') }}/"+id+"/edit",
      method: "GET",
      success: function(data) {
        $('#edit-modal').find('.modal-body').html("");
        $('#edit-modal').find('.modal-body').html(data.html);
        $('#edit-modal').modal('toggle');
        $('select[multiple="1"]').multiselect({
          buttonWidth: '100%',
          enableFiltering: true,
          includeSelectAllOption: true,
        });
      }
    });
  };
  function checkUserPass(input) {
    $("#password, #password-confirm").each(function() {
      this.setCustomValidity('');
    });
    if ($("#password").val() != $("#password-confirm").val()) {
      input.setCustomValidity('La contraseña no coincide.');
    }
  }
  function checkChangePass(input) {
    $("[name='cpassword1'], [name='cpassword2']").each(function() {
      this.setCustomValidity('');
    });
    if ($("[name='cpassword1']").val() != $("[name='cpassword2']").val()) {
      input.setCustomValidity('La contraseña no coincide.');
    }
  }
  function setUserIdModal(id){
    $("[name='cpassword_user_id']").val(id);
  }
</script>
@endsection
