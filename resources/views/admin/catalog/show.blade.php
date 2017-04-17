<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$catalog->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/catalog', $catalog->id],
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
                <th>ID</th><td>{{ $catalog->id }}</td>
            </tr>
            <tr>
                <th> {{ trans('catalog.code') }} </th>
                <td> {{ $catalog->code }} </td>
            </tr>
            <tr>
                <th> {{ trans('catalog.name') }} </th>
                <td> {{ $catalog->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('catalog.organization_id') }} </th>
                <td> {{ $catalog->organization->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('catalog.valid_from') }} </th>
                <td> {{ $catalog->valid_from }} </td>
            </tr>
            <tr>
                <th> {{ trans('catalog.valid_to') }} </th>
                <td> {{ $catalog->valid_to }} </td>
            </tr>
            <tr>
                <th> {{ trans('catalog.value') }} </th>
                <td> {{ $catalog->value }} </td>
            </tr>
        </tbody>
    </table>
</div>