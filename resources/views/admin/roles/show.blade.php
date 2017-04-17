<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$role->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
'method' => 'DELETE',
'url' => ['/admin/roles', $role->id],
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
                <th>ID.</th> <th>Name</th><th>Label</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $role->id }}</td> <td> {{ $role->name }} </td><td> {{ $role->label }} </td>
            </tr>
        </tbody>
    </table>
</div>