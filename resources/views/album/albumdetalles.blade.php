<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{$album->nombre}}
        </h2>
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
                        <td>----</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
