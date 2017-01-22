<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!--Font Awesome-->
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
               
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->        
              
        
        
        
        <script>
            window.Laravel = <?php
            echo json_encode([
                'csrfToken' => csrf_token(),
            ]);
            ?>
        </script>

        @yield('script')

    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <i class="fa fa-home" aria-hidden="true" title="Página Inicial"></i>
                        </a>                        
                        @yield('navbarIcons')
                    </div>


                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right  bg-success">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Entrar</a></li>
                            <li><a href="{{ url('/register') }}">Registrar</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ config('app.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Perfil</a>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Sair
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>

                    </div>

                </div>
            </nav>
            @yield('content')

        </div>
        <!-- Scripts -->
        <script src="../js/app.js"></script>        
        @yield('underScript')
    </body>
</html>
