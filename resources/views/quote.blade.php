@extends('layouts.app')

@section('title')
Cotización - Arios Colombia
@endsection

@section('styles')
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
	<strong>La cotización {{$quote->quote_number}} tiene un valor de {{$quote->total}}.</strong>
</div>
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
@endsection