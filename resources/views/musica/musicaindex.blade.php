@inject('musicMet', 'App\Models\Music')
@inject('nomAutor', 'App\Models\Autor')
@inject('generoNom', 'App\Models\Genero')
<x-app-layout>
    <x-slot name="fonts">
    </x-slot>
    <x-slot name="styles">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet" >
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
            {{ __('Música') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <div class="py-12 animate__animated animate__fadeInDown">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 style="color: #EFF3F5">Toda nuestra base de datos de música</h4>
                        <p style="color: #C8CDD0">Aquí la encontrarás</p>
                    </div>
                </div>
            </div>
        </div>
        <section
            class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeIn animate__slow">
            <!--<div class="col-10 pr-3">-->

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Álbum</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Género</th>
                        <th scope="col">Play</th>
                        <th scope="col">Añadir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($musica as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <a
                                    href="{{ route('verAlbum', ['album' => $item->album->id, 'nombre' => $item->album->nombre]) }}">{{ $item->album->nombre }}</a>
                            </td>
                            <td><a
                                    href="{{ route('verAutor', ['autor' => $item->autor->id, 'nombre' => $item->autor->nombre]) }}">{{ $item->autor->nombre }}</a>
                            </td>
                            <td>{{ ucfirst($item->genero->nombre) }}</td>
                            <!-- Los audios cargan correctamente en apache y al usar php artisan serve en modo incognito -->
                            <td><div class="audioExample"><audio preload="auto" id='{{ $item->id }}' onplay="parar(this.id)"
                                    onended="siguiente(this.id)">
                                    <source src="{{ asset($item->ruta) }}" type="audio/ogg">
                                    <source src="{{ asset($item->ruta) }}" type="audio/mp3">
                                    No lo soporta
                                </audio></div>
                            </td>
                            <td><form method="POST" action="{{route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id])}}" id="anadirPlaylist" onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" title="Añadir a tu playlist"><i class="fas fa-plus"></i></button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!--</div>-->
        </section>
        {{ $musica->links() }}
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

            function submitForm(event){
      	$.ajax({
           		type: $('#anadirPlaylist').attr('method'),
                url: $('#anadirPlaylist').attr('action'),
                data: $('#anadirPlaylist').serialize(),
        		success: function (data) { console.log('Datos enviados !!!');}
         	});
           	event.preventDefault();
  	}
        </script>
    </x-slot>
</x-app-layout>
