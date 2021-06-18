<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('inicios.index')}}">
                <img src="{{URL::asset('storage/img/pagina/logo.png')}}" height="50" width="200">
            </a>
        </x-slot>

        <div class="card-body">
            <div class="mb-4 texto">
                {{ __('¿Olvidaste tu contraseña? Pon tu correo y nosotros nos ocupamos del resto') }}
            </div>

            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-3" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                    <div class="form-group">
                        <x-label for="email" :value="__('Email')" class="texto"/>

                        <x-input id="email" type="email" name="email" :value="old('email')" class="form-control inputOscuro " style="background-color:#212E36; color: #C8CDD0;" required autofocus />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <x-button class="boton">
                            {{ __('Mandar correo') }}
                        </x-button>
                        <a href="{{route('login')}}" class="btn boton texto ml-3">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
