@inject('albumMet', 'App\Models\Album')

<x-app-layout>
    <x-slot name="fonts">
        <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
        <div class="text-center position-fixed pr-5 pl-5" style="background-color:#212E36; left: 85%;">
            <h5 class="border-bottom border-secondary" style="color: white">Géneros</h5>
                <form name="b" action={{route('albums.index')}} >
                    <select class="" style="color: black; margin-left:-35%" name="tematica" onchange="this.form.submit()">
                        <option value="%">Todos</option>
                @foreach ($genero as $item)
                    @if($request->tematica == "$item->id")
                    <option value={{$item->id}} selected>{{ucfirst($item->nombre)}}</option>
                    @else
                    <option value={{$item->id}}>{{ucfirst($item->nombre)}}</option>
                    @endif
                @endforeach
            </select>
                </form>

        </div>
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeIn"
            id="albums">
            <!--<div class="col-10 pr-3">-->
            @foreach ($album as $item)
                <a href="{{ route('verAlbum', ['album' => $item, 'nombre' => $item->nombre]) }}">
                    <div class="card col-md-3 col-sm-3 mr-sm-5 mr-md-5 pt-3 mt-4"
                        style="width: 18rem; background-color:#212E36; font-family: 'New Tegomin', serif; font-weight: bold;">
                        <img class="card-img-top" src='{{ asset($item->portada) }}' alt="Card image cap"
                            style="height:300px;">
                        <div class="card-body align-items-center">
                            <p class="card-title" style="font-size:1.2vw; text-align: center; color: #EFF3F5">
                                {{ $item->nombre }}</p>
                        </div>
                        <div class="card-footer text-center mt-auto" style="background-color:#212E36;">
                            <p><a href="{{ route('verAlbum', ['album' => $item, 'nombre' => $item->nombre]) }}"
                                    class="btn btn-primary mb-4">Escuchar</a></p>
                                <p><button class="mr-1" data-toggle="modal" data-target="#albumRaw"
                                    role="tab" title="Raw" onclick="carga({{$item->id}})">Raw</button></p>
                            <p class="text-muted text-left" style="float:left;">
                                {{ $albumMet->nomAutor($item->autor_id) }}</p>
                            <p class="text-muted text-right" style="float:right;">{{ $albumMet->numTemas($item->id) }}
                                temas</p>
                        </div>
                    </div>
                </a>
            @endforeach
            <!--</div>-->
        </section>
        <!--<p><button class="btn btn-primary" id='carga' onclick="carga()"></button></p>-->
        <div class="modal fade rounded" id="albumRaw" data-backdrop="static"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="exampleModalLabel">Álbum</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody" style="background-color: #192229">

                    </div>
                    <div class="modal-footer border-primary" style="background-color: #0f2738;">
                        <button type="submit" class="btn btn-success" data-dismiss="modal">Volver</button>
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
                    if(temat == null || temat == "%"){
                    fetch(`{{route('paginAlbum')}}?page=${page}`, {
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
                    }else{
                        fetch(`{{route('paginAlbum')}}?tematica=${temat}&page=${page}`, {
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
            url: '{{route('albumAuto')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
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
                            elementos[i].play();

                        } else {
                            elementos[i].pause();
                        }
                    } catch (e) {
                        console.log("Error " + e)
                    }
                }
            }

            function siguiente(id) {
                id = parseInt(id);
                var elementos = document.getElementsByTagName('audio');
                for (var i = 0; i < elementos.length; i++) {
                    if (elementos[i].id == id) {
                        try {
                            if (elementos[i + 1] != null) {
                                elementos[i + 1].play();
                            } else {
                                console.log("Fin de la lista");
                            }
                        } catch (e) {
                            console.log("Error " + e)
                        }
                    } else {
                        elementos[i].pause();
                    }
                }
            }

            function carga(id){
                var url = "{{route('albumRaw', ':id')}}";
                url = url.replace(':id', id);
                $('#modalBody').load(`${url}`);
            }

        </script>
    </x-slot>
</x-app-layout>
