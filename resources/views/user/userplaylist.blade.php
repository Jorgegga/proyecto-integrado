<x-userplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <style>
            .green-audio-player{
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
            {{ __('Playlist de '.$user->name) }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <x-mensajes-alertas></x-mensajes-alertas>
        <div class="w-100 animate__animated animate__fadeIn table-responsive-sm" id="cuerpo">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Álbum</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Play</th>
                        <th scope="col">Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playlist as $item)
                        <tr>
                            <td>{{ $item->music->nombre }}</td>
                            <td>
                                <a
                                    href="{{ route('verAlbum', ['album' => $item->music->album->id, 'nombre' => $item->music->album->nombre]) }}">{{ $item->music->album->nombre }}</a>
                            </td>
                            <td><a
                                    href="{{ route('verAutor', ['autor' => $item->music->autor->id, 'nombre' => $item->music->autor->nombre]) }}">{{ $item->music->autor->nombre }}</a>
                            </td>
                            <!-- Los audios cargan correctamente en apache y al usar php artisan serve en modo incognito -->
                            <td><div class="audioExample"><audio preload="auto" id='{{ $item->music->id }}' onplay="parar(this.id)"
                                    onended="siguiente(this.id)">
                                    <source src="{{ asset($item->music->ruta) }}" type="audio/ogg">
                                    <source src="{{ asset($item->music->ruta) }}" type="audio/mp3">
                                    No lo soporta
                                </audio></div>
                            </td>
                            <td>
                                    <form method="POST" action="{{ route('playlists.destroy', $item) }}" name="a">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Borrar de tu playlist"><i class="fas fa-minus"></i></button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$playlist->links()}}
        <a href="{{ route('inicios.index') }}"><button class="btn btn-primary">Volver</button></a>

    </x-slot>
    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var audios = document.getElementsByClassName("audioExample");
                for (var i = 0; i<audios.length;i++){
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
                            playPromise.then(_ =>{

                            }).catch(error =>{

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
        </script>
    </x-slot>

</x-userplantilla>
