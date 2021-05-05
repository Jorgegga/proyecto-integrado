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
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeInLeft" id="autores">
            <!--<div class="col-10 pr-3">-->
            @foreach ($autor as $item)
                <div class="card mb-5 w-100" style="background-color:#212E36;">
                    <img src='{{asset($item->foto)}}'
                        class="card-img-top"/>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:1.75vw; text-align: left; color: #EFF3F5">{{$item->nombre}}</h5>
                        <p class="card-text" style="font-size:0.9vw; color: #C8CDD0">
                            {{$item->descripcion}}
                        </p>
                        <a href="{{route('verAutor', ['autor' => $item, 'nombre'=> $item->nombre])}}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
            <!--</div>-->
        </section>

    </x-slot>
    <x-slot name="script">
        <script>
            let page = 2;
            let bool = true;
            window.onscroll = () => {
            if (((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) && (bool == true)) {
                    bool = false;
                    const section = document.getElementById('autores');

                    // Pedir al servidor
                    fetch(`/autor/pagination?page=${page}`, {
                        method: 'get'
                    })
                    .then(response => response.text())
                    .then(htmlContent => {
                        // Respuesta en HTML
                        if(htmlContent != ""){
                            section.innerHTML += htmlContent;
                            page += 1;
                            bool = true;
                        }

                    })
                    .catch(err => console.log(err));
                }
            }
        </script>
    </x-slot>
</x-app-layout>
