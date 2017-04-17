<button class="btn btn-warning btn-xs" title="Editar" onclick="edit({{$user->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
<br/>
<br/>
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }} </td>
                <td>
                {{$user_roles[0]}}
                </td>
            </tr>
        </tbody>
    </table>
</div>