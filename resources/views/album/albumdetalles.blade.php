<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{$album->nombre}}
        </h2>
        <div style="display: flex; align-items:center;">
        <img src='{{ asset($album->portada) }}' class="img-thumbnail img-fluid" alt="Responsive image" style="height: 200px;">
        <p class="ml-3">{{$album->descripcion}}</p>
    </div>
    </x-slot>

    <x-slot name="cuerpo">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Album</th>
                    <th scope="col">Autor</th>
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
                        <td>{{ $item->autor }}</td>
                        <td><audio controls preload="auto"><source src="{{ $item->ruta }}" type="audio/mpeg"></audio></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
