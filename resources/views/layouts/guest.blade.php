<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{URL::asset('storage/img/pagina/keystoneBack.png')}}" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            html{
                background: #0f2738;;
            }
            body{
                background: #192229;
            }
            .boton{
                background:black;
            }
            .inputOscuro{
                background-color:#212E36;
                color: #C8CDD0;
                border-color:gray;
            }
            .texto{
                color: #EFF3F5;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        {{ $slot }}
    </body>
</html>
