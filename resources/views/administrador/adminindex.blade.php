@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">

    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Modificación de albums
        </h3>
        <a href="{{route('admins.create')}}">Crear album</a>
        <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Portada</th>
                <th scope="col">Nombre</th>
                <th scope="col">Autor</th>
                <th scope="col">Temas</th>
                <th scope="col">Genero</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach($album as $item)
              <tr>
                <td><img src='{{asset($item->portada)}}' height="50px"></td>
                <td>{{$item->nombre}}</td>
                <td>{{ $albumMet->nomAutor($item->autor_id) }}</td>
                <td>{{ $albumMet->numTemas($item->id)}}</td>
                <td>{{ucfirst($generoNom->nomGenero($item->genero_id))}}</td>
                <td>{{$item->created_at}}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$album->links()}}
    </x-slot>
    <x-slot name="script">
        <script>

        </script>

    </x-slot>
</x-adminplantilla>
