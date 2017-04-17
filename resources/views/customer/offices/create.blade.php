@extends('layouts.app')

@section('title')
Crear {{ trans('office.crud_name') }} - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">Inicio</a></li>
	<li><a href="{{ url('/shop') }}">Tienda</a></li>
	<li><a href="{{ url('/customer/offices') }}">{{ trans('office.crud_name') }}</a></li>
	<li><a href="#">Crear {{ trans('office.crud_name') }}</a></li>
</ol>
<h4>Crear {{ trans('office.crud_name') }}
	<div class="btn-group pull-right">
		<a href="{{ url('/customer/offices/') }}" class="btn btn-danger" title="Regresar">
			<i class="glyphicon glyphicon-remove"></i>
		</a>
	</div>
</h4>
<br>
{!! Form::open(['url' => '/customer/offices', 'class' => 'form-horizontal', 'files' => true]) !!}

@include ('customer.offices.form')

{!! Form::close() !!}
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		getDepartmentCities();
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
</script>
<script type="text/javascript">
	$(document).on('click', '#close-preview', function(){ 
		$('.image-preview').popover('hide');    
		$('.image-preview').hover(
			function () {
				$('.image-preview').popover('show');
			}, 
			function () {
				$('.image-preview').popover('hide');
			}
			);    
	});
	$(function() {

		var closebtn = $('<button/>', {
			type:"button",
			text: 'x',
			id: 'close-preview',
			style: 'font-size: initial;',
		});
		closebtn.attr("class","close pull-right");
		$('.image-preview').popover({
			trigger:'manual',
			html:true,
			title: "<strong>Vista previa</strong>"+$(closebtn)[0].outerHTML,
			content: "No hay imagen",
			placement:'left'
		});
		$('.image-preview-clear').click(function(){
			$('.image-preview').attr("data-content","").popover('hide');
			$('.image-preview-filename').val("");
			$('.image-preview-clear').hide();
			$('.image-preview-input input:file').val("");
			$(".image-preview-input-title").text("Browse"); 
		}); 
		$(".image-preview-input input:file").change(function (){     
			var img = $('<img/>', {
				id: 'dynamic',
				width:250,
				height:200
			});      
			var file = this.files[0];
			var reader = new FileReader();
			reader.onload = function (e) {
				$(".image-preview-input-title").text("Change");
				$(".image-preview-clear").show();
				$(".image-preview-filename").val(file.name);            
				img.attr('src', e.target.result);
				$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
			}        
			reader.readAsDataURL(file);
		});  
	});
</script>
@endsection