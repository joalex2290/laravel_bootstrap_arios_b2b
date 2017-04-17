<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$orderlog->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/orderlog', $orderlog->id],
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
                <th>ID</th><td>{{ $orderlog->id }}</td>
            </tr>
            <tr><th> {{ trans('orderlog.order_id') }} </th><td> {{ $orderlog->order_id }} </td></tr><tr><th> {{ trans('orderlog.comment') }} </th><td> {{ $orderlog->comment }} </td></tr><tr><th> {{ trans('orderlog.attachment_type') }} </th><td> {{ $orderlog->attachment_type }} </td></tr><tr><th> {{ trans('orderlog.attachment') }} </th><td> {{ $orderlog->attachment }} </td></tr><tr><th> {{ trans('orderlog.from') }} </th><td> {{ $orderlog->from }} </td></tr><tr><th> {{ trans('orderlog.to') }} </th><td> {{ $orderlog->to }} </td></tr>
        </tbody>
    </table>
</div>