{!! Form::model($product, [
'method' => 'PATCH',
'url' => ['/admin/product', $product->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.product.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}