<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$product->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/product', $product->id],
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
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('product.code') }} </th>
                    <td> {{ $product->code }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.name') }} </th>
                    <td> {{ $product->name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.type') }} </th>
                    <td> {{ ($product->type == 0)? 'Articulo':'Servicio' }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.category') }} </th>
                    <td> {{ $product->category->name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.reference') }} </th>
                    <td> {{ $product->reference }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.barcode') }} </th>
                    <td> {{ $product->barcode }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.brand') }} </th>
                    <td> {{ $product->brand }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.tax') }} </th>
                    <td> {{ $product->tax }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.package_qty') }} </th>
                    <td> {{ $product->package_qty }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.unit_meassure') }} </th>
                    <td> {{ $product->unit_meassure }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.comment') }} </th>
                    <td> {{ $product->comment }} </td>
                </tr>
                <tr>
                    <th> {{ trans('product.img_url') }} </th>
                    <td>     
                        <img src="{{asset('img/products//'.$product->img_url)}}" width="300" class="img-thumbnail">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>