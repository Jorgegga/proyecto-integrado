<form name="a" action="{{ route('autores.update', $autor) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" style="background-color: #192229">
                    <img src='{{ asset($autor->foto) }}'
                        class="mx-auto d-block img-fluid w-50 mb-3" height="50px">

                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Nombre</h5>
                        <input type="text" class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0;" title="" name="nombre"
                            value="{{ $autor->nombre }}" required/>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Descripcion</h5>
                        <textarea class="form-control border-0"
                            style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4"
                            maxlength="200"
                            name="descripcion">{{ $autor->descripcion }}</textarea>
                    </div>
                    <div class="form-group">
                        <h5 style="color: #EFF3F5;">Género</h5>
                        <select class="custom-select"
                            style="background-color:#212E36; color: #C8CDD0; border:none;"
                            name="genero" required>
                            @foreach ($genero as $item2)
                                @if ($item2->id == $autor->genero_id)
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
