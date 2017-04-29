@extends('layouts.app')

@section('title')
Detalle de cotización - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}">Inicio</a></li>
    <li><a href="{{url('/admin/manage-quotes')}}">Cotizaciones</a></li>
    <li><a href="">Detalle de cotización</a></li>
</ol>
<h4>Detalle de la cotización
    <div class="btn-group pull-right">
        <a href="{{url($url)}}" class="btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
    </div>
</h4>
<br>
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li @if($tab == 1) class="active" @endif><a href="#tab-quote" data-toggle="tab">General</a></li>
        <li @if($tab == 2) class="active" @endif><a href="#tab-products" data-toggle="tab">Productos</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-quote" @if($tab == 1) class="tab-pane active" @else class="tab-pane" @endif >
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <td class="col-sm-3">ID pedido:</td>
                        <td>{{$quote->id}}</td>
                    </tr>
                    <tr>
                        <td>Numero cotización:</td>
                        <td>{{$quote->quote_number}}</td>
                    </tr>
                    <tr>
                        <td>Fecha Creacion:</td>
                        <td>{{$quote->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Estado:</td>
                        <td>@if($quote->status) Cotizado @else Pendiente cotizar @endif</td>
                    </tr>
                    <tr>
                        <td>Solicitante:</td>
                        <td>{{$quote->name}}</td>
                    </tr>
                    <tr>
                        <td>Correo Electrónico:</td>
                        <td>{{$quote->email}}</td>
                    </tr>
                    <tr>
                        <td>Telefono:</td>
                        <td>{{$quote->phone}}</td>
                    </tr>
                    <tr>
                        <td>Direccion:</td>
                        <td>{{$quote->address}}</td>
                    </tr>
                    <tr>
                        <td>Ciudad:</td>
                        <td>{{$quote->city->name}}</td>
                    </tr>
                    <tr>
                        <td>Departamento:</td>
                        <td>{{$quote->city->department->name}}</td>
                    </tr>
                    <tr>
                        <td>Organización:</td>
                        <td>{{$quote->organization}}</td>
                    </tr>
                    <tr>
                        <td>Comentario:</td>
                        <td>{{$quote->comment}}</td>
                    </tr>
                    <tr>
                        <td>Subtotal:</td>
                        <td>$ {{number_format($quote->subtotal,2)}}</td>
                    </tr>
                    <tr>
                        <td>IVA:</td>
                        <td>$ {{number_format($quote->tax,2)}}</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>$ {{number_format($quote->total,2)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="tab-products" @if($tab == 2) class="tab-pane active" @else class="tab-pane" @endif >
            <form action="{{route('manage-quotes')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$quote->id}}">
                <input type="hidden" name="url" value="{{url($url)}}">
                <input type="hidden" name="tab" value="2">
                </br>
                <ul class="list-inline pull-right">
                    <li>
                        <strong>Subtotal:</strong>
                        <div id="subtotal">$ {{number_format($quote->subtotal,2)}}</div>
                        <input type="hidden" id="subtotal_" name="subtotal" value="{{$quote->subtotal}}">
                    </li>
                    <li>
                        <strong>Iva:</strong>
                        <div id="tax">$ {{number_format($quote->tax,2)}}</div>
                        <input type="hidden" id="tax_" name="tax" value="{{$quote->tax}}">
                    </li>
                    <li>
                        <strong>Total:</strong>
                        <div id="total">$ {{number_format($quote->total,2)}}</div>
                        <input type="hidden" id="total_" name="total" value="{{$quote->total}}">
                        <input type="hidden" name="quote_id" value="{{$quote->id}}"required>
                    </li>
                    @unless($quote->status)
                    <li>
                        <strong>Envio:</strong>
                        <div id="shipping">$ <input step="0.01" min="0" class="input-number-control" id="shipping" name="shipping" value="{{$quote->shipping}}" required=""></div>
                    </li>
                    <li>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="glyphicon glyphicon-check"></i><span class="hidden-xs"> Finalizar cotización </span>
                            </button>
                        </div>
                    </li>
                    @else
                    <li>
                        <strong>Envio:</strong>
                        <div id="total">$ {{number_format($quote->shipping,2)}}</div>
                    </li>
                    @endunless
                </ul>
                <br>
                <table id="products-datatable" class="table table-hover">
                    <thead>
                        <tr class="active">
                            <th>Linea</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>IVA</th>
                            <th>Precio+IVA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quote_details as $index => $products)
                        <tr>
                            <td>{{$index+1}}</td>
                            <input type="hidden" name="quote_detail_id[]" value="{{$products->id}}">
                            <td>{{$products->product->code}}</td>
                            <td>{{$products->product_name}}</td>
                            <td>{{$products->quantity}}</td>
                            <input type="hidden" id="qty_{{$index+1}}" value="{{$products->quantity}}">
                            @if($quote->status)
                            <td>$ {{$products->price}}</td>
                            @else
                            <td >$ <input type="number" step="0.01" min="0" class="input-number-control" name="price[]" id="price_{{$index+1}}" value="" onkeyup="updatePrice({{$index+1}});" required="">
                            </td>


                            @endif
                            <input type="hidden" id="old_price_{{$index+1}}" value="0">
                            <td>{{$products->product->tax}}%</td>
                            <input type="hidden" name="product_tax[]" id="tax_{{$index+1}}" value="{{$products->product->tax}}">
                            <td id="price_tax_{{$index+1}}">$ {{number_format($products->price_tax,2)}}</td>
                            <input type="hidden" name="price_tax[]" id="price_tax_{{$index+1}}" value="{{$products->price_tax}}">
                            <td id="price_total_{{$index+1}}">$ {{number_format($products->price_tax * $products->quantity,2)}}</td>
                            <input type="hidden" id="price_total_{{$index+1}}" value="{{$products->price}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $("#products-datatable").DataTable();
    });
</script>
<script type="text/javascript">
    function number_format(n, currency) {
        return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }
    function updatePrice(id) {
        if(document.getElementById('price_' + id).value){
            var price = document.getElementById('price_' + id).value;
        }
        else{
            var price = 0;
        }
        var old_price = document.getElementById('old_price_' + id).value;
        var qty = document.getElementById('qty_' + id).value;
        var product_tax = document.getElementById('tax_' + id).value/100;
        var subtotal = document.getElementById('subtotal_').value;
        var tax = document.getElementById('tax_').value;
        var total = document.getElementById('total_').value;
        var price_tax = (parseFloat(price) * parseFloat(product_tax))+parseFloat(price);
        var total_line = parseFloat(qty) * parseFloat(price_tax);
        subtotal = subtotal - (parseFloat(qty) * parseFloat(old_price));
        subtotal = subtotal + (parseFloat(qty) * parseFloat(price));
        document.getElementById('subtotal_').value = subtotal;
        document.getElementById('old_price_' + id).value = price; 
        tax = tax - (qty * (parseFloat(old_price) * parseFloat(product_tax)));
        tax = tax + (qty * (parseFloat(price) * parseFloat(product_tax)));
        document.getElementById('tax_').value = tax;
        total = subtotal + tax;
        document.getElementById('total_').value = total;

        $("div[id='subtotal'").html(number_format(subtotal, '$'));
        $("div[id='tax'").html(number_format(tax, '$'));
        $("div[id='total'").html(number_format(total, '$'));
        $("td[id='price_total_" + id + "'").html(number_format(total_line, '$'));
        $("td[id='price_tax_" + id + "'").html(number_format(price_tax, '$'));
        $("input[id='price_total_" + id + "'").val(total_line);
        $("input[id='price_tax_" + id + "'").val(price_tax);
    }
    ;
</script>
@endsection