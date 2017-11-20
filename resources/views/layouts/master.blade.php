<html>

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/img/logo.png') }}?asd=qweq"/>

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <link href="{{ asset('css/smartcart.css') }}" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!--<script src="{{ mix('js/app.js') }}"></script>-->
        <script src="{{ asset('js/app.js') }}"></script>


    </head>

    <body>
        @section('sidebar')
            <!-- Navigation -->
            <nav class="navbar navbar-inverse smartcart-navbar" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--
                        <a class="navbar-brand" href="#">
                            <img src="http://placehold.it/150x50&text=Logo" alt="">
                        </a>
                        -->
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    @if(Auth::check())
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li style="display: @if(!(Auth::user()->isAdminUser() OR Auth::user()->isSuperAdmin())) none @endif">
                                <a href="{{ route('users.index') }}">Operadores</a>
                            </li>
                            <li style="display: @if(!(Auth::user()->isAdminPush() OR Auth::user()->isSuperAdmin())) none @endif">
                                <a href="{{ route('notifications.index') }}">Notificaciones</a>
                            </li>
                            <li style="display: @if(!(Auth::user()->isCashier() OR Auth::user()->isSuperAdmin())) none @endif">
                                <a href="{{ route('purchases.index') }}">Compras</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav" style="float: right;">
                            <li>
                                <a href="{{ route('logout') }}">Cerrar Sesión <i class="fa fa-power-off" aria-hidden="true"></i> </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
        @show

        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class = "alert alert-success">
                <ul>
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
        @endif

        <div class = "container">
            @yield('content')
        </div>

    </body>
</html>