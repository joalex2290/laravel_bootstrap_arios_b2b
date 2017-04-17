@extends('layouts.app')

@section('title')
Pedidos de mi empresa - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}">Inicio</a></li>
    <li><a href="{{url('/shop')}}">Tienda</a></li>
    <li><a href="#">Pedidos de mis oficinas</a></li>
</ol>
<h4>Pedidos de mi empresa</h4>
<br>
<table id="orders-datatable" class="table table-hover table-condensed">
    <thead>
        <tr class="active">
            <th class="text-center">Num.</th>
            <th class="text-center">Solicitante</th>
            <th class="text-center">Oficina</th>
            <th class="text-center">Catalogo</th>
            <th class="text-center">Estado</th>
            <th class="text-center">F. Pedido</th>
            <th class="text-center">F. Despacho</th>
            <th class="text-center">F. Entrega</th>
            <th class="text-center"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($organization->orders()->get() as $order)
        <tr>
            <td class="hidden-xs text-right small">{{$order->doc_num}}</td>
            <td class="text-right small">{{$order->user->name}}</td>
            <td class="text-right small">{{$order->office->name}}</td>
            <td class="text-right small">{{$order->catalog->name}}</td>
            <td class="text-right small">{{$order_status[$order->status]}}</td>
            <td class="hidden-xs text-right small">{{$order->created_at}}</td>
            <td class="hidden-xs text-right small">{{$order->dispatched_at}}</td>
            <td class="hidden-xs text-right small">{{$order->delivered_at}}</td>
            <td class="text-center">
                <button class="btn btn-primary btn-sm" onclick="viewOrderDetails({{$order->id}})">
                    <i class="glyphicon glyphicon-new-window"></i><span class="hidden-xs"> Ver</span>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form id="order-details" action="{{route('order.details')}}" method="GET">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="url" value="shop/organization-orders">
    <input type="hidden" name="tab" value="1">
</form>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#orders-datatable").DataTable({
      columnDefs: [
      { orderable: false, targets: -1 }
      ]
  });
});
</script>
<script type="text/javascript">
    function viewOrderDetails(id) {
        $("input[name='id']").val(id);
        $("#order-details").submit();
    }
</script>
@endsection