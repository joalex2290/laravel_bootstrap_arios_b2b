@extends('layouts.app')

@section('title')
Todos los Cotizaciones - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}">Inicio</a></li>
    <li><a href="{{url('/shop')}}">Tienda</a></li>
    <li><a href="#">Cotizaciones</a></li>
</ol>
<h4>Administración de Cotizaciones</h4>
<br>
<table id="quotes-datatable" class="table table-hover table-condensed">
    <thead>
        <tr class="active">
            <th class="text-center">Num.</th>
            <th class="text-center">Solicitante</th>
            <th class="text-center">Correo Elect.</th>
            <th class="text-center">Estado</th>
            <th class="hidden-xs text-center">F. Cotizacion</th>
            <th class="text-center"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotes as $quote)
        <tr>
            <td class="text-right small">{{$quote->quote_number}}</td>
            <td class="text-right small">{{$quote->name}}</td>
            <td class="text-right small">{{$quote->email}}</td>
            <td class="text-right small">@if($quote->status) Cotizado @else Pendiente cotizar @endif</td>
            <td class="hidden-xs text-right small">{{$quote->created_at}}</td>
            <td class="text-center">
                <button class="btn btn-primary btn-sm" onclick="viewQuoteDetails({{$quote->id}})">
                    <i class="glyphicon glyphicon-new-window"></i><span class="hidden-xs"> Ver</span>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form id="quote-details" action="{{route('manage-quote-details')}}" method="GET">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="url" value="/admin/manage-quotes">
    <input type="hidden" name="tab" value="1">
</form>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#quotes-datatable").DataTable({
      columnDefs: [
      { quoteable: false, targets: -1 }
      ]
  });
});
</script>
<script type="text/javascript">
    function viewQuoteDetails(id) {
        $("input[name='id']").val(id);
        $("#quote-details").submit();
    }
</script>
@endsection