<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Música') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Album</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Play</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($musica as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                @foreach ($album as $item2)
                                    @if ($item->album_id == $item2->id)
                                        {{ $item2->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $item->autor }}</td>
                            <td>----</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!--</div>-->
        </section>
        {{ $musica->links() }}
    </x-slot>
</x-app-layout>
