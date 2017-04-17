@extends('layouts.app')

@section('title')
Productos - Arios Colombia
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Categoria</a></li>
</ol>
<h4>
	Productos
</h4>
<div class="row ">
	@foreach($products as $index =>  $product)
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<img src="{{asset('img/products/'.$product['img_url'])}}" height="150" />
				</div>
				<div class="row">
					<small>
						@if(strlen($product['name']) > 25) {{substr($product['name'], 0, 25)}}... @else {{$product['name']}} @endif
					</small>
				</div>
			</div>
			<div class="panel-footer">
				<input type="hidden" id="id_{{$index}}" value="{{$product['id']}}">
				<input type="hidden" id="name_{{$index}}" value="{{$product['name']}}">
				<input type="number" class="input-number-control" id="quantity_{{$index}}" name="quantity" value="1">
				<button type="button" class="btn btn-success btn-sm" onclick="addToCart({{$index}})">
					<i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Pedir</span>
				</button>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	function addToCart(id){
		var product_id = document.getElementById('id_' + id).value;
		var name = document.getElementById('name_' + id).value;
		var quantity = document.getElementById('quantity_' + id).value;
		$('#add-button_'+id).html('<img class="loader" src="/img/loading.gif" height="30" width="30">');
		$.ajax({
			url: "{{route('cart.add')}}",
			method: 'GET',
			data: {
				product_id: product_id,
				name: name,
				quantity: quantity,
			},
			success: function (data) {
				location.reload(); }
			});
	}
</script>
@endsection