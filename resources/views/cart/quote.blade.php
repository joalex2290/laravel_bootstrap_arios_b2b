@extends('layouts.app')

@section('title')
ARB2B - Checkout invitado
@endsection

@section('styles')
@endsection

@section('content')
@if(Session::has('alert-success'))
<div class="alert alert-info">
    <h4>
        <i class="glyphicon glyphicon-check"></i> La solicitud se ha realizado con exito! Puede consultar el estado de la cotización con el numero:
        <br>
        <strong>{{$quote_number}}</strong>
    </h4>
</div>
@else
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-panel1">
                Resumen
            </a>
        </h4>
    </div>
    <div id="collapse-panel1" class="panel-collapse collapse in">
        <ul class="text-left list-group">
            <li class="list-group-item"> Cantidad productos <strong class="pull-right">{{$cart_total_qty}}</strong></li>
            <li class="list-group-item"> Subtotal <strong class="pull-right">cotización</strong></li>
            <li class="list-group-item"> Iva <strong class="pull-right">cotización</strong></li>
            <li class="list-group-item"> Total <strong class="pull-right">cotización</strong></li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-panel3">
                Confirmar cotización
            </a>
        </h4>
    </div>
    <div id="collapse-panel3" class="panel-collapse collapse in">
        <div class="panel-body">
            <form action="{{route('quote')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" required="">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" required="">
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone">Telefono</label>
                    <input type="text" class="form-control" name="phone" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">Direccion</label>
                    <input type="text" class="form-control" name="address" maxlength="10" required="">
                </div>
                <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}" required>
                <label for="department_id">Departamento</label>
                    <div id="departments">

                    </div>
                </div>
                <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}" required>
                    <label for="city_id" >Ciudad</label>
                    <div id="cities">

                    </div>
                </div>
                <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                    <label for="organization">Empresa</label>
                    <input type="text" class="form-control" name="organization" placeholder="Opcional">
                </div>
                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment">Comentario</label>
                    <textarea class="form-control" rows="4" name="comment" placeholder="Opcional"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: "{{ route('register.departments') }}",
            method: "GET",
            success: function(data) {
                $('#departments').html('');
                $('#departments').html(data.html);
                getDepartmentCities();
            }
        });
    });
    function getDepartmentCities() {
        var department_id = $('select[name="department_id"]').val();
        $('#cities').html('<img class="loader" src="{{asset("img/loading.gif")}}">');
        $.ajax({
            url: "{{ route('department-cities') }}",
            method: "GET",
            data: {department_id : department_id}, 
            success: function(data) {
                $('#cities').html('');
                $('#cities').html(data.html);
            }
        });
    };
</script>
@endsection