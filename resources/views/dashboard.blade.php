<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Pantalla principal') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Toda la música del momento
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
