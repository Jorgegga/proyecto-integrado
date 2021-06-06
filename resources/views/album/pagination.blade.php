@inject('albumMet', 'App\Models\Album')
@foreach ($album as $item)
    <a href="{{ route('verAlbum', ['album' => $item, 'nombre' => $item->nombre]) }}">
        <div class="card col-md-3 col-sm-7 mr-sm-5 mr-md-5 pt-3 mt-4"
            style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold;">
            <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap" style="height:300px;">
            <div class="card-body align-items-center">
                <p class="card-title" style="font-size:1.5em; text-align: center; color: #EFF3F5">
                    {{ $item->nombre }}</p>
            </div>
            <div class="card-footer text-center mt-auto" style="background-color:#212E36;">
                <p><a href="{{ route('verAlbum', ['album' => $item->id, 'nombre' => $item->nombre]) }}"
                        class="btn btn-primary mb-1">Ir al álbum</a></p>
                <p><button class="btn btn-success" data-toggle="modal" data-target="#albumRaw" role="tab" title="Raw"
                        onclick="carga('{{ $item->id }}', '{{ $item->nombre }}')">Modo
                        ventana</button></p>
                <a href="{{ route('verAutor', ['autor' => $item->autor->id, 'nombre' => $item->autor->nombre]) }}"
                    class="text-muted text-left" style="float:left;">
                    {{ $item->autor->nombre }}</a>
                <p class="text-muted text-right" style="float:right;">
                    {{ $item->music->count('id') }}
                    temas</p>
            </div>
        </div>
    </a>
@endforeach
