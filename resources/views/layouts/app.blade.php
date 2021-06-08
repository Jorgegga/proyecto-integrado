<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{URL::asset('storage/img/pagina/keystoneBack.png')}}" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">


    {{ $fonts }}


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    {{ $styles }}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    {{ $scriptsCDN }}


</head>

<body class="font-sans antialiased" style="background-color: #192229">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="d-flex py-3 shadow-sm border-bottom border-secondary col-12">
        <div class="container">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main class="container my-5">
        {{ $cuerpo }}
    </main>

    @include('layouts.footer')

    <script>
        //Posiciona el footer en la parte de abajo a pesar de que la pantalla sea pequeña

        $(document).ready(function() {
            if ($("body").height() < $(window).height()) {
                $("footer").css({
                    "position": "absolute",
                    "bottom": "0px"
                });
            }
        });

        //En caso de cambiar el tamaño de la ventana, ya sea porque la pasamos a otro monitor u otro motivo
        //esto hara que permanezca abajo
        window.onresize = function(event) {
            if ($("body").height() < $(window).height()) {
                $("footer").css({
                    "position": "absolute",
                    "bottom": "0px"
                });
            }
        }

    </script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    {{ $script }}

</body>

</html>
