<x-app-layout>
    <x-slot name="fonts">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong:300,400,400i,500,600,700" />
    </x-slot>
    <x-slot name="styles">
        <link href="{{asset('css/resCarousel.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
    </x-slot>
    <x-slot name="scriptsCDN">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </x-slot>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-white leading-tight titulo-align">
            {{ __('Inicio') }}
        </h2>

    </x-slot>
    <x-slot name="cuerpo">
        <div class="py-12 animate__animated animate__fadeInDown">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2 fondo-gris">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 class="titulo">¡Bienvenido a la página principal!</h4>
                        <p class="parrafo">Aquí encontraras los últimos álbums que hemos añadido a nuestro repertorio junto con alguna cosilla más, ¡disfrutalos!</p>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn mb-3">
            Últimos álbums añadidos
        </h3>
        <!--A este paquete de animaciones al parecer no le gusta el carousel de bootstrap y si pones una animacion desde los lados
        la pagina recibe una embolia y todos los elementos de la pagina reciben animaciones raras-->
        <div id="ultimosAlbum" class="carousel slide border-bottom border-secondary pb-3 animate__animated animate__fadeIn"  data-ride="carousel">
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
                            <img src="{{asset($item->portada)}}" class="img-responsive d-block m-auto img-peque">
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

        <div class="container p8 mt-4 animate__animated animate__fadeInUp">
            <h3 class="font-semibold text-xl text-white leading-tight text-center">
                Últimos autores añadidos
            </h3>
            <div class="resCarousel" data-items="2-4-4-4" data-interval="2000" data-slide="2" data-animator="lazy">
                <div class="resCarousel-inner">
                    @foreach ($autorNew as $item)
                    <a href="{{route('verAutor', ['autor' => $item, 'nombre'=> $item->nombre])}}">
                    <div class="item" title="{{$item->nombre}}">
                        <div class="tile">
                            <img src="{{asset($item->foto)}}" class="carousel2img img-responsive ">
                        </div>
                    </div>
                </a>
                    @endforeach

                </div>
                <button class='btn btn-light leftRs' style="opacity: 0.4"><</button>
                <button class='btn btn-light rightRs' style="opacity: 0.4">></button>
            </div>
        </div>

    </x-slot>
    <x-slot name="script">
        <script src="{{asset('js/dashboard.js')}}"></script>
        <script src="{{asset('js/resCarousel.js')}}"></script>
    </x-slot>
</x-app-layout>
