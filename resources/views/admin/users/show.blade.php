<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$user->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
'method' => 'DELETE',
'url' => ['/admin/users', $user->id],
'style' => 'display:inline'
]) !!}
{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar', array(
'type' => 'submit',
'class' => 'btn btn-danger btn-xs',
'title' => 'Eliminar',
'onclick'=>'return confirm("Confirma eliminar el registro?")'
))!!}
{!! Form::close() !!}
<br/>
<br/>
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID.</th> <th>Name</th><th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->id }}</td> <td> {{ $user->name }} </td><td> {{ $user->email }} </td>
            </tr>
        </tbody>
    </table>
</div>