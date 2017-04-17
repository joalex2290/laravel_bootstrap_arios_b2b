@extends('layouts.app')

@section('title')
Carrito visitante - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="">Inicio</a></li>
    <li><a href="#">Carrito</a></li>
</ol>
<h4>
Carrito visitante 

</div>
@endif
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#cart-datatable").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
        "paging": false,
        columnDefs: [
        { orderable: false, targets: -1 }
        ]
    });
});
</script>
<script type="text/javascript">
    function updateProductQty(id){
        var quantity = document.getElementById('quantity_' + id).value;
        console.log(quantity);
        $.ajax({
            url:"{{route('cart.update')}}",
            method:'GET',
            data:{rowId: id,
                quantity: quantity,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
    function removeProduct(id){
        $.ajax({
            url:"{{route('cart.remove')}}",
            method:'GET',
            data:{rowId: id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>
@endsection