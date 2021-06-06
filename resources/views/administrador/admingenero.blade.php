<h3 class="font-semibold text-xl text-white leading-tight text-center animate__animated animate__fadeIn">
    Modificación de géneros
</h3>
<x-mensajes-alertas></x-mensajes-alertas>
<button class="btn btn-dark mb-2 rounded contact  animate__animated animate__fadeIn" data-toggle="modal" data-target="#createForm" role="tab">
    Crear género
</button>
<table class="table table-striped table-responsive-sm table-dark  animate__animated animate__fadeIn" id="tabla">
    <thead>
        <tr>
            <th scope="col">Portada</th>
            <th scope="col">Nombre</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($genero as $item)
            <tr>
                <td><img src='{{ asset($item->portada) }}' height="50px" width="50px"></td>
                <td><a
                        href="">{{ ucwords($item->nombre) }}</a>
                </td>
                <td>
                    <div class="row">
                        <form name="a" action='{{ route('generos.destroy', $item) }}' method="POST">
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
                <h4 class="modal-title" id="exampleModalLabel">Crear género</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="a" action="{{ route('generos.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="background-color: #192229">
                    @csrf
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Nombre</h5>
                        <input type="text" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Portada</h5>
                        <input class="form-control-file" type="file" name="foto"
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
                <h4 class="modal-title" id="exampleModalLabel">Modificar género</h4>
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
                <h4 class="modal-title" id="exampleModalLabel">Detalles género</h4>
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

    function cargaUpdate(id) {
        var url = "{{ route('generoRawUpdate', ':id') }}";
        url = url.replace(':id', id);
        $('#updateFormCuerpo').load(`${url}`);
    }

    function cargaDetalles(id) {
        var url = "{{ route('generoRawDetalles', ':id') }}";
        url = url.replace(':id', id);
        $('#detallesFormCuerpo').load(`${url}`);
    }
</script>
