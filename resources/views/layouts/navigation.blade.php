<nav class="navbar navbar-expand-md navbar-light border-bottom border-primary sticky-top" style="background-color: #0f2738;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <x-application-logo width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" >
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" style="color: #C8CDD0;">
                    {{ __('Inicio') }}
                </x-nav-link>
                <x-nav-link href="{{ route('albums.index') }}" :active="request()->routeIs('albums.index')" style="color: #C8CDD0;">
                    {{ __('Album') }}
                </x-nav-link>
                <x-nav-link href="{{ route('musics.index') }}" :active="request()->routeIs('musics.index')" style="color: #C8CDD0;">
                    {{ __('Música') }}
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                @auth
                    <x-dropdown id="settingsDropdown" style="color: #C8CDD0;">
                        <x-slot name="trigger">
                            {{ Auth::user()->name }}
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </ul>
        </div>
    </div>
</nav>
