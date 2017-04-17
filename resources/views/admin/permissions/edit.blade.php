{!! Form::model($permission, [
'method' => 'PATCH',
'url' => ['/admin/permissions', $permission->id],
'class' => 'form-horizontal'
]) !!}

@include ('admin.permissions.form', ['submitButtonText' => 'Update'])

{!! Form::close() !!}