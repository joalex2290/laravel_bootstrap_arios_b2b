@extends('layouts.app')

@section('title')
ARB2B - Productos del catalogo
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}">Inicio</a></li>
    <li><a href="{{route('shop')}}">Tienda</a></li>
    <li><a href="#">Productos</a></li>
</ol>
<h4> Productos       
    <div class="btn-group pull-right">
        <a href="{{route('shop.unset-catalog')}}" type="button" class="btn btn-warning">
            <i class="glyphicon glyphicon-chevron-left"></i><span class="hidden-xs"> Cambiar catalogo</span>
        </a>
        <a class="btn btn-primary" data-toggle="modal" data-target="#confirm_modal">
            <i class="glyphicon glyphicon-flash"></i><span class="hidden-xs"> Pedir todo</span>
        </a>
        <a href="{{route('cart')}}"class="btn btn-success">
            <i class="glyphicon glyphicon-shopping-cart"></i><span class="hidden-xs"> Ver carrito</span>
        </a>
    </div>
</h4>
<br>
<form id="add_all_form" action="{{route('cart.add-all')}}" method="POST">
    {{csrf_field()}}
    <table id="products" class="table table-hover table-condensed">
        <thead>
            <tr class="text-center active">
                <th class="text-center hidden-xs">Imagen</th>
                <th class="text-center">Codigo</th>
                <th class="text-center">Nombre</th>
                <th class="text-center hidden-xs">Precio</th>
                <th class="text-center hidden-xs">IVA</th>
                <th class="text-center">Precio+IVA</th>
                <th class="text-center">Cantidad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td class="text-center hidden-xs">
                    <a onclick="getProductDetails({{$product['id']}})">
                        <img  src="{{asset('img/products/'.$product->img_url)}}" height="40" width="40" alt="{{$product['name']}}">
                    </a>
                </td>
                <td class="text-right">
                    {{$product->pivot->product_code}}
                    <input type="hidden" id="id_{{$index}}" name="id[]" value="{{$product['id']}}"/>
                    <input type="hidden" id="code_{{$index}}" name="code[]" value="{{$product->pivot->product_code}}"/>
                </td>
                <td class="text-right">
                    <a onclick="getProductDetails({{$product['id']}})"> {{$product->pivot->product_name}}</a>
                    <input type="hidden" id="name_{{$index}}" name="name[]" value="{{$product->pivot->product_name}}"/>
                </td>
                <td class="text-right hidden-xs">
                    ${{number_format($product->pivot->product_price,2)}}
                    <input type="hidden" id="price_{{$index}}" name="price[]" value="{{$product->pivot->product_price}}"/>
                </td>
                <td class="text-right hidden-xs">
                    {{$product['tax']}}%
                    <input type="hidden" id="tax_{{$index}}" name="tax[]" value="{{$product['tax']}}"/>
                </td>
                <td class="text-right">
                    ${{number_format($product->pivot->product_price*(1+($product['tax']/100)),2)}}
                    <input type="hidden" id="price_tax_{{$index}}" name="price_tax[]" value="{{$product->pivot->price*(1+($product['tax']/100))}}"/>
                </td>
                <td class="text-center">
                <input type="number" class="input-number-control" id="quantity_{{$index}}" name="quantity[]" value="1">
                </td>
                <td id="add-button_{{$index}}">
                    <button type="button" class="btn btn-success btn-sm" onclick="addToCart({{$index}})">
                        <i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Pedir</span>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
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
<!-- Confirm Modal -->
<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="glyphicon glyphicon-exclamation-sign"></i> Atencion
            </div>
            <div class="modal-body">
                <p>Se agregaran todos los productos del catalogo actual con la cantidad indicada en el campo "Cantidad".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <a id="add_all" class="btn btn-success btn-ok">Aceptar</a>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JS: -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#products").DataTable({
        });
    });
    $(document.body).on('click', '#add_all', function() {
        $("#confirm_modal").modal("hide");
        $("#add_all_form").submit();
    });
    function addToCart(id){
        var product_id = document.getElementById('id_' + id).value;
        var code = document.getElementById('code_' + id).value;
        var name = document.getElementById('name_' + id).value;
        var quantity = document.getElementById('quantity_' + id).value;
        var price = document.getElementById('price_' + id).value;
        var tax = document.getElementById('tax_' + id).value;
        $('#add-button_'+id).html('<img class="loader" src="/img/loading.gif" height="30" width="30">');
        $.ajax({
            url: "{{route('cart.add')}}",
            method: 'GET',
            data: {
                product_id: product_id,
                code: code,
                name: name,
                quantity: quantity,
                price: price,
                tax: tax
            },
            success: function (data) {
                location.reload(); }
            });
    }
    function getProductDetails(id) {
     var product_id = id;
     $.ajax({
         url: "{{route('shop.catalog.product-detail')}}",
         method: "GET",
         data: {product_id: product_id},
         success:function (data) {
             $('#product_modal').modal('toggle');
             $("div[id='product_modal_body'").html('');
             $("div[id='product_modal_body'").html(data.product);
         }
     });
 }
</script>

@endsection