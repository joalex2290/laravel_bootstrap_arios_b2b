{!! Form::model($city, [
'method' => 'PATCH',
'url' => ['/admin/city', $city->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.city.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}