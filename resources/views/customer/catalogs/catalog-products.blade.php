<ul class="list-inline">
	<li><strong>ID: </strong>{{$catalog->id}}</li>
	<li><strong>Codigo: </strong>{{$catalog->code}}</li>
	<li><strong>Nombre: </strong>{{$catalog->name}}</li>
</ul>
<ul class="list-inline">
	<li><strong>Valido desde: </strong>{{$catalog->valid_from}}</li>
	<li><strong>Valido hasta: </strong>{{$catalog->valid_to}}</li>
	<li><strong>Cuantia: </strong>{{$catalog->value}}</li>
</ul>
<table id="catalog-products-datatable" class="table table-borderless table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($catalog->products()->get() as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->pivot->product_code }}</td>
			<td>{{ $product->pivot->product_name }}</td>
			<td>{{ $product->pivot->product_price }}</td>
			<td>
				<button class="btn btn-primary btn-xs" title="Ver" onclick="getProductDetails({{$product->id}})"><i class="fa fa-eye" aria-hidden="true"></i> 
					<span class="hidden-xs">Ver</span>
				</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(function() {
		$("#catalog-products-datatable").DataTable({
			'scrolly' : "200px;",
			'scrollCollapse' : true,
			'paging' : false,
			columnDefs: [
			{ orderable: false, targets: -1 }
			]
		});
	});
	function getProductDetails(id) {
		var product_id = id;
		$.ajax({
			url: "{{route('shop.catalog.product-detail')}}",
			method: "GET",
			data: {product_id: product_id},
			success:function (data) {
				$('#product_modal').modal('toggle');
				$("div[id='product_modal_body'").html('');
				$("div[id='product_modal_body'").html(data.product);
			}
		});
	}
</script>