<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de música
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-dark mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal" data-target="#createForm" role="tab">
    Crear música
</button>
<table class="table table-striped table-dark table-responsive-sm animate__animated animate__fadeIn" id="tabla">
    <thead>
        <tr>
            <th scope="col">Portada</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Álbum</th>
            <th scope="col">Canción</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($music as $item)
            <tr>
                <td><img src='{{ asset($item->portada) }}' height="50px" width="50px"></td>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->autor->nombre }}</td>
                <td>{{ ucfirst($item->album->nombre) }}</td>
                <td><audio controls="true" preload="none" id='{{ $item->id }}' onplay="parar(this.id)" onended="siguiente(this.id)">
                    <source src="{{ asset($item->ruta) }}" type="audio/ogg">
                    <source src="{{ asset($item->ruta) }}" type="audio/mp3">
                    No lo soporta
                </audio></td>

                <td>
                    <div class="row">
                        <form name="a" action='{{ route('musics.destroy', $item) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mr-1" type="submit" title="Borrar"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        <button class="mr-1" data-toggle="modal" data-target="#detallesForm" onclick="cargaDetalles('{{ $item->id }}')"
                            role="tab" title="Detalles">
                            <i class="fas fa-book"></i>
                        </button>
                        <button data-toggle="modal" data-target="#updateForm" role="tab" onclick="cargaUpdate('{{ $item->id }}')"
                            title="Actualizar">
                            <i class="fas fa-wrench"></i>
                        </button>
                    </div>
                </td>
            </tr>




        @endforeach
    </tbody>
</table>



<div class="modal fade rounded" id="createForm" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Crear música</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="a" action="{{ route('musics.store') }}" method="POST" enctype="multipart/form-data">
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
                            style="background-color:#212E36; color: #C8CDD0; border:none;" name="autor" required>
                            @foreach ($autor as $item)
                                <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Album</h5>
                        <select class="custom-select"
                            style="background-color:#212E36; color: #C8CDD0; border:none;" name="album" required>
                            @foreach ($album as $item)
                                <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Número de canción</h5>
                        <input type="number" style="background-color:#212E36; color: #C8CDD0;" name="numCancion" value="0" min="0" required>
                    </div>

                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Género</h5>
                        <select class="custom-select"
                            style="background-color:#212E36; color: #C8CDD0; border:none;" name="genero" required>
                            @foreach ($genero as $item)
                                <option value={{ $item->id }}>{{ ucfirst($item->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Portada</h5>
                        <input class="form-control-file" type="file" name="foto"
                        style="color: #C8CDD0;" />
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Canción</h5>
                        <input class="form-control-file" type="file" name="ruta" accept="audio/mpeg, audio/ogg"
                        style="color: #C8CDD0;" />
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

<div class="modal fade rounded" id="updateForm" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Modificar música</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="updateFormCuerpo">

            </div>

        </div>
    </div>
</div>

<!--------------------------------------------------------------------------------------------------------------->

<!-------------------------------------------Detalles modal------------------------------------------------------>
 <div class="modal fade rounded" id="detallesForm" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Detalles música</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #192229" id="detallesFormCuerpo">

            </div>
            <div class="modal-footer border-primary" style="background-color: #0f2738;">
                <button type="submit" class="btn btn-success" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------->
<script>
    $('#tabla').DataTable();

    $('#autorCreate').select2({
        placeholder: 'Buscar autor',
        dropdownParent: $("#createForm"),
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


    $('#albumCreate').select2({
        placeholder: 'Buscar album',
        dropdownParent: $("#createForm"),
        theme: "default",
        ajax: {
            url: '{{ route('albumAuto') }}',
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

    function cargaUpdate(id) {
        var url = "{{ route('musicRawUpdate', ':id') }}";
        url = url.replace(':id', id);
        $('#updateFormCuerpo').load(`${url}`);
        setTimeout(function() {
            $('#autorUpdate').select2({
                placeholder: 'Buscar autor',
                dropdownParent: $("#updateForm"),
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

        $('#albumUpdate').select2({
        placeholder: 'Buscar album',
        dropdownParent: $("#updateForm"),
        theme: "default",
        ajax: {
            url: '{{ route('albumAuto') }}',
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
        }, 750);
    }

    function cargaDetalles(id) {
        var url = "{{ route('musicRawDetalles', ':id') }}";
        url = url.replace(':id', id);
        $('#detallesFormCuerpo').load(`${url}`);
    }
</script>
