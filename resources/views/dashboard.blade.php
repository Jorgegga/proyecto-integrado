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

        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Inicio') }}
        </h2>

    </x-slot>
    <x-slot name="cuerpo">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 style="color: #EFF3F5">¡Bienvenido a la página principal!</h4>
                        <p style="color: #C8CDD0">Aquí encontraras los últimos álbums que hemos añadido a nuestro repertorio junto con alguna cosilla más, ¡disfrutalos!</p>
                    </div>
                </div>
            </div>
        </div>
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
                        <img class="d-block w-50 m-auto img-responsive"  src="{{ asset($item->portada) }}"
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

        <div class="container p8 mt-4">
            <h3 class="font-semibold text-xl text-white leading-tight text-center">
                Últimos autores añadidos
            </h3>
            <div class="resCarousel" data-items="2-4-4-4" data-interval="2000" data-slide="1" data-animator="lazy">
                <div class="resCarousel-inner">
                    @foreach ($autorNew as $item)
                    <a href="{{route('verAutor', ['autor' => $item, 'nombre'=> $item->nombre])}}">
                    <div class="item">
                        <div class="tile">
                            <img src="{{asset($item->foto)}}" style="height:300px; width:300px" class="img-responsive">
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
        <script>
            //ResCarouselCustom();
            var pageRefresh = true;

            function ResCarouselCustom() {
                var items = $("#dItems").val(),
                    slide = $("#dSlide").val(),
                    speed = $("#dSpeed").val(),
                    interval = $("#dInterval").val()

                var itemsD = "data-items=\"" + items + "\"",
                    slideD = "data-slide=\"" + slide + "\"",
                    speedD = "data-speed=\"" + speed + "\"",
                    intervalD = "data-interval=\"" + interval + "\"";


                var atts = "";
                atts += items != "" ? itemsD + " " : "";
                atts += slide != "" ? slideD + " " : "";
                atts += speed != "" ? speedD + " " : "";
                atts += interval != "" ? intervalD + " " : ""

                //console.log(atts);

                var dat = "";
                dat += '<h4 >' + atts + '</h4>'
                dat += '<div class=\"resCarousel\" ' + atts + '>'
                dat += '<div class="resCarousel-inner">'
                for (var i = 1; i <= 14; i++) {
                    dat += '<div class=\"item\"><div><h1>' + i + '</h1></div></div>'
                }
                dat += '</div>'
                dat += '<button class=\'btn btn-default leftRs\'><i class=\"fa fa-fw fa-angle-left\"></i></button>'
                dat += '<button class=\'btn btn-default rightRs\'><i class=\"fa fa-fw fa-angle-right\"></i></button>    </div>'
                console.log(dat);
                $("#customRes").html(null).append(dat);

                if (!pageRefresh) {
                    ResCarouselSize();
                } else {
                    pageRefresh = false;
                }
                //ResCarouselSlide();
            }

            $("#eventLoad").on('ResCarouselLoad', function() {
                //console.log("triggered");
                var dat = "";
                var lenghtI = $(this).find(".item").length;
                if (lenghtI <= 30) {
                    for (var i = lenghtI; i <= lenghtI + 10; i++) {
                        dat += '<div class="item"><div class="tile"><div><h1>' + (i + 1) + '</h1></div><h3>Title</h3><p>content</p></div></div>'
                    }
                    $(this).append(dat);
                }
            });
        </script>
        <script src="{{asset('js/resCarousel.js')}}"></script>
    </x-slot>
</x-app-layout>
