<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de autor
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-dark mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal" data-target="#createFormaut" role="tab">
    Crear autor
</button>
<table class="table table-striped table-responsive-sm table-dark  animate__animated animate__fadeIn" id="tabla">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Género</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($autor as $item)
            <tr>
                <td><img src='{{ asset($item->foto) }}' height="50px" width="50px"></td>
                <td><a
                        href="{{route('verAutor', ['autor' => $item->id, 'nombre'=> $item->nombre])}}">{{ $item->nombre }}</a>
                </td>
                <td>{{ ucfirst($item->genero->nombre) }}</td>
                <td>
                    <div class="row">
                        <form name="a" action='{{ route('autores.destroy', $item) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mr-1" type="submit" title="Borrar"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        <button class="mr-1" data-toggle="modal" data-target="#detallesFormaut" onclick="cargaDetalles('{{ $item->id }}')"
                            role="tab" title="Detalles">
                            <i class="fas fa-book"></i>
                        </button>
                        <button data-toggle="modal" data-target="#updateFormaut" role="tab" onclick="cargaUpdate('{{ $item->id }}')"
                            title="Actualizar">
                            <i class="fas fa-wrench"></i>
                        </button>
                    </div>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>

<div class="modal fade rounded" id="createFormaut" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Crear autor</h4>
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
                            style="background-color:#212E36; color: #C8CDD0; border:none;" name="genero" required>
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

<div class="modal fade rounded" id="updateFormaut" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom border-primary"
                style="background-color: #0f2738; color: #EFF3F5;">
                <h4 class="modal-title" id="exampleModalLabel">Modificar autor</h4>
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
<div class="modal fade rounded" id="detallesFormaut" data-backdrop="static"
tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header border-bottom border-primary"
            style="background-color: #0f2738; color: #EFF3F5;">
            <h4 class="modal-title" id="exampleModalLabel">Detalles autor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="detallesFormCuerpo" style="background-color: #192229">


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

    function cargaUpdate(id) {
        var url = "{{ route('autorRawUpdate', ':id') }}";
        url = url.replace(':id', id);
        $('#updateFormCuerpo').load(`${url}`);
    }

    function cargaDetalles(id) {
        var url = "{{ route('autorRawDetalles', ':id') }}";
        url = url.replace(':id', id);
        $('#detallesFormCuerpo').load(`${url}`);
    }
</script>
