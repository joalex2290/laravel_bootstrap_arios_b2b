{!! Form::model($role, [
    'method' => 'PATCH',
    'url' => ['/admin/roles', $role->id],
    'class' => 'form-horizontal'
    ]) !!}

    @include ('admin.roles.form', ['submitButtonText' => 'Actualizar'])

{!! Form::close() !!}