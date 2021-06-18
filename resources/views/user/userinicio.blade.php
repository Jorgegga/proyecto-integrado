<x-userplantilla>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <style>
            .card {
                flex-direction: row;
                align-items: center;
            }

            .card-title {
                font-weight: bold;
            }

            .card img {
                width: 30%;
                border-top-right-radius: 0;
                border-bottom-left-radius: calc(0.25rem - 1px);
            }

            @media only screen and (max-width: 768px) {
                a {
                    display: none;
                }

                .card-body {
                    padding: 0.5em 1.2em;
                }

                .card-body .card-text {
                    margin: 0;
                }

                .card img {
                    width: 50%;
                }
            }

            @media only screen and (max-width: 1200px) {
                .card img {
                    width: 40%;
                }
            }

            .inputOscuro {
                background-color: #212E36;
                color: #C8CDD0;
                font-size: 20px;
            }

            .cabeceraOscura {
                color: #EFF3F5;
            }

            .image-upload>input {
                display: none;
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Área de ' . $user->name) }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <x-mensajes-alertas></x-mensajes-alertas>
        <section
            class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4 animate__animated animate__fadeInLeft"
            id="autores">
            <!--<div class="col-10 pr-3">-->
                <form name="a" action="{{ route('updateUser', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            <div class="card mb-5 w-100" style="background-color:#212E36;">
                <img src='{{ asset($user->foto) }}' class="card-img-top pl-4" />
                <div class="card-body">
                    <div class="form-group">
                        <form name="a" action="" method="POST" enctype="multipart/form-data">
                        <h3 class="cabeceraOscura">Usuario</h3>
                        <input id="inputNombre" name="inputNombre" class="inputOscuro form-control" type="text" style="background-color:#212E36; color: #C8CDD0;"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <h3 class="cabeceraOscura">Contraseña</h3>
                        <input type="password" id="inputPass" name="inputPass" class="inputOscuro form-control" type="text" value="" style="background-color:#212E36; color: #C8CDD0;">
                    </div>
                    <div class="form-group">
                        <h3 class="cabeceraOscura">Correo</h3>
                        <input id="inputEmail" name="inputEmail" class="inputOscuro form-control" type="text" style="background-color:#212E36; color: #C8CDD0;"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <h3 class="cabeceraOscura">Subir foto de perfil</h3>
                        <input class="form-control-file" type="file" accept="image/png, image/jpeg" name="foto" style="color:white">
                    </div>
                    <button id="boton" type="submit" class="btn btn-primary float-right"  >Guardar cambios</button>
                </div>
            </div>

            <!--</div>-->
                </form>
        </section>
    </x-slot>
    <x-slot name="script">

    </x-slot>

</x-userplantilla>
