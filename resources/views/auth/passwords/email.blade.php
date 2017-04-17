@extends('layouts.app')

@section('title')
Recuperar contraseña - Arios Colombia
@endsection

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Inicio</a></li>
    <li><a href="#">Recuperar contraseña</a></li>
</ol>
<h4>
    Recuperar contraseña
</h4>
<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-3 control-label">Correo electrónico</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary">
                Enviar enlace para recuperar contraseña
            </button>
        </div>
    </div>
</form>
@endsection
