<img src='{{ asset($album->portada) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">

<h5 style="color: #EFF3F5;">Nombre</h5>
<p class=" border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->nombre }}</p>


<h5 style="color: #EFF3F5;">Descripcion</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->descripcion }}</p>


<h5 style="color: #EFF3F5;">Autor</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->autor->nombre }}
</p>


<h5 style="color: #EFF3F5;">Género</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ ucfirst($album->genero->nombre) }}
</p>


<h5 style="color: #EFF3F5;">Nº de temas</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->music->count('id') }}
</p>


<h5 style="color: #EFF3F5;">Fecha de creación</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->created_at }}
</p>


<h5 style="color: #EFF3F5;">Fecha de actualización</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $album->updated_at }}
</p>
