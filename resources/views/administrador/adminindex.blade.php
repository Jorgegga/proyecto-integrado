@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
@inject('nomAutor', 'App\Models\Autor')
<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <style>
            td a:link,:focus,:active {
                text-decoration: none;
                color: white;
            }
            td a:visited{
                text-decoration: none;
                color: white;
            }
            td a:hover{
                color: lightblue;
            }
        </style>
    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Modificación de albums
        </h3>
        <x-mensajes-alertas></x-mensajes-alertas>
        <button class="btn btn-primary mb-2 rounded contact" data-toggle="modal" data-target="#createForm" role="tab">
            Crear álbum
        </button>
        <table class="table table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">Portada</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Temas</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($album as $item)
                    <tr>
                        <td><img src='{{ asset($item->portada) }}' height="50px" width="50px"></td>
                        <td><a
                                href="{{ route('verAlbum', ['album' => $item->id, 'nombre' => $item->nombre]) }}">{{ $item->nombre }}</a>
                        </td>
                        <td>{{ $albumMet->nomAutor($item->autor_id) }}</td>
                        <td>{{ $albumMet->numTemas($item->id) }}</td>
                        <td>{{ ucfirst($generoNom->nomGenero($item->genero_id)) }}</td>
                        <td>
                            <div class="row">
                                <form name="a" action='{{ route('albums.destroy', $item) }}' method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="mr-1" type="submit" title="Borrar"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                                <button class="mr-1" data-toggle="modal" data-target="#detallesForm{{ $item->id }}"
                                    role="tab" title="Detalles">
                                    <i class="fas fa-book"></i>
                                </button>
                                <button data-toggle="modal" data-target="#updateForm{{ $item->id }}" role="tab"
                                    title="Actualizar">
                                    <i class="fas fa-wrench"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-------------------------------------------Edit modal------------------------------------------------------>
                    <div class="modal fade rounded" id="updateForm{{ $item->id }}" data-backdrop="static"
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom border-primary"
                                    style="background-color: #0f2738; color: #EFF3F5;">
                                    <h4 class="modal-title" id="exampleModalLabel">Modificar álbum</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form name="a" action="{{ route('albums.update', $item) }}" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="modal-body" style="background-color: #192229">
                                        <img src='{{ asset($item->portada) }}'
                                            class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <h5 style="color: #EFF3F5;">Nombre</h5>
                                            <input type="text" class="form-control border-0"
                                                style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre"
                                                value="{{ $item->nombre }}" />
                                        </div>
                                        <div class="form-group">
                                            <h5 style="color: #EFF3F5;">Descripcion</h5>
                                            <textarea class="form-control border-0"
                                                style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4"
                                                maxlength="200"
                                                name="descripcion">{{ $item->descripcion }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 style="color: #EFF3F5;">Autor</h5>
                                            <select class="custom-select"
                                                style="background-color:#212E36; color: #C8CDD0; border:none;"
                                                name="autor">
                                                @foreach ($autor as $item2)
                                                    @if ($item2->id == $item->autor_id)
                                                        <option value={{ $item2->id }} selected>
                                                            {{ ucfirst($item2->nombre) }}</option>
                                                    @else
                                                        <option value={{ $item2->id }}>
                                                            {{ ucfirst($item2->nombre) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <h5 style="color: #EFF3F5;">Género</h5>
                                            <select class="custom-select"
                                                style="background-color:#212E36; color: #C8CDD0; border:none;"
                                                name="genero">
                                                @foreach ($genero as $item2)
                                                    @if ($item2->id == $item->genero_id)
                                                        <option value={{ $item2->id }} selected>
                                                            {{ ucfirst($item2->nombre) }}</option>
                                                    @else
                                                        <option value={{ $item2->id }}>
                                                            {{ ucfirst($item2->nombre) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <input class="form-control-file" type="file" name="foto"
                                            style="color: #C8CDD0;" />
                                    </div>
                                    <div class="modal-footer border-primary" style="background-color: #0f2738;">
                                        <button type="submit" class="btn btn-primary"
                                            data-dismiss="modal">Volver</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------Detalles modal------------------------------------------------------>
                    <div class="modal fade rounded" id="detallesForm{{ $item->id }}" data-backdrop="static"
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom border-primary"
                                    style="background-color: #0f2738; color: #EFF3F5;">
                                    <h4 class="modal-title" id="exampleModalLabel">Modificar álbum</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background-color: #192229">
                                    <img src='{{ asset($item->portada) }}'
                                        class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Nombre</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $item->nombre }}</p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Descripcion</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $item->descripcion }}</p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Autor</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $albumMet->nomAutor($item->autor_id) }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Género</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ ucfirst($generoNom->nomGenero($item->genero_id)) }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Nº de temas</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $albumMet->numTemas($item->id) }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Fecha de creación</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $item->created_at }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 style="color: #EFF3F5;">Fecha de actualización</h5>
                                        <p class="form-control border-0"
                                            style="background-color:#212E36; color: #C8CDD0;">
                                            {{ $item->updated_at }}
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer border-primary" style="background-color: #0f2738;">
                                    <button type="submit" class="btn btn-success" data-dismiss="modal">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------------------------------------------------------------->
                @endforeach
            </tbody>
        </table>
        {{ $album->links() }}
        <a href="{{ route('inicios.index') }}"><button class="btn btn-primary">Volver</button></a>

        <div class="modal fade rounded" id="createForm" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="exampleModalLabel">Crear álbum</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="a" action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body" style="background-color: #192229">
                            @csrf
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Nombre</h5>
                                <input type="text" class="form-control border-0"
                                    style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Descripcion</h5>
                                <textarea class="form-control border-0"
                                    style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4"
                                    maxlength="200" name="descripcion"></textarea>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Autor</h5>
                                <select class="custom-select"
                                    style="background-color:#212E36; color: #C8CDD0; border:none;" name="autor">
                                    @foreach ($autor as $item)
                                        <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Género</h5>
                                <select class="custom-select"
                                    style="background-color:#212E36; color: #C8CDD0; border:none;" name="genero">
                                    @foreach ($genero as $item)
                                        <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control-file" type="file" name="foto" style="color: #C8CDD0;" />
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal">Volver</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </x-slot>
    <x-slot name="script">
        <script>

        </script>

    </x-slot>
</x-adminplantilla>
