<navbar-element>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">
                {{ config('app.name', 'Ecommervel') }}
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMain">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarMain" class="navbar-menu">
            @auth
                <div class="navbar-start">
                    <a class="navbar-item">
                        Home
                    </a>

                    <a class="navbar-item">
                        Documentation
                    </a>
                </div>
            @endauth
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        @guest
                            @if (Route::has('login'))
                                <a class="button is-link" href="{{ route('login.show') }}">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                <a class="button is-link is-light" href="{{ route('register.show') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <dropdown-element>
                                <div class="navbar-item has-dropdown">
                                    <a class="navbar-link" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="navbar-dropdown is-boxed" aria-labelledby="navbarDropdown">
                                        <a class="navbar-item" href="#">
                                            {{ __('My Posts') }}
                                        </a>
                                        <a class="navbar-item" href={{route('profile.edit')}}>
                                            {{ __('Profile') }}
                                        </a>
                                        <hr class="navbar-divider">
                                        <a class="navbar-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </dropdown-element>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
</navbar-element>