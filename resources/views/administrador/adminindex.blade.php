@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">

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
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Portada</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Temas</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($album as $item)
                    <tr>
                        <td><img src='{{ asset($item->portada) }}' height="50px"></td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $albumMet->nomAutor($item->autor_id) }}</td>
                        <td>{{ $albumMet->numTemas($item->id) }}</td>
                        <td>{{ ucfirst($generoNom->nomGenero($item->genero_id)) }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <form name="a" action='{{ route('albums.destroy', $item) }}' method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
                            <button class="btn btn-primary mb-2 rounded contact" data-toggle="modal" data-target="#updateForm" role="tab">
                                Actualizar
                            </button>
                        </td>
                    </tr>
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
                            <input class="form-control-file" type="file" name="foto" />
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade rounded" id="updateForm" data-backdrop="static" tabindex="-1" role="dialog"
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
                                    style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre" value="{{}}" required>
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
                            <input class="form-control-file" type="file" name="foto" />
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
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
