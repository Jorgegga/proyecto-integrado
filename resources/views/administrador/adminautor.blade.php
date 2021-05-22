@inject('generoNom', 'App\Models\Genero')

<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de autor
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-primary mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal" data-target="#createFormaut" role="tab">
    Crear autor
</button>
<table class="table table-striped table-dark  animate__animated animate__fadeIn">
    <thead>
        <tr>
            <th scope="col">Portada</th>
            <th scope="col">Nombre</th>
            <th scope="col">Género</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($autor as $item)
            <tr>
                <td><img src='{{ asset($item->portada) }}' height="50px" width="50px"></td>
                <td><a
                        href="">{{ $item->nombre }}</a>
                </td>
                <td>{{ ucfirst($generoNom->nomGenero($item->genero_id)) }}</td>
                <td>
                    <div class="row">
                        <form name="a" action='{{ route('autores.destroy', $item) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mr-1" type="submit" title="Borrar"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        <button class="mr-1" data-toggle="modal" data-target="#detallesFormaut{{ $item->id }}"
                            role="tab" title="Detalles">
                            <i class="fas fa-book"></i>
                        </button>
                        <button data-toggle="modal" data-target="#updateFormaut{{ $item->id }}" role="tab"
                            title="Actualizar">
                            <i class="fas fa-wrench"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-------------------------------------------Detalles modal------------------------------------------------------>
            <div class="modal fade rounded" id="detallesFormaut{{ $item->id }}" data-backdrop="static"
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
                                <h5 style="color: #EFF3F5;">Género</h5>
                                <p class="form-control border-0"
                                    style="background-color:#212E36; color: #C8CDD0;">
                                    {{ ucfirst($generoNom->nomGenero($item->genero_id)) }}
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

<nav aria-label="Page navigation example">
<ul class="pagination animate__animated animate__fadeIn">
    @for ($i = 1; $autor->lastpage()>=$i;$i++)
    <li class="page-item" id="li{{$i}}"><button class="page-link" id={{$i}} onclick="carga(this.id, 'autor')">{{$i}}</button></li>
    @endfor
</ul>
</nav>

<div class="modal fade rounded" id="createFormaut" data-backdrop="static" tabindex="-1" role="dialog"
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
            <form name="a" action="{{ route('autores.store') }}" method="POST" enctype="multipart/form-data">
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
                        <h5 style="color: #EFF3F5;">Género</h5>
                        <select class="custom-select"
                            style="background-color:#212E36; color: #C8CDD0; border:none;" name="genero">
                            @foreach ($genero as $item2)
                                <option value={{ $item2->id }}>{{ ucfirst($item2->nombre) }}</option>
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

<!-------------------------------------------Edit modal------------------------------------------------------>
<!--Si el modal no esta aparte no hace el update, no se como ni porque pero ocurre :/-->
@foreach ($autor as $item)
<div class="modal fade rounded" id="updateFormaut{{ $item->id }}" data-backdrop="static"
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
            <form name="a" action="{{ route('autores.update', $item) }}" method="POST"
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
@endforeach
<!--------------------------------------------------------------------------------------------------------------->
