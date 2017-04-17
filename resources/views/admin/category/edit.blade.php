{!! Form::model($category, [
'method' => 'PATCH',
'url' => ['/admin/category', $category->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.category.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}