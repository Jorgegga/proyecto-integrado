@inject('autorMus', 'App\Models\Autor')
@inject('musicMet', 'App\Models\Music')
<x-app-layout>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet">
        <style>
            .green-audio-player {
                background-color: #0c171d;
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/green-audio-player.js') }}" defer></script>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $autor->nombre }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Últimos albums de {{ $autor->nombre }}
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
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" title="{{ $item->nombre }}">
                        <a href="{{ route('verAlbum', ['album' => $item->id, 'nombre' => $item->nombre]) }}">
                            <img class="d-block w-40 m-auto img-responsive" src="{{ asset($item->portada) }}"
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
                    @auth
                    <th scope="col">Añadir</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($autorMus->autMusic($autor->id) as $item)

                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <a
                                    href="{{ route('verAlbum', ['album' => $item->album->id, 'nombre' => $item->album->nombre]) }}">{{ $item->album->nombre }}</a>
                            </td>
                            <!-- Los audios cargan correctamente en modo incognito -->
                            <td>
                                <div class="audioExample"><audio preload="auto" id='{{ $item->id }}'
                                        onplay="parar(this.id) " onended="siguiente(this.id)">
                                        <source src="{{ asset($item->ruta) }}" type="audio/ogg">
                                        <source src="{{ asset($item->ruta) }}" type="audio/mp3">
                                        No lo soporta
                                    </audio></div>
                            </td>
                            @auth
                            <td><form method="POST" action="{{route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id])}}" id="anadirPlaylist{{$item->id}}" onsubmit="submitForm(event, {{$item->id}})">
                                @csrf
                                <button type="submit" title="Añadir a tu playlist"><i class="fas fa-plus"></i></button>
                            </form>
                            </td>
                            @endauth
                        </tr>
                @endforeach
            </tbody>
        </table>
        {{$autorMus->autMusic($autor->id)->links()}}
    </x-slot>
    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var audios = document.getElementsByClassName("audioExample");
                for (var i = 0; i < audios.length; i++) {
                    new GreenAudioPlayer(audios[i], {
                        selector: '.player',
                        stopOthersOnPlay: true,
                    });
                }

            });

            function parar(idEl) {
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    try {
                        if (elementos[i].id == idEl) {
                            var playPromise = elementos[i].play();
                            //Es necesario para que no salte error
                            playPromise.then(_ => {

                            }).catch(error => {

                            });

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

            function submitForm(event, id) {
                id = "#anadirPlaylist" + id;
                $.ajax({
                    type: $(id).attr('method'),
                    url: $(id).attr('action'),
                    data: $(id).serialize(),
                    success: function(data) {
                        console.log('Datos enviados !!!');
                    }
                });
                event.preventDefault();
            }

        </script>

    </x-slot>
</x-app-layout>
