@inject('autorMus', 'App\Models\Autor')
@inject('musicMet', 'App\Models\Music')
@inject('playMusic', 'App\Models\Playlist')
<x-app-layout>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet">
        <style>
            .card {
                flex-direction: row;
                align-items: center;
            }

            .card-title {
                font-weight: bold;
            }

            .card img {
                width: 30%;
                border-top-right-radius: 0;
                border-bottom-left-radius: calc(0.25rem - 1px);
            }

            .card-text{
                color: #C8CDD0;
            }

            @media only screen and (max-width: 768px) {
                .card-body {
                    padding: 0.5em 1.2em;
                }

                .card-body .card-text {
                    margin: 0;
                }

                .card img {
                    width: 50%;
                }
            }

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
        <section
            class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeIn"
            id="autores">
            <!--<div class="col-10 pr-3">-->
                <div class="card w-md-75 w-sm-100 fondo-gris">
                    <img src='{{ asset($autor->foto) }}' class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title titulo" style="font-size:1.75em; text-align: left;">
                            {{ $autor->nombre }}</h5>
                        <p class="card-text parrafo" style="font-size:0.9em;">
                            {{ $autor->descripcion }}
                        </p>
                        <p class="card-text">
                            <b>Álbums: </b>{{$autor->album->count('id')}}
                        </p>
                        <p class="card-text float-md-right" style="margin-top: -6%">
                            <b>Temas: </b>{{$autor->music->count('id')}}
                        </p>
                    </div>
                </div>
            <!--</div>-->
        </section>

    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeInDown">
            Últimos albums de {{ $autor->nombre }}
        </h3>
        <div id="ultimosAlbum" class="carousel slide border-bottom border-secondary pb-3 animate__animated animate__fadeIn"  data-ride="carousel">
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
                            <img src="{{asset($item->portada)}}" class="img-responsive d-block m-auto img-peque">
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

        <table class="table table-striped table-dark table-responsive-sm animate__animated animate__fadeInUp mt-4">
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
                            <td>
                                @if($playMusic->musicExist(Auth::user(), $item->id) == 0)
                                <form method="POST"
                                    action="{{ route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id]) }}"
                                    id="anadirPlaylist{{ $item->id }}"
                                    onsubmit="submitForm(event, {{ $item->id }})">
                                    @csrf
                                    <button id="btn{{$item->id}}" type="submit" title="Añadir a tu playlist"><i
                                            class="fas fa-plus"></i></button>
                                </form>
                                @else
                                <button type="submit" title="Ya esta en tu playlist" disabled><i
                                    class="fas fa-plus"></i></button>
                                @endif
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
                boton = "btn" + id;
                id = "#anadirPlaylist" + id;
                $.ajax({
                    type: $(id).attr('method'),
                    url: $(id).attr('action'),
                    data: $(id).serialize(),
                    success: function(data) {
                        console.log('Datos enviados !!!');
                        document.getElementById(boton).disabled = true;
                        document.getElementById(boton).title = "Ya esta en tu playlist";
                    }
                });
                event.preventDefault();
            }

        </script>

    </x-slot>
</x-app-layout>
