<x-app-layout>
    <x-slot name="fonts">
        <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
    </x-slot>
    <x-slot name="styles">
        <style>
            .card {
                flex-direction: row;
                align-items: center;
            }

            .card-title {
                font-weight: bold;
            }

            .card img {
                width: 30%;
                border-top-right-radius: 0;
                border-bottom-left-radius: calc(0.25rem - 1px);
            }

            @media only screen and (max-width: 768px) {
                a {
                    display: none;
                }

                .card-body {
                    padding: 0.5em 1.2em;
                }

                .card-body .card-text {
                    margin: 0;
                }

                .card img {
                    width: 50%;
                }
            }

            @media only screen and (max-width: 1200px) {
                .card img {
                    width: 40%;
                }
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Artistas') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->
            @foreach ($autor as $item)
                <div class="card mb-5 w-100">
                    <img src='{{asset($item->foto)}}'
                        class="card-img-top"/>
                    <div class="card-body">
                        <h5 class="card-title">{{$item->nombre}}</h5>
                        <p class="card-text">
                            {{$item->descripcion}}
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
            <!--</div>-->
        </section>

    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-app-layout>
