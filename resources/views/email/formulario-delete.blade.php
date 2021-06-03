<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje nuevo</title>
</head>
<body>
    <p>Nuevo mensaje de: {{ $mensaje['correo']}}</p>
    <p>Asunto: <strong>Borrar album/canción</strong></p>
    <p>Elemento: <strong>{{$mensaje['options']}}</strong> </p>
    <p>Titulo: <strong>{{$mensaje['titulo']}}</strong></p>
    <p>Autor: <strong>{{$mensaje['autor']}}</strong></p>
    <p>{{ $mensaje['mensaje'] }}</p>
</body>
</html>
