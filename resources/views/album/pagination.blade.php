@inject('albumMet', 'App\Models\Album')
@foreach ($album as $item)
            <a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}">
                <div class="card col-md-3 col-sm-3 mr-sm-5 mr-md-5 pt-3 mt-4"
                    style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold; animate__animated animate__fadeIn">
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
