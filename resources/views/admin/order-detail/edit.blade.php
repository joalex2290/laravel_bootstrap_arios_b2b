{!! Form::model($orderdetail, [
'method' => 'PATCH',
'url' => ['/admin/order-detail', $orderdetail->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.order-detail.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}