<hr>
<h4>Catalogo: {{ $catalog->name }}</h4>
<div class="table-responsive">
	<table id="catalog-datatable" class="table table-borderless table-hover">
		<thead>
			<tr>
				<th>ID</th><th>Codigo</th><th>Nombre</th><th>Precio</th><th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($catalog->products()->get() as $product)
			<tr>
				<td>{{ $product->id }}</td>
				<td>{{ $product->pivot->product_code }}</td><td>{{ $product->pivot->product_name }}</td><td>{{ $product->pivot->product_price }}</td>
				<td>
					{!! Form::open([
					'method'=>'POST',
					'url' => ['/admin/remove-catalog-products'],
					'style' => 'display:inline'
					]) !!}
					<input type="hidden" name="catalog" value="{{ $catalog->id }}">
					<input type="hidden" name="product" value="{{ $product->id }}">
					{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Quitar', array(
					'type' => 'submit',
					'class' => 'btn btn-danger btn-xs',
					'title' => 'Quitar',
					'onclick'=>'return confirm("Confirma quitar del catalogo?")'
					)) !!}
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(function() {
		$("#catalog-datatable").DataTable({
			columnDefs: [
			{ orderable: false, targets: -1 }
			]
		});
	});
</script>