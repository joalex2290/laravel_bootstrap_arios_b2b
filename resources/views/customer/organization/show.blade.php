@extends('layouts.app')

@section('title')
{{ trans('office.crud_name') }} - ARB2B
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/') }}">Inicio</a></li>
  <li><a href="{{ url('/shop') }}">Tienda</a></li>
  <li><a href="#">{{ trans('office.crud_name') }}</a></li>
</ol>
<h4>
  {{ $organization->name  }}
  @if(Auth::user()->hasRole('administrador')) 
  <div class="btn-group pull-right">
  <a href="{{ url('/customer/organization/'.$organization->id.'/edit') }}" class="btn btn-warning" title="Editar">
      <i class="fa fa-pencil-square-o"></i><span class="hidden-xs"> Editar</span>
    </a>
  </div> 
  @endif 
</h4>
<br>
<!-- left column -->
<div class="col-md-4 col-sm-6 col-xs-12">
  <div class="text-center">
    <img src="{{asset('img/organizations/'.$organization->avatar_url)}}" class="img-circle" width="250" alt="avatar">
  </div>
</div>
<!-- edit form column -->
<div class="col-md-6 col-sm-6 col-xs-12 personal-info">
  <table class="table table-borderless">
    <tbody>
      <tr>
        <th>ID</th>
        <td>{{ $organization->id }}</td>
      </tr>
      <tr><th> {{ trans('organization.tax_id') }} </th>
        <td> {{ $organization->tax_id }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.name') }} </th>
        <td> {{ $organization->name }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.comercial_name') }} </th>
        <td> {{ $organization->comercial_name }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.description') }} </th>
        <td> {{ $organization->description }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.phone') }} </th>
        <td> {{ $organization->phone }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.address') }} </th>
        <td> {{ $organization->address }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.city_id') }} </th>
        <td> {{ $organization->city->name }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.department_id') }} </th>
        <td> {{ $organization->city->department->name }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.country_id') }} </th>
        <td> {{ $organization->city->department->country->name }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.website') }} </th>
        <td> {{ $organization->website }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.facebook') }} </th>
        <td> {{ $organization->facebook }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.avatar_url') }} </th>
        <td> {{ $organization->avatar_url }} </td>
      </tr>
      <tr>
        <th> {{ trans('organization.active') }} </th>
        <td> {{ $organization->active }} </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
@endsection