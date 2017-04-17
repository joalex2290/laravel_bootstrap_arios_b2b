@extends('layouts.app')

@section('title')
Registro de organización - ARB2B
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Registro de organización</a></li>
</ol>
<h4>Registro de organización</h4>
<br>
<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('tax_id') ? ' has-error' : '' }}">
		<label for="tax_id" class="col-md-3 control-label">NIT (numero de identificación tributaria)</label>
		<div class="col-md-6">
			<div class="col-md-8 col-xs-8" style="padding: 0;">
				<input type="text" class="form-control" name="tax_id" value="{{ old('tax_id') }}" maxlength="9" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required autofocus>
				@if ($errors->has('tax_id'))
				<span class="help-block">
					<strong>{{ $errors->first('tax_id') }}</strong>
				</span>
				@endif
			</div>
			<label for="tax_id-dv" class="col-md-1 col-xs-1 control-label"> - </label>
			<div class="col-md-3 col-xs-3" style="padding: 0;">
				<input type="text" class="form-control" name="tax_id-dv" value="{{ old('tax_id-dv') }}" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" >
				@if ($errors->has('tax_id-dv'))
				<span class="help-block">
					<strong>{{ $errors->first('tax_id-dv') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="col-md-4">

		</div>
	</div>
	<div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
		<label for="organization_name" class="col-md-3 control-label">Razon social</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="organization_name" value="{{ old('organization_name') }}" required>
			@if ($errors->has('organization_name'))
			<span class="help-block">
				<strong>{{ $errors->first('organization_name') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('comercial_name') ? ' has-error' : '' }}">
		<label for="comercial_name" class="col-md-3 control-label">Nombre comercial</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="comercial_name" value="{{ old('comercial_name') }}" placeholder="Opcional">
			@if ($errors->has('comercial_name'))
			<span class="help-block">
				<strong>{{ $errors->first('comercial_name') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="alert alert-info">
		<i class="glyphicon glyphicon-exclamation-sign"></i> 
		Informacion de la oficina principal, la persona de contacto y la direccion seran utilizados para realizar envios a esta oficina.
	</div>
	<div class="form-group{{ $errors->has('office_name') ? ' has-error' : '' }}">
		<label for="office_name" class="col-md-3 control-label">Nombre oficina</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="office_name" value="{{ old('office_name') }}" placeholder="Opcional">
			@if ($errors->has('office_name'))
			<span class="help-block">
				<strong>{{ $errors->first('office_name') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('office_code') ? ' has-error' : '' }}">
		<label for="office_code" class="col-md-3 control-label">Codigo oficina</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="office_code" value="{{ old('office_code') }}" placeholder="Opcional">
			@if ($errors->has('office_code'))
			<span class="help-block">
				<strong>{{ $errors->first('office_code') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
		<label for="contact_name" class="col-md-3 control-label">Persona de contacto</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required>
			@if ($errors->has('contact_name'))
			<span class="help-block">
				<strong>{{ $errors->first('contact_name') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
		<label for="contact_phone" class="col-md-3 control-label">Telefono contacto</label>
		<div class="col-md-6">
			<input type="tel" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
			@if ($errors->has('contact_phone'))
			<span class="help-block">
				<strong>{{ $errors->first('contact_phone') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
		<label for="contact_email" class="col-md-3 control-label">Correo electrónico contacto</label>
		<div class="col-md-6">
			<input type="email" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required>
			@if ($errors->has('contact_email'))
			<span class="help-block">
				<strong>{{ $errors->first('contact_email') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
		<label for="phone" class="col-md-3 control-label">Telefono oficina</label>
		<div class="col-md-6">
			<input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
			@if ($errors->has('phone'))
			<span class="help-block">
				<strong>{{ $errors->first('phone') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		<label for="address" class="col-md-3 control-label">Dirección</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
			@if ($errors->has('address'))
			<span class="help-block">
				<strong>{{ $errors->first('adress') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}" required>
		<label for="department_id" class="col-md-3 control-label">Departamento</label>
		<div id="departments" class="col-md-6">

		</div>
	</div>
	<div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}" required>
		<label for="city_id" class="col-md-3 control-label">Ciudad</label>
		<div id="cities" class="col-md-6">

		</div>
	</div>
	<hr>
	<div class="alert alert-info">
		<i class="glyphicon glyphicon-exclamation-sign"></i> 
		El usuario que realice el registro inicial será el responsable del perfil de administrador de la organización.
	</div>
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="col-md-3 control-label">Nombre completo</label>
		<div class="col-md-6">
			<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" >
			@if ($errors->has('name'))
			<span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<label for="email" class="col-md-3 control-label">Correo electronico</label>

		<div class="col-md-6">
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
			<input id="password" type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Debe contener al menos un numero, al menos una letra y mas de 6 caracteres" oninput="checkUserPass(this)"  required>

			@if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<label for="password-confirm" class="col-md-3 control-label">Confirmar contraseña</label>

		<div class="col-md-6">
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" oninput="checkUserPass(this)" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			{!! app('captcha')->display(); !!}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			<button type="submit" class="btn btn-success">
				Registrar
			</button>
		</div>
	</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: "{{ route('register.departments') }}",
			method: "GET",
			success: function(data) {
				$('#departments').html('');
				$('#departments').html(data.html);
				getDepartmentCities();
			}
		});
	});
	function getDepartmentCities() {
		var department_id = $('select[name="department_id"]').val();
		$('#cities').html('<img class="loader" src="{{asset("img/loading.gif")}}">');
		$.ajax({
			url: "{{ route('department-cities') }}",
			method: "GET",
			data: {department_id : department_id}, 
			success: function(data) {
				$('#cities').html('');
				$('#cities').html(data.html);
			}
		});
	};
	function checkUserPass(input) {
		$("#password, #password-confirm").each(function() {
			this.setCustomValidity('');
		});
		if ($("#password").val() != $("#password-confirm").val()) {
			input.setCustomValidity('La contraseña no coincide.');
		}
	}
</script>
@endsection
