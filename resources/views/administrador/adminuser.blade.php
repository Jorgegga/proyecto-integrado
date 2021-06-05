@inject('albumMet', 'App\Models\Album')
@inject('generoNom', 'App\Models\Genero')
@inject('nomAutor', 'App\Models\Autor')
@inject('musicMet', 'App\Models\Music')

<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de usuarios
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-dark mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal"
    data-target="#createForm" role="tab">
    Crear usuario
</button>
<table class="table table-striped table-dark table-responsive-sm animate__animated animate__fadeIn" id="tabla">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Pass</th>
            <th scope="col">Permisos</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
            <tr>
                <td><img src='{{ asset($item->foto) }}' height="50px" width="50px"></td>
                <td>{{ ucwords($item->name) }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->password }}</td>
                <td>@if ($item->permisos == 0)
                    Administrador
                @else
                    Usuario
                @endif</td>
                <td>
                    <div class="row">
                        <form name="a" action='{{ route('users.destroy', $item) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mr-1" type="submit" title="Borrar"><i class="fas fa-trash"></i></button>
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

            <!-------------------------------------------Detalles modal------------------------------------------------------>
            <div class="modal fade rounded" id="detallesForm{{ $item->id }}" data-backdrop="static" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom border-primary"
                            style="background-color: #0f2738; color: #EFF3F5;">
                            <h4 class="modal-title" id="exampleModalLabel">Detalles usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="background-color: #192229">
                            <img src='{{ asset($item->foto) }}' class="mx-auto d-block img-fluid w-50 mb-3"
                                height="50px">
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Nombre</h5>
                                <p class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;">
                                    {{ $item->name }}</p>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Email</h5>
                                <p class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;">
                                    {{ $item->email }}
                                </p>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Permisos</h5>
                                <p class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;">
                                    @if ($item->permisos == 0)
                                        Administrador
                                    @else
                                        Usuario
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Fecha de creación</h5>
                                <p class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;">
                                    {{ $item->created_at }}
                                </p>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Fecha de actualización</h5>
                                <p class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;">
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


<div class="modal fade rounded" id="createForm" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary" style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Crear género</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="a" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="background-color: #192229">
                    @csrf
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Nombre</h5>
                        <input type="text" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Email</h5>
                        <input type="email" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" name="email" required />
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Contraseña</h5>
                        <input type="password" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" name="pass" required />
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Permisos</h5>
                        <select type="number" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" name="permisos" required>
                            <option value="0">Administrador</option>
                            <option value="1" selected>Usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Foto</h5>
                        <input class="form-control-file" type="file" name="foto" style="color: #C8CDD0;" />
                    </div>
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
@foreach ($user as $item)
    <div class="modal fade rounded" id="updateForm{{ $item->id }}" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary"
                    style="background-color: #0f2738; color: #EFF3F5;">
                    <h4 class="modal-title" id="exampleModalLabel">Modificar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="a" action="{{ route('users.update', $item) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body" style="background-color: #192229">
                        <img src='{{ asset($item->foto) }}' class="mx-auto d-block img-fluid w-50 mb-3"
                            height="50px">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <h5 style="color: #EFF3F5;">Nombre</h5>
                            <input type="text" class="form-control border-0"
                                style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre"
                                value="{{ $item->name }}" required />
                        </div>
                        <div class="form-group">
                            <h5 style="color: #EFF3F5;">Email</h5>
                            <input type="email" class="form-control border-0" value='{{ $item->email }}'
                                style="background-color:#212E36; color: #C8CDD0;" name="email" required />
                        </div>
                        <div class="form-group">
                            <h5 style="color: #EFF3F5;">Contraseña</h5>
                            <input type="password" class="form-control border-0"
                                style="background-color:#212E36; color: #C8CDD0;" name="pass" />
                        </div>
                        <div class="form-group">
                            <h5 style="color: #EFF3F5;">Permisos</h5>
                            <select class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;"
                                name="permisos" required>
                                @if ($item->permisos == 0)
                                    <option value="0" selected>Administrador</option>
                                    <option value="1">Usuario</option>
                                @else
                                    <option value="0">Administrador</option>
                                    <option value="1" selected>Usuario</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 style="color: #EFF3F5;">Portada</h5>
                            <input class="form-control-file" type="file" name="foto" style="color: #C8CDD0;" />
                        </div>
                    </div>
                    <div class="modal-footer border-primary" style="background-color: #0f2738;">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Volver</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!--------------------------------------------------------------------------------------------------------------->
<script>
    $('#tabla').DataTable();
</script>
