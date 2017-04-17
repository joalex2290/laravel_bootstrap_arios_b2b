<hr>
<h4>Catalogos de la oficina</h4>
<div class="table-responsive">
	<table id="catalog-datatable" class="table table-borderless table-hover">
		<thead>
			<tr>
				<th>ID</th><th>Codigo</th><th>Nombre</th><th>Valido hasta</th><th>Valido desde</th><th>Valor</th><th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($catalogs as $catalog)
			<tr>
				<td>{{ $catalog->id }}</td>
				<td>{{ $catalog->code }}</td>
				<td>{{ $catalog->name }}</td>
				<td>{{ $catalog->valid_from }}</td>
				<td>{{ $catalog->valid_to }}</td>
				<td>{{ $catalog->value }}</td>
				<td>
					{!! Form::open([
					'method'=>'POST',
					'url' => ['customer/remove-catalog-from-office'],
					'style' => 'display:inline'
					]) !!}
					<input type="hidden" name="office_id" value="{{ $office->id }}">
					<input type="hidden" name="catalog_id" value="{{ $catalog->id }}">
					{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Quitar', array(
					'type' => 'submit',
					'class' => 'btn btn-danger btn-xs',
					'title' => 'Quitar',
					'onclick'=>'return confirm("Confirma quitar de la oficina?")'
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