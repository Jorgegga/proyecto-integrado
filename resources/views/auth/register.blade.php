<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('inicios.index')}}">
                <img src="{{URL::asset('storage/img/pagina/logo.png')}}" height="50" width="200">
            </a>
        </x-slot>

        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-label for="name" :value="__('Name')" class="texto"/>

                    <x-input id="name" class="form-control inputOscuro" type="text" name="name" :value="old('name')" style="background-color:#212E36; color: #C8CDD0;" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <x-label for="email" :value="__('Email')" class="texto"/>

                    <x-input id="email" class="form-control inputOscuro" type="email" name="email" :value="old('email')" style="background-color:#212E36; color: #C8CDD0;" required />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-label for="password" :value="__('Contraseña')" class="texto"/>

                    <x-input id="password" type="password"
                                    name="password" class="form-control inputOscuro"
                                    required autocomplete="new-password" style="background-color:#212E36; color: #C8CDD0;" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-label for="password_confirmation" :value="__('Confirmar contraseña')" class="texto"/>

                    <x-input id="password_confirmation" type="password" class="form-control inputOscuro"
                                    name="password_confirmation" style="background-color:#212E36; color: #C8CDD0;" required />
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline" >
                        <a class="texto mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('¿Ya estas registrado?') }}
                        </a>

                        <x-button class="boton">
                            {{ __('Registrarse') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
