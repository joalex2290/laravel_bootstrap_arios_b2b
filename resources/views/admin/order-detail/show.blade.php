<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$orderdetail->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/orderdetail', $orderdetail->id],
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
                <th>ID</th><td>{{ $orderdetail->id }}</td>
            </tr>
            <tr><th> {{ trans('orderdetail.line') }} </th><td> {{ $orderdetail->line }} </td></tr><tr><th> {{ trans('orderdetail.order_id') }} </th><td> {{ $orderdetail->order_id }} </td></tr><tr><th> {{ trans('orderdetail.product_id') }} </th><td> {{ $orderdetail->product_id }} </td></tr><tr><th> {{ trans('orderdetail.product_code') }} </th><td> {{ $orderdetail->product_code }} </td></tr><tr><th> {{ trans('orderdetail.product_name') }} </th><td> {{ $orderdetail->product_name }} </td></tr><tr><th> {{ trans('orderdetail.quantity') }} </th><td> {{ $orderdetail->quantity }} </td></tr><tr><th> {{ trans('orderdetail.approved_quantity') }} </th><td> {{ $orderdetail->approved_quantity }} </td></tr><tr><th> {{ trans('orderdetail.open_quantity') }} </th><td> {{ $orderdetail->open_quantity }} </td></tr><tr><th> {{ trans('orderdetail.price') }} </th><td> {{ $orderdetail->price }} </td></tr><tr><th> {{ trans('orderdetail.tax_prct') }} </th><td> {{ $orderdetail->tax_prct }} </td></tr><tr><th> {{ trans('orderdetail.tax') }} </th><td> {{ $orderdetail->tax }} </td></tr><tr><th> {{ trans('orderdetail.price_tax') }} </th><td> {{ $orderdetail->price_tax }} </td></tr><tr><th> {{ trans('orderdetail.status') }} </th><td> {{ $orderdetail->status }} </td></tr>
        </tbody>
    </table>
</div>