<img src='{{ asset($genero->portada) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">
<div class="form-group">
    <h5 style="color: #EFF3F5;">Nombre</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $genero->nombre }}</p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Fecha de creación</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $genero->created_at }}
    </p>
</div>
<div class="form-group">
    <h5 style="color: #EFF3F5;">Fecha de actualización</h5>
    <p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
        {{ $genero->updated_at }}
    </p>
</div>
