<select class="form-control" name="offices[]" multiple="1">
	@foreach($offices as $office)
	<option value="{{$office->id}}" 
		@foreach($catalog->offices()->get() as $office_catalog)
		@if($office_catalog->id == $office->id) selected @endif
		@endforeach
		>{{$office->organization->name}} - {{$office->name}}
	</option>
	@endforeach
</select>
{!! $errors->first('offices[]', '<p class="help-block">:message</p>') !!}
<script type="text/javascript">
	$('select[multiple="1"]').multiselect({
		buttonWidth: '100%',
		enableFiltering: true,
		includeSelectAllOption: true,
	});
</script>