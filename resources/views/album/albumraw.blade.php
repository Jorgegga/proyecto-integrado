@inject('playMusic', 'App\Models\Playlist')
<section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
    <!--<div class="col-10 pr-3">-->
    <div class="card mb-2" style="background-color:#212E36; width:90%;">
        <img src='{{ asset($album->portada) }}' class="card-img-top" />
        <div class="card-body">
            <h5 class="card-title" style="font-size:1.75vw; text-align: left; color: #EFF3F5" id="cabeceraCard">
                Selecciona una canción</h5>
            <p class="card-text" style="font-size:0.9vw; color: #C8CDD0" id="cuerpoCard"></p>
            <div class="audioExample">
                <audio preload="auto" name="audio" onplay="parar(this.id)" onended="siguiente(this.id)"
                    style="color: black" crossorigin>
                    <source src="" id="oggAudio" type="audio/ogg">
                    <source src="" id="mp3Audio" type="audio/mp3">
                    No lo soporta
                </audio>
            </div>
        </div>
    </div>
    <!--</div>-->
</section>
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Pista</th>
            <th scope="col">Play</th>
            @auth
            <th scope="col">Añadir</th>
            @endauth
        </tr>
    </thead>
    <tbody>
        @foreach ($music as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->numCancion }}</td>
                <td>
                    <button class="circle" name="botonsito" id="{{ $item->id }}"
                        onclick="cabecera( '{{ $item->nombre }}', '{{ $item->ruta }}', '{{ $item->id }}', '{{ $item->autor->nombre }}')"><i
                            class="fas fa-play-circle"></i></button>
                </td>
                @auth
                    <td>
                        @if ($playMusic->musicExist(Auth::user(), $item->id) == 0)
                            <form method="POST"
                                action="{{ route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id]) }}"
                                id="anadirPlaylist{{ $item->id }}" onsubmit="submitForm(event, {{ $item->id }})">
                                @csrf
                                <button id="btn{{ $item->id }}" type="submit" title="Añadir a tu playlist"><i
                                        class="fas fa-plus"></i></button>
                            </form>
                        @else
                            <button type="submit" title="Ya esta en tu playlist" disabled><i
                                    class="fas fa-plus"></i></button>
                        @endif
                    </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>
