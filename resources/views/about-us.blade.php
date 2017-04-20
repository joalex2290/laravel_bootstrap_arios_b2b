@extends('layouts.app')

@section('title')
Acerca de nosotros - Arios Colombia
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="/">Inicio</a></li>
	<li><a href="#">Nosotros</a></li>
</ol>
<h4>
	Acerca de nosotros
</h4>
<ul class="nav nav-pills">
	<li class="active"><a data-toggle="pill" href="#mision">MISION</a></li>
	<li><a data-toggle="pill" href="#vision">VISION 2018</a></li>
	<li><a data-toggle="pill" href="#politica">NUESTRA POLITICA</a></li>
	<li><a data-toggle="pill" href="#valores">VALORES</a></li>
	<li><a data-toggle="pill" href="#principios">PRINCIPIOS</a></li>
	<li><a data-toggle="pill" href="#historia">HISTORIA</a></li>
</ul>

<div class="tab-content">
	<div id="mision" class="tab-pane fade in active">
	<br>
		<p class="well">
			ARIOS COLOMBIA S.A.S es una empresa con sentido social haciendo las   cosas bien, proporciona soluciones integrales  a  nuestros  clientes en   el suministro de productos de cafetería, papelería, artículos de   oficina,  aseo y productos de  línea institucional, mediante  una   permanente actualización e innovación  siendo su aliado estratégico.                    
			Obteniendo   el desarrollo y satisfacción de nuestros colaboradores, el progreso de   nuestro país a través de un equipo de trabajo calificado, procesos   productivos eficientes que respetan el medio ambiente.
		</p>
	</div>
	<div id="vision" class="tab-pane fade">
	<br>
		<p class="well">
			Consolidarnos y ser la empresa líder en el año 2018 en el mercado   nacional de productos para limpieza, hogar, instituciones de salud y   demás industrias a través de la innovación, calidad y un excelente   servicio al cliente. 
		</p>
	</div>
	<div id="politica" class="tab-pane fade">
	<br>
		<p class="well">
			Nuestro compromiso es asegurar la satisfacción de nuestros clientes   mediante el mejoramiento continuo a través de un capital humano   competente, comprometido y reconocido por ARIOS COLOMBIA S.A.S.
		</p>
	</div>
	<div id="valores" class="tab-pane fade">
	<br>
		<ul class="list-group well">
			<li class="list-group-item">Respeto: Cumplimiento por parte de ARIOS COLOMBIA S.A.S con sus   responsabilidades ante sus aliados estratégicos y clientes en general. </li>
			<li class="list-group-item">Orientación al Cliente: Conocimiento de las necesidades y la búsqueda   de satisfacer sus necesidades para mantener relaciones de corto y largo   plazo. </li>
			<li class="list-group-item"> Innovación: Disposición permanente para crear y mejorar los productos y servicios para garantizar soluciones integrales. </li>
			<li class="list-group-item"> Integridad: Operar de forma honesta y clara, con el propósito de   generar confianza en los clientes, colaboradores y proveedores, de   acuerdo al marco legal. </li>
		</ul>
	</div>
	<div id="principios" class="tab-pane fade">
	<br>
		<ul class="list-group well">
			<li class="list-group-item"> Legalidad: El  personal de ARIOS COLOMBIA S.A.S realiza sus   funciones con el cumplimiento de la normatividad y de las leyes   aplicables en su accionar, así como con respeto a las políticas internas   de la compañía. </li>
			<li class="list-group-item"> Eficiencia: ARIOS COLOMBIA S.A.S busca en todo   momento el mejor uso de los recursos para el cumplimiento de sus metas   en el menor tiempo posible. </li>
			<li class="list-group-item"> Creatividad: El personal de ARIOS   COLOMBIA S.A.S siempre está en busca de ideas novedosas para mejorar su   desempeño y la consecución de los objetivos de la empresa y la   satisfacción del cliente. </li>
			<li class="list-group-item"> Responsabilidad: Todas las personas   que laboran en ARIOS COLOMBIA S.A.S asumen la importancia de sus   decisiones y acciones y se esfuerzan por cumplir con diligencia todos   los encargos recibidos. </li>
			<li class="list-group-item"> Puntualidad: como principio   empresarial, ARIOS COLOMBIA S.A.S reconoce y valora la puntualidad como   forma de realizar mejor el trabajo cotidiano. </li>
		</ul>
	</div>
	<div id="historia" class="tab-pane fade">
	<br>
	<p class="well">
		En el año 2007, ARIOS COLOMBIA S.A.S  fue creada en vista de la   creciente necesidad que tienen algunas empresas ya sean del sector   público o privado para abastecerse de insumos vitales para su   funcionamiento como son: papelería, productos de aseo, artículos de   oficina, papelería en general y la línea institucional. A pesar de ser   un mercado en expansión había sido poco explotado, es por ello que ARIOS   COLOMBIA S.A.S creo una alternativa rápida, dinámica, eficiente y   confiable para suministrar a sus clientes todos estos productos que   demandan para su funcionamiento.
	</br>
	</br>
	Para desarrollar estrategias adecuadas, fue necesario convertirse como distribuidor   autorizado o en su defecto como fabricante, de tal manera que se   obtenían mejores precios y una calidad óptima para llegar al cliente.
	</br>
	</br>
	Desde el momento de su creación ARIOS COLOMBIA S.A.S ha venido desarrollando   estrategias en busca de expandirse por todo el territorio local,   regional y nacional, ampliando su gama de productos y buscando que sea   reconocida por todos sus clientes como una empresa seria, de trayectoria   y en la cual puedan depositar su confianza.
    </p>
    </div>
</div>
@endsection

@section('scripts')
@endsection