@extends('layouts.app')

@section('title')
Contactenos - Arios Colombia
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Contactenos</a></li>
</ol>
<h4>
	Contactenos
</h4>
<div class="row">
	<div class="col-md-8">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.7251093126747!2d-76.54313521584248!3d3.4170149054850794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e30a6a4704569db%3A0x94e3baa21c6bb252!2sARIOS+Colombia+S.a.s.!5e0!3m2!1ses!2sco!4v1492544734086" width="550" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div class="col-md-4">
		<div class="well well-sm">
			<address>
				<strong>ARIOS COLOMBIA S.A.S.</strong><br />
				Calle 8 #42-76<br />
				Cali, Valle del Cauca<br />
				<abbr title="Phone">Linea gratuita nacional:</abbr> 018000180452<br />
				<abbr title="Phone">Telefono:</abbr> (2) 3739920
			</address>
			<address>
				<strong>Informacion general</strong><br />
				<a href="mailto:info@arioscolombia.com.co">info@arioscolombia.com.co</a>
			</address>
		</div> 
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="{{url('/contact')}}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" class="form-control" name="name" required>
					</div>
					<div class="form-group">
						<label for="email">Correo electrónico</label>
						<input type="email" class="form-control" name="email" required>
					</div>
					<div class="form-group">
						<label for="phone">Telefono</label>
						<input type="text" class="form-control" name="phone" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
					</div>
					<div class="form-group">
						<label for="organization">Empresa</label>
						<input type="text" class="form-control" name="organization" placeholder="Opcional">
					</div>
					<div class="form-group">
						<label for="subject">Subject</label>
						<select class="form-control" id="tipocon" name="type" required>
							<option>Contacto</option>
							<option>Sugerencia</option>
							<option>Queja</option>
							<option>Felicitación</option>
							<option>Reclamo</option>
						</select>
					</div>
					<div class="form-group">
						<label for="InputText">Mensaje</label>
						<textarea class="form-control" name="message" placeholder="Escriba su mensaje en este espacio..." rows="5" style="margin-bottom:10px;"></textarea>
					</div>
					<div class="form-group">
						{!! app('captcha')->display(); !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg">
							Enviar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection