<select class="form-control" name="department_id" onchange="getDepartmentCities()" required>
	@foreach($departments as $department)
	<option value="{{$department->id}}">{{$department->name}}</option>
	@endforeach
</select>