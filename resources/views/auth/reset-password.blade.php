<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('inicios.index')}}">
                <img src="{{URL::asset('storage/img/pagina/logo.png')}}" height="50" width="200">
            </a>
        </x-slot>


        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-3" :errors="$errors" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <x-label for="email" :value="__('Email')" style="color: #EFF3F5;"/>

                    <x-input id="email" type="email" name="email" :value="old('email', $request->email)" style="background-color:#212E36; color: #C8CDD0;" required autofocus />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-label for="password" :value="__('Nueva contraseña')" style="color: #EFF3F5;"/>

                    <x-input id="password" type="password" name="password" style="background-color:#212E36; color: #C8CDD0;" required />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-label for="password_confirmation" :value="__('Confirmar contraseña')" style="color: #EFF3F5;"/>

                    <x-input id="password_confirmation" type="password"
                                        name="password_confirmation" style="background-color:#212E36; color: #C8CDD0;" required />
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end">
                        <x-button>
                            {{ __('Cambiar contraseña') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
