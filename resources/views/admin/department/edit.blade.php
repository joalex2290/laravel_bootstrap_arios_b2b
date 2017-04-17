{!! Form::model($department, [
'method' => 'PATCH',
'url' => ['/admin/department', $department->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.department.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}