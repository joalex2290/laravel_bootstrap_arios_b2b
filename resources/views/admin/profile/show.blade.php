<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$profile->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
{!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/profile', $profile->id],
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
                <th>ID</th><td>{{ $profile->id }}</td>
            </tr>
            <tr><th> {{ trans('profile.user_id') }} </th><td> {{ $profile->user->name}} </td></tr><tr><th> {{ trans('profile.organization_id') }} </th><td> @if(isset($profile->organization_id)) $profile->organization->name @else N/A @endif </td></tr><tr><th> {{ trans('profile.personal_id') }} </th><td> {{ $profile->personal_id }} </td></tr><tr><th> {{ trans('profile.phone') }} </th><td> {{ $profile->phone }} </td></tr><tr><th> {{ trans('profile.cellphone') }} </th><td> {{ $profile->cellphone }} </td></tr><tr><th> {{ trans('profile.personal_email') }} </th><td> {{ $profile->personal_email }} </td></tr><tr><th> {{ trans('profile.born_date') }} </th><td> {{ $profile->born_date }} </td></tr><tr><th> {{ trans('profile.address') }} </th><td> {{ $profile->address }} </td></tr><tr><th> {{ trans('profile.city_id') }} </th><td> {{ $profile->city_id }} </td></tr><tr><th> {{ trans('profile.img_url') }} </th><td> {{ $profile->img_url }} </td></tr>
        </tbody>
    </table>
</div>