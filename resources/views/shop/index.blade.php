@extends('layouts.app')

@section('title')
Tienda - ARB2B
@endsection

@section('styles')

@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('/')}}">Inicio</a></li>
	<li><a href="#">Tienda</a></li>
</ol>
@if(Auth::user()->profile['active'])
@if(Auth::user()->hasRole('administrador'))
@if(Session::has('catalog'))
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="thumbnail">
			<img src="{{asset('img/offices/'.$current_office->avatar_url)}}" height="150" width="150" />
			<div class="caption">
				<h5>{{$current_office->name}}</h5>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="thumbnail">
			<img src="{{asset('img/catalog-default.png')}}" height="150" width="150" />
			<div class="caption">
				<h5>{{$current_catalog->name}}</h5>
			</div>
		</div>
	</div>
</div>
@else
@if(Auth::user()->profile->organization->offices()->exists())
<div id="office-catalog-wizard">
	<div id="offices" class="step" data-step-title="Oficina">
		@foreach(Auth::user()->profile->organization->offices()->get() as $office)
		@if($office->active)
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
			<div id="{{$office->id}}" class="overlay offices">
				<div class="thumbnail">
					<img src="{{asset('img/offices/' . $office->avatar_url)}}" height="150" width="150" />
					<div class="caption">
						<h5>{{ $office->name }}</h5>
					</div>
				</div>
				<div class="check-wrapper"></div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
	<div id="catalogs" class="step" data-step-title="Catalogo"></div>

	<form id="set-catalog" action="{{route('shop.set-catalog')}}" method="GET">
		{{ csrf_field() }}
		<input type="hidden" name="office_id" value="" required>
		<input type="hidden" name="catalog_id" value="" required> 
	</form>
</div>
@else
<div class="alert alert-warning">
	<p> <i class="glyphicon glyphicon-exclamation-sign"></i> 
		La organización no tiene oficinas creadas, comience a <a href="{{url('customer/offices/create')}}">crear las oficinas.</a>
	</p>
</div>
@endif
@endif
@else
@if(Session::has('catalog'))
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="thumbnail">
			<img src="{{asset('img/offices/'.$current_office->avatar_url)}}" height="150" width="150" />
			<div class="caption">
				<h5>{{$current_office->name}}</h5>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="thumbnail">
			<img src="{{asset('img/catalog-default.png')}}" height="150" width="150" />
			<div class="caption">
				<h5>{{$current_catalog->name}}</h5>
			</div>
		</div>
	</div>
</div>
@else
@if(Auth::user()->offices()->exists())
<div id="office-catalog-wizard">
	<div id="offices" class="step" data-step-title="Oficina">
		@foreach(Auth::user()->offices()->get() as $office)
		@if($office->active)
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
			<div id="{{$office->id}}" class="overlay offices">
				<div class="thumbnail">
					<img src="{{asset('img/offices/office-default.png')}}" height="150" width="150" />
					<div class="caption">
						<h5>{{ $office->name }}</h5>
					</div>
				</div>
				<div class="check-wrapper"></div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
	<div id="catalogs" class="step" data-step-title="Catalogo"></div>

	<form id="set-catalog" action="{{route('shop.set-catalog')}}" method="GET">
		{{ csrf_field() }}
		<input type="hidden" name="office_id" value="" required>
		<input type="hidden" name="catalog_id" value="" required> 
	</form>
</div>
@else
<div class="alert alert-warning">
	<p> <i class="glyphicon glyphicon-exclamation-sign"></i> No tiene oficinas asignadas, envie una <a href="#">solicitud de asignación de oficina</a> al administrador de la organización.</p>
</div>
@endif
@endif
@endif

@else
<div class="alert alert-danger">
	<p> <i class="glyphicon glyphicon-exclamation-sign"></i> Usuario inactivo, comuniquese con el administrador de su organización.</p>
</div>
@endif
<br>
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
<div class="featured">
	<a href="#"><img src="{{asset('img/slides/slide-00.jpg')}}" class="img-responsive" /></a>
	<a href="#"><img src="{{asset('img/slides/slide-01.jpg')}}" class="img-responsive" /></a>
	<a href="#"><img src="{{asset('img/slides/slide-02.jpg')}}" class="img-responsive" /></a>
</div>
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
</script>
<script src="{{asset('js/jquery.easyWizard.js')}}"></script>
<script type="text/javascript">
	$('#office-catalog-wizard').easyWizard({
		submitButton: false,
		buttonsClass: "btn btn-primary",
		prevButton: "< Anterior",
		nextButton: "Siguiente >"
	});
	$('.next').hide();
	$('.overlay.offices').bind('click', function(e) {
		e.preventDefault();
		var office_id = $(this).attr('id');
		$(".overlay").find('div.check-wrapper').removeClass('checked-thumbnail ');
		$(this).find('.check-wrapper').addClass('checked-thumbnail ');
		$("input[name='office_id']").val(office_id);
		$("input[name='get-catalog']").attr('disabled', true);
		$('#catalogs').html('<img class="loader" src="/img/loading.gif">');
		$.ajax({
			url: "{{route('shop.get-office-catalogs')}}",
			method: 'GET',
			data: {office_id: office_id},
			success: function (data) {
				$("#catalogs").html(data.options);
			}
		});
		$('#office-catalog-wizard').easyWizard('nextStep');
	});
</script>
@endsection