<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <style>
            td a:link,
            :focus,
            :active {
                text-decoration: none;
                color: white;
            }

            td a:visited {
                text-decoration: none;
                color: white;
            }

            td a:hover {
                color: lightblue;
            }

            /* Specifies the size of the audio container */
            audio {
                width: 115px;
                height: 25px;
            }

            audio::-webkit-media-controls-panel {
                -webkit-justify-content: center;
                height: 25px;
            }

            /* Removes the timeline */
            audio::-webkit-media-controls-timeline {
                display: none !important;
            }

            /* Removes the time stamp */
            audio::-webkit-media-controls-current-time-display {
                display: none;
            }

            audio::-webkit-media-controls-time-remaining-display {
                display: none;
            }

            .dataTables_wrapper{
                color:white;
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Modificación de tablas') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <button class="btn btn-dark" onclick="cambio('album')">Album</button>
        <button class="btn btn-dark" onclick="cambio('autor')">Autor</button>
        <button class="btn btn-dark" onclick="cambio('music')">Música</button>
        <button class="btn btn-dark" onclick="cambio('genero')">Género</button>
        <button class="btn btn-dark" onclick="cambio('user')">Usuario</button>
        <x-mensajes-alertas></x-mensajes-alertas>
        <div class="w-100 " id="cuerpo">
        </div>
        <a href="{{ route('inicios.index') }}"><button class="btn btn-dark">Volver</button></a>
    </x-slot>
    <x-slot name="script">
        <script>

            window.onload = function() {
                var tabla = parametroTabla();
                $('#cuerpo').load(`${tabla}`);
            };

            //Botones de cambio de tabla
            function cambio(tabla) {
                var link = ruta(tabla);
                console.log(link);
                $('#cuerpo').load(`${link}`);
            }

            //Al realizar alguna acción del crud, regresar a la tabla en la que te encontrabas.
            function parametroTabla() {
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var tabla = urlParams.get('tabla');
                if (tabla == null) {
                    tabla = "{{route('adminAlbum')}}";
                }else{
                    return ruta(tabla);
                }
            }

            //switch con las rutas donde tienes que ir
            function ruta(tabla){
                switch(tabla){
                    case "album":
                    return link = "{{route('adminAlbum')}}";
                    break;
                    case "autor":
                    return link = "{{route('adminAutor')}}";
                    break;
                    case "music":
                    return link = "{{route('adminMusic')}}";
                    break;
                    case "genero":
                    return link = "{{route('adminGenero')}}";
                    break;
                    case "user":
                    return link = "{{route('adminUser')}}";
                    break;
                    default:
                    return link = "{{route('adminAlbum')}}";
                    break;
                }
            }


        </script>
    </x-slot>
</x-adminplantilla>
