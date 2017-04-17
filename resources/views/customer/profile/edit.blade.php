@extends('layouts.app')

@section('title')
Editar {{ trans('office.crud_name') }} - ARB2B
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
  <li><a href="{{ url('/shop/customer/office') }}">{{ trans('office.crud_name') }}</a></li>
  <li><a href="#">Editar {{ trans('office.crud_name') }}</a></li>
</ol>
<h4>Editar {{ trans('office.crud_name') }}
  <div class="btn-group pull-right">
    <a href="{{ url('/shop/customer/office/') }}" class="btn btn-danger" title="Regresar">
      <i class="glyphicon glyphicon-remove"></i>
    </a>
  </div>
</h4>
<br>
{!! Form::model($office, [
  'method' => 'PATCH',
  'url' => ['/shop/customer/office', $office->id],
  'class' => 'form-horizontal',
  'files' => true
  ]) !!}
  @include ('shop.customer.office.form', ['submitButtonText' => 'Actualizar'])

  {!! Form::close() !!}
  @endsection

  @section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      getdepartmentCities();
    });
    function getdepartmentCities() {
      var department_id = $('select[name="department_id"]').val();
      $('#cities').html('<img class="loader" src="/img/loading.gif">');
      $.ajax({
        url: "{{ route('office.department-cities') }}",
        method: "GET",
        data: {
          department_id : department_id,
          office_id : {{$office->id}},
        }, 
        success: function(data) {
          $('#cities').html('');
          $('#cities').html(data.html);
        }
      });
    };
  </script>
  @endsection