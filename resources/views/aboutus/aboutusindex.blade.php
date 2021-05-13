<x-app-layout>
    <x-slot name="fonts">

    </x-slot>
    <x-slot name="styles">
        <style>
            .contact {
                background-color: black;
                color: #C8CDD0;
                transition: 0.7s;
            }

            .contact:hover {
                background-color: black;
                color: #C8CDD0;
                opacity: 0.75;
                border-color: blue;
                border-top-color: blue
            }

        </style>
    </x-slot>
    <x-slot name="scriptsCDN">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('About us') }}
        </h2>
    </x-slot>
    <x-slot name="cuerpo">
        <div class="row justify-content-center align-items-center mb-3 rounded animate__animated animate__fadeIn "
            style="background-color:#212E36;">
            <div class="col-md-8 col-xs-12 animate__animated animate__fadeInLeft" style="">
                <h3 style="color: #EFF3F5" class="mt-3">Scarlet Perception</h3>
                <p style="color: #C8CDD0; font-size:17px;">Somos una pequeña página que se dedica a publicar albums de
                    música, muchas de ellas a petición... ¡de vosotros!<br><br>
                    Intentamos pedir permiso a los autores en la medida de lo posible, aunque a veces es imposible
                    contactar con ellos ya que o las canciones son muy antiguas
                    o porque el artista no tiene numero de contacto. Si ves alguna canción tuya que desees que quitemos
                    ¡no dudes en decirlo!</p>
            </div>
            <div class="col-md-3 col-xs-12 animate__animated animate__fadeInRight" style="">
                <img src="{{ asset('/storage/img/aboutus/tenshi1.gif') }}" style="" class="img-responsive pl-4">
            </div>
        </div>
        <p class="border-bottom border-secondary animate__animated animate__fadeIn"></p>
        <div class="row justify-content-center align-items-center mb-3 rounded animate__animated animate__fadeIn "
            style="background-color:#212E36;">
            <div class="col-md-3 col-xs-11 animate__animated animate__fadeInLeft " style="">
                <img src="{{ asset('/storage/img/aboutus/imagen2.gif') }}" style="" class="img-responsive pl-4">
            </div>
            <div class="col-md-8 col-xs-11 animate__animated animate__fadeInRight" style="" align="right">
                <h3 style="color: #EFF3F5" class="mt-3">¿Todavía tienes dudas o simplemente quieres contactar con
                    nosotros?</h3>
                <p style="color: #C8CDD0; font-size:17px;">Aquí abajo te dejamos una serie de formas de hacerlo en caso
                    de que tengas alguna petición.</p>
            </div>
        </div>
        <p class="border-bottom border-secondary animate__animated animate__fadeIn"></p>
        <div class="row justify-content-center align-items-center text-center animate__animated animate__fadeInUp"
            style="background-color:#212E36;">
            <div class="col-10 m-auto text-center animate__animated animate__fadeInUp">
                <h3 style="color: #EFF3F5" class="mt-3">Contacto</h3>
            </div>
            <div class="col-5 m-auto text-center animate__animated animate__fadeInUp">
                <div class="list-group">
                    <button class="btn mb-2 rounded contact" data-toggle="modal" data-target="#añadirForm" role="tab">
                        Añadir canción o albúm
                    </button>
                    <button class="btn mb-2 rounded contact" data-toggle="modal" data-target="#quitarForm" role="tab">
                        Quitar canción o albúm
                    </button>
                    <button class="btn mb-2 rounded contact" data-toggle="modal" data-target="#negocForm" role="tab">
                        Negocios
                    </button>
                    <button class="btn mb-3 rounded contact" data-toggle="modal" data-target="#otrosForm" role="tab">
                        Otros
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade rounded" id="añadirForm" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="exampleModalLabel">Petición para añadir canción o album</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body" style="background-color: #192229">
                            @csrf
                            <h5 style="color: #EFF3F5;">Tipo</h5>
                            <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                <label class="btn btn-dark active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" value="cancion"
                                        checked>Canción
                                </label>
                                <label class="btn btn-dark">
                                    <input type="radio" name="options" id="option2" autocomplete="off"
                                        value="album">Álbum
                                </label>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Título</h5>
                                <input type="text" class="form-control border-0"
                                    placeholder="Pon el nombre de la canción o el álbum"
                                    style="background-color:#212E36; color: #C8CDD0;" title="" required>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Autor</h5>
                                <input type="text" class="form-control border-0" placeholder="Pon el nombre del autor"
                                    style="background-color:#212E36; color: #C8CDD0;" required>
                            </div>
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
                            <button type="button" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade rounded" id="quitarForm" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="exampleModalLabel">Petición para quitar canción o album</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body" style="background-color: #192229">
                            @csrf
                            <h5 style="color: #EFF3F5;">Tipo</h5>
                            <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                <label class="btn btn-dark active">
                                    <input type="radio" name="options" id="option3" autocomplete="off" value="cancion"
                                        checked>Canción
                                </label>
                                <label class="btn btn-dark">
                                    <input type="radio" name="options" id="option4" autocomplete="off"
                                        value="album">Álbum
                                </label>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Título</h5>
                                <input type="text" class="form-control border-0"
                                    placeholder="Pon el nombre de la canción o el álbum"
                                    style="background-color:#212E36; color: #C8CDD0;" title="" required>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Autor</h5>
                                <input type="text" class="form-control border-0" placeholder="Pon el nombre del autor"
                                    style="background-color:#212E36; color: #C8CDD0;" required>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Comentarios adicionales</h5>
                                <textarea class="form-control border-0"
                                    placeholder="Si tienes algo más que comunicarnos"
                                    style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4"
                                    maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
                            <button type="button" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade rounded" id="negocForm" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom border-primary"
                        style="background-color: #0f2738; color: #EFF3F5;">
                        <h4 class="modal-title" id="exampleModalLabel">Petición de negocios</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body" style="background-color: #192229">
                            @csrf
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Nombre de la empresa</h5>
                                <input type="text" class="form-control border-0" placeholder="Nombre de tu empresa"
                                    style="background-color:#212E36; color: #C8CDD0;" title="" required>
                            </div>
                            <div class="form-group">
                                <h5 style="color: #EFF3F5;">Intereses</h5>
                                <textarea class="form-control border-0" placeholder="¿Que oferta de negocios tiene?"
                                    style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="8"
                                    maxlength="400"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-primary" style="background-color: #0f2738;">
                            <button type="button" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="modal fade rounded" id="otrosForm"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom border-primary"
                            style="background-color: #0f2738; color: #EFF3F5;">
                            <h4 class="modal-title" id="exampleModalLabel">Petición de negocios</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body" style="background-color: #192229">
                                @csrf
                                <div class="form-group">
                                    <h5 style="color: #EFF3F5;">Titulo</h5>
                                    <input type="text" class="form-control border-0"
                                        placeholder="Pon el nombre de la canción o el álbum"
                                        style="background-color:#212E36; color: #C8CDD0;" title="" required>
                                </div>
                                <div class="form-group">
                                    <h5 style="color: #EFF3F5;">Descripción</h5>
                                    <textarea class="form-control border-0" placeholder="¿Necesitas algo?"
                                        style="background-color:#212E36; color: #C8CDD0; resize:none;" rows="4"
                                        maxlength="200"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-primary" style="background-color: #0f2738;">
                                <button type="button" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-app-layout>
