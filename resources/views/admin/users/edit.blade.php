{!! Form::model($user, [
    'method' => 'PATCH',
    'url' => ['/admin/users', $user->id],
    'class' => 'form-horizontal'
    ]) !!}

@include ('admin.users.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}
