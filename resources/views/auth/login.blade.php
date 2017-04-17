@extends('layouts.app')

@section('title')
Inicio de sesión - ARB2B
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li><a href="#">Inicio de sesión</a></li>
</ol>
<h4>Inicio de sesión</h4>
<br>
<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-3 control-label">Correo electronico</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-3 control-label">Contraseña</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar sesión
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-3">
            <button type="submit" class="btn btn-primary">
                Enviar
            </button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Olvido su contraseña?
            </a>
        </div>
    </div>
</form>
@endsection
