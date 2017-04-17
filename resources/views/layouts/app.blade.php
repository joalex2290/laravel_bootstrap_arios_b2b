<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('img/favicon.ico')}}">
    <!-- Title -->
    <title>
        @yield('title')
    </title>
    <!-- Styles -->
    <!-- Bootstrap CSS-->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- App CSS-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <!-- Fonts CSS -->
    <link href="{{asset('fonts/font-awesome.min.css')}}" rel="stylesheet">
    @yield('styles')
    <!-- Styles End -->
</head>
<body>
    @include('partials.navbar')
    <!-- Page content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @include('partials.alerts')
            </div>
            <div class="col-lg-3 col-sm-12 content-left">
                @include('partials.menu')
            </div>
            <div class="col-lg-9 col-sm-12 content-right">
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials.footer')
    <!-- JavaScript -->
    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $("#alert").fadeTo(5000, 500).slideUp(500, function(){$("#alert").addClass('hidden');}); 
        });
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
    <script type="text/javascript">
        $('.list-subgroups').on('shown.bs.collapse', function () {
            $('#'+$(this).attr('id')+'-toggle').find("span.glyphicon").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
        });
        $('.list-subgroups').on('hidden.bs.collapse', function () { 
            $('#'+$(this).attr('id')+'-toggle').find("span.glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
        });
    </script>
    <script type="text/javascript">
        $(window).resize(function(){
            if (($(window).width() <= 1024)){
                $("#collapse-menu-all").collapse("hide");
            }
            else{
                $("#collapse-menu-all").collapse("show");
            }
        });
    </script>
    @yield('scripts')
    <!-- Scripts End-->
    <!-- JavaScript End-->
</body>
</html>