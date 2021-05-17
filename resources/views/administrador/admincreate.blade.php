<x-adminplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">

    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Creacion de albums') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <h3 class="font-semibold text-xl text-white leading-tight text-center">
            Modificación de albums
        </h3>
        <form route={{route('admins.store')}}>

        </form>
    </x-slot>
    <x-slot name="script">
        <script>

        </script>

    </x-slot>
</x-adminplantilla>
