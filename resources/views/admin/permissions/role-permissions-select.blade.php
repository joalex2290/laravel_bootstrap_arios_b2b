<select class="form-control" name="permissions[]" multiple="1">
	@foreach($permissions as $permission)
	<option value="{{$permission->id}}" 
		@foreach($role->permissions()->get() as $role_permission)
		@if($role_permission->id == $permission->id) selected @endif
		@endforeach
		>{{$permission->name}}
	</option>
	@endforeach
</select>
{!! $errors->first('label', '<p class="help-block">:message</p>') !!}
<script type="text/javascript">
	$('select[multiple="1"]').multiselect({
		buttonWidth: '100%',
		enableFiltering: true,
		includeSelectAllOption: true,
	});
</script>