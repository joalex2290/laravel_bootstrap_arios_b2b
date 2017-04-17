@if($catalogs->count())
@foreach($catalogs as $catalog)
@if($catalog->valid_from <= date('Y-m-d',time()) && $catalog->valid_to >= date('Y-m-d',time()))
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div id="{{$catalog->id}}" class="overlay catalogs">
        <div class="thumbnail">
            <img src="{{asset('img/catalog-default.png')}}" width="150" height="150" />
            <div class="caption">
                <h6>{{$catalog->name}}</h6>
                <small>{{$catalog->valid_from}} a {{$catalog->valid_to}}</small>
            </div>
        </div>
        <div class="check-wrapper"></div>
    </div>
</div>
@else
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div class="thumbnail">
        <img src="{{asset('img/catalog-default.png')}}" width="150" height="150" />
        <div class="caption">
            <h6>{{$catalog->name}} - <small class="text-danger">Inactivo</small></h6>
            <small class="text-danger">{{$catalog->valid_from}} a {{$catalog->valid_to}}</small>
        </div>
    </div>
</div>
@endif
@endforeach
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".overlay.catalogs").click(function () {
            $(".catalogs").find('div.check-wrapper').removeClass('checked-thumbnail ');
            $(this).find('.check-wrapper').addClass('checked-thumbnail ');
            $("input[name='catalog_id']").val($(this).attr('id'));
            $("input[name='get-catalog']").removeAttr('disabled');
            $("#set-catalog").submit();
        });
    });
</script>
@else
<div class="alert alert-warning alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <i class="glyphicon glyphicon-exclamation-sign"></i> Esta sucursal no tiene catalogos asignados.
</div>
@endif