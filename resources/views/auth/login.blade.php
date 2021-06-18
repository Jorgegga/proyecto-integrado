<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('inicios.index')}}">
                <img src="{{URL::asset('storage/img/pagina/logo.png')}}" height="50" width="200">
            </a>
        </x-slot>

        <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-3" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-label for="email" :value="__('Email')" class="texto"/>

                    <x-input id="email" type="email" name="email" class="form-control inputOscuro" style="background-color:#212E36; color: #C8CDD0;" :value="old('email')"  required autofocus />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-label for="password" :value="__('Contraseña')" class="texto"/>

                    <x-input id="password" type="password"
                             name="password"
                             required autocomplete="current-password" class="form-control inputOscuro" style="background-color:#212E36; color: #C8CDD0;" />
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <div class="form-check">
                        <x-checkbox id="remember_me" name="remember" />

                        <label class="form-check-label" for="remember_me" style="color: #EFF3F5;">
                            {{ __('Recuerdame') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="mr-3 texto" href="{{ route('password.request') }}">
                                {{ __('¿Has olvidado tu contraseña?') }}
                            </a>
                        @endif

                        <x-button class="btn boton">
                            {{ __('Log in') }}
                        </x-button>
                        <a href="{{route('inicios.index')}}" class="btn boton texto ml-3">Invitado</a>

                    </div>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
