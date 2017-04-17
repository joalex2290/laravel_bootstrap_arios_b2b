{!! Form::model($user, [
    'method' => 'PATCH',
    'url' => ['customer/users', $user->id],
    'class' => 'form-horizontal'
    ]) !!}

@include ('customer.users.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}
