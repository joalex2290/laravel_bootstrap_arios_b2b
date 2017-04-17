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
        @yield('content')
    </div>
    @include('partials.footer')
    <!-- JavaScript -->
    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- ScrollUp JS -->
    <script src="{{asset('js/jquery.scrollUp.js')}}"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
    @yield('scripts')
    <!-- Scripts End-->
    <!-- JavaScript End-->
</body>
</html>