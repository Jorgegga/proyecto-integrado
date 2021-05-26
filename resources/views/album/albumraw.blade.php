
<table class="table table-sm table-dark">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Pista</th>
        <th scope="col">Canción</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($music as $item)
      <tr>
        <td>{{$item->nombre}}</td>
        <td>{{$item->numCancion}}</td>
        <td><audio controls="true" preload="auto" id='{{ $item->id }}' onplay="parar(this.id)"
            onended="siguiente(this.id)">
            <source src="{{ asset($item->ruta) }}" type="audio/ogg">
            <source src="{{ asset($item->ruta) }}" type="audio/mp3">
            No lo soporta
        </audio></td>
      </tr>
      @endforeach
    </tbody>
  </table>

