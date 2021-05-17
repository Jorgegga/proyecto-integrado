<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{ $fonts }}


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{ $styles }}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{ $scriptsCDN }}


</head>

<body class="font-sans antialiased" style="background-color: #192229">

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

    {{ $script }}

</body>

</html>
