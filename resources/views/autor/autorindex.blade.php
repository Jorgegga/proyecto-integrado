@inject('albumMet', 'App\Models\Album')
<x-app-layout>
    <x-slot name="fonts">
        <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Álbums') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->
            @foreach ($autor as $item)
            <a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}">
                <div class="card col-md-3 col-sm-3 mr-sm-5 mr-md-5 pt-3 mt-4"
                    style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold;">
                    <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap" style="height:300px;">
                    <div class="card-body align-items-center">
                        <p class="card-title" style="font-size:1.2vw; text-align: center; color: #C8CDD0">
                            {{ $item->nombre }}</p>
                    </div>
                    <div class="card-footer text-center mt-auto" style="background-color:#212E36;">
                        <p><a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}" class="btn btn-primary mb-4">Escuchar</a></p>
                        <p class="text-muted text-left" style="float:left;">{{ $albumMet->nomAutor($item->autor_id) }}</p>
                        <p class="text-muted text-right" style="float:right;">{{ $albumMet->numTemas($item->id)}} temas</p>
                    </div>
                </div>
            </a>
            @endforeach
            <!--</div>-->
        </section>
        {{ $album->links() }}
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-app-layout>
