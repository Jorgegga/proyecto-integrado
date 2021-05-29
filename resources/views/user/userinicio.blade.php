<x-userplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Área de '.$user->name) }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <x-mensajes-alertas></x-mensajes-alertas>
        <div class="w-100 " id="cuerpo">

        </div>
        <a href="{{ route('inicios.index') }}"><button class="btn btn-primary">Volver</button></a>
    </x-slot>
    <x-slot name="script">

    </x-slot>

</x-userplantilla>
