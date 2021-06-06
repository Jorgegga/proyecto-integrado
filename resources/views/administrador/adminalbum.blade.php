<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de albums
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-dark mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal"
    data-target="#createForm" role="tab">
    Crear álbum
</button>
<table class="table table-striped table-dark table-responsive-sm animate__animated animate__fadeIn" id="tabla">
    <thead>
        <tr>
            <th scope="col">Portada</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Temas</th>
            <th scope="col">Género</th>
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
                <td>{{ $item->autor->nombre }}</td>
                <td>{{ $item->music->count('id') }}</td>
                <td>{{ ucfirst($item->genero->nombre) }}</td>
                <td>
                    <div class="row">
                        <form name="a" action='{{ route('albums.destroy', $item) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mr-1" type="submit" title="Borrar"><i class="fas fa-trash"></i></button>
                        </form>
                        <button class="mr-1" data-toggle="modal" data-target="#detallesForm"
                            role="tab" title="Detalles" onclick="cargaDetalles('{{ $item->id }}')">
                            <i class="fas fa-book"></i>
                        </button>
                        <button data-toggle="modal" data-target="#updateForm" role="tab" title="Actualizar"
                            onclick="cargaUpdate('{{ $item->id }}')">
                            <i class="fas fa-wrench"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-------------------------------------------Create modal------------------------------------------------------>
<div class="modal fade rounded" id="createForm" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary" style="background-color: #0f2738; color: #EFF3F5;">
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
                            style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4" maxlength="200"
                            name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Autor</h5>
                        <select class="livesearch custom-select mb-sm-5" name="autor" style="width: 100%;">
                            <option value="1" selected="selected">Desconocido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Género</h5>
                        <select class="custom-select" style="background-color:#212E36; color: #C8CDD0; border:none;"
                            name="genero" required>
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
<!--------------------------------------------------------------------------------------------------------------->

<!-------------------------------------------Edit modal------------------------------------------------------>
<div class="modal fade rounded" id="updateForm" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Modificar álbum</h4>
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
<div class="modal fade rounded" id="detallesForm" data-backdrop="static" tabindex="-1"
role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header border-bottom border-primary"
            style="background-color: #0f2738; color: #EFF3F5;">
            <h4 class="modal-title" id="exampleModalLabel">Detalles álbum</h4>
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

    $('.livesearch').select2({
                placeholder: 'Buscar autor',
                dropdownParent: $("#createForm"),

                ajax: {
                    url: "{{ route('autorAuto') }}",
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

    function cargaUpdate(id) {
        var url = "{{ route('albumRawUpdate', ':id') }}";
        url = url.replace(':id', id);
        $('#updateFormCuerpo').load(`${url}`);
        setTimeout(function() {
            $('#autorUpdate').select2({
                placeholder: 'Buscar autor',
                dropdownParent: $("#updateForm"),

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
        }, 750);
    }

    function cargaDetalles(id) {
        var url = "{{ route('albumRawDetalles', ':id') }}";
        url = url.replace(':id', id);
        $('#detallesFormCuerpo').load(`${url}`);
    }

</script>
