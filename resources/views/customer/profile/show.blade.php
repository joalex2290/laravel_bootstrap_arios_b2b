<div class="row">
    <div class="col-md-4">
        <img src="{{asset('img/offices/'.$office->avatar_url)}}" alt="oficina" class="img-thumbnail" max-height="100">
    </br>
</br>
<h4><strong>Catalogos</strong></h4>
<p class="">
    @if($office->catalogs()->exists())
    @foreach($office->catalogs as $catalog)
    <span class="label label-as-badge label-primary">{{$catalog->name}}</span>
    @endforeach
    @else
    <span class="label label-as-badge label-default">Sin catalogos</span>
    @endif
</p>
</div>
<div class="col-md-8">
    <div class="pull-right">
        <a href="{{url('shop/customer/office/'.$office->id.'/edit')}}" class="btn btn-warning btn-sm" title="Editar">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Editar</span>
        </a> 
    </div>
</br>
</br>
<table class="table table-condensed table-hover">
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
            <td> {{ $office->organization->name }} </td>
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
            <th> {{ trans('office.department_id') }} </th>
            <td> {{ $office->city->department->name }} </td>
        </tr>
        <tr>
            <th> {{ trans('office.city_id') }} </th>
            <td> {{ $office->city->name }} </td>
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
    </tbody>
</table>
</div>
</div>