<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <div class="card my-4">
            <div class="card-body">
                You're logged in!
            </div>
        </div>
    </x-slot>
</x-app-layout>
