<img src='{{ asset($music->portada) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
<div class="form-group">
    <h5 style="color: #EFF3F5;">Nombre</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->nombre }}</p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Descripcion</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->descripcion }}</p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Autor</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->autor->nombre }}
    </p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Albúm</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->album->nombre }}
    </p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Número de canción</h5>
    <p style="background-color:#212E36; color: #C8CDD0;" name="numCancion">{{ $music->numCancion }}</p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Género</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ ucfirst($music->genero->nombre) }}
    </p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Fecha de creación</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->created_at }}
    </p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Fecha de actualización</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $music->updated_at }}
    </p>
</div>
