<hr>
<h4>Usuarios de la oficina</h4>
<div class="table-responsive">
	<table id="user-datatable" class="table table-borderless table-hover">
		<thead>
			<tr>
				<th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					@foreach($user->roles()->get() as $role)
					{{ $role->name }}
					@endforeach
				</td>
				<td>
					{!! Form::open([
					'method'=>'POST',
					'url' => ['customer/remove-user-from-office'],
					'style' => 'display:inline'
					]) !!}
					<input type="hidden" name="office_id" value="{{ $office->id }}">
					<input type="hidden" name="user_id" value="{{ $user->id }}">
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
		$("#user-datatable").DataTable({
			columnDefs: [
			{ orderable: false, targets: -1 }
			]
		});
	});
</script>