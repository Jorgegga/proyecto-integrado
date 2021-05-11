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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 style="color: #EFF3F5">Toda nuestra base de datos de música</h4>
                        <p style="color: #C8CDD0">Aquí la encontrarás</p>
                    </div>
                </div>
            </div>
        </div>
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
                            <!--<td> <a href="{{route('verAutor', ['autor' => $nomAutor->autorComp($item->album_id), 'nombre'=> $nomAutor->autorComp($item->album_id)->nombre])}}"> {{ $nomAutor->autorComp($item->album_id)->nombre }}</a></td>-->
                            <td><a href="{{route('verAutor', ['autor' => $musicMet->nomAutor($item->autor_id), 'nombre' => $musicMet->nomAutor($item->autor_id)->nombre])}}">{{$musicMet->nomAutor($item->autor_id)->nombre}}</a></td>
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
