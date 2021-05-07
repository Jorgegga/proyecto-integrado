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
                        <td><audio controls preload="auto"><source src="{{ $item->ruta }}" type="audio/mpeg"></audio></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-app-layout>
