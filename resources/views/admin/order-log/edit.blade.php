{!! Form::model($orderlog, [
'method' => 'PATCH',
'url' => ['/admin/order-log', $orderlog->id],
'class' => 'form-horizontal',
'files' => true
]) !!}
@include ('admin.order-log.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}