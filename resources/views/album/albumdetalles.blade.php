@inject('musicMet', 'App\Models\Music')
<x-app-layout>
    <x-slot name="fonts">
    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="h4 font-semibold text-white">
            {{$album->nombre}}
        </h2>
        <div style="display: flex; align-items:center;">
        <img src='{{ asset($album->portada) }}' class="img-thumbnail img-fluid" alt="Responsive image" style="height: 200px;">
        <p class="ml-3" style="color: #C8CDD0;">{{$album->descripcion}}</p>
    </div>
    </x-slot>

    <x-slot name="cuerpo">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Album</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Pista</th>
                    <th scope="col">Play</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($musica as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            {{$album->nombre}}
                        </td>
                        <td><a href="{{route('verAutor', ['autor' => $musicMet->nomAutor($item->autor_id), 'nombre' => $musicMet->nomAutor($item->autor_id)->nombre])}}">{{$musicMet->nomAutor($item->autor_id)->nombre}}</a></td>
                        <td>{{ $item->numCancion }}</td>
                        <td><audio controls="true" preload="auto" id='{{ $item->id }}' onplay="parar(this.id)"
                            onended="siguiente(this.id)">
                            <source src="{{ asset($item->ruta) }}" type="audio/ogg">
                            <source src="{{ asset($item->ruta) }}" type="audio/mp3">
                            No lo soporta
                        </audio>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="script">
        <script>
            function parar(idEl) {
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    try {
                        if (elementos[i].id == idEl) {
                            elementos[i].play();

                        } else {
                            elementos[i].pause();
                        }
                    } catch (e) {
                        console.log("Error " + e)
                    }
                }
            }

            function siguiente(id) {
                id = parseInt(id);
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    if (elementos[i].id == id) {
                        try {
                            if (elementos[i + 1] != null) {
                                elementos[i + 1].play();
                            } else {
                                console.log("Fin de la lista");
                            }
                        } catch (e) {
                            console.log("Error " + e)
                        }
                    } else {
                        elementos[i].pause();
                    }
                }
            }

        </script>
    </x-slot>
</x-app-layout>
