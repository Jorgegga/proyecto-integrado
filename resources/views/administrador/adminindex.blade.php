@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
@inject('nomAutor', 'App\Models\Autor')
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
        <button class="btn btn-primary" onclick="cambio('Album')">Album</button>
        <button class="btn btn-primary" onclick="cambio('Autor')">Autor</button>
        <button class="btn btn-primary" onclick="cambio('Music')">Música</button>
        <button class="btn btn-primary" onclick="cambio('Genero')">Género</button>
        <button class="btn btn-primary" onclick="cambio('User')">Usuario</button>
        <x-mensajes-alertas></x-mensajes-alertas>
        <div class="w-100 " id="cuerpo">
        </div>
        <a href="{{ route('inicios.index') }}"><button class="btn btn-primary">Volver</button></a>
    </x-slot>
    <x-slot name="script">
        <script>
            window.onload = function() {
                var tabla = parametroTabla();
                $('#cuerpo').load(`${tabla}`);
                var active = `li1`;
                setTimeout(function() {
                    document.getElementById(`${active}`).className += " active"
                }, 750);
            };

            function cambio(tabla) {
                switch(tabla){
                    case "Album":
                    var link = "{{route('adminAlbum')}}";
                    break;
                    case "Autor":
                    var link = "{{route('adminAutor')}}";
                    break;
                    case "Music":
                    var link = "{{route('adminMusic')}}";
                    break;
                    case "Genero":
                    var link = "{{route('adminGenero')}}";
                    break;
                    case "User":
                    var link = "{{route('adminUser')}}";
                    break;
                    default:
                    var link = "{{route('adminAlbum')}}";
                    break;
                }
                $('#cuerpo').load(`${link}`);
                active = `li1`;
                setTimeout(function() {
                    document.getElementById(`${active}`).className += " active"
                }, 750);
            }

            function carga(id, nombre) {
                switch(nombre){
                    case "Album":
                    var link = "{{route('adminAlbum')}}";
                    break;
                    case "Autor":
                    var link = "{{route('adminAutor')}}";
                    break;
                    case "Music":
                    var link = "{{route('adminMusic')}}";
                    break;
                    case "Genero":
                    var link = "{{route('adminGenero')}}";
                    break;
                    case "User":
                    var link = "{{route('adminUser')}}";
                    break;
                    default:
                    var link = "{{route('adminAlbum')}}";
                    break;
                }
                link += `?page=${id}`;
                $('#cuerpo').load(link);
                var active = `li${id}`;
                setTimeout(function() {
                    document.getElementById(`${active}`).className += " active"
                }, 750);
            }

            function parametroTabla() {
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var tabla = urlParams.get('tabla');
                console.log(tabla);
                if (tabla == null) {
                    tabla = "{{route('adminAlbum')}}";
                }else{
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
            }


        </script>
    </x-slot>
</x-adminplantilla>
