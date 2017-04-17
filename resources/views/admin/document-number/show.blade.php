<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$documentnumber->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/documentnumber', $documentnumber->id],
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
                <th>ID</th><td>{{ $documentnumber->id }}</td>
            </tr>
            <tr>
                <th> {{ trans('documentnumber.organization_id') }} </th>
                <td> {{ $documentnumber->organization->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('documentnumber.current_number') }} </th>
                <td> {{ $documentnumber->current_number }} </td>
            </tr>
            <tr>
                <th> {{ trans('documentnumber.next_number') }} </th>
                <td> {{ $documentnumber->next_number }} </td>
            </tr>
        </tbody>
    </table>
</div>