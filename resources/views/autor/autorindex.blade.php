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
        <div class="py-12 animate__animated animate__fadeInDown">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2 fondo-gris">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 class="titulo">Si por el contrario buscas un artista en concreto...</h4>
                        <p class="parrafo">Entonces tenemos una gran base de datos de artistas, ¡quizas descubras
                            alguno nuevo!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-5 col-sm-10 animate__animated animate__fadeInLeft">
                <form name="b" action={{ route('autores.index') }}>
                    <select class="livesearch custom-select w-sm-30 w-md-50 mb-sm-5" name="livesearch"
                        onchange="this.form.submit()">

                    </select>
                </form>
            </div>
            <div class="w-25 animate__animated animate__fadeInLeft">
                <form name="b" action={{ route('autores.index') }}>
                    <select class="custom-select select-generos"
                         name="tematica"
                        onchange="this.form.submit()">
                        <option value="%">Todos</option>
                        @foreach ($genero as $item)
                            @if ($request->tematica == " $item->id")
                                <option value={{ $item->id }} selected>{{ ucfirst($item->nombre) }}</option>
                            @else
                                <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                            @endif
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <section
            class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeInLeft"
            id="autores">
            <!--<div class="col-10 pr-3">-->
            @foreach ($autor as $item)
                <div class="card mb-5 w-100 fondo-gris">
                    <img src='{{ asset($item->foto) }}' class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title titulo" style="font-size:1.75em; text-align: left;">
                            {{ $item->nombre }}</h5>
                        <p class="card-text parrafo" style="font-size:0.9em;">
                            {{ $item->descripcion }}
                        </p>
                        <a href="{{ route('verAutor', ['autor' => $item, 'nombre' => $item->nombre]) }}"
                            class="btn btn-primary">Obras del autor</a>
                    </div>
                </div>
            @endforeach
            <!--</div>-->
        </section>
        @if($request->livesearch != "")
        <div class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 mr-4 animate__animated animate__fadeIn">
        <a href="{{route('autores.index')}}" class="btn btn-primary w-25">Volver</a>
        </div>
        @endif
    </x-slot>
    <x-slot name="script">
        <script>
            let page = 2;
            let bool = true;
            window.onscroll = () => {
                if (((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) && (bool == true)) {
                    bool = false;
                    const section = document.getElementById('autores');
                    //Necesario para hacer el **** paginado con scopes
                    let temat = "<?php echo $request->tematica; ?>"
                    let lives = "<?php echo $request->livesearch; ?>";

                    // Pedir al servidor
                    if (lives == "") {
                        if (temat == null || temat == "%") {
                            fetch(`{{ route('paginAutor') }}?page=${page}`, {
                                    method: 'get'
                                })
                                .then(response => response.text())
                                .then(htmlContent => {
                                    // Respuesta en HTML
                                    if (htmlContent != "") {
                                        section.innerHTML += htmlContent;
                                        page += 1;
                                        bool = true;
                                    }

                                })
                                .catch(err => console.log(err));
                        } else {
                            fetch(`{{ route('paginAutor') }}?tematica=${temat}&page=${page}`, {
                                    method: 'get'
                                })
                                .then(response => response.text())
                                .then(htmlContent => {
                                    // Respuesta en HTML
                                    if (htmlContent != "") {
                                        section.innerHTML += htmlContent;
                                        page += 1;
                                        bool = true;
                                    }

                                })
                                .catch(err => console.log(err));
                        }
                    }
                }
            }

            $('.livesearch').select2({
                placeholder: 'Buscar autor',
                theme: "default",
                ajax: {
                    url: '{{ route('autorAuto') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nombre,
                                    id: item.id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

        </script>
    </x-slot>
</x-app-layout>
