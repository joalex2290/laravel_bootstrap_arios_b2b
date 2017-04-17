<select class="form-control" name="users[]" multiple="1">
	@foreach($users as $user)
	<option value="{{$user->user_id}}" 
		@foreach($office->users()->get() as $office_user)
		@if($office_user->id == $user->user_id) selected @endif
		@endforeach
		>{{$user->user->name}}
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