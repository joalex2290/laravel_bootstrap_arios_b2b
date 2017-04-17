<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$department->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/department', $department->id],
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
        <tbody>
            <tr>
                <th>ID</th><td>{{ $department->id }}</td>
            </tr>
            <tr><th> {{ trans('department.code') }} </th><td> {{ $department->code }} </td></tr><tr><th> {{ trans('department.name') }} </th><td> {{ $department->name }} </td></tr><tr><th> {{ trans('department.country_id') }} </th><td> {{ $department->country->name }} </td></tr>
        </tbody>
    </table>
</div>