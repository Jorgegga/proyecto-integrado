@foreach ($autor as $item)
                <div class="card mb-5 w-100" style="background-color:#212E36;">
                    <img src='{{asset($item->foto)}}'
                        class="card-img-top"/>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:1.75vw; text-align: left; color: #EFF3F5">{{$item->nombre}}</h5>
                        <p class="card-text" style="font-size:0.9vw; color: #C8CDD0">
                            {{$item->descripcion}}
                        </p>
                        <a href="{{route('verAutor', ['autor' => $item, 'nombre'=> $item->nombre])}}" class="btn btn-primary">Obras del autor</a>
                    </div>
                </div>
            @endforeach
