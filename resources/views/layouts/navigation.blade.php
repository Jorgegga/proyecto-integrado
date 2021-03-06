<nav class="navbar navbar-expand-md navbar-light border-bottom border-primary sticky-top"
    style="background-color: #0f2738;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{route('inicios.index')}}">
            <img src="{{URL::asset('storage/img/pagina/logo.png')}}" height="50" width="200">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Center Side Of Navbar -->
            <ul class="navbar-nav navbar-left">
                <x-nav-link href="{{ route('inicios.index') }}" :active="request()->routeIs('inicios.index')"
                    style="color: #C8CDD0;">
                    {{ __('Inicio') }}
                </x-nav-link>
                <x-nav-link href="{{ route('albums.index') }}" :active="request()->routeIs('albums.index')"
                    style="color: #C8CDD0;">
                    {{ __('Álbum') }}
                </x-nav-link>
                <x-nav-link href="{{ route('autores.index') }}" :active="request()->routeIs('autores.index')"
                    style="color: #C8CDD0;">
                    {{ __('Artistas') }}
                </x-nav-link>
                <x-nav-link href="{{ route('musics.index') }}" :active="request()->routeIs('musics.index')"
                    style="color: #C8CDD0;">
                    {{ __('Música') }}
                </x-nav-link>
                @auth
                <x-nav-link href="{{ route('playlistUser', ['id' => Auth::user()->id, 'user' => Auth::user()->name]) }}"
                    :active="request()->routeIs('playlistUser')" style="color: #C8CDD0;">
                    {{ __('Tu Playlist') }}
                </x-nav-link>
                @endauth
                <x-nav-link href="{{ route('aboutus.index') }}" :active="request()->routeIs('aboutus.index')"
                    style="color: #C8CDD0;">
                    {{ __('About us') }}
                </x-nav-link>
            </ul>
            <!--<img src="/storage/img/otros/default.png" height="100px">-->
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                @auth
                    <x-dropdown id="settingsDropdown" style="color: #C8CDD0;font-size: 32px; font-family: 'Just Another Hand', cursive;">

                        <x-slot name="trigger">
                            {{ Auth::user()->name }}
                        </x-slot>

                        <x-slot name="content">
                            @if (Auth::user()->permisos == 0)
                            <x-dropdown-link
                                :href="route('admins.index', 'tabla=album')">
                                {{ __('Area admin') }} </x-dropdown-link>
                                @endif
                            <x-dropdown-link
                                :href="route('areaUser', ['id'=>Auth::user()->id, 'user'=>Auth::user()->name])">
                                {{ __('Area del usuario') }} </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>
                @endauth
                @guest
                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                        style="color: #C8CDD0;">
                        {{ __('Iniciar sesión') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                        style="color: #C8CDD0;">
                        {{ __('Registrarse') }}
                    </x-nav-link>
                @endguest
            </ul>
        </div>
    </div>
</nav>
