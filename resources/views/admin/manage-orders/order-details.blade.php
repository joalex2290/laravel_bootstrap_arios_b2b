@extends('layouts.app')

@section('title')
Detalle del pedido - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}">Inicio</a></li>
    <li><a href="{{url('/shop')}}">Tienda</a></li>
    <li><a href="">Detalle del pedido</a></li>
</ol>
<h4>Detalle del pedido
    <div class="btn-group pull-right">
        <a href="{{url('admin/sap-template?order_id='.$order->id)}}" class="btn btn-primary">
            <i class="fa fa-file-excel-o"></i> Template SAP
        </a>
        <a href="{{url($url)}}" class="btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
    </div>
</h4>
<br>
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li @if($tab == 1) class="active" @endif><a href="#tab-order" data-toggle="tab">General</a></li>
        <li><a href="#tab-shipping" data-toggle="tab">Envio</a></li>
        <li @if($tab == 3) class="active" @endif><a href="#tab-products" data-toggle="tab">Productos</a></li>
        <li @if($tab == 4) class="active" @endif><a href="#tab-logs" data-toggle="tab">Trazabilidad</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-order" @if($tab == 1) class="tab-pane active" @else class="tab-pane" @endif >
            <table class="table table-bordered table-striped table-hover">
                <tbody><tr>
                    <td class="col-sm-3">ID pedido:</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td>Numero del Documento:</td>
                    <td>{{$order->doc_num}}</td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td>{{$order_status[$order->status]}}</td>
                </tr>
                <tr>
                    <td>Oficina:</td>
                    <td>{{$order->office->name}}</td>
                </tr>
                <tr>
                    <td>Contrato:</td>
                    <td>{{$order->catalog->name}}</td>
                </tr>
                <tr>
                    <td>Solicitante:</td>
                    <td>{{$order->user->name}}</td>
                </tr>
                <tr>
                    <td>Subtotal:</td>
                    <td>$ {{number_format($order->subtotal,2)}}</td>
                </tr>
                <tr>
                    <td>IVA:</td>
                    <td>$ {{number_format($order->tax,2)}}</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>$ {{number_format($order->total,2)}}</td>
                </tr>
                <tr>
                    <td>Referencia:</td>
                    <td>{{$order->reference}}</td>
                </tr>
                <tr>
                    <td>Comentario:</td>
                    <td>{{$order->comment}}</td>
                </tr>
                <tr>
                    <td>Fecha Creacion:</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                <tr>
                    <td>Fecha Revision:</td>
                    <td>{{$order->reviewed_at}}</td>
                </tr>
                <tr>
                    <td>Fecha Despacho:</td>
                    <td>{{$order->dispatched_at}}</td>
                </tr>
                <tr>
                    <td>Fecha Entrega:</td>
                    <td>{{$order->delivered_at}}</td>
                </tr>
                <tr>
                    <td>Vendedor asignado:</td>
                    <td>{{$order->seller_name}}</td>
                </tr>
            </tbody></table>
        </div>
        <div id="tab-shipping" class="tab-pane">
            <table class="table table-bordered table-striped table-hover">
                <tbody><tr>
                    <td class="col-sm-3">Recibe:</td>
                    <td>{{$order->contact_name}}</td>
                </tr>
                <tr>
                    <td>Telefono del contacto:</td>
                    <td>{{$order->contact_phone}}</td>
                </tr>
                <tr>
                    <td>Celular del contacto:</td>
                    <td>{{$order->contact_cellphone}}</td>
                </tr>
                <tr>
                    <td>Correo electrónico del contacto:</td>
                    <td>{{$order->contact_email}}</td>
                </tr>
                <tr>
                    <td>Oficina:</td>
                    <td>{{$order->office->name}}</td>
                </tr>
                <tr>
                    <td>Direccion:</td>
                    <td>{{$order->address}}</td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td>{{$order->city->name}}</td>
                </tr>
                <tr>
                    <td>Departamento:</td>
                    <td>{{$order->city->department->name}}</td>
                </tr>
                <tr>
                    <td>Pais:</td>
                    <td>{{$order->city->department->country->name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="tab-products" @if($tab == 3) class="tab-pane active" @else class="tab-pane" @endif >
        <form action="{{route('order.approve')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$order->id}}">
            <input type="hidden" name="url" value="{{url($url)}}">
            <input type="hidden" name="tab" value="3">
        </br>
        <ul class="list-inline pull-right">
            <li>
                <strong>Subtotal:</strong>
                <div id="subtotal">$ {{number_format($order->subtotal,2)}}</div>
                <input type="hidden" id="subtotal_" name="subtotal" value="{{$order->subtotal}}">
            </li>
            <li>
                <strong>Iva:</strong>
                <div id="tax">$ {{number_format($order->tax,2)}}</div>
                <input type="hidden" id="tax_" name="tax" value="{{$order->tax}}">
            </li>
            <li>
                <strong>Total:</strong>
                <div id="total">$ {{number_format($order->total,2)}}</div>
                <input type="hidden" id="total_" name="total" value="{{$order->total}}">
                <input type="hidden" name="order_id" value="{{$order->id}}"required>
            </li>
            <li>
                @if(($order->status == 1) && (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')||Auth::user()->hasRole('revisor')))
                <div class="btn-group pull-right">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-check"></i><span class="hidden-xs"> Aprobar </span>
                    </button>
                    <a href="" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i><span class="hidden-xs"> Rechazar</span>
                    </a>
                </div>
                @elseif(($order->status == 2) && (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')))
                <div class="btn-group pull-right">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-check"></i><span class="hidden-xs"> Aprobar </span>
                    </button>
                    <a href="" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i><span class="hidden-xs"> Rechazar</span>
                    </a>
                </div>
                @else
                @endif
            </li>
        </ul>
        <br>
        <table id="products-datatable" class="table table-hover">
            <thead>
                <tr class="active">
                    <th>Linea</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Solicitado</th>
                    <th>Aprobado</th>
                    <th>Precio</th>
                    <th>IVA</th>
                    <th>Precio+IVA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_details as $index => $products)
                <tr>
                    <td>{{$index+1}}</td>
                    <input type="hidden" name="order_detail_id[]" value="{{$products->id}}">
                    <td>{{$products->product_code}}</td>
                    <td>{{$products->product_name}}</td>
                    <td>{{$products->quantity}}</td>
                    <td>
                        @if(($order->status == 1) && (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')||Auth::user()->hasRole('revisor')))
                        <input type="number" name="approved_qty[]" id="approved_qty_{{$index+1}}" onkeyup="updateQuantity({{$index+1}})" class="input-number-control" value="{{$products->quantity}}"required>
                        <input type="hidden" id="qty_{{$index+1}}" value="{{$products->quantity}}">
                        @elseif(($order->status == 2) && (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')))
                        <input type="number" name="approved_qty[]" id="approved_qty_{{$index+1}}" onkeyup="updateQuantity({{$index+1}})" class="input-number-control" value="{{$products->quantity}}"required>
                        <input type="hidden" id="qty_{{$index+1}}" value="{{$products->quantity}}">
                        @else
                        {{$products->approved_quantity}} <abbr title="Pendiente {{$products->approved_quantity}} por entregar"><i class="text-warning fa fa-clock-o"></i></abbr>
                        @endif
                    </td>
                    <td >$ {{number_format($products->price,2)}}</td>
                    <input type="hidden" id="price_{{$index+1}}" value="{{$products->price}}">
                    <td>{{$products->tax_prct}}%</td>
                    <input type="hidden" id="tax_{{$index+1}}" value="{{$products->tax}}">
                    <td>$ {{number_format($products->price_tax,2)}}</td>
                    <td id="price_total_{{$index+1}}">$ {{number_format($products->price_tax * $products->quantity,2)}}</td>
                    <input type="hidden" id="price_total_{{$index+1}}" value="{{$products->price}}">
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
<div id="tab-logs" @if($tab == 4) class="tab-pane active" @else class="tab-pane" @endif >
    <div id="order_log">
    </br>
    <table id="logs-datatable" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Comentario</th>
                <th>De</th>
                <th>Para</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_logs as $log)
            <tr>
               <td>{{$log->created_at}}</td>
               <td>
                {{$log->comment}}
                @if($log->attachment_type)
                <p><small><a href="{{asset('download/'.$log->attachment)}}"><i class="fa fa-paperclip"></i> {{$attachment_types[$log->attachment_type]}}</a></small></p>
                @endif
                @if($log->tracking_number)
                <p><small><a href="{{$log->tracking_link}}" target="_blank"><i class="fa fa-truck"></i> Seguimiento: {{$log->tracking_number}}</a></small></p>
                @endif
            </td>
            <td>{{$log->from}}</td>
            <td>{{$log->to}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<form class="form-horizontal" action="{{route('admin.add-order-log')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="order_id" value="{{$order->id}}">
    <input type="hidden" name="url" value="{{url($url)}}">
    <input type="hidden" name="tab" value="4">
    <div class="form-group">
        <label class="control-label col-sm-2" for="comment">Mensaje:</label>
        <div class="control-field col-sm-4">
            <textarea name="comment" class="form-control" rows="2" id="comment" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Archivos adjunto:</label>
        <div class="control-field col-sm-4">
            <select name="attachment_type" class="form-control" onchange="showAttachmentArea(this)">
                @foreach($attachment_types as $key => $value)
                <option value="{{$key}}"> {{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="control-field col-sm-6">
            <input type="file" id="attachment" name="attachment" class="hidden">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Nuevo Estado:</label>
        <div class="control-field col-sm-4">
            <select name="status" class="form-control" onchange="showShippingInfo(this)">
                @foreach($order_statuses as $index => $value)
                @if($index == $order->status)
                <option value="{{$index}}" selected> {{$value}}</option>
                @else
                <option value="{{$index}}"> {{$value}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div id="shipping-info" class="hidden">
        <div class="form-group">
            <label class="control-label col-sm-2">Numero de seguimiento:</label>
            <div class="control-field col-sm-4">
                <input type="text" name="tracking_number" class="form-control">
            </div>
            <div class="control-field col-sm-4">
                <select name="carrier_id" class="form-control">
                    <option value=""> - Seleccione transportadora - </option>
                    @foreach($carriers as $carrier)
                    <option value="{{$carrier->id}}">{{$carrier->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Enlace seguimiento:</label>
            <div class="control-field col-sm-4">
                <input type="url" name="tracking_link" class="form-control" placeholder="Copie y peque aqui el enlace o URL">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="control-field col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Enviar</button>
        </div>
    </div>
</form>
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
        $("#logs-datatable").DataTable();
    });
    function showAttachmentArea(selectObject){
        if(selectObject.value == 0){
            $('#attachment').addClass('hidden');
            $('#attachment').removeAttr('required');
        }
        else{
            $('#attachment').removeClass('hidden');
            $('#attachment').attr('required',true);
        }
    }
    function showShippingInfo(selectObject){
        if(selectObject.value == 6){
            $("#shipping-info").removeClass('hidden');
            $("#shipping-info input").attr('required',true);
            $("#shipping-info select").attr('required',true);

        }
        else{
            $("#shipping-info").addClass('hidden');
            $("#shipping-info input").removeAttr('required');
            $("#shipping-info select").removeAttr('required');
        }
    }
</script>
<script type="text/javascript">
    function number_format(n, currency) {
        return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }
    function updateQuantity(id) {
        var old_qty = document.getElementById('qty_' + id).value;
        var new_qty = document.getElementById('approved_qty_' + id).value;
        if (!new_qty == '' && new_qty <= 0) {
            new_qty = 0;
            alert('Se eliminara este producto de la orden');
        }
        document.getElementById('qty_' + id).value = new_qty;
        var product_price = document.getElementById('price_' + id).value;
        var product_tax = document.getElementById('tax_' + id).value;
        var subtotal = document.getElementById('subtotal_').value;
        var tax = document.getElementById('tax_').value;
        var total = document.getElementById('total_').value;
        var total_line = parseFloat(new_qty) * (parseFloat(product_price) + parseFloat(product_tax));
        subtotal = subtotal - (old_qty * product_price);
        subtotal = subtotal + (new_qty * product_price);
        document.getElementById('subtotal_').value = subtotal;
        tax = tax - (old_qty * product_tax);
        tax = tax + (new_qty * product_tax);
        document.getElementById('tax_').value = tax;
        total = subtotal + tax;
        document.getElementById('total_').value = total;
        $("div[id='subtotal'").html(number_format(subtotal, '$'));
        $("div[id='tax'").html(number_format(tax, '$'));
        $("div[id='total'").html(number_format(total, '$'));
        $("td[id='price_total_" + id + "'").html(number_format(total_line, '$'));
    }
    ;
</script>
@endsection