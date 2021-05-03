@inject('musicMet', 'App\Models\Music')
@inject('nomAutor', 'App\Models\Autor')
<x-app-layout>
    <x-slot name="fonts">
    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Música') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Álbum</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Play</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($musica as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <a href="{{ route('verAlbum', ['album' => $musicMet->nomAlbum($item->album_id)[0],
                                    'nombre' => $musicMet->nomAlbum($item->album_id)[0]->nombre]) }}">{{ $musicMet->nomAlbum($item->album_id)[0]->nombre }}</a>
                            </td>
                            <td>{{ $nomAutor->nomAutor($item->album_id) }}</td>
                            <!-- Los audios cargan correctamente en modo incognito -->
                            <td><audio controls preload="auto">
                                    <source src="{{asset($item->ruta) }}" type="audio/ogg">
                                        No lo soporta
                                </audio>
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
    </x-slot>
</x-app-layout>
