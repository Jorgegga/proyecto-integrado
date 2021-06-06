<img src='{{ asset($autor->foto) }}' class="mx-auto d-block img-fluid w-50 mb-3" height="50px">

<h5 style="color: #EFF3F5;">Id</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $autor->id }}</p>

<h5 style="color: #EFF3F5;">Nombre</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $autor->nombre }}</p>

<h5 style="color: #EFF3F5;">Descripcion</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $autor->descripcion }}</p>
<h5 style="color: #EFF3F5;">Género</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ ucfirst($autor->genero->nombre) }}
</p>
<h5 style="color: #EFF3F5;">Fecha de creación</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $autor->created_at }}
</p>
<h5 style="color: #EFF3F5;">Fecha de actualización</h5>
<p class="border-0 rounded p-2" style="background-color:#212E36; color: #C8CDD0;">
    {{ $autor->updated_at }}
</p>
