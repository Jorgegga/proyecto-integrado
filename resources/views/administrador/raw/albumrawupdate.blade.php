        <form name="a" action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body" style="background-color: #192229">
                <img src='{{ asset($album->portada) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <h5 style="color: #EFF3F5;">Nombre</h5>
                    <input type="text" class="form-control border-0" style="background-color:#212E36; color: #C8CDD0;"
                        title="" name="nombre" value="{{ $album->nombre }}" required />
                </div>
                <div class="form-group">
                    <h5 style="color: #EFF3F5;">Descripcion</h5>
                    <textarea class="form-control border-0"
                        style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4" maxlength="200"
                        name="descripcion">{{ $album->descripcion }}</textarea>
                </div>
                <div class="form-group">
                    <h5 style="color: #EFF3F5;">Autor</h5>
                    <select class="livesearch custom-select mb-sm-5" id="autorUpdate" name="autor" style="width: 100%;">
                        <option value="{{ $album->autor_id }}" selected="selected">{{ $album->autor->nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <h5 style="color: #EFF3F5;">Género</h5>
                    <select class="custom-select" style="background-color:#212E36; color: #C8CDD0; border:none;"
                        name="genero" required>
                        @foreach ($genero as $item2)
                            @if ($item2->id == $album->genero_id)
                                <option value={{ $item2->id }} selected>
                                    {{ ucfirst($item2->nombre) }}</option>
                            @else
                                <option value={{ $item2->id }}>
                                    {{ ucfirst($item2->nombre) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <input class="form-control-file" type="file" name="foto" style="color: #C8CDD0;" />
            </div>
            <div class="modal-footer border-primary" style="background-color: #0f2738;">
                <button type="submit" class="btn btn-primary" data-dismiss="modal">Volver</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
