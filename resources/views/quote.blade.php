@extends('layouts.app')

@section('title')
Cotización - Arios Colombia
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Cotización</a></li>
</ol>
<h4>
	Cotización
</h4>
@if(!empty($quote))
@if($quote->status)
<div class="alert alert-success">
	<strong>La cotización {{$quote->quote_number}} tiene un valor de $ {{$quote->total}} pesos.</strong>
</div>

<ul class="list-inline pull-right">
	<li>
		<strong>Subtotal:</strong>
		<div id="subtotal">$ {{number_format($quote->subtotal,2)}}</div>
	</li>
	<li>
		<strong>Iva:</strong>
		<div id="tax">$ {{number_format($quote->tax,2)}}</div>
	</li>
	<li>
		<strong>Total:</strong>
		<div id="total">$ {{number_format($quote->total,2)}}</div>
	</li>
	<li>
		<strong>Envio:</strong>
		<div id="total">$ {{number_format($quote->shipping,2)}}</div>
	</li>
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
		@foreach($quote->quoteDetails()->get() as $index => $products)
		<tr>
			<td>{{$index+1}}</td>
			<td>{{$products->product->code}}</td>
			<td>{{$products->product_name}}</td>
			<td>{{$products->quantity}}</td>
			<td>$ {{$products->price}}</td>
			<td>{{$products->product->tax}}%</td>
			<td>$ {{number_format($products->price_tax,2)}}</td>
			<td>$ {{number_format($products->price_tax * $products->quantity,2)}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-info">
	<strong>La cotización {{$quote->quote_number}} aun esta en procesamiento.</strong>
</div>
@endif

@else
<div class="alert alert-warning">
	<strong>El numero de cotización no coincide con nuestros registros.</strong>
</div>
@endif
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
@endsection