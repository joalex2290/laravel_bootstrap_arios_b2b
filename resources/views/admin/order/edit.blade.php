{!! Form::model($order, [
'method' => 'PATCH',
'url' => ['/admin/order', $order->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.order.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}