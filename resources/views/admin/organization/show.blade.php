<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$organization->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/organization', $organization->id],
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
                <th>ID</th>
                <td>{{ $organization->id }}</td>
            </tr>
            <tr><th> {{ trans('organization.tax_id') }} </th>
                <td> {{ $organization->tax_id }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.name') }} </th>
                <td> {{ $organization->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.comercial_name') }} </th>
                <td> {{ $organization->comercial_name }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.description') }} </th>
                <td> {{ $organization->description }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.phone') }} </th>
                <td> {{ $organization->phone }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.address') }} </th>
                <td> {{ $organization->address }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.city_id') }} </th>
                <td> {{ $organization->city->name }} </td>
            </tr>
            <tr>
            <th> {{ trans('organization.department_id') }} </th>
                <td> {{ $organization->city->department->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.country_id') }} </th>
                <td> {{ $organization->city->department->country->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.website') }} </th>
                <td> {{ $organization->website }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.facebook') }} </th>
                <td> {{ $organization->facebook }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.avatar_url') }} </th>
                <td> {{ $organization->avatar_url }} </td>
            </tr>
            <tr>
                <th> {{ trans('organization.active') }} </th>
                <td> {{ $organization->active }} </td>
            </tr>
        </tbody>
    </table>
</div>