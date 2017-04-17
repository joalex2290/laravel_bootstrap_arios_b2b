{!! Form::model($country, [
'method' => 'PATCH',
'url' => ['/admin/country', $country->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.country.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}