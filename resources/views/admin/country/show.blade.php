<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$country->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/country', $country->id],
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
                <th>ID</th><td>{{ $country->id }}</td>
            </tr>
            <tr><th> {{ trans('country.code') }} </th><td> {{ $country->code }} </td></tr><tr><th> {{ trans('country.name') }} </th><td> {{ $country->name }} </td></tr>
        </tbody>
    </table>
</div>