@inject('albumMet', 'App\Models\Album')
@inject('playMusic', 'App\Models\Playlist')
<x-app-layout>
    <x-slot name="fonts">
        <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
        <link href="{{ asset('css/green-audio-player.css') }}" rel="stylesheet" >
    </x-slot>
    <x-slot name="styles">
        <style>
            .modal-body .card {
                flex-direction: row;
                align-items: center;
            }

            .modal-body .card-title {
                font-weight: bold;
            }

            .modal-body .card img {
                width: 40%;
                border-top-right-radius: 0;
                border-bottom-left-radius: calc(0.25rem - 1px);
            }

            @media only screen and (max-width: 768px) {
                .modal-body a {
                    display: none;
                }

                .modal-body .card-body {
                    padding: 0.5em 1.2em;
                }

                .modal-body .card-body .card-text {
                    margin: 0;
                }

                .modal-body .card img {
                    width: 50%;
                }
            }

            @media only screen and (max-width: 1200px) {
                .modal-body .card img {
                    width: 40%;
                }
            }

            .green-audio-player{
                background-color: #0c171d;
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
                <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <h4 style="color: #EFF3F5">¡Álbums de todo tipo!</h4>
                        <p style="color: #C8CDD0">Tenemos una gran selección de álbums que hemos ido añadiendo con el
                            tiempo.<br> Si hay alguno que no está mandanos un correo, ¡y en la medida de lo posible
                            intetaremos añadirlo a nuestro repertorio! </p>
                    </div>
                </div>
            </div>
        </div>
        <!--<select class="livesearch form-control" name="livesearch"></select>-->
        <div class="w-25 animate__animated animate__fadeInLeft">
            <form name="b" action={{ route('albums.index') }}>
                <select class="custom-select" style="background-color:#212E36; color: #C8CDD0; border:none;float: right;" name="tematica" onchange="this.form.submit()">
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

        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeIn"
            id="albums">
            <!--<div class="col-10 pr-3">-->
            @foreach ($album as $item)
                    <div class="card col-md-3 col-sm-3 mr-sm-5 mr-md-5 pt-3 mt-4"
                        style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold;">
                        <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap"
                            style="height:300px;">
                        <div class="card-body align-items-center">
                            <p class="card-title" style="font-size:1.2vw; text-align: center; color: #EFF3F5">
                                {{ $item->nombre }}</p>
                        </div>
                        <div class="card-footer text-center mt-auto" style="background-color:#212E36;">
                            <p><a href="{{ route('verAlbum', ['album' => $item->id, 'nombre' => $item->nombre]) }}"
                                    class="btn btn-primary mb-1">Escuchar</a></p>
                            <p><button class="btn btn-success" data-toggle="modal" data-target="#albumRaw" role="tab" title="Raw"
                                    onclick="carga('{{ $item->id }}', '{{$item->nombre}}')">Ventana</button></p>
                            <p class="text-muted text-left" style="float:left;">
                                {{ $item->autor->nombre }}</p>
                            <p class="text-muted text-right" style="float:right;">
                                {{ $item->music->count('id') }}
                                temas</p>
                        </div>
                    </div>

            @endforeach
            <!--</div>-->
        </section>
        <!--<p><button class="btn btn-primary" id='carga' onclick="carga()"></button></p>-->
        <div class="modal fade rounded" id="albumRaw" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="modalHeader">Álbum</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="pararTodo()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody" style="background-color: #192229">

                    </div>
                    <div class="modal-footer border-primary" style="background-color: #0f2738;">
                        <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="pararTodo()">Volver</button>
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
                    let temat = "<?php echo $request->tematica; ?>"

                    // Pedir al servidor
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

            $('.livesearch').select2({
                placeholder: 'Select movie',
                ajax: {
                    url: '{{ route('albumAuto') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nombre,
                                    id: item.id
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
                            playPromise.then(_ =>{

                            }).catch(error =>{

                            });

                        } else {
                            elementos[i].pause();
                        }
                    } catch (e) {
                        console.log("Error " + e)
                    }
                }
            }

            function pararTodo(){
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
                    if(elementos[i].id == id){
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

            function cabecera(nom, ruta, id, autor){
                document.getElementById("cabeceraCard").innerHTML = nom;
                document.getElementById("cuerpoCard").innerHTML = autor;
                document.getElementById("oggAudio").src=ruta;
                document.getElementById("mp3Audio").src=ruta;
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
