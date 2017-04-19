<!-- Navbar -->
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-brand">
				<a href="/">
					<img src="{{asset('img/logo.png')}}" height="50" alt="Arios Colombia" title="Arios Colombia" />
				</a>
			</div>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="{{url('/')}}">
						Inicio
					</a>
				</li>
				<li>
					<a href="{{url('/about-us')}}">
						Nosotros 
					</a>
				</li>
				<li>
					<a href="{{url('/services')}}">
						Servicios
					</a>
				</li>
				<li>
					<a href="{{url('/contact')}}">
						Contactenos
					</a>
				</li>
				@if(Auth::guest() || Auth::user()->hasRole('administrador') || Auth::user()->hasRole('revisor') || Auth::user()->hasRole('supervisor') || Auth::user()->hasRole('ordenador') )
				<li>
					<a href="{{route('cart')}}">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						<span id="cart_qty" class="label label-success label-as-badge">{{$cart_qty}}</span>
						@if(Session::has('catalog'))
						<span class="label label-primary label-as-badge">{{$current_office->name}}</span>
						<span class="label label-primary label-as-badge">{{$current_catalog->name}}</span>
						@endif          
					</a>
				</li>
				@endif
				@if(Auth::guest())
				<li>
					<a href="{{url('/register')}}">
						Registrese 
					</a>
				</li>
				@endif 
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> 
						@if(Auth::guest())
						Iniciar Sesión 
						@else 
						Bienvenido, {{ Auth::user()->name }} 
						@endif
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu login">
						@if(Auth::guest())
						<li>
							<div class="row">
								<div class="col-md-12">
									<form class="login-wrapper" role="form" method="POST" action="{{ url('/login') }}">
										{{ csrf_field() }}
										<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
											<label class="sr-only" for="email">Email</label>
											<input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
											@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
											<label class="sr-only" for="password">Contraseña</label>
											<input type="password" class="form-control" name="password" placeholder="Contraseña" required>
											@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
											@endif
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="remember"> Seguir conectado
											</label>
										</div>
										<li class="divider"></li>
										<div class="form-group">
											<button type="submit" class="btn btn-success btn-block">Ingresar</button>
										</div>
										<a class="link" href="{{ url('/password/reset') }}">
											Olvido la contraseña?
										</a>
									</form>
								</div>
							</div>
						</li>
						@else 
						<li>
							<div class="navbar-login">
								<div class="row">
									<a href="">
										@if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('supervisor') || Auth::user()->hasRole('revisor') || Auth::user()->hasRole('generador'))
										<div class="col-lg-4">
											<img src="{{asset('img/users/'. Auth::user()->profile->avatar_url)}}" class="img-circle img-responsive" alt="avatar">
										</div>
										<div class="col-lg-8 pull-right">
											@else
											<div class="col-lg-12">
												@endif
												<p class="text-left"><strong>{{Auth::user()->name}}</strong></p>
												@foreach(Auth::user()->roles()->get() as $role)
												<p class="text-left small">{{$role->label}}</p>
												@endforeach
											</div>
										</div>
									</a>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-12">
										<p class="text-left small">{{Auth::user()->email}}</p>
										@if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('supervisor') || Auth::user()->hasRole('revisor') || Auth::user()->hasRole('generador'))
										<p class="text-left small"><strong>Empresa: </strong></p>
										<p class="text-left small">{{ Auth::user()->profile->organization->name }}</p>
										<p class="text-left small"><strong>Oficinas: </strong></p>
										@if(Auth::user()->hasRole('administrador'))
										<span class="badge badge-as-label small">Todas</span>
										@else
										@foreach(Auth::user()->offices()->get() as $office)
										<span class="badge badge-as-label small">{{$office->name}}</span>
										@endforeach
										@endif
										@endif
									</div>
								</div>
								<li class="divider"></li>
								<li>
									<div class="navbar-login">
										<div class="row">
											<div class="col-lg-12">
												<p>
													@if(Auth::user()->hasRole('administrador'))
													<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#change_pass_modal" ><i class="fa fa-lock"></i><span class="hidden-xs"> Cambiar Contraseña</span>
													</button>
													@endif
													<a href="{{ url('/logout')}}" class="btn btn-danger btn-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Salir
													</a>
												</p>
											</div>
										</div>
									</div>
									<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</div>
						</li>
						@endif
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
<!-- Change Pass Modal -->
<div class="modal fade" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading"><i class="fa fa-lock"></i> Cambiar contraseña</h4>
			</div>
			<div class="modal-body">
				<form action="{{route('customer.users.change-pass')}}" method="POST">
					{{CSRF_field()}}
					<input type="hidden" name="cpassword_user_id" value="{{isset(Auth::user()->id)}}">
					<input type="hidden" name="from_url" value="{{ Request::url() }}">
					<div class="form-group">
						<label>Contraseña</label>
						<input class="form-control " type="password" name="cpassword1" oninput="checkChangePass(this)" pattern = "(?=.*\d)(?=.*[a-z]).{6,}" title = "Debe contener al menos un numero, al menos una letra y mas de 6 caracteres" required>
					</div>
					<div class="form-group">
						<label>Confirmar contraseña</label>
						<input class="form-control " type="password" name="cpassword2" oninput="checkChangePass(this)" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning"> Cambiar</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
</div>
<script type="text/javascript">
	function checkChangePass(input) {
		$("[name='cpassword1'], [name='cpassword2']").each(function() {
			this.setCustomValidity('');
		});
		if ($("[name='cpassword1']").val() != $("[name='cpassword2']").val()) {
			input.setCustomValidity('La contraseña no coincide.');
		}
	}
</script>