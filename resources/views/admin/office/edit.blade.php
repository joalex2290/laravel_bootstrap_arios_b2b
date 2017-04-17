{!! Form::model($office, [
'method' => 'PATCH',
'url' => ['/admin/office', $office->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.office.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}