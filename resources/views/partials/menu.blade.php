<!-- Menu -->
@if(Auth::guest())
<div class="well well-sm">
	<form action="{{url('search-product')}}" method="POST">
		{{csrf_field()}}
		<div class="input-group">
			<input type="text" class="form-control" name="product" placeholder="Buscar producto" required>
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</form>
</div>
<div class="well well-sm hidden-lg">
	<div class="mobile-categories">
		<select class="form-control" onchange="window.location.href=this.options[this.selectedIndex].value;">
			<option>-- Categorias --</option>
			@if(!empty($categories))
			@foreach($categories as $category)
			<option value="{{url('category/'.$category->name)}}" class="list-group-item">
				{{$category->label}} <span class="glyphicon glyphicon-chevron-right"></span>
			</option>
			@endforeach
			@else
			<option href="#" class="list-group-item">Sin categorias en la BD, comuniquese con el administrador del sistema.
			</option>
			@endif
		</select>
	</div>
</div>
<div class="menu list-group hidden-xs hidden-sm hidden-md">
	@if(!empty($categories))
	@foreach($categories as $category)
	<a href="{{url('category/'.$category->name)}}" class="list-group-item">{{$category->label}} <span class="glyphicon glyphicon-chevron-right"></span></a>
	@endforeach
	@else
	<a href="#" class="list-group-item">Sin categorias en la BD, comuniquese con el administrador del sistema.</a>
	@endif
</div>
<div class="well well-sm">
	<form action="{{url('search-quote')}}" method="GET">
		<div class="input-group">
			<input type="text" class="form-control" name="quote" placeholder="Consultar cotización" required>
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</form>
</div>
<div class="well hidden-xs">
	<div class="row">
		<div class="col-lg-6 col-xs-6">
			<div >
				<a href="http://www.azeus.com.co/" target="_blank"><img src="{{asset('img/brands/1.png')}}" width="200" class="img-responsive" alt="AZEUS"></a>
			</div>
		</div>
		<div class="col-lg-6 col-xs-6">
			<div >
				<a href="http://www.biomedicaltecnologia.com.co/" target="_blank"><img src="{{asset('img/brands/2.png')}}" width="200" class="img-responsive" alt="BIOMEDICAL"></a>
			</div>
		</div>
		<div class="col-lg-6 col-xs-6">
			<div >
				<a href="http://eliteprofesional.com.co" target="_blank"><img src="{{asset('img/brands/3.png')}}" width="200" class="img-responsive" alt="ELITE"></a>
			</div>
		</div>
	</div>
</div>
@elseif(Auth::user()->hasRole('superadmin'))
<div class="menu list-group">
	@foreach($laravelAdminMenus->menus as $section)
	@if($section->items)
	<div class="list-group-item"><i class="fa fa-cube"></i> 
		{{ trans($section->section) }}
	</div>
	<div class="list-subgroups">
		@foreach($section->items as $menu)
		<a href="{{ url($menu->url) }}" class="list-subgroup-item">- {{ trans($menu->title) }}</a>
		@endforeach
	</div>
	@endif
	@endforeach
</div>
@elseif(Auth::user()->hasRole('vendedor'))
<div class="menu list-group">
	<a class="list-group-item" data-toggle="collapse" data-target="#collapse-menu-all">
		Menu<span class="glyphicon glyphicon-menu-hamburger"></span>
	</a>
	<div id="collapse-menu-all" class="collapse in">
		<a id="collapse-menu3-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu3">
			<i class="fa fa-cube"></i> Gestion<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu3" class="list-subgroups collapse in">
			<a href="{{route('manage-quotes')}}" class="list-subgroup-item"> Cotizaciones</a>
			<a href="{{route('manage-all-orders')}}" class="list-subgroup-item"> Pedidos</a>
			<a href="{{url('/admin/organization/')}}" class="list-subgroup-item"> Empresas</a>
			<a href="{{url('/admin/office')}}" class="list-subgroup-item">Oficinas</a>
			<a href="{{url('/admin/users')}}" class="list-subgroup-item">Usuarios</a>
			<a href="{{url('/admin/catalog')}}" class="list-subgroup-item">Catalogos</a>
			<a href="{{url('/admin/product')}}" class="list-subgroup-item">Productos</a>
			<a href="{{route('admin-add-catalog-products')}}" class="list-subgroup-item">Agregar productos a catalogos</a>
		</div>
	</div>
</div>

@else
<div class="menu list-group">
	<a class="list-group-item" data-toggle="collapse" data-target="#collapse-menu-all">
		Menu<span class="glyphicon glyphicon-menu-hamburger"></span>
	</a>
	<div id="collapse-menu-all" class="collapse in">
		<a href="{{route('shop')}}" class="list-group-item" ><i class="glyphicon glyphicon-home"></i> Inicio</a>
		<a id="collapse-menu1-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu1"><i class="glyphicon glyphicon-shopping-cart"></i> Tienda<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu1" class="list-subgroups collapse in">
			@if(Session::has('catalog'))
			<a href="{{route('shop.catalogs')}}" class="bg-success list-subgroup-item"><strong>{{$current_catalog->name}}</strong></a>
			@else
			<a href="{{route('shop.catalogs')}}" class="list-subgroup-item"><strong>Seleccione un catalogo</strong></a>
			@endif
			<a href="{{route('cart')}}" class="list-subgroup-item">Carrito</a>
			<a href="{{route('checkout')}}" class="list-subgroup-item">Realizar el pedido</a>
		</div>
		@if(Auth::user()->hasRole('administrador'))
		<a id="collapse-menu2-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu2">
			<i class="glyphicon glyphicon-list-alt"></i> Pedidos<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu2" class="list-subgroups collapse in">
			<a href="{{route('my-orders')}}" class="list-subgroup-item">Mis pedidos</a>
			<a href="{{route('pending-organization-orders')}}" class="list-subgroup-item">Solicitudes de mi empresa</a>
			<a href="{{route('organization-orders')}}" class="list-subgroup-item">Pedidos de mi empresa</a>       
		</div>
		<a id="collapse-menu3-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu3">
			<i class="glyphicon glyphicon-briefcase"></i> Empresa<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu3" class="list-subgroups collapse in">
			<a href="{{url('/customer/organization/'.Auth::user()->profile->organization->id)}}" class="list-subgroup-item">Mi empresa</a>
			<a href="{{url('/customer/offices')}}" class="list-subgroup-item">Oficinas</a>
			<a href="{{url('/customer/users')}}" class="list-subgroup-item">Empleados</a>
			<a href="{{url('/customer/catalogs')}}" class="list-subgroup-item">Catalogos</a>
			<a href="{{url('/customer/add-catalogs-to-office')}}" class="list-subgroup-item">Agregar catalogos a oficina</a>
			<a href="{{url('/customer/add-users-to-office')}}" class="list-subgroup-item">Agregar empleados a oficina</a>
		</div>
		<a href="{{route('reports')}}" class="list-group-item" >
			<i class="glyphicon glyphicon-stats"></i> Reportes
		</a>
		@elseif(Auth::user()->hasRole('supervisor') || Auth::user()->hasRole('revisor'))
		<a id="collapse-menu2-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu2">
			<i class="glyphicon glyphicon-list-alt"></i> Pedidos<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu2" class="list-subgroups collapse in">
			<a href="{{route('my-orders')}}" class="list-subgroup-item">Mis pedidos</a>
			<a href="{{route('pending-office-orders')}}" class="list-subgroup-item">Solicitudes de mis oficinas</a>
			<a href="{{route('office-orders')}}" class="list-subgroup-item">Pedidos de mis oficinas</a>                   
		</div>
		<a id="collapse-menu3-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu3">
			<i class="glyphicon glyphicon-briefcase"></i> Empresa<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu3" class="list-subgroups collapse in">
			<a href="{{url('/customer/organization/'.Auth::user()->profile->organization->id)}}" class="list-subgroup-item">Mi empresa</a>
			<a href="{{url('/customer/offices')}}" class="list-subgroup-item">Oficinas</a>
			<a href="{{url('/customer/users')}}" class="list-subgroup-item">Empleados</a>
			<a href="{{url('/customer/catalogs')}}" class="list-subgroup-item">Catalogos</a>
		</div>
		<a href="{{route('reports')}}" class="list-group-item" >
			<i class="glyphicon glyphicon-stats"></i> Reportes
		</a>
		@elseif(Auth::user()->hasRole('ordenador'))
		<a id="collapse-menu2-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu2">
			<i class="glyphicon glyphicon-list-alt"></i> Pedidos<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu2" class="list-subgroups collapse in">
			<a href="{{route('my-orders')}}" class="list-subgroup-item">Mis pedidos</a>        
		</div>
		<a id="collapse-menu3-toggle" class="list-group-item" data-toggle="collapse" data-target="#collapse-menu3">
			<i class="glyphicon glyphicon-briefcase"></i> Empresa<span class="glyphicon glyphicon-chevron-down"></span>
		</a>
		<div id="collapse-menu3" class="list-subgroups collapse in">
			<a href="{{url('/customer/organization/'.Auth::user()->profile->organization->id)}}" class="list-subgroup-item">Mi empresa</a>
			<a href="{{url('/customer/offices')}}" class="list-subgroup-item">Mis oficinas</a>
		</div>
		@else
		No hay menu para  este rol aun
		@endif
	</div>
</div>
@endif