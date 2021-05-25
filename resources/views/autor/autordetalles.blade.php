@inject('autorMus', 'App\Models\Autor')
@inject('musicMet', 'App\Models\Music')
<x-app-layout>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">

    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $autor->nombre}}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Últimos albums de {{$autor->nombre}}
        </h3>
        <div id="ultimosAlbum" class="carousel slide border-bottom border-secondary pb-3" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($album as $item)
                    <li data-target="#ultimosAlbum" data-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($album as $item)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}"  title="{{$item->nombre}}">
                        <a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}">
                        <img class="d-block w-40 m-auto img-responsive"  src="{{ asset($item->portada) }}"
                            style="height:400px; width:500px">
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#ultimosAlbum" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#ultimosAlbum" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Álbum</th>
                        <th scope="col">Play</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($album as $item)
                    @foreach ($autorMus->autMusic($item->id) as $item2)
                        <tr>
                            <td>{{ $item2->nombre }}</td>
                            <td>
                                <a href="{{ route('verAlbum', ['album' => $musicMet->nomAlbum($item2->album_id)[0],
                                    'nombre' => $musicMet->nomAlbum($item2->album_id)[0]->nombre]) }}">{{ $musicMet->nomAlbum($item2->album_id)[0]->nombre }}</a>
                            </td>
                            <!-- Los audios cargan correctamente en modo incognito -->
                            <td><audio controls="true" preload="auto" id='{{ $item2->id }}' onplay="parar(this.id)">
                                <source src="{{ asset($item2->ruta) }}" type="audio/ogg">
                                <source src="{{ asset($item2->ruta) }}" type="audio/mp3">
                                No lo soporta
                            </audio></td>
                        </tr>
                    @endforeach
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
