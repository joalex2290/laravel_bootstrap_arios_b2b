@extends('layouts.app')

@section('title')
{{ trans('organization.crud_name') }} - ARB2B
@endsection

@section('styles')
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">Inicio</a></li>
	<li><a href="{{ url('/shop') }}">Tienda</a></li>
	<li><a href="#">{{ trans('organization.crud_name') }}</a></li>
</ol>
<h4>
	{{ $organization->name  }}    
	<div class="btn-group pull-right">
		<a href="{{ url('/customer/organization/'.$organization->id) }}" class="btn btn-danger" title="Regresar">
			<i class="glyphicon glyphicon-remove"></i>
		</a>
	</div> 
</h4>
<br>
{!! Form::model($organization, [
	'method' => 'PATCH',
	'url' => ['/customer/organization', $organization->id],
	'class' => 'form-horizontal',
	'files' => true
	]) !!}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="text-center">
			<img src="{{asset('img/organizations/'.$organization->avatar_url)}}" class="img-circle" width="250" alt="avatar">
			</br>
			</br>
			<div class="input-group image-preview">
				{!! Form::text('', null, ['class' => 'form-control image-preview-filename', 'disabled' => 'disabled', 'placeholder' => 'Opcional']) !!}
				<span class="input-group-btn">
					<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
					<div class="btn btn-success image-preview-input">
						<span class="glyphicon glyphicon-folder-open"></span>
						<input type="file" accept="image/png, image/jpeg, image/gif" name="avatar_url"/>
						{!! $errors->first('avatar_url', '<p class="help-block">:message</p>') !!}
					</div>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		@include ('customer.organization.form', ['submitButtonText' => 'Actualizar'])

		{!! Form::close() !!}
	</div>
	@endsection

	@section('scripts')
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
				placement:'bottom'
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