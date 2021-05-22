@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
@inject('nomAutor', 'App\Models\Autor')
<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <style>
            td a:link,:focus,:active {
                text-decoration: none;
                color: white;
            }
            td a:visited{
                text-decoration: none;
                color: white;
            }
            td a:hover{
                color: lightblue;
            }
        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <button class="btn btn-primary" onclick="cambio('album')">Album</button>
        <button class="btn btn-primary" onclick="cambio('autor')">Autor</button>
        <button class="btn btn-primary" onclick="cambio('music')">Música</button>
        <div class="w-100 " id="cuerpo">
        </div>
        <a href="{{ route('inicios.index') }}"><button class="btn btn-primary">Volver</button></a>
    </x-slot>
    <x-slot name="script">
        <script>
            window.onload = function(){
                var tabla = parametroTabla();
                    $('#cuerpo').load(`/tablas/${tabla}`);
                    var active = `li1`;
                setTimeout(function(){document.getElementById(`${active}`).className += " active"}, 750);
                };

            function cambio(tabla){
                $('#cuerpo').load(`/tablas/${tabla}`);
                active = `li1`;
                setTimeout(function(){document.getElementById(`${active}`).className += " active"}, 750);
            }

            function carga(id, nombre){
                $('#cuerpo').load(`/tablas/${nombre}?page=${id}`);
                var active = `li${id}`;
                setTimeout(function(){document.getElementById(`${active}`).className += " active"}, 750);
                }

            function parametroTabla(){
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var tabla = urlParams.get('tabla');
                if(tabla == null){
                    tabla = 'album';
                }
                return tabla;
            }
        </script>
    </x-slot>
</x-adminplantilla>
