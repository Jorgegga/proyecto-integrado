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
    <p>Asunto: Contacto de empresa</p>
    <p>Titulo: <strong>{{ $mensaje['titulo'] }}</strong> </p>
    <p>{{ $mensaje['mensaje'] }}</p>
</body>
</html>
