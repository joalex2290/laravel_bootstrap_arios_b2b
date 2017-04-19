@extends('layouts.app')

@section('title')
ARB2B - Checkout invitado
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
                Confirmar pedido
            </a>
        </h4>
    </div>
    <div id="collapse-panel3" class="panel-collapse collapse in">
        <div class="panel-body">
            <form action="{{route('checkout')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" required="">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" required="">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" class="form-control" name="phone" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
                </div>
                <div class="form-group">
                    <label for="organization">Empresa</label>
                    <input type="text" class="form-control" name="organization" placeholder="Opcional">
                </div>

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