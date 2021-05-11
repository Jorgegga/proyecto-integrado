<x-app-layout>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">

    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('About us') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <div class="row justify-content-center align-items-center mb-3 rounded animate__animated animate__fadeIn " style="background-color:#212E36;">
            <div class="col-5 animate__animated animate__fadeInLeft" style="">
                <h3 style="color: #EFF3F5" class="mt-3" >Scarlet Perception</h3>
                <p style="color: #C8CDD0; font-size:17px;">Somos una pequeña página que se dedica a publicar albums de música, muchas de ellas a petición... ¡de vosotros!<br><br>
                Intentamos pedir permiso a los autores en la medida de lo posible, aunque a veces es imposible contactar con ellos ya que o las canciones son muy antiguas
                o porque el artista no tiene numero de contacto. Si ves alguna canción tuya que desees que quitemos ¡no dudes en decirlo!</p>
            </div>
            <div class="col-5 animate__animated animate__fadeInRight" style="">
                <img src="{{asset('/storage/img/aboutus/tenshi1.gif')}}" style="margin-left:20%" >
            </div>
        </div>
        <p class="border-bottom border-secondary "></p>
        <div class="row justify-content-center align-items-center mb-3 rounded animate__animated animate__fadeIn" style="background-color:#212E36;">
            <div class="col-5 animate__animated animate__fadeInLeft" style="">
                <img src="{{asset('/storage/img/aboutus/imagen2.gif')}}" style="margin-top:-20%" height="400">
            </div>
            <div class="col-5 animate__animated animate__fadeInRight" style="">
                <h3 style="color: #EFF3F5" class="mt-3" >Scarlet Perception</h3>
                <p style="color: #C8CDD0; font-size:17px;">Somos una pequeña página que se dedica a publicar albums de música, muchas de ellas a petición... ¡de vosotros!<br><br>
                Intentamos pedir permiso a los autores en la medida de lo posible, aunque a veces es imposible contactar con ellos ya que o las canciones son muy antiguas
                o porque el artista no tiene numero de contacto. Si ves alguna canción tuya que desees que quitemos ¡no dudes en decirlo!</p>
            </div>

        </div>
    </x-slot>
    <x-slot name="script">
        <script>

        </script>

    </x-slot>
</x-app-layout>
