@extends('layouts.app')

@section('title')
Reportes - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
<!-- MultiSelect CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/') }}">Inicio</a></li>
  <li><a href="{{ url('/shop') }}">Tienda</a></li>
  <li><a href="#">Reportes</a></li>
</ol>
<h4>Reportes</h4>
<br>
<ul class="nav nav-list well">
  <li>
    <a href="">
      <img alt="Contiene graficos/tablas" title="Contiene graficos/tablas" src="{{asset('img/chart.png')}}">
      Pedidos por oficina 
    </a>
  </li>
  <li>
    <a href="">
      <img alt="Contiene graficos/tablas" title="Contiene graficos/tablas" src="{{asset('img/chart.png')}}">
      Pedidos por oficina 
    </a>
  </li>
  <li>
    <a href="">
      <img alt="Contiene graficos/tablas" title="Contiene graficos/tablas" src="{{asset('img/chart.png')}}">
      Pedidos por oficina 
    </a>
  </li>
</ul>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<!-- MultiSelect JS -->
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
@endsection
