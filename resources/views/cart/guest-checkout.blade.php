@extends('layouts.app')

@section('title')
ARB2B - Checkout
@endsection

@section('styles')
@endsection

@section('content')
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
            <li class="list-group-item"> Catalogo <strong class="pull-right">{{$catalog->code}}</strong></li>
            <li class="list-group-item"> Cantidad productos <strong class="pull-right">{{$cart_total_qty}}</strong></li>
            <li class="list-group-item"> Subtotal <strong class="pull-right">${{$subtotal}}</strong></li>
            <li class="list-group-item"> Iva <strong class="pull-right">${{$tax}}</strong></li>
            <li class="list-group-item">Total <strong class="pull-right">${{$total}}</strong></li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-panel2">
                Informacion del envio
            </a>
        </h4>
    </div>
    <div id="collapse-panel2" class="panel-collapse collapse in">
        <ul class="text-left list-group">
            <li class="list-group-item"> Sucursal <strong class="pull-right">{{$office->name}}</strong></li>
            @foreach($addresses as $address)
            @if($address->is_default)

            <li class="list-group-item"> Direccion <strong class="pull-right">{{$address->address}}</strong></li>
            <li class="list-group-item"> Ciudad <strong class="pull-right">{{$address->city['name']}}</strong></li>
            <li class="list-group-item"> Departamento <strong class="pull-right">{{$address->state['name']}}</strong></li>
            @else
            No hay direccion predeterminada
            @endif
            @endforeach
            @foreach($contacts as $contact)
            @if($contact->is_default)
            <li class="list-group-item"> Nombre <strong class="pull-right">{{$contact->first_name}} {{$contact->last_name}}</strong></li>
            <li class="list-group-item"> Telefono <strong class="pull-right">{{$contact->phone}}</strong></li>
            <li class="list-group-item"> Celular <strong class="pull-right">{{$contact->cellphone}}</strong></li>
            <li class="list-group-item"> E-mail <strong class="pull-right">{{$contact->email}}</strong></li>
            @else
            No hay contacto predeterminado
            @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-panel3">
                Confirmar pedido</a>
            </h4>
        </div>
        <div id="collapse-panel3" class="panel-collapse collapse in">
            <div class="panel-body">
                <form action="{{route('checkout')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="catalog_id" value="{{$catalog->id}}">
                    <input type="hidden" name="office_id" value="{{$office->id}}">
                    <input type="hidden" name="contact_id" value="{{$contact->id}}">
                    <input type="hidden" name="address_id" value="{{$address->id}}">
                    <textarea class="form-control" rows="4" name="comment"></textarea>
                    <ul class="text-left list-group" >
                        <li class="list-group-item"> 
                            Referencia 
                            <div class="pull-right">
                                <input type="text" name="reference">
                            </div>
                        </li>
                    </ul>
                    <input type="submit" class="btn btn-success" value="Enviar">
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    @endsection