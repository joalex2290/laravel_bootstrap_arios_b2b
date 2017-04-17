@foreach (['success','danger','warning','info'] as $msg)
@if(Session::has('alert-' . $msg))
<div  id="alert" class="alert alert-{{$msg}} alert-dismissable fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<i class="glyphicon glyphicon-exclamation-sign"></i> {{Session::get('alert-' . $msg)}}
</div>
@endif
@endforeach
@if ($errors->any())
<div  id="alert" class="alert alert-danger alert-dismissable fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	@foreach ($errors->all() as $error)
	<p> <i class="glyphicon glyphicon-exclamation-sign"></i> {{ $error }}</p>
	@endforeach
</div>
@endif
<div id="alert" class="alert hidden"></div>
