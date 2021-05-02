<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Últimos álbums añadidos
        </h3>
        <div id="ultimosAlbum" class="carousel slide border-bottom border-secondary pb-3" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($albumNew as $item)
                    <li data-target="#ultimosAlbum" data-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($albumNew as $item)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}"  title="{{$item->nombre}}">
                        <a href="{{route('verAlbum', ['album' => $item, 'nombre'=> $item->nombre])}}">
                        <img class="d-block w-50 m-auto"  src="{{ asset($item->portada) }}"
                            style="height:600px; width:600px">
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#ultimosAlbum" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#ultimosAlbum" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="container p8">
            <h3 class="font-semibold text-xl text-white leading-tight text-center">
                Últimos álbums añadidos
            </h3>
            <div class="resCarousel" data-items="2-4-4-4" data-interval="2000" data-slide="1" data-animator="lazy">
                <div class="resCarousel-inner">
                    @foreach ($albumNew as $item)
                    <div class="item">
                        <div class="tile">
                            <img src="{{asset($item->portada)}}" style="height:300px; width:300px">
                        </div>
                    </div>
                    @endforeach

                </div>
                <button class='btn btn-default leftRs'><</button>
                <button class='btn btn-default rightRs'>></button>
            </div>
        </div>

    </x-slot>
</x-app-layout>
