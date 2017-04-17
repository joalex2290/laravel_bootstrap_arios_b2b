@extends('layouts.app')

@section('title')
Carrito - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Inicio</a></li>
    <li><a href="#">Carrito</a></li>
</ol>
<h4>
    Resumen - Carrito 
    @if(Session::has('catalog'))
    <div class="btn-group pull-right">
        <a href="{{route('shop.catalog.products')}}" type="button" class="btn btn-warning">
            <i class="glyphicon glyphicon-chevron-left"></i><span class="hidden-xs"> Volver al catalogo</span>
        </a>
        <a href="{{route('cart.destroy')}}" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i><span class="hidden-xs"> Vaciar carrito</span>
        </a>
        <a href="{{route('checkout')}}" class="btn btn-success">
            <i class="glyphicon glyphicon-check"></i><span class="hidden-xs"> Realizar pedido</span>
        </a>
    </div>
</h4>
@if($cart->count()>0)
<ul class="list-inline pull-left">
    <li><h5>Subtotal<br> <strong>${{number_format($subtotal,2)}}</strong></h5></li>
    <li><h5>IVA<br> <strong>${{number_format($tax,2)}}</strong></h5></li>
    <li><h5>Total<br> <strong>${{number_format($total,2)}}</strong></h5></li>
</ul>
@endif
@else
<div class="btn-group pull-right">
    <a href="/" type="button" class="btn btn-primary">
        <i class="glyphicon glyphicon-home"></i><span class="hidden-xs"> Volver al inicio</span>
    </a>
    <a href="{{route('cart.destroy')}}" class="btn btn-danger">
        <i class="glyphicon glyphicon-trash"></i><span class="hidden-xs"> Vaciar carrito</span>
    </a>
    <a href="#" class="btn btn-success">
        <i class="glyphicon glyphicon-check"></i><span class="hidden-xs"> Cotizar</span>
    </a>
</div>
</h4>
@endif
<br>
@if($cart->count()>0)
<table id="cart-datatable" class="table table-hover table-condensed">
    <thead>
        <tr class="active">
            @if(Session::has('catalog'))
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th></th>
            <th>Precio+IVA</th>
            <th>Total</th>
            @else
            <th>Descripcion</th>
            <th>Cantidad</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if(Session::has('catalog'))
        @foreach($cart as $index => $cartRow)
        <tr>
            <td>
                {{$cartRow->options->code}}
            </td>
            <td>
                <p>{{$cartRow->name}}</p>
            </td>
            <td>
                <input type="number" class="input-number-control" id="quantity_{{$cartRow->rowId}}" name="quantity" value="{{$cartRow->qty}}">
                <button class="btn btn-info btn-xs" onclick="updateProductQty('{{$cartRow->rowId}}')"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-danger btn-xs" onclick="removeProduct('{{$cartRow->rowId}}')"><i class="fa fa-trash-o"></i></button>   
            </td>
            <td class="actions" data-th="">

            </td>
            <td>
                ${{number_format(($cartRow->price*(1+($cartRow->options->tax/100))),2)}}
            </td>
            <td>
                ${{number_format($cartRow->total,2)}}
            </td>
        </tr>
        @endforeach
        @else
        @foreach($cart as $index => $cartRow)
        <tr>
            <td>
                <p>{{$cartRow->name}}</p>
            </td>
            <td>
                <input type="number" class="input-number-control" id="quantity_{{$cartRow->rowId}}" name="quantity" value="{{$cartRow->qty}}">
                <button class="btn btn-info btn-xs" onclick="updateProductQty('{{$cartRow->rowId}}')"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-danger btn-xs" onclick="removeProduct('{{$cartRow->rowId}}')"><i class="fa fa-trash-o"></i></button>   
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<div class="alert alert-warning">
    <i class="glyphicon glyphicon-exclamation-sign"></i> El carrito esta vacio.
</div>
@endif
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#cart-datatable").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
        "paging": false,
        columnDefs: [
        { orderable: false, targets: -1 }
        ]
    });
});
</script>
<script type="text/javascript">
    function updateProductQty(id){
        var quantity = document.getElementById('quantity_' + id).value;
        console.log(quantity);
        $.ajax({
            url:"{{route('cart.update')}}",
            method:'GET',
            data:{rowId: id,
                quantity: quantity,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
    function removeProduct(id){
        $.ajax({
            url:"{{route('cart.remove')}}",
            method:'GET',
            data:{rowId: id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>
@endsection