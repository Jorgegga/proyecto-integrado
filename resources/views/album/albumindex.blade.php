@inject('albumMet', 'App\Models\Album')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->
            @foreach ($album as $item)
                <div class="card col-md-3 col-sm-3 mr-sm-5 mr-md-5 pt-3 mt-4"
                    style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold;">
                    <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap">
                    <div class="card-body align-items-center">
                        <p class="card-title" style="font-size:1.2vw; text-align: center; color: #C8CDD0">
                            {{ $item->nombre }}</p>
                    </div>
                    <div class="card-footer text-center" style="background-color:#212E36;">
                        <p><a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}" class="btn btn-primary">Ver</a></p>
                        <p class="text-muted text-left" style="float:left;">{{ $item->autor }}</p>
                        <p class="text-muted text-right" style="float:right;">{{ $albumMet->numTemas($item->id)}} temas</p>
                    </div>
                </div>
            @endforeach
            <!--</div>-->
        </section>
        {{ $album->links() }}
    </x-slot>
</x-app-layout>
