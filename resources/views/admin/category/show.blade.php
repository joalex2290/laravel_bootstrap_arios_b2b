<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$category->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/category', $category->id],
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
                <th>ID</th><td>{{ $category->id }}</td>
            </tr>
            <tr><th> {{ trans('category.name') }} </th><td> {{ $category->name }} </td></tr><tr><th> {{ trans('category.label') }} </th><td> {{ $category->label }} </td></tr>
        </tbody>
    </table>
</div>