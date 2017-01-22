<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!--Page Title and icon-->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon"  href="{{ config('app.titleIcon') }}">

        <!-- Styles -->        
        <link href="/css/app.css" rel="stylesheet">

        <!--Font Awesome-->
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        
        <!--Pace-->
        <link rel="stylesheet" href="css/pace.css">

        <!--Jquery ui-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">        


        <!-- Scripts -->        
        <script src="../js/pace.js"></script>

        <script>
            window.Laravel = <?php
            echo json_encode([
                'csrfToken' => csrf_token(),
            ]);
            ?>
        </script>
        
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
                        <a class="navbar-brand" href="{{ url('/paIndicators') }}" title="Indicadores Pronto Atendimento">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </a>
                        <a class="navbar-brand" href="{{ url('/paDataCollect') }}" title="Coleta de Dados Pronto Atendimento">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a class="navbar-brand" href="{{ url('/paTable') }}" title="Visualizar a tabela com os dados preenchidos">
                            <i class="fa fa-table" aria-hidden="true"></i>
                        </a>

                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <a class="navbar-brand" style="margin-left: 20px;">
                            <p>Pronto Atendimento</p>
                        </a>
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

            @can('Pronto Atendimento')

            @yield('content')

            @else    
            <div class='container'>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading text-center">Acesso Negado</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <p>Você não tem autorização para acessar esta página, contate o administrador do sistema.</p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @endcan

        </div>

        <!-- Scripts -->
        <script src="../js/app.js"></script>

        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript">
                                               $(document).ready(function () {
                                               $('input:text').bind({

                                               });
                                               $.ui.autocomplete.prototype._renderItem = function (ul, item) {
                                               item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
                                               return $("<li></li>")
                                                       .data("item.autocomplete", item)
                                                       .append("<a>" + item.label + "</a>")
                                                       .appendTo(ul);
                                               };
                                               $('#medicoPA').autocomplete({
                                               minLength: 1,
                                                       autoFocus: true,
                                                       source: '{{URL('selectDoctors')}}',
                                                       });
                                               $('#medicoEspecialista').autocomplete({
                                               minLength: 1,
                                                       autoFocus: true,
                                                       source: '{{URL('selectDoctors')}}'
                                                       });
                                               });
        </script>
    </body>
</html>
