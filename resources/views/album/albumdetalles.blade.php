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

            @media only screen and (max-width: 768px) {
                a {
                    display: none;
                }

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

            @media only screen and (max-width: 1200px) {
                .card img {
                    width: 40%;
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
                    <img src='{{ asset($album->portada) }}' class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title titulo" style="font-size:1.75em; text-align: left;">
                            {{ $album->nombre }}</h5>
                        <p class="card-text parrafo" style="font-size:0.9em;">
                            {{ $album->descripcion }}
                        </p>
                        <p class="card-text parrafo">
                            <b>Temas: </b>{{$album->music->count('id')}}
                        </p>
                    </div>
                </div>
            <!--</div>-->
        </section>
    </x-slot>

    <x-slot name="cuerpo">
        <table class="table table-striped table-dark table-responsive-sm animate__animated animate__fadeInUp">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Album</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Pista</th>
                    <th scope="col">Play</th>
                    @auth
                        <th scope="col">Añadir</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($musica as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            {{ $album->nombre }}
                        </td>
                        <td><a
                                href="{{ route('verAutor', ['autor' => $item->autor->id, 'nombre' => $item->autor->nombre]) }}">{{ $item->autor->nombre }}</a>
                        </td>
                        <td>{{ $item->numCancion }}</td>
                        <td>
                            <div class="audioExample"><audio preload="auto" id='{{ $item->id }}'
                                    onplay="parar(this.id)" onended="siguiente(this.id)">
                                    <source src="{{ asset($item->ruta) }}" type="audio/ogg">
                                    <source src="{{ asset($item->ruta) }}" type="audio/mp3">
                                    No lo soporta
                                </audio></div>
                        </td>
                        @auth
                            <td>
                                @if ($playMusic->musicExist(Auth::user(), $item->id) == 0)
                                    <form method="POST"
                                        action="{{ route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id]) }}"
                                        id="anadirPlaylist{{ $item->id }}"
                                        onsubmit="submitForm(event, {{ $item->id }})">
                                        @csrf
                                        <button id="btn{{ $item->id }}" type="submit" title="Añadir a tu playlist"><i
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
