<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$order->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/order', $order->id],
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
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('order.doc_num') }} </th>
                    <td> {{ $order->doc_num }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.user_id') }} </th>
                    <td> {{ $order->user_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.user_name') }} </th>
                    <td> {{ $order->user_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.office_id') }} </th>
                    <td> {{ $order->office_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.office_name') }} </th>
                    <td> {{ $order->office_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.organization_id') }} </th>
                    <td> {{ $order->organization_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.organization_name') }} </th>
                    <td> {{ $order->organization_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.catalog_id') }} </th>
                    <td> {{ $order->catalog_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.catalog_name') }} </th>
                    <td> {{ $order->catalog_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.status') }} </th>
                    <td> {{ $order->status }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.subtotal') }} </th>
                    <td> {{ $order->subtotal }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.tax') }} </th>
                    <td> {{ $order->tax }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.total') }} </th>
                    <td> {{ $order->total }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.total_delivered') }} </th>
                    <td> {{ $order->total_delivered }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.reference') }} </th>
                    <td> {{ $order->reference }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.comment') }} </th>
                    <td> {{ $order->comment }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.address') }} </th>
                    <td> {{ $order->address }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.city_id') }} </th>
                    <td> {{ $order->city_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.city_name') }} </th>
                    <td> {{ $order->city_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.department_name') }} </th>
                    <td> {{ $order->department_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.country_name') }} </th>
                    <td> {{ $order->country_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.contact_name') }} </th>
                    <td> {{ $order->contact_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.contact_phone') }} </th>
                    <td> {{ $order->contact_phone }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.contact_cellphone') }} </th>
                    <td> {{ $order->contact_cellphone }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.contact_email') }} </th>
                    <td> {{ $order->contact_email }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.seller_id') }} </th>
                    <td> {{ $order->seller_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.seller_name') }} </th>
                    <td> {{ $order->seller_name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.reviewed_at') }} </th>
                    <td> {{ $order->reviewed_at }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.received_at') }} </th>
                    <td> {{ $order->received_at }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.dispatched_at') }} </th>
                    <td> {{ $order->dispatched_at }} </td>
                </tr>
                <tr>
                    <th> {{ trans('order.delivered_at') }} </th>
                    <td> {{ $order->delivered_at }} </td>
                </tr>
            </tbody>
        </table>
    </div>