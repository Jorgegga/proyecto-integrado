<form name="a" action="{{ route('generos.update', $genero) }}" method="POST" enctype="multipart/form-data">
    <div class="modal-body" style="background-color: #192229">
        <img src='{{ asset($genero->portada) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
        @csrf
        @method('PUT')
        <div class="form-group">
            <h5 style="color: #EFF3F5;">Nombre</h5>
            <input type="text" class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;" title=""
                name="nombre" value="{{ $genero->nombre }}" required />
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
