@inject('albumMet', 'App\Models\Album')
@inject('playMusic', 'App\Models\Playlist')
<x-app-layout>
    <x-slot name="fonts">
        <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet">
    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="{{ asset('js/green-audio-player.js') }}" defer></script>

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Álbums') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <div class="py-12 animate__animated animate__fadeInDown">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="overflow-hidden shadow-sm rounded pt-2 fondo-gris">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 class="titulo">¡Álbums de todo tipo!</h4>
                        <p class="parrafo">Tenemos una gran selección de álbums que hemos ido añadiendo con el
                            tiempo.<br> Si hay alguno que no está mandanos un correo, ¡y en la medida de lo posible
                            intetaremos añadirlo a nuestro repertorio! </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-5 col-sm-10 animate__animated animate__fadeInLeft">
                <form name="b" action={{ route('albums.index') }}>
                    <select class="livesearch custom-select w-sm-30 w-md-50 mb-sm-5" name="livesearch"
                        onchange="this.form.submit()">
                    </select>
                </form>
            </div>
            <div class="animate__animated animate__fadeInRight col-md-5 col-sm-10 float-right">
                <form name="b" action={{ route('albums.index') }}>
                    <select class="custom-select select-generos" name="tematica"
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

        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeIn"
            id="albums">
            <!--<div class="col-10 pr-3">-->
            @foreach ($album as $item)
                <a href="{{ route('verAlbum', ['album' => $item, 'nombre' => $item->nombre]) }}">
                    <div class="card col-md-3 col-sm-7 mr-sm-5 mr-md-5 pt-3 mt-4 card-style">
                        <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap"
                            style="height:300px;">
                        <div class="card-body align-items-center">
                            <p class="card-title titulo-carta">
                                {{ $item->nombre }}</p>
                        </div>
                        <div class="card-footer text-center mt-auto fondo-gris">
                            <p><a href="{{ route('verAlbum', ['album' => $item->id, 'nombre' => $item->nombre]) }}"
                                    class="btn btn-primary mb-1">Ir al álbum</a></p>
                            <p><button class="btn btn-success" data-toggle="modal" data-target="#albumRaw" role="tab"
                                    title="Raw" onclick="carga('{{ $item->id }}', '{{ $item->nombre }}')">Modo
                                    ventana</button></p>
                            <a href="{{ route('verAutor', ['autor' => $item->autor->id, 'nombre' => $item->autor->nombre]) }}"
                                class="text-muted text-left float-left">
                                {{ $item->autor->nombre }}</a>
                            <p class="text-muted text-right float-right">
                                {{ $item->music->count('id') }}
                                temas</p>
                        </div>
                    </div>
                </a>
            @endforeach
            <!--</div>-->

        </section>
        @if ($request->livesearch != '')
            <div
                class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 mr-4 animate__animated animate__fadeIn">
                <a href="{{ route('albums.index') }}" class="btn btn-primary w-25">Volver</a>
            </div>
        @endif
        <!--<p><button class="btn btn-primary" id='carga' onclick="carga()"></button></p>-->
        <div class="modal fade rounded" id="albumRaw" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary titulo modal-cabecera">
                        <h4 class="modal-title" id="modalHeader">Álbum</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="pararTodo()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-cuerpo" id="modalBody">

                    </div>
                    <div class="modal-footer border-primary modal-cabecera">
                        <button type="submit" class="btn btn-success" data-dismiss="modal"
                            onclick="pararTodo()">Volver</button>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
    <x-slot name="script">
        <script>
            let page = 2;
            let bool = true;
            window.onscroll = () => {
                if (((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) && (bool == true)) {
                    bool = false;
                    const section = document.getElementById('albums');
                    //Necesario para hacer el **** paginado con scopes
                    let temat = "<?php echo $request->tematica; ?>";
                    let lives = "<?php echo $request->livesearch; ?>";
                    console.log(lives);
                    // Pedir al servidor, en caso de que no haya ninguna busqueda hará páginado,
                    // de lo contrario no lo hará
                    if (lives == "") {
                        if (temat == null || temat == "%") {
                            fetch(`{{ route('paginAlbum') }}?page=${page}`, {
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
                            fetch(`{{ route('paginAlbum') }}?tematica=${temat}&page=${page}`, {
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
                placeholder: 'Buscar álbum',
                theme: "default",
                ajax: {
                    url: "{{ route('albumAuto') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nombre + "  |  " + item.autorNom,
                                    id: item.id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            function parar(idEl) {
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    try {
                        if (elementos[i].id == idEl) {
                            var playPromise = elementos[i].play();
                            //Es necesario para que no salte error
                            playPromise.then(_ => {

                            }).catch(error => {

                            });

                        } else {
                            elementos[i].pause();
                        }
                    } catch (e) {
                        console.log("Error " + e)
                    }
                }
            }

            function pararTodo() {
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    try {
                        elementos[i].pause();
                    } catch (e) {
                        console.log("Error " + e)
                    }
                }
            }

            function siguiente(id) {
                id = parseInt(id);
                var elementos = document.getElementsByName("botonsito");
                for (var i = 0; i < elementos.length; i++) {
                    if (elementos[i].id == id) {
                        try {
                            if (elementos[i + 1] != null) {
                                elementos[i + 1].click();
                            } else {
                                console.log("Fin de la lista");
                            }
                        } catch (e) {
                            console.log("Error " + e)
                        }
                    }
                }
            }

            function carga(id, nom) {
                document.getElementById('modalHeader').innerHTML = nom;
                var url = "{{ route('albumRaw', ':id') }}";
                url = url.replace(':id', id);
                $('#modalBody').load(`${url}`);
                setTimeout(function() {
                    new GreenAudioPlayer('.audioExample', {
                        selector: '.player',
                        stopOthersOnPlay: true,
                    });
                }, 750);

            }

            function cabecera(nom, ruta, id, autor) {
                document.getElementById("cabeceraCard").innerHTML = nom;
                document.getElementById("cuerpoCard").innerHTML = autor;
                document.getElementById("oggAudio").src = ruta;
                document.getElementById("mp3Audio").src = ruta;
                var audio = document.getElementsByName("audio")[0];
                audio.id = id;
                audio.src = ruta;
                parar(id);
            }

            function submitForm(event, id) {
                boton = "btn" + id;
                id = "#anadirPlaylist" + id;
                $.ajax({
                    type: $(id).attr('method'),
                    url: $(id).attr('action'),
                    data: $(id).serialize(),
                    success: function(data) {
                        console.log('Datos enviados !!!');
                        document.getElementById(boton).disabled = true;
                        document.getElementById(boton).title = "Ya esta en tu playlist";
                    }
                });
                event.preventDefault();
            }

        </script>
    </x-slot>
</x-app-layout>
