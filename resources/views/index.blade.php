@extends('layouts.app')

@section('title')
Inicio - Arios Colombia - ARB2B
@endsection

@section('styles')
@endsection

@section('content')
@if(Auth::guest())
<div class="featured">
	<a href="#"><img src="{{asset('img/slides/slide-00.jpg')}}" class="img-responsive" /></a>
	<a href="#"><img src="{{asset('img/slides/slide-01.jpg')}}" class="img-responsive" /></a>
	<a href="#"><img src="{{asset('img/slides/slide-02.jpg')}}" class="img-responsive" /></a>
</div>
<div class="jumbotron">
	<div class="row">
		<div class="col-xs-6 col-md-3">
			<img src="{{asset('img/logo2.png')}}" class="img-responsive">
		</div>
		<div class="col-xs-6 col-md-9">
			Somos una organización que trabaja para colocar a su disposición la mas amplia gama de productos y servcios enfocados a su necesidad, tenemos diferentes lineas de negocios entre los que se encuentran: el suministro de medicamentos y dispositivos medicos de los laboratorios, suministro de insumos de aseo, cafetería y papeleria, todo lo anterior representado en productos de la mas alta calidad a un costo muy favorable, representando beneficios y ganancias a su organización.
		</div>
	</div>
</div>
<h4>Recomendados</h4>
<div class="row ">
	@foreach($products as $index =>  $product)
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="panel">
			<div class="panel-body"">
				<div class="row">
					<img src="{{asset('img/products/'.$product['img_url'])}}" height="150" />
				</div>
				<div class="row">
					<small>@if(strlen($product['name']) > 25) {{substr($product['name'], 0, 25)}}... @else {{$product['name']}} @endif</small>
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
@elseif(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('vendedor') )

@include ('admin.index')

@else

@include ('shop.index')

@endif

@endsection

@section('scripts')
<script src="{{asset('js/jquery.slides.min.js')}}"></script>
<script type="text/javascript">
	$(".featured").slidesjs({
		width: 900,
		height: 300,
		navigation: false,
		play: {
			active: false,
			effect: "slide",
			interval: 4000,
			auto: true,
			swap: true,
			pauseOnHover: true,
			restartDelay: 2500
		}
	});
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