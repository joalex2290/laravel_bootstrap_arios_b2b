@extends('layouts.app')

@section('title')
Detalle del pedido - ARB2B
@endsection

@section('styles')
@endsection

@section('content')


<!-- Main Container start -->
<div class="dashboard-container">
    <div class="container">
        @include('partials.menu')
        <!-- Dashboard Wrapper Start -->
        <div class="dashboard-wrapper-lg">
            <!-- Row starts -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="container">
                                <div class="invoice">
                                    <div class="panel">
                                        <div class="invoice-header">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                    <a href="#">
                                                        <img src="/img/logo.png" alt="Bluemoon Logo" class="logo"></a>
                                                </div>
                                                <div class="col-lg-9 col-sm-8 col-xs-12">
                                                    <div class="pull-right" style="font-size: 14px">
                                                        <h4 class="no-margin">Pedido - {{$order->doc_num}}</h4>
                                                        <mark>Contrato - {{$order->catalog}}</mark>
                                                        <p class="text-info">{{$order->created_at}}</p>
                                                        <p>Referencia: {{$order->reference}}</p>
                                                        <p>Comentario: <br>{{$order->comment}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body"><br>
                                            <div class="row"><div class="col-md-6 col-sm-6 col-xs-12">
                                                    <address>
                                                        <h4>ARIOS COLOMBIA S.A.S <br><small>900.183.528-6</small></h4>
                                                        <p style="font-size: 14px">
                                                            CL 8 #42-76, Cali, Valle del Cauca <br>
                                                            E-mail:<a href="mailto:#" data-original-title="" title="">comercial@arioscolombia.com.co</a><br>
                                                            Telefono: (032) 373-9920<br>PBX: 01-8000-180452	
                                                        </p>
                                                        <br>
                                                    </address>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <address class="right-text"><h4>{{$order->company}} <br><small>{{$order->office}}</small></h4>
                                                        <p style="font-size: 14px">
                                                            <mark>Direccion de Entrega: {{$order->address.', '.$order->city.', '.$order->state}}</mark><br>
                                                            Contacto: {{$order->contact}}<br>
                                                            E-mail: <a href="mailto:#" data-original-title="" title="">{{$order->email}} </a><br>
                                                            Telefono: {{$order->phone}} <br>
                                                        </p>
                                                    </address>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="active">
                                                                    <th style="width:2%"></th>
                                                                    <th style="width:15%">Codigo</th>
                                                                    <th style="width:30%">Descripcion</th>
                                                                    <th style="width:10%">Cantidad</th>
                                                                    <th style="width:10%">Precio</th>
                                                                    <th style="width:5%">IVA</th>
                                                                    <th style="width:10%">Precio con IVA</th>
                                                                    <th style="width:10%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($order_details as $index => $products)
                                                                <tr>
                                                                    <td>{{$index+1}}</td>
                                                                    <td>{{$products->product_code}}</td>
                                                                    <td>{{$products->product_name}}</td>
                                                                    <td>{{$products->quantity}}</td>
                                                                    <td>${{number_format($products->price,2)}}</td>
                                                                    <td>{{$products->tax}}%</td>
                                                                    <td>${{number_format($products->price_tax,2)}}</td>
                                                                    <td>${{number_format($products->price_tax * $products->quantity,2)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <ul class="list-inline pull-right">
                                                    <li><h5>Subtotal<br> <strong>${{number_format($order->subtotal,2)}}</strong></h5></li>
                                                    <li><h5>IVA<br> <strong>${{number_format($order->tax,2)}}</strong></h5></li>
                                                    <li><h5>Total<br> <strong>${{number_format($order->total,2)}}</strong></h5></li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button> 
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Exportar PDF</button>
                                                    <button type="button" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exportar CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row ends -->
        </div>
        <!-- Dashboard Wrapper End -->
        @include('partials.footer')
    </div>
    <!-- Container End -->
</div>
<!-- Main Container End -->
@endsection

@section('scripts')
@endsection