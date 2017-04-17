<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$office->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/office', $office->id],
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
                <th>ID</th><td>{{ $office->id }}</td>
            </tr>
            <tr>
                <th> {{ trans('office.code') }} </th>
                <td> {{ $office->code }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.name') }} </th>
                <td> {{ $office->name }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.type') }} </th>
                <td> {{ $office_types[$office->type] }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.organization_id') }} </th>
                <td> {{ $office->organization_id }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.phone') }} </th>
                <td> {{ $office->phone }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.address') }} </th>
                <td> {{ $office->address }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.city_id') }} </th>
                <td> {{ $office->city_id }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.postal_code') }} </th>
                <td> {{ $office->postal_code }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.contact_name') }} </th>
                <td> {{ $office->contact_name }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.contact_phone') }} </th>
                <td> {{ $office->contact_phone }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.contact_cellphone') }} </th>
                <td> {{ $office->contact_cellphone }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.contact_email') }} </th>
                <td> {{ $office->contact_email }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.credit_limit') }} </th>
                <td> {{ $office->credit_limit }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.avatar_url') }} </th>
                <td> {{ $office->avatar_url }} </td>
            </tr>
            <tr>
                <th> {{ trans('office.active') }} </th>
                <td> {{ $office->active }} </td>
            </tr>
        </tbody>
    </table>
</div>