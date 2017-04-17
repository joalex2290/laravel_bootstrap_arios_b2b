{!! Form::model($catalog, [
'method' => 'PATCH',
'url' => ['/admin/catalog', $catalog->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.catalog.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}