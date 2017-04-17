<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$carrier->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/carrier', $carrier->id],
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
                <th>ID</th><td>{{ $carrier->id }}</td>
            </tr>
            <tr><th> {{ trans('carrier.name') }} </th><td> {{ $carrier->name }} </td></tr><tr><th> {{ trans('carrier.label') }} </th><td> {{ $carrier->label }} </td></tr><tr><th> {{ trans('carrier.website') }} </th><td> {{ $carrier->website }} </td></tr><tr><th> {{ trans('carrier.phone') }} </th><td> {{ $carrier->phone }} </td></tr>
        </tbody>
    </table>
</div>