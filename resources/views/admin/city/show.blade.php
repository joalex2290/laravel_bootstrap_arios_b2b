<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$city->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/city', $city->id],
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
                <th>ID</th><td>{{ $city->id }}</td>
            </tr>
            <tr>
                <th> {{ trans('city.code') }} </th>
                <td> {{ $city->code }} </td>
            </tr>
            <tr>
                <th> {{ trans('city.name') }} </th>
                <td> {{ $city->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('city.department_id') }} </th>
                <td> {{ $city->department->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('city.country_id') }} </th>
                <td> {{ $city->department->country->name }} </td>
            </tr>
        </tbody>
    </table>
</div>