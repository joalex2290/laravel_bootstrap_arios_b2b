@extends('layouts.app')

@section('title')
Servicios - Arios Colombia
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Servicios</a></li>
</ol>
<h4>
	Servicios
</h4>
<div class="row text-center">

	<div class="col-md-6 col-sm-6 hero-feature">
		<div class="panel panel-default">
		<img style="max-height:300px;" src="{{asset('img/aseo1.jpg')}}" alt="">
			<div class="caption">
				<p>Aseo integral y atención de cafetería.</p>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 hero-feature">
		<div class="panel panel-default">
		<img style="max-height:300px;" src="{{asset('img/aseo2.jpg')}}" alt="">
			<div class="caption">
				<p>Servicios de sellado y cristalizado de pisos</p>
			</div>
		</div>
	</div>

</div>
<div class="row text-center">

	<div class="col-md-6 col-sm-6 hero-feature">
		<div class="panel panel-default">
		<img style="max-height:300px;" src="{{asset('img/aseo3.jpg')}}" alt="">
			<div class="caption">
				<p>Servicio de jardinería, electricidad, plomería, piscinas</p>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 hero-feature">
		<div class="panel panel-default">
		<img style="max-height:300px;" src="{{asset('img/aseo4.jpg')}}" alt="">
			<div class="caption">
				<p>Fumigación especializada para el control de plagas y roedores</p>
			</div>
		</div>
	</div>

</div>
@endsection

@section('scripts')
@endsection