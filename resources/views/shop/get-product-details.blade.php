<div class="row">
    <div class="col-md-6">
        <img src="{{asset('img/products/'.$product->img_url)}}" alt="teste" class="img-thumbnail" max-width="500"> 
    </div>
    <div class="col-md-6">
        <table class="table table-condensed table-hover">
            <thead>
                <th colspan="2">Especificaciones:</th>
            </thead>
            <tbody style="font-size: 12px;">
                <tr>
                    <td>Nombre general</td>
                    <td>{{$product->name}}</td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td>{{$product->description}}</td>
                </tr>
                <tr>
                    <td>Categoria</td>
                    <td>{{$product->category->label}}</td>
                </tr>
                <tr>
                    <td>Referencia</td>
                    <td>{{$product->reference}}</td>
                </tr>
                <tr>
                    <td>Marca</td>
                    <td>{{$product->brand}}</td>
                </tr>
                <tr>
                    <td>Cantidad por presentacion</td>
                    <td>{{$product->package_qty}}</td>
                </tr>
                <tr>
                    <td>Unidad de medida</td>
                    <td>{{$product->unit_meassure}}</td>
                </tr>
                <tr>
                <td>IVA</td>
                    <td>{{$product->tax}}</td>
                </tr>
                <tr>
                    <td>Codigo de barras</td>
                    <td>{{$product->barcode}}</td>
                </tr>
                <tr>
                    <td>Comentario</td>
                    <td>{{$product->comment}}</td>
                </tr>
            </tbody>
        </table> 
    </div>
</div>