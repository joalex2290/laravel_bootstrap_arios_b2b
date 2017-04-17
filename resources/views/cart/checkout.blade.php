@extends('layouts.app')

@section('title')
ARB2B - Checkout
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Inicio</a></li>
    <li><a href="/cart">Carrito</a></li>
    <li><a href="#">Confirmar pedido</a></li>
</ol>
@if(Session::has('alert-success'))
<div class="alert alert-info">
    <h4>
        <i class="glyphicon glyphicon-check"></i> La solicitud se ha realizado con exito! Puede ver el pedido en el modulo <a href="{{route('my-orders')}}">"Mis pedidos"</a>.
    </h4>
</div>
@else
<form id="checkout-wizard" action="{{route('checkout')}}" method="POST" class="form-horizontal">
    <div class="step" data-step-title="Resumen">
        <ul class="text-left list-group" style="height: 250px">
            <li class="list-group-item"> Catalogo <strong class="pull-right">{{$catalog->code}}</strong></li>
            <li class="list-group-item"> Cantidad productos <strong class="pull-right">{{$cart_total_qty}}</strong></li>
            <li class="list-group-item"> Subtotal <strong class="pull-right">${{$subtotal}}</strong></li>
            <li class="list-group-item"> Iva <strong class="pull-right">${{$tax}}</strong></li>
            <li class="list-group-item">Total <strong class="pull-right">${{$total}}</strong></li>
        </ul>
    </div>
    <div class="step" data-step-title="Direccion del envio">
        <ul class="text-left list-group" style="height: 250px">
            <li class="list-group-item"> Sucursal <strong class="pull-right">{{$office->name}}</strong></li>
            <li class="list-group-item"> Direccion <strong class="pull-right">{{$office->address}}</strong></li>
            <li class="list-group-item"> Ciudad <strong class="pull-right">{{$office->city->name}}</strong></li>
            <li class="list-group-item"> Departamento <strong class="pull-right">{{$office->city->department->name}}</strong></li>
        </ul>
    </div>
    <div class="step" data-step-title="Persona de contacto">
        <ul class="text-left list-group" style="height: 250px">
            <li class="list-group-item"> Nombre <strong class="pull-right">{{$office->contact_name}}</strong></li>
            <li class="list-group-item"> Telefono <strong class="pull-right">{{$office->contact_phone}}</strong></li>
            <li class="list-group-item"> Celular <strong class="pull-right">{{$office->contact_cellphone}}</strong></li>
            <li class="list-group-item"> E-mail <strong class="pull-right">{{$office->contact_email}}</strong></li>
        </ul>
    </div>

    <div class="step" data-step-title="Comentarios">
        <div style="height: 270px">
            {{csrf_field()}}
            <input type="hidden" name="catalog_id" value="{{$catalog->id}}">
            <input type="hidden" name="office_id" value="{{$office->id}}">
            <div class="form-group ">
                <label for="reference" class="col-md-3 control-label text-right">Referencia</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="Opcional" name="reference" type="text" id="reference">
                </div>
            </div>
            <div class="form-group ">
                <label for="comment" class="col-md-3 control-label">Comentario</label>
                <div class="col-md-7">
                    <textarea class="form-control" placeholder="Opcional" name="comment" cols="50" rows="5" id="comment"></textarea>
                </div>
            </div>
        </div>
    </div>
</form>
@endif
@endsection

@section('scripts')
<script src="{{asset('js/jquery.easyWizard.js')}}"></script>
<script type="text/javascript">
    $('#checkout-wizard').easyWizard({
        buttonsClass: "btn btn-primary",
        submitButtonClass: "btn btn-success",
        submitButtonText: "Solicitar el pedido >",
        prevButton: "< Anterior",
        nextButton: "Siguiente >"
    });
</script>
@endsection